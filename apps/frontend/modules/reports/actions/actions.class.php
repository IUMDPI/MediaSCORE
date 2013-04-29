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
                        ->innerJoin('u.Personnel p ')
                        ->innerJoin('u.StorageLocations sl ')
                        ->where('u.id  = ?', $listUnits_RRD)
                        ->fetchArray();
            } else {

                $Units = Doctrine_Query::Create()
                        ->from('Unit u')
                        ->select('u.* ,p.*,sl.*')
                        ->innerJoin('u.Personnel p ')
                        ->innerJoin('u.StorageLocations sl ')
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
                                ->where('ft.type  = ?', $format_id)
                                ->addOrderBy('ft.asset_score DESC')
                                ->fetchArray();
                    } else {

                        $Asset = Doctrine_Query::Create()
                                ->from('AssetGroup a')
                                ->select('a.*, ft.*')
                                ->innerJoin("a.FormatType ft")
                                ->where('a.parent_node_id  = ?', $Collection['id'])
                                ->addOrderBy('ft.asset_score DESC')
                                ->fetchArray();
                    }

                    $SolutionArray = array();
                    $SolutionArray['AssetGroup'] = $Asset[0];
                    $SolutionArray['Collection'] = $Collection;
                    $SolutionArray['Unit'] = $Unit;
                    $Assets[] = $SolutionArray;
                }
            }

            foreach ($Assets as $Asset) {
                $FormatType = FormatType::$formatTypesValue1d[$Asset['AssetGroup']['type']];
                foreach (FormatType::$typeNames as $typeNames) {
                    foreach ($typeNames as $key => $type) {
                        if ($type == $FormatType) {
                            $value = $key;
                        }
                    }
                }
                $value::$constants;
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
                $AssetScoreReport['Collection Name'] = $Asset['Collection']['name']; #
                $AssetScoreReport['Asset Group ID'] = $Asset['Collection']['id']; #
                $AssetScoreReport['Asset Group Primary ID'] = $Asset['AssetGroup']['inst_id'];
                $AssetScoreReport['Asset Group Name'] = $Asset['AssetGroup']['name'];
                $AssetScoreReport['Asset Group Description'] = $Asset['AssetGroup']['resident_structure_description']; #
                $AssetScoreReport['Location'] = $Asset['AssetGroup']['location']; #
                $AssetScoreReport['Format'] = $Asset['AssetGroup']['FormatType']['format'];
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
                $AssetScoreReportArray[] = $AssetScoreReport;
            }
            $AssetScoreReportArray = $commonFunctions->arsort($AssetScoreReportArray, 'score');

            if ($ExportType == 'xls') {
                $excel = new excel();
                $excel->setDataArray($AssetScoreReportArray);
                $excel->extractHeadings();
                $filename = 'Asset_Group_Score_Report_' . date('M D Y-His', time()) . '.xlsx';
                $Sheettitle = 'Asset_Group_Score_Report';
                $intial_dicrectory = '\AssetsScore\xls\\';
                $file_name_with_directory = $intial_dicrectory . $filename;


                $excel->setDataArray($AssetScoreReportArray);
                $excel->extractHeadings();
                $excel->setFileName($file_name_with_directory);
                $excel->setSheetTitle($Sheettitle);

                $excel->createExcel();

                $excel->SaveFile();
                $excel->DownloadXLSX($file_name_with_directory, $filename);
//                $excel->DeleteFile($file_name_with_directory);
                exit;
            } else {

                $csvHandler = new csvHandler();

                $file_name = 'Recording_Date_Report_' . date('M D Y-His', time()) . '.csv';
                $intial_dicrectory = '\RecordingDate\csv\\';
                $file_name_with_directory = $intial_dicrectory . $file_name;
                $csvHandler->CreateCSV($AssetScoreReportArray, $file_name_with_directory);
                $csvHandler->DownloadCSV($file_name_with_directory);
//                $csvHandler->DeleteFile($file_name_with_directory);
                exit;
            }
        }
    }

    /**
     * Assets Groups Scoring Reports From reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executeRecordingdatereport(sfWebRequest $request) {

        $this->form = new ReportsForm();

        if ($request->isMethod(sfRequest::POST)) {

            $commonFunctions = new commonFunctions();
            $ExportArray = array();
            $params = $request->getPostParameter('reports');
            $unit_id = $params['listUnits'];
            $Type = $params['ExportType'];

            if (!empty($unit_id)) {
                $Units = Doctrine_Query::Create()
                        ->from('Unit u')
                        ->select('u.*')
                        ->where('u.id = ?', $unit_id)
                        ->execute();
            } else {
                $Units = Doctrine_Query::Create()
                        ->from('Unit u')
                        ->select('u.*')
                        ->execute();
            }

            $index = 0;
            foreach ($Units AS $Unit) {

                $collections = Doctrine_Query::Create()
                        ->from('Collection c')
                        ->select('c.*')
                        ->where('c.parent_node_id  = ?', $Unit->getId())
                        ->fetchArray();

                foreach ($collections as $collection) {
                    $check = Doctrine_Query::Create()
                            ->from('AssetGroup a')
                            ->select('a.*,ft.*')
                            ->where("a.parent_node_id = ?", $collection['id'])
                            ->innerJoin("a.FormatType ft")
                            ->orderBy('ft.year_recorded DESC')
                            ->fetchArray();

                    foreach ($check as $c) {
                        $thisFormat = '';
                        foreach (FormatType::$formatTypesValue as $formatType) {
                            if (!empty($formatType[$c['FormatType']['type']])) {
                                $thisFormat = $formatType[$c['FormatType']['type']];
                            }
                        }

                        $ExportArray[$index]['Unit_Name'] = $Unit->getName();
                        $ExportArray[$index]['Collection_Name'] = $collection['name'];
                        $ExportArray[$index]['Collection_ID'] = $collection['id'];
                        $ExportArray[$index]['Asset_Group'] = $c['name'];
                        $ExportArray[$index]['Format'] = $thisFormat;
                        $ExportArray[$index]['Recording_date'] = $c['FormatType']['year_recorded'];
                        $ExportArray[$index]['Quantity'] = $c['FormatType']['quantity'];
                        $index++;
                    }
                }
            }

            $ExportArray = $commonFunctions->aasort($ExportArray, 'Recording_date');
            if ($Type == 'xls') {

                $excel = new excel();

                $filename = 'Recording_Date_Report_' . date('M D Y-His', time()) . '.xlsx';
                $Sheettitle = 'Recording_Date_Report';
                $intial_dicrectory = '\RecordingDate\xls\\';
                $file_name_with_directory = $intial_dicrectory . $filename;

                $excel->setDataArray($ExportArray);
                $excel->extractHeadings();
                $excel->setFileName($file_name_with_directory);
                $excel->setSheetTitle($Sheettitle);
                $excel->createExcel();
                $excel->SaveFile();
                $excel->DownloadXLSX($file_name_with_directory, $filename);
                $excel->DeleteFile($file_name_with_directory);
            } else {

                $csvHandler = new csvHandler();
                $file_name = 'Recording_Date_Report_' . date('M D Y-His', time()) . '.csv';
                $intial_dicrectory = '\RecordingDate\csv\\';
                $file_name_with_directory = $intial_dicrectory . $file_name;
                $csvHandler->CreateCSV($ExportArray, $file_name_with_directory);
                $csvHandler->DownloadCSV($file_name_with_directory);
                $csvHandler->DeleteFile($file_name_with_directory);
            }
        }
    }

}

