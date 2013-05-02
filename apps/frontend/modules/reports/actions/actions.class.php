<?php

/**
 * reports actions.
 *
 * @package    mediaSCORE
 * @subpackage reports
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reportsActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        
    }

    /**
     * Assets Groups Scoring Reports From reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executeAssetsgroupsscoringreports(sfWebRequest $request) {
        $this->form = new ReportsForm();

        if ($request->isMethod(sfRequest::POST)) {
            $FlagForReport = FALSE;

            $AssetScoreReportArray = array();
            $Assets = array();
            $params = $request->getPostParameter('reports');

            $commonFunctions = new commonFunctions();
            $listUnits_RRD = $params['listUnits_RRD'];
            $format_id = $params['format_id'];
            $ExportType = $params['ExportType'];

            if ($listUnits_RRD) {
                $Units = Doctrine_Query::Create()
                        ->from('Unit u')
                        ->select('u.* ,p.*,sl.*')
                        ->leftJoin('u.Personnel p ')
                        ->leftJoin('u.StorageLocations sl ')
                        ->whereIn('u.id', $listUnits_RRD)
                        ->fetchArray();
            }

            foreach ($Units as $Unit) {
                $Collections = Doctrine_Query::Create()
                        ->from('Collection c')
                        ->select('c.*,sl.*')
                        ->where('c.parent_node_id  = ?', $Unit['id'])
                        ->fetchArray();

                foreach ($Collections as $Collection) {
                    if ($format_id) {
                        $Asset = Doctrine_Query::Create()
                                ->from('AssetGroup a')
                                ->select('a.*, ft.*')
                                ->innerJoin("a.FormatType ft")
                                ->where('a.parent_node_id  = ?', $Collection['id'])
                                ->whereIn('ft.type', $format_id)
                                ->addOrderBy('ft.asset_score DESC')
                                ->fetchArray();
                    }

                    if ($Asset) {
                        foreach ($Asset as $A) {
                            $SolutionArray = array();
                            $SolutionArray['AssetGroup'] = $A;
                            $SolutionArray['Collection'] = $Collection;
                            $SolutionArray['Unit'] = $Unit;
                            $FlagForReport = TRUE;
                            $Assets[] = $SolutionArray;
                        }
                    }
                }
            }


            if ($Assets && $FlagForReport) {
                foreach ($Assets as $Asset) {

                    $formatTypeValuesManager = new formatTypeValuesManager();
                    $AssetScoreReport = array();
                    $AssetScoreReport['score'] = $Asset['AssetGroup']['FormatType']['asset_score'];
                    $AssetScoreReport['Unit ID'] = $Asset['Unit']['id'];
                    $AssetScoreReport['Unit Primary ID'] = $Asset['Unit']['inst_id'];
                    $AssetScoreReport['Unit Name'] = $Asset['Unit']['name'];
                    $AssetScoreReport['Unit Personnel First Name'] = $Asset['Unit']['Personnel'][0]['first_name'];
                    $AssetScoreReport['Unit Personnel Last Name'] = $Asset['Unit']['Personnel'][0]['last_name'];
                    $AssetScoreReport['Unit Personnel Phone'] = $Asset['Unit']['Personnel'][0]['phone'];
                    $AssetScoreReport['Unit Personnel Email'] = $Asset['Unit']['Personnel'][0]['email_address'];
                    $AssetScoreReport['Contact Notes'] = $Asset['Unit']['Personnel'][0]['contact_info'];
                    $AssetScoreReport['Storage Location Name'] = $Asset['Unit']['StorageLocations'][0]['name'];
                    $AssetScoreReport['Storage Location'] = $Asset['Unit']['StorageLocations'][0]['name']; #
                    $AssetScoreReport['Building name/Room number'] = $Asset['Unit']['resident_structure_description']; #resident_structure_description
                    $AssetScoreReport['Storage Location Environment'] = StorageLocation::$constants[$Asset['Unit']['StorageLocations'][0]['env_rating']]; #
                    $AssetScoreReport['Collection ID'] = $Asset['Collection']['id'];
                    $AssetScoreReport['Collection Primary ID'] = $Asset['Collection']['inst_id'];
                    $AssetScoreReport['Collection Name'] = $Asset['Collection']['name'];
                    $AssetScoreReport['Asset Group ID'] = $Asset['Collection']['id'];
                    $AssetScoreReport['Asset Group Primary ID'] = $Asset['AssetGroup']['inst_id'];
                    $AssetScoreReport['Asset Group Name'] = $Asset['AssetGroup']['name'];
                    $AssetScoreReport['Asset Group Description'] = $Asset['AssetGroup']['resident_structure_description']; #
                    $AssetScoreReport['Location'] = $Asset['AssetGroup']['location'];
                    $FormatArray = explode(',', $Asset['AssetGroup']['FormatType']['format']);
                    $format = '';
                    foreach ($FormatArray as $formatValue) {
                        if ($formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue) != '' && $formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue) != NULL)
                            $format .= $formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue) . ' , ';
                    }

                    $AssetScoreReport['Format'] = $format;
                    $AssetScoreReport['Quantity'] = $Asset['AssetGroup']['FormatType']['quantity'];
                    $AssetScoreReport['Generation'] = $Asset['AssetGroup']['FormatType']['generation'];
                    $AssetScoreReport['Year Recorded'] = $Asset['AssetGroup']['FormatType']['year_recorded'];
                    $AssetScoreReport['Copies'] = ($Asset['AssetGroup']['FormatType']['copies'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Stock Brand'] = $Asset['AssetGroup']['FormatType']['stock_brand'];
                    $AssetScoreReport['Off-Brand'] = ($Asset['AssetGroup']['FormatType']['off_brand'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Fungus'] = ($Asset['AssetGroup']['FormatType']['fungus'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Other Contaminants'] = ($Asset['AssetGroup']['FormatType']['other_contaminants'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Duration'] = $Asset['AssetGroup']['FormatType']['duration'];
                    $AssetScoreReport['Duration type'] = FormatTypeForm::$durationtype[$Asset['AssetGroup']['FormatType']['duration_type']];
                    $AssetScoreReport['Duration type Methodology'] = $Asset['AssetGroup']['FormatType']['duration_type_methodology'];
                    $AssetScoreReport['Asset Group format detal fields populate to the right, aligning repetitive fields'] = $Asset['AssetGroup']['FormatType']['format_notes'];
                    $AssetScoreReport['Format Type'] = $Asset['AssetGroup']['type'];
                    if ($AssetScoreReport['score'] != '')
                        $AssetScoreReportArray[] = $AssetScoreReport;
                }
                $AssetScoreReportArray = $commonFunctions->arsort($AssetScoreReportArray, 'score');

                if ($ExportType == 'xls') {
                    $excel = new excel();
                    $excel->setDataArray($AssetScoreReportArray);
                    $excel->extractHeadings();
                    $filename = 'Asset_Group_Score_Report_' . time() . '.xlsx';
                    $Sheettitle = 'Asset_Group_Score_Report';
//                $intial_dicrectory = '\AssetsScore\xls\\';
                    $intial_dicrectory = '/AssetsScore/xls/';
                    $file_name_with_directory = $intial_dicrectory . $filename;


                    $excel->setDataArray($AssetScoreReportArray);
                    $excel->extractHeadings();
                    $excel->setFileName($file_name_with_directory);
                    $excel->setSheetTitle($Sheettitle);

                    $excel->createExcel();

                    $excel->SaveFile();
                    $excel->DownloadXLSX($file_name_with_directory, $filename);
                    $excel->DeleteFile($file_name_with_directory);
                    exit;
                } else {

                    $csvHandler = new csvHandler();

                    $file_name = 'Asset_Group_Score_Report_' . time() . '.csv';
//                $intial_dicrectory = '\RecordingDate\csv\\';
                    $intial_dicrectory = '/AssetsScore/csv/';
                    $file_name_with_directory = $intial_dicrectory . $file_name;
                    $csvHandler->CreateCSV($AssetScoreReportArray, $file_name_with_directory);
                    $csvHandler->DownloadCSV($file_name_with_directory);
                    $csvHandler->DeleteFile($file_name_with_directory);
                    exit;
                }
            } else {
                $Bug = '<script type="text/javascript"> $(function(){
                alert("No Record Found To Export!")                    
                });
                    </script>';
                $this->getResponse()->setSlot('my_slot', $Bug);
            }
        }
    }

    public function executeRecordingdatereport(sfWebRequest $request) {
        $this->form = new ReportsForm();

        if ($request->isMethod(sfRequest::POST)) {
            $FlagForReport = FALSE;

            $AssetScoreReportArray = array();
            $Assets = array();

            $params = $request->getPostParameter('reports');

            $commonFunctions = new commonFunctions();
            $listUnits_RRD = $params['listUnits_RRD'];
            $format_id = $params['format_id'];
            $ExportType = $params['ExportType'];

            if ($listUnits_RRD) {
                $Units = Doctrine_Query::Create()
                        ->from('Unit u')
                        ->select('u.* ,p.*,sl.*')
                        ->leftJoin('u.Personnel p ')
                        ->leftJoin('u.StorageLocations sl ')
                        ->whereIn('u.id', $listUnits_RRD)
                        ->fetchArray();
            }

            foreach ($Units as $Unit) {
                $Collections = Doctrine_Query::Create()
                        ->from('Collection c')
                        ->select('c.*,sl.*')
                        ->where('c.parent_node_id  = ?', $Unit['id'])
                        ->fetchArray();

                foreach ($Collections as $Collection) {
                    $Asset = Doctrine_Query::Create()
                            ->from('AssetGroup a')
                            ->select('a.*, ft.*')
                            ->innerJoin("a.FormatType ft")
                            ->where('a.parent_node_id  = ?', $Collection['id'])
                            ->orderBy('ft.year_recorded DESC')
                            ->fetchArray();

                    if ($Asset) {
                        foreach ($Asset as $A) {
                            $SolutionArray = array();
                            $SolutionArray['AssetGroup'] = $A;
                            $SolutionArray['Collection'] = $Collection;
                            $SolutionArray['Unit'] = $Unit;
                            $FlagForReport = TRUE;
                            $Assets[] = $SolutionArray;
                        }
                    }
                }
            }


            if ($Assets && $FlagForReport) {
                foreach ($Assets as $Asset) {

                    $formatTypeValuesManager = new formatTypeValuesManager();
                    $AssetScoreReport = array();
                    $AssetScoreReport['Year Recorded'] = $Asset['AssetGroup']['FormatType']['year_recorded'];
                    $AssetScoreReport['score'] = $Asset['AssetGroup']['FormatType']['asset_score'];
                    $AssetScoreReport['Unit ID'] = $Asset['Unit']['id'];
                    $AssetScoreReport['Unit Primary ID'] = $Asset['Unit']['inst_id'];
                    $AssetScoreReport['Unit Name'] = $Asset['Unit']['name'];
                    $AssetScoreReport['Unit Personnel First Name'] = $Asset['Unit']['Personnel'][0]['first_name'];
                    $AssetScoreReport['Unit Personnel Last Name'] = $Asset['Unit']['Personnel'][0]['last_name'];
                    $AssetScoreReport['Unit Personnel Phone'] = $Asset['Unit']['Personnel'][0]['phone'];
                    $AssetScoreReport['Unit Personnel Email'] = $Asset['Unit']['Personnel'][0]['email_address'];
                    $AssetScoreReport['Contact Notes'] = $Asset['Unit']['Personnel'][0]['contact_info'];
                    $AssetScoreReport['Storage Location Name'] = $Asset['Unit']['StorageLocations'][0]['name'];
                    $AssetScoreReport['Storage Location'] = $Asset['Unit']['StorageLocations'][0]['name']; #
                    $AssetScoreReport['Building name/Room number'] = $Asset['Unit']['resident_structure_description']; #resident_structure_description
                    $AssetScoreReport['Storage Location Environment'] = StorageLocation::$constants[$Asset['Unit']['StorageLocations'][0]['env_rating']]; #
                    $AssetScoreReport['Collection ID'] = $Asset['Collection']['id'];
                    $AssetScoreReport['Collection Primary ID'] = $Asset['Collection']['inst_id'];
                    $AssetScoreReport['Collection Name'] = $Asset['Collection']['name'];
                    $AssetScoreReport['Asset Group ID'] = $Asset['Collection']['id'];
                    $AssetScoreReport['Asset Group Primary ID'] = $Asset['AssetGroup']['inst_id'];
                    $AssetScoreReport['Asset Group Name'] = $Asset['AssetGroup']['name'];
                    $AssetScoreReport['Asset Group Description'] = $Asset['AssetGroup']['resident_structure_description']; #
                    $AssetScoreReport['Location'] = $Asset['AssetGroup']['location'];
                    $FormatArray = explode(',', $Asset['AssetGroup']['FormatType']['format']);
                    $format = '';
                    foreach ($FormatArray as $formatValue) {
                        if ($formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue) != '' && $formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue) != NULL)
                            $format .= $formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue) . ' , ';
                    }
                    $AssetScoreReport['Format'] = $format;
                    $AssetScoreReport['Quantity'] = $Asset['AssetGroup']['FormatType']['quantity'];
                    $AssetScoreReport['Generation'] = $Asset['AssetGroup']['FormatType']['generation'];
                    $AssetScoreReport['Copies'] = ($Asset['AssetGroup']['FormatType']['copies'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Stock Brand'] = $Asset['AssetGroup']['FormatType']['stock_brand'];
                    $AssetScoreReport['Off-Brand'] = ($Asset['AssetGroup']['FormatType']['off_brand'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Fungus'] = ($Asset['AssetGroup']['FormatType']['fungus'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Other Contaminants'] = ($Asset['AssetGroup']['FormatType']['other_contaminants'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Duration'] = $Asset['AssetGroup']['FormatType']['duration'];
                    $AssetScoreReport['Duration type'] = FormatTypeForm::$durationtype[$Asset['AssetGroup']['FormatType']['duration_type']];
                    $AssetScoreReport['Duration type Methodology'] = $Asset['AssetGroup']['FormatType']['duration_type_methodology'];
                    $AssetScoreReport['Asset Group format detal fields populate to the right, aligning repetitive fields'] = $Asset['AssetGroup']['FormatType']['format_notes'];
                    $AssetScoreReport['Format Type'] = $Asset['AssetGroup']['type'];
                    if ($AssetScoreReport['score'] != '')
                        $AssetScoreReportArray[] = $AssetScoreReport;
                }
                $AssetScoreReportArray = $commonFunctions->arsort($AssetScoreReportArray, 'Year Recorded');

                if ($ExportType == 'xls') {
                    $excel = new excel();
                    $excel->setDataArray($AssetScoreReportArray);
                    $excel->extractHeadings();
                    $filename = 'Asset_Group_Score_Report_' . time() . '.xlsx';
                    $Sheettitle = 'Asset_Group_Score_Report';
                    $intial_dicrectory = '/AssetsScore/xls/';
                    $file_name_with_directory = $intial_dicrectory . $filename;


                    $excel->setDataArray($AssetScoreReportArray);
                    $excel->extractHeadings();
                    $excel->setFileName($file_name_with_directory);
                    $excel->setSheetTitle($Sheettitle);

                    $excel->createExcel();

                    $excel->SaveFile();
                    $excel->DownloadXLSX($file_name_with_directory, $filename);
                    $excel->DeleteFile($file_name_with_directory);
                    exit;
                } else {

                    $csvHandler = new csvHandler();

                    $file_name = 'Asset_Group_Score_Report_' . time() . '.csv';
                    $intial_dicrectory = '/AssetsScore/csv/';
                    $file_name_with_directory = $intial_dicrectory . $file_name;
                    $csvHandler->CreateCSV($AssetScoreReportArray, $file_name_with_directory);
                    $csvHandler->DownloadCSV($file_name_with_directory);
                    $csvHandler->DeleteFile($file_name_with_directory);
                    exit;
                }
            } else {
                $Bug = '<script type="text/javascript"> $(function(){
                alert("No Record Found To Export!")                    
                });
                    </script>';
                $this->getResponse()->setSlot('my_slot', $Bug);
            }
        }
    }

    /**
     * Assets Groups Collection Status Report From reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executeCollectionstatusreport(sfWebRequest $request) {
        $this->form = new ReportsForm();
        if ($request->isMethod(sfRequest::POST)) {
            $params = $request->getPostParameter('reports');
            $commonFunctions = new commonFunctions();

            $Collection_id = $params['listCollection_RRD'];
            $Units_id = $params['listUnits_RRD'];
            $collectionStatus = $params['collectionStatus'];
            $ExportType = $params['ExportType'];

            $collectionStatusReports = array();

            $Units = Doctrine_Query::Create()
                    ->from('Unit u')
                    ->select('u.*')
                    ->whereIn('u.id', $Units_id)
                    ->fetchArray();

            $collections = array();
            foreach ($Units as $Unit) {
                if ($Collection_id) {
                    $Collections = Doctrine_Query::Create()
                            ->from('Collection c')
                            ->select('c.*,s.*,cu.*,eu.*')
                            ->leftJoin('c.StorageLocations s')
                            ->leftJoin('c.Creator cu')
                            ->leftJoin('c.Editor eu')
                            ->where('c.parent_node_id  = ?', $Unit['id'])
                            ->whereIn('c.id', $Collection_id)
                            ->fetchArray();
                }

                $SolutionArray = array();
                foreach ($Collections as $Collection) {
                    if (in_array($Collection['status'], $collectionStatus)) {
                        $SolutionArray['Collection'] = $Collection;
                        $SolutionArray['Unit'] = $Unit;
                        $collections[] = $SolutionArray;
                    }
                }
            }
            echo '<pre>';
            print_r($collections);
            exit;
            if ($collections) {
                foreach ($collections as $collection) {
                    $collectionStatusReport = array();
                    $collectionStatusReport['Uuit ID'] = $collection['Unit']['id'];
                    $collectionStatusReport['Unit Primary ID'] = $collection['Unit']['inst_id'];
                    $collectionStatusReport['Unit Name'] = $collection['Unit']['name'];
                    $collectionStatusReport['Storage Location Name'] = $collection['Collection']['StorageLocations'][0]['name'];
                    $collectionStatusReport['Storage Location Building name/Room number'] = $collection['Collection']['resident_structure_description'];
                    $collectionStatusReport['Collection ID'] = $collection['Collection']['id'];
                    $collectionStatusReport['Collection Primary ID'] = $collection['Collection']['inst_id'];
                    $collectionStatusReport['Collection Name'] = $collection['Collection']['name'];
                    $collectionStatusReport['Status'] = Collection::$statusConstants[$collection['Collection']['status']];
                    $collectionStatusReport['Collection Created On Date'] = $collection['Unit']['created_at'];
                    $collectionStatusReport['Collection Created By'] = $collection['Collection']['Creator']['first_name'] . ' ' . $collection['Collection']['Creator']['last_name'];
                    $collectionStatusReport['Collection Updated On Date'] = $collection['Collection']['updated_at'];
                    $collectionStatusReport['Collection Updated By'] = $collection['Collection']['Editor']['first_name'] . ' ' . $collection['Collection']['Editor']['last_name'];
                    $collectionStatusReports[] = $collectionStatusReport;
                }
                $collectionStatusReports = $commonFunctions->arsort($collectionStatusReports, 'Uuit ID');

                if ($ExportType == 'xls') {
                    $excel = new excel();
                    $excel->setDataArray($collectionStatusReports);
                    $excel->extractHeadings();
                    $filename = 'Collection_Status_Report_' . time() . '.xlsx';
                    $Sheettitle = 'Collection_Status_Report';
                    $intial_dicrectory = '/CollectionStatusReport/xls/';
                    $file_name_with_directory = $intial_dicrectory . $filename;

                    $excel->setDataArray($collectionStatusReports);
                    $excel->extractHeadings();
                    $excel->setFileName($file_name_with_directory);
                    $excel->setSheetTitle($Sheettitle);

                    $excel->createExcel();

                    $excel->SaveFile();
                    $excel->DownloadXLSX($file_name_with_directory, $filename);
                    $excel->DeleteFile($file_name_with_directory);
                    exit;
                } else {

                    $csvHandler = new csvHandler();

                    $file_name = 'Collection_Status_Report_' . time() . '.csv';

                    $intial_dicrectory = '/CollectionStatusReport/csv/';
                    $file_name_with_directory = $intial_dicrectory . $file_name;
                    $csvHandler->CreateCSV($collectionStatusReports, $file_name_with_directory);
                    $csvHandler->DownloadCSV($file_name_with_directory);
                    $csvHandler->DeleteFile($file_name_with_directory);
                    exit;
                }
//            } else {
//                $Bug = '<script type="text/javascript"> $(function(){
//                alert("No Record Found To Export!")                    
//                });
//                    </script>';
//                $this->getResponse()->setSlot('my_slot', $Bug);
//            }
            }else{
                 $Bug = '<script type="text/javascript"> $(function(){ alert("No Record Found To Export!"); }); </script>';
                $this->getResponse()->setSlot('my_slot', $Bug);
            }
        }
    }

    /**
     * Problem Media Report Report From reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executeProblemmediareport(sfWebRequest $request) {
        $this->form = new ReportsForm();
        if ($request->isMethod(sfRequest::POST)) {
            $commonFunctions = new commonFunctions();
            $formatTypeValuesManager = new formatTypeValuesManager();
            $Assets = array();
            $AssetScoreReportArray = array();
            $params = $request->getPostParameter('reports');

            $Collection_id = $params['listCollection_RRD'];
            $Constraints = $params['Constraints'];
            $ExportType = $params['ExportType'];


            $Units = Doctrine_Query::Create()
                    ->from('Unit u')
                    ->select('u.* ,p.*,sl.*')
                    ->leftJoin('u.Personnel p ')
                    ->leftJoin('u.StorageLocations sl ')
                    ->fetchArray();

            foreach ($Units as $Unit) {
                $Collections = Doctrine_Query::Create()
                        ->from('Collection c')
                        ->select('c.*')
                        ->where('c.parent_node_id  = ?', $Unit['id'])
                        ->whereIn('c.id', $Collection_id)
                        ->fetchArray();


                foreach ($Collections as $Collection) {
                    $Asset = Doctrine_Query::Create()
                            ->from('AssetGroup a')
                            ->select('a.*, ft.*')
                            ->leftJoin("a.FormatType ft")
                            ->where('a.parent_node_id  = ?', $Collection['id'])
                            ->addOrderBy('ft.asset_score DESC')
                            ->fetchArray();
                    if ($Asset) {
                        foreach ($Asset as $A) {
                            $addAssetFlag = FALSE;
                            foreach ($Constraints as $Constraint) {
                                if (strstr($Constraint, 'pack_deformation')) {
                                    $pack_deforemation = explode('-', $Constraint);

                                    if ($A['FormatType'][$pack_deforemation[0]] == $pack_deforemation[1]) {
                                        $addAssetFlag = TRUE;
                                    }
                                } else {
                                    if ($A['FormatType'][$Constraint] != '') {
                                        $addAssetFlag = TRUE;
                                    }
                                }
                            }
                            $addAssetFlag = TRUE;
                            $SolutionArray = array();
                            if ($addAssetFlag) {
                                $SolutionArray['AssetGroup'] = $A;
                                $SolutionArray['Collection'] = $Collection;
                                $SolutionArray['Unit'] = $Unit;

                                $Assets[] = $SolutionArray;
                            }
                        }
                    }
                }
            }

            if ($Assets) {
                foreach ($Assets as $Asset) {
                    ReportsForm::$constraintsArray;

                    $AssetScoreReport['score'] = $Asset['AssetGroup']['FormatType']['asset_score'];
                    $AssetScoreReport['Unit ID'] = $Asset['Unit']['id'];
                    $AssetScoreReport['Unit Primary ID'] = $Asset['Unit']['inst_id'];
                    $AssetScoreReport['Unit Name'] = $Asset['Unit']['name'];
                    $AssetScoreReport['Unit Personnel First Name'] = $Asset['Unit']['Personnel'][0]['first_name'];
                    $AssetScoreReport['Unit Personnel Last Name'] = $Asset['Unit']['Personnel'][0]['last_name'];
                    $AssetScoreReport['Unit Personnel Phone'] = $Asset['Unit']['Personnel'][0]['phone'];
                    $AssetScoreReport['Unit Personnel Email'] = $Asset['Unit']['Personnel'][0]['email_address'];
                    $AssetScoreReport['Contact Notes'] = $Asset['Unit']['Personnel'][0]['contact_info'];
                    $AssetScoreReport['Storage Location Name'] = $Asset['Unit']['StorageLocations'][0]['name'];
                    $AssetScoreReport['Storage Location'] = $Asset['Unit']['StorageLocations'][0]['name']; #
                    $AssetScoreReport['Building name/Room number'] = $Asset['Unit']['resident_structure_description']; #resident_structure_description
                    $AssetScoreReport['Storage Location Environment'] = StorageLocation::$constants[$Asset['Unit']['StorageLocations'][0]['env_rating']]; #
                    $AssetScoreReport['Collection ID'] = $Asset['Collection']['id'];
                    $AssetScoreReport['Collection Primary ID'] = $Asset['Collection']['inst_id'];
                    $AssetScoreReport['Collection Name'] = $Asset['Collection']['name'];
                    $AssetScoreReport['Asset Group ID'] = $Asset['Collection']['id'];
                    $AssetScoreReport['Asset Group Primary ID'] = $Asset['AssetGroup']['inst_id'];
                    $AssetScoreReport['Asset Group Name'] = $Asset['AssetGroup']['name'];
                    $AssetScoreReport['Asset Group Description'] = $Asset['AssetGroup']['resident_structure_description']; #
                    $AssetScoreReport['Location'] = $Asset['AssetGroup']['location'];
                    $FormatArray = explode(',', $Asset['AssetGroup']['FormatType']['format']);
                    $format = '';
                    foreach ($FormatArray as $formatValue) {
                        if ($formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue) != '' && $formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue) != NULL)
                            $format .= $formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue) . ' , ';
                    }

                    $AssetScoreReport['Format'] = $format;
                    $AssetScoreReport['Quantity'] = $Asset['AssetGroup']['FormatType']['quantity'];
                    $AssetScoreReport['Generation'] = $Asset['AssetGroup']['FormatType']['generation'];
                    $AssetScoreReport['Year Recorded'] = $Asset['AssetGroup']['FormatType']['year_recorded'];
                    $AssetScoreReport['Copies'] = ($Asset['AssetGroup']['FormatType']['copies'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Stock Brand'] = $Asset['AssetGroup']['FormatType']['stock_brand'];
                    $AssetScoreReport['Off-Brand'] = ($Asset['AssetGroup']['FormatType']['off_brand'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Fungus'] = ($Asset['AssetGroup']['FormatType']['fungus'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Other Contaminants'] = ($Asset['AssetGroup']['FormatType']['other_contaminants'] == '1') ? 'Yes' : 'No';
                    $AssetScoreReport['Duration'] = $Asset['AssetGroup']['FormatType']['duration'];
                    $AssetScoreReport['Duration type'] = FormatTypeForm::$durationtype[$Asset['AssetGroup']['FormatType']['duration_type']];
                    $AssetScoreReport['Duration type Methodology'] = $Asset['AssetGroup']['FormatType']['duration_type_methodology'];
                    $AssetScoreReport['Asset Group format detal fields populate to the right, aligning repetitive fields'] = $Asset['AssetGroup']['FormatType']['format_notes'];
                    $AssetScoreReport['Format Type'] = $Asset['AssetGroup']['type'];
                    if ($AssetScoreReport['score'] != '')
                        $AssetScoreReportArray[] = $AssetScoreReport;
                }
                $AssetScoreReportArray = $commonFunctions->arsort($AssetScoreReportArray, 'score');
                if ($ExportType == 'xls') {
                    $excel = new excel();
                    $excel->setDataArray($AssetScoreReportArray);
                    $excel->extractHeadings();
                    $filename = 'Asset_Group_Score_Report_' . time() . '.xlsx';
                    $Sheettitle = 'Asset_Group_Score_Report';
//                $intial_dicrectory = '\AssetsScore\xls\\';
                    $intial_dicrectory = '/AssetsScore/xls/';
                    $file_name_with_directory = $intial_dicrectory . $filename;


                    $excel->setDataArray($AssetScoreReportArray);
                    $excel->extractHeadings();
                    $excel->setFileName($file_name_with_directory);
                    $excel->setSheetTitle($Sheettitle);

                    $excel->createExcel();

                    $excel->SaveFile();
                    $excel->DownloadXLSX($file_name_with_directory, $filename);
                    $excel->DeleteFile($file_name_with_directory);
                    exit;
                } else {

                    $csvHandler = new csvHandler();

                    $file_name = 'Asset_Group_Score_Report_' . time() . '.csv';
//                $intial_dicrectory = '\RecordingDate\csv\\';
                    $intial_dicrectory = '/AssetsScore/csv/';
                    $file_name_with_directory = $intial_dicrectory . $file_name;
                    $csvHandler->CreateCSV($AssetScoreReportArray, $file_name_with_directory);
                    $csvHandler->DownloadCSV($file_name_with_directory);
                    $csvHandler->DeleteFile($file_name_with_directory);
                    exit;
                }
            } else {
                $Bug = '<script type="text/javascript"> $(function(){
                alert("No Record Found To Export!")                    
                });
                    </script>';
                $this->getResponse()->setSlot('my_slot', $Bug);
            }
        }
    }

    /**
     * Problem Media Report Report From reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executeAlldataoutputreport(sfWebRequest $request) {
        $this->form = new ReportsForm();

        if ($request->isMethod(sfRequest::POST)) {
            $param = $request->getPostParameters();
            echo '<pre>';
            if ($param['reports']['listReports'] == '0') {


                $Units = Doctrine_Query::Create()
                        ->from('Unit u')
                        ->select('u.*,sl.*,p.*,cu.*,eu.*')
                        ->leftJoin('u.Creator cu')
                        ->leftJoin('u.Editor eu')
                        ->leftJoin('u.StorageLocations sl')
                        ->leftJoin('u.Personnel p')
                        ->fetchArray();
                foreach ($Units as $Unit) {
                    $Collections = Doctrine_Query::Create()
                            ->from('Collection c')
                            ->select('c.*,sl.*,cu.*,eu.*')
                            ->leftJoin('c.StorageLocations sl')
                            ->leftJoin('c.Creator cu')
                            ->leftJoin('c.Editor eu')
                            ->where('c.parent_node_id  = ?', $Unit['id'])
                            ->fetchArray();
                    foreach ($Collections as $Collection) {
                        $Asset = Doctrine_Query::Create()
                                ->from('AssetGroup a')
                                ->select('a.*, ft.*,eh.*,cu.*,eu.*')
                                ->leftJoin("a.FormatType ft")
                                ->leftJoin("a.EvaluatorHistory eh")
                                ->leftJoin('a.Creator cu')
                                ->leftJoin('a.Editor eu')
                                ->where('a.parent_node_id  = ?', $Collection['id'])
                                ->addOrderBy('ft.asset_score DESC')
                                ->fetchArray();
                        $SolutionArray = array();
                        foreach ($Asset as $A) {
                            $SolutionArray['AssetGroup'] = $A;
                            $SolutionArray['Collection'] = $Collection;
                            $SolutionArray['Unit'] = $Unit;

                            $Assets[] = $SolutionArray;
                        }
                    }
                }
                echo '<pre>';
//                print_r($Units);
                print_r($Assets);
                exit;
                if ($Assets) {
                    foreach ($Assets as $Asset) {
                        $AssetScoreReport['Unit ID'] = $Asset['Unit']['id'];
                        $AssetScoreReport['Unit Primary ID'] = $Asset['Unit']['inst_id'];
                        $AssetScoreReport['Unit Name'] = $Asset['Unit']['name'];

                        $AssetScoreReport['Building name/Room number'] = $Asset['Unit']['StorageLocations']['resident_structure_description'];
                        $AssetScoreReport['Contact Notes'] = $Asset['Unit']['notes'];
                        $AssetScoreReport['Storage Location Name'] = $Asset['Unit']['StorageLocations']['name'];

                        $AssetScoreReport['Unit Personnel ID'] = $Asset['Unit']['Personnel'][0]['id'];
                        $AssetScoreReport['Unit Personnel First Name'] = $Asset['Unit']['Personnel'][0]['first_name'];
                        $AssetScoreReport['Unit Personnel Last Name'] = $Asset['Unit']['Personnel'][0]['last_name'];
                        $AssetScoreReport['Unit Personnel Role'] = $Asset['Unit']['Personnel'][0]['role'];
                        $AssetScoreReport['Unit Personnel Email'] = $Asset['Unit']['Personnel'][0]['email_address'];
                        $AssetScoreReport['Unit Personnel Phone'] = $Asset['Unit']['Personnel'][0]['phone'];

                        $AssetScoreReport['Unit Created'] = $Asset['Unit']['created_at'];
                        $AssetScoreReport['Unit Created By'] = $Asset['Unit']['Creator']['first_name'] . ' ' . $Asset['Unit']['Creator']['last_name']; #
                        $AssetScoreReport['User ID'] = $Asset['Unit']['Creator']['id'];
                        $AssetScoreReport['User First Name'] = $Asset['Unit']['Creator']['first_name'];
                        $AssetScoreReport['User Last Name'] = $Asset['Unit']['Creator']['last_name'];
                        $AssetScoreReport['User e-mail'] = $Asset['Unit']['Creator']['email_address'];
                        $AssetScoreReport['User Phone'] = $Asset['Unit']['Creator']['phone'];
                        $AssetScoreReport['User Role'] = $Asset['Unit']['Creator']['role'];

                        $AssetScoreReport['Unit Updated On'] = $Asset['Unit']['updated_at'];
                        $AssetScoreReport['Unit Updated By'] = $Asset['Unit']['Editor']['first_name'] . ' ' . $Asset['Unit']['Editor']['last_name'];
                        $AssetScoreReport['User ID'] = $Asset['Unit']['Editor']['id'];
                        $AssetScoreReport['User First Name'] = $Asset['Unit']['Editor']['first_name'];
                        $AssetScoreReport['User Last Name'] = $Asset['Unit']['Editor']['last_name'];
                        $AssetScoreReport['User e-mail'] = $Asset['Unit']['Editor']['email_address'];
                        $AssetScoreReport['User Phone'] = $Asset['Unit']['Editor']['phone'];
                        $AssetScoreReport['User Role'] = $Asset['Unit']['Editor']['role'];

                        $AssetScoreReport['Collection ID'] = $Asset['Collection']['id'];
                        $AssetScoreReport['Collection Primary ID'] = $Asset['Collection']['inst_id'];
                        $AssetScoreReport['Collection Name'] = $Asset['Collection']['name'];
                        $AssetScoreReport['Collection Description'] = $Asset['Collection']['resident_structure_description'];


                        $AssetScoreReport['Storage Location ID'] = $Asset['Collection']['StorageLocations']['id'];
                        $AssetScoreReport['Storage Location Name'] = $Asset['Collection']['StorageLocations']['name'];
                        $AssetScoreReport['Storage Location'] = $Asset['Collection']['Editor']['name'];
                        $AssetScoreReport['Building name/Room number'] = $Asset['Collection']['StorageLocations']['resident_structure_description'];
                        $AssetScoreReport['Storage Location Environment'] = StorageLocation::$constants[$Asset['Collection']['StorageLocations'][0]['env_rating']]; #$Asset['Collection']['StorageLocations']['role'];

                        $AssetScoreReport['Unit Personnel ID'] = $Asset['Unit']['Personnel'][0]['id'];
                        $AssetScoreReport['Unit Personnel First Name'] = $Asset['Unit']['Personnel'][0]['first_name'];
                        $AssetScoreReport['Unit Personnel Last Name'] = $Asset['Unit']['Personnel'][0]['last_name'];
                        $AssetScoreReport['Unit Personnel Role'] = $Asset['Unit']['Personnel'][0]['role'];
                        $AssetScoreReport['Unit Personnel Email'] = $Asset['Unit']['Personnel'][0]['email_address'];
                        $AssetScoreReport['Unit Personnel Phone'] = $Asset['Unit']['Personnel'][0]['phone'];



                        $AssetScoreReport['Collection Created'] = $Asset['Collection']['created_at'];
                        $AssetScoreReport['Collection Created By'] = $Asset['Collection']['Creator']['first_name'] . ' ' . $Asset['Collection']['Creator']['last_name']; #
                        $AssetScoreReport['User ID'] = $Asset['Collection']['Creator']['id'];
                        $AssetScoreReport['User First Name'] = $Asset['Collection']['Creator']['first_name'];
                        $AssetScoreReport['User Last Name'] = $Asset['Collection']['Creator']['last_name'];
                        $AssetScoreReport['User e-mail'] = $Asset['Collection']['Creator']['email_address'];
                        $AssetScoreReport['User Phone'] = $Asset['Collection']['Creator']['phone'];
                        $AssetScoreReport['User Role'] = $Asset['Collection']['Creator']['role'];

                        $AssetScoreReport['Collection'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Updated On'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Collection Updated By'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User ID'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User First Name'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User Last Name'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User e-mail'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User Phone'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User Role'] = $Asset['Unit']['Editor']['role'];





                        $AssetScoreReport['Asset Group ID'] = $Asset['AssetGroup']['id'];
                        $AssetScoreReport['Asset Group Primary ID'] = $Asset['AssetGroup']['inst_id'];
                        $AssetScoreReport['Asset Group Name'] = $Asset['AssetGroup']['name'];

                        $AssetScoreReport['Storage Location Name'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Asset Group Description Location'] = $Asset['Unit']['Editor']['role'];


                        $AssetScoreReport['Asset Group Created'] = $Asset['AssetGroup']['created_at'];

                        $AssetScoreReport['Asset Group Created By User ID'] = $Asset['AssetGroup']['Creator']['id'];
                        $AssetScoreReport['User First Name'] = $Asset['AssetGroup']['Creator']['first_name'];
                        $AssetScoreReport['User Last Name'] = $Asset['AssetGroup']['Creator']['last_name'];
                        $AssetScoreReport['User e-mail'] = $Asset['AssetGroup']['Creator']['email_address'];
                        $AssetScoreReport['User Phone'] = $Asset['AssetGroup']['Creator']['phone'];
                        $AssetScoreReport['User Role'] = $Asset['AssetGroup']['Creator']['role'];


                        $AssetScoreReport['Asset Group'] = $Asset['AssetGroup']['name'];
                        $AssetScoreReport['Updated On'] = $Asset['AssetGroup']['Editor']['role'];
                        $AssetScoreReport['Asset Group Updated By'] = $Asset['AssetGroup']['Editor']['first_name'] . ' ' . $Asset['AssetGroup']['Editor']['last_name']; #;
                        $AssetScoreReport['User ID'] = $Asset['AssetGroup']['Editor']['role'];
                        $AssetScoreReport['User First Name'] = $Asset['AssetGroup']['Editor']['role'];
                        $AssetScoreReport['User Last Name'] = $Asset['AssetGroup']['Editor']['role'];
                        $AssetScoreReport['User e-mail'] = $Asset['AssetGroup']['Editor']['role'];
                        $AssetScoreReport['User Phone'] = $Asset['AssetGroup']['Editor']['role'];
                        $AssetScoreReport['User Role'] = $Asset['AssetGroup']['Editor']['role'];


                        $AssetScoreReport['Asset Group Date'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Asset Group Person'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User ID'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User First Name'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User Last Name'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User e-mail'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User Phone'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['User Role'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Asset Group In consultation With'] = $Asset['Unit']['Editor']['role'];


                        $AssetScoreReport['Unit Personnel ID'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Unit Personnel First Name'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Unit Personnel Last Name'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Unit Personnel Role'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Unit Personnel Email'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Unit Personnel Phone'] = $Asset['Unit']['Editor']['role'];


                        $AssetScoreReport['Format	Quantity'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Generation'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Year Recorded'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Copies'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Stock Brand'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Off-Brand'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Fungus'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Other Contaminants'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Duration'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['uration type'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Duration type Methodology'] = $Asset['Unit']['Editor']['role'];
                        $AssetScoreReport['Format specific fields'] = $Asset['Unit']['Editor']['role'];
                    }
                }
            }
        }
    }

}