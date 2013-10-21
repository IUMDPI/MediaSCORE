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

    public function preExecute() {
        parent::preExecute();
        $uri = $this->getContext()->getRouting()->getCurrentInternalUri();
        $actionWithParam = explode('/', $uri);
        $param = $actionWithParam[(count($actionWithParam) - 1)];
        $actionWithOutParam = explode('?', $param);
        $reports = array(
            'recordingdatereport',
            'assetsgroupsscoringreports',
            'collectionstatusreport',
            'problemmediareport',
            'alldataoutputreport',
            'evaluatorsreport',
            'percentageofholdings',
            'durationandquantitysearch'
        );

        $IsMediaScoreAccess = $this->getUser()->getGuardUser()->getMediascoreAccess();

        if (in_array($actionWithOutParam[0], $reports) && ($this->getUser()->getGuardUser()->getType() == 3 || $this->getUser()->getGuardUser()->getType() == 2) && !$IsMediaScoreAccess) {
            $this->redirect('/');
        }
    }

    public function executeIndex(sfWebRequest $request) {
        $this->IsMediaScoreAccess = $this->getUser()->getGuardUser()->getMediascoreAccess();
        $this->ISMediaRiverAccess = $this->getUser()->getGuardUser()->getMediariverAccess();
    }

    public function executeGetFormatCollections(sfWebRequest $request) {
        $formatIDs = $request->getParameter('f');
        $format_explode = explode(',', $formatIDs);
        $db_collections = Doctrine_Query::Create()
                ->from('AssetGroup as')
                ->innerJoin('as.Collection c')
                ->innerJoin('c.Unit u')
                ->innerJoin('as.FormatType ft');
        if ($this->getUser()->getGuardUser()->getType() == 3) {
            $db_collections = $db_collections->innerJoin('u.Personnel p')->where('person_id = ?', $this->getUser()->getGuardUser()->getId());
        }
        if (!empty($formatIDs) && count($format_explode) > 0)
            $db_collections = $db_collections->whereIn('ft.type', $format_explode);
        $db_collections = $db_collections->fetchArray();

        $final = array();
        foreach ($db_collections as $value) {
            $final['units'][] = array('id' => $value['Collection']['Unit']['id'], 'name' => $value['Collection']['Unit']['name']);
            $final['collections'][] = array('id' => $value['Collection']['id'], 'name' => $value['Collection']['name']);
        }
        $final['units'] = array_values(array_map("unserialize", array_unique(array_map("serialize", $final['units']))));
        $final['collections'] = array_values(array_map("unserialize", array_unique(array_map("serialize", $final['collections']))));
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $this->setLayout('json');
        return $this->renderText(json_encode($final));
    }

    public function executeGetCollectionFormats(sfWebRequest $request) {
        $collectionIDs = $request->getParameter('c');
        $collection_explode = explode(',', $collectionIDs);
        $db_formats = Doctrine_Query::Create()
                ->from('AssetGroup as')
                ->innerJoin('as.Collection c')
                ->innerJoin('c.Unit u')
                ->groupBy('ft.type')
                ->leftJoin('as.FormatType ft');
        if (!empty($collectionIDs) && count($collection_explode) > 0)
            $db_formats = $db_formats->whereIn('c.id', $collection_explode);
        $db_formats = $db_formats->fetchArray();

        $final = array();
        foreach ($db_formats as $value) {
            $final['units'][] = array('id' => $value['Collection']['Unit']['id'], 'name' => $value['Collection']['Unit']['name']);
            $final['formats'][] = array('id' => $value['FormatType']['type'], 'name' => FormatType::$formatTypesValue1d[$value['FormatType']['type']]);
        }

        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $this->setLayout('json');

        return $this->renderText(json_encode($final));
    }

    public function executeGetUserFormats(sfWebRequest $request) {
        $collectionIDs = $request->getParameter('u');
        $EvaluatorHistorys = Doctrine_Query::Create()
                ->from('AssetGroup as')
                ->innerJoin('as.EvaluatorHistory eh')
                ->innerJoin('as.FormatType ft');
        if (!empty($collectionIDs) && $collectionIDs != NULL)
            $EvaluatorHistorys = $EvaluatorHistorys->where('eh.evaluator_id = ?', $collectionIDs);
        $EvaluatorHistorys = $EvaluatorHistorys->fetchArray();
        $formats = array();
        foreach ($EvaluatorHistorys as $value) {
            if (!array_key_exists($value['FormatType']['type'], $formats))
                $formats[$value['FormatType']['type']] = FormatType::$formatTypesValue1d[$value['FormatType']['type']];
        }
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $this->setLayout('json');

        return $this->renderText(json_encode($formats));
    }

    /**
     * Get Problems within collection(s).
     *  
     * @param sfWebRequest $request
     * @return type
     */
    public function executeGetCollectionProblems(sfWebRequest $request) {
        $collectionIDs = $request->getParameter('c');
        $collection_explode = explode(',', $collectionIDs);
        $db_assets = Doctrine_Query::Create()
                ->from('AssetGroup ag')
                ->innerJoin("ag.FormatType ft")
                ->innerJoin('ag.Collection c');
        if (!empty($collectionIDs) && count($collection_explode) > 0)
            $db_assets = $db_assets->whereIn('c.id', $collection_explode);
        $db_assets = $db_assets->fetchArray();
        $problems = array();
        foreach ($db_assets as $value) {
            foreach ($value['FormatType'] as $index => $format) {
                if ($index == 'pack_deformation') {
                    if (array_key_exists("{$index}-{$format}", ReportsForm::$constraintsArray))
                        $problems["{$index}-{$format}"] = ReportsForm::$constraintsArray["{$index}-{$format}"];
                }
                else {
                    if ($format != '' && array_key_exists("{$index}", ReportsForm::$constraintsArray))
                        $problems["{$index}"] = ReportsForm::$constraintsArray["{$index}"];
                }
            }
        }
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $this->setLayout('json');

        return $this->renderText(json_encode($problems));
    }

    /**
     * Get Collection and its status within unit(s).
     * 
     * @param sfWebRequest $request
     * @return json
     */
    public function executeGetUnitCollections(sfWebRequest $request) {
        if ($request->isXmlHttpRequest()) {
            $status = array(0 => 'Incomplete', 1 => 'In Progress', 2 => 'Completed');
            $unitIDs = $request->getParameter('u');
            $collectionIDs = $request->getParameter('c');
            $unit_explode = explode(',', $unitIDs);
            $collection_explode = explode(',', $collectionIDs);
            $db_collections = Doctrine_Query::Create()
                    ->from('Collection c')
                    ->innerJoin('c.Unit u');
            if ($this->getUser()->getGuardUser()->getType() == 3) {
                $db_collections = $db_collections->innerJoin('u.Personnel p')->where('person_id = ?', $this->getUser()->getGuardUser()->getId());
            }
            if (!empty($unitIDs) && count($unit_explode) > 0)
                $db_collections = $db_collections->whereIn('c.parent_node_id', $unit_explode);
            if (!empty($collectionIDs) && count($collection_explode) > 0)
                $db_collections = $db_collections->whereIn('c.id', $collection_explode);
            $db_collections = $db_collections->fetchArray();
            $unit_collections['collections'] = array();
            $unit_collections['status'] = array();
            foreach ($db_collections as $value) {
                $unit_collections['collections'][] = array('id' => $value['id'], 'name' => $value['name']);
                if (!in_array($status[$value['status']], $unit_collections['status'])) {
                    $unit_collections['status'][$value['status']] = $status[$value['status']];
                }
            }

            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');

            return $this->renderText(json_encode($unit_collections));
        }
    }

    /**
     * Get Formats that contain within unit(s).
     * 
     * @param sfWebRequest $request
     * @return json
     */
    public function executeGetUnitFormats(sfWebRequest $request) {
        if ($request->isXmlHttpRequest()) {
            $unitIDs = $request->getParameter('u');

            $unit_explode = explode(',', $unitIDs);
            $db_formats = Doctrine_Query::Create()
                    ->from('AssetGroup ag')
                    ->innerJoin("ag.FormatType ft")
                    ->innerJoin('ag.Collection c')
                    ->innerJoin('c.Unit u')
                    ->groupBy('ft.type');
            if (!empty($unitIDs) && count($unit_explode) > 0)
                $db_formats = $db_formats->whereIn('u.id', $unit_explode);
            $db_formats = $db_formats->fetchArray();
            $formats = array();
            foreach ($db_formats as $value) {
                $formats[] = array('format_id' => $value['FormatType']['type'], 'format_name' => FormatType::$formatTypesValue1d[$value['FormatType']['type']]);
            }

            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');

            return $this->renderText(json_encode($formats));
        }
    }

    /**
     * Assets Groups Scoring Reports From reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executeAssetsgroupsscoringreports(sfWebRequest $request) {
        $this->form = new ReportsForm(null, array('from' => 'assetsgroupsscoringreports', 'user' => $this->getUser()->getGuardUser()));

        if ($request->isMethod(sfRequest::POST)) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $FlagForReport = FALSE;

                $AssetScoreReportArray = array();
                $Assets = array();
                $params = $request->getPostParameter('reports');

                $commonFunctions = new commonFunctions();
                $listUnits_RRD = $params['listUnits_RRD'];
                $format_id = $params['format_id'];
                $ExportType = $params['ExportType'];

                if ($listUnits_RRD && $format_id) {

                    $db_formats = Doctrine_Query::Create()
                            ->from('AssetGroup ag')
                            ->innerJoin("ag.FormatType ft")
                            ->innerJoin('ag.Collection c')
                            ->innerJoin('c.Unit u')
                            ->leftJoin('u.Personnel p ')
                            ->leftJoin('u.StorageLocations sl')
                            ->whereIn('u.id', $listUnits_RRD)
                            ->whereIn('ft.type', $format_id)
                            ->orderBy('ft.asset_score DESC')
                            ->fetchArray();
                    foreach ($db_formats as $A) {
                        $SolutionArray = array();
                        $SolutionArray['AssetGroup'] = $A;
                        $SolutionArray['Collection'] = $A['Collection'];
                        $SolutionArray['Unit'] = $A['Collection']['Unit'];
                        $FlagForReport = TRUE;
                        $Assets[] = $SolutionArray;
                    }

                    $formatTypeValuesManager = new formatTypeValuesManager();
                    if ($Assets && $FlagForReport) {
                        foreach ($Assets as $Asset) {
                            $AssetScoreReport = array();
                            $FormatArray = explode(',', $Asset['AssetGroup']['FormatType']['format']);
                            $formattext = '';

                            foreach ($FormatArray as $formatValue) {
                                if ($formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'format', $formatValue)) {
                                    $formattext .= $formatTypeValuesManager->getArrayOfValueTargeted('general', 'format', $formatValue) . ' , ';
                                }
                            }
                            $AssetScoreReport['Score'] = $Asset['AssetGroup']['FormatType']['asset_score'];
                            $AssetScoreReport['Format'] = $formattext;
                            $AssetScoreReport['Quantity'] = $Asset['AssetGroup']['FormatType']['quantity'];
                            $AssetScoreReport['Duration'] = minutesToHour::ConvertMinutes2Hours($Asset['AssetGroup']['FormatType']['duration']);
                            $AssetScoreReport['Duration type'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'duration_type', $Asset['AssetGroup']['FormatType']['duration_type']);
                            $AssetScoreReport['Generation'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'generation', $Asset['AssetGroup']['FormatType']['generation']);
                            $AssetScoreReport['Collection Primary ID'] = $Asset['Collection']['inst_id'];
                            $AssetScoreReport['Collection Name'] = $Asset['Collection']['name'];
                            $AssetScoreReport['Asset Group Primary ID'] = $Asset['AssetGroup']['inst_id'];
                            $AssetScoreReport['Asset Group Name'] = $Asset['AssetGroup']['name'];
                            $AssetScoreReport['Asset Group Description'] = $Asset['AssetGroup']['resident_structure_description']; #
                            $AssetScoreReport['Unit Primary ID'] = $Asset['Unit']['inst_id'];
                            $AssetScoreReport['Unit Name'] = $Asset['Unit']['name'];
                            $AssetScoreReport['Year Recorded'] = $Asset['AssetGroup']['FormatType']['year_recorded'];
                            $AssetScoreReport['Copies'] = ($Asset['AssetGroup']['FormatType']['copies'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['Stock Brand'] = $Asset['AssetGroup']['FormatType']['stock_brand'];
                            $AssetScoreReport['Off-Brand'] = ($Asset['AssetGroup']['FormatType']['off_brand'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['format_notes'] = $Asset['AssetGroup']['FormatType']['format_notes'];
                            $AssetScoreReport['type'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'GlobalFormatType', $Asset['AssetGroup']['FormatType']['type']);

                            if ($AssetScoreReport['Score'] != '')
                                $AssetScoreReportArray[] = $AssetScoreReport;
                        }
                        if ($ExportType == 'xls') {
                            $excel = new excel();
                            $excel->setDataArray($AssetScoreReportArray);
                            $excel->extractHeadings();
                            $filename = 'Asset_Group_Scoring_Report_' . date('Ymd') . '.xlsx';
                            $Sheettitle = 'Asset_Group_Scoring_Report';
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

                            $file_name = 'Asset_Group_Scoring_Report_' . date('Ymd') . '.csv';
                            $intial_dicrectory = '/AssetsScore/csv/';
                            $file_name_with_directory = $intial_dicrectory . $file_name;
                            $csvHandler->CreateCSV($AssetScoreReportArray, $file_name_with_directory);
                            $csvHandler->DownloadCSV($file_name_with_directory, $file_name);
                            $csvHandler->DeleteFile($file_name_with_directory);
                            exit;
                        }
                    } else {
                        $Bug = '<span style="color:#7d110c;font-size:16px;"><b>No record available for export.</b></span>';
                        $this->getResponse()->setSlot('my_slot', $Bug);
                    }
                }
            }
        }
    }

    /**
     * Assets Groups Recorded Date Report For reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executeRecordingdatereport(sfWebRequest $request) {
        $this->form = new ReportsForm(null, array('from' => 'recordingdatereport', 'user' => $this->getUser()->getGuardUser()));

        if ($request->isMethod(sfRequest::POST)) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $FlagForReport = FALSE;

                $AssetScoreReportArray = array();
                $Assets = array();

                $params = $request->getPostParameter('reports');

                $commonFunctions = new commonFunctions();
                $listUnits_RRD = $params['listUnits_RRD'];
                $ExportType = $params['ExportType'];

                if ($listUnits_RRD) {
                    $db_assets = Doctrine_Query::Create()
                            ->from('AssetGroup ag')
                            ->innerJoin("ag.FormatType ft")
                            ->innerJoin('ag.Collection c')
                            ->innerJoin('c.Unit u')
                            ->leftJoin('u.Personnel p ')
                            ->leftJoin('u.StorageLocations sl')
                            ->whereIn('u.id', $listUnits_RRD)
                            ->orderBy('ft.year_recorded')
                            ->fetchArray();
                    foreach ($db_assets as $A) {
                        $SolutionArray = array();
                        $SolutionArray['AssetGroup'] = $A;
                        $SolutionArray['Collection'] = $A['Collection'];
                        $SolutionArray['Unit'] = $A['Collection']['Unit'];
                        $FlagForReport = TRUE;
                        $Assets[] = $SolutionArray;
                    }


                    if ($Assets && $FlagForReport) {
                        foreach ($Assets as $Asset) {

                            $formatTypeValuesManager = new formatTypeValuesManager();
                            $AssetScoreReport = array();
                            $AssetScoreReport['Year Recorded'] = $Asset['AssetGroup']['FormatType']['year_recorded'];
                            $AssetScoreReport['type'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'GlobalFormatType', $Asset['AssetGroup']['FormatType']['type']);
                            $AssetScoreReport['Quantity'] = $Asset['AssetGroup']['FormatType']['quantity'];
                            $AssetScoreReport['Duration'] = minutesToHour::ConvertMinutes2Hours($Asset['AssetGroup']['FormatType']['duration']);
                            $AssetScoreReport['Duration type'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'duration_type', $Asset['AssetGroup']['FormatType']['duration_type']);
                            $AssetScoreReport['Score'] = $Asset['AssetGroup']['FormatType']['asset_score'];
                            $AssetScoreReport['Unit Name'] = $Asset['Unit']['name'];
                            $AssetScoreReport['Collection Primary ID'] = $Asset['Collection']['inst_id'];
                            $AssetScoreReport['Collection Name'] = $Asset['Collection']['name'];
                            $AssetScoreReport['Asset Group Primary ID'] = $Asset['AssetGroup']['inst_id'];
                            $AssetScoreReport['Asset Group Name'] = $Asset['AssetGroup']['name'];
                            $AssetScoreReport['Generation'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'generation', $Asset['AssetGroup']['FormatType']['generation']);
                            $AssetScoreReport['Copies'] = ($Asset['AssetGroup']['FormatType']['copies'] == '1') ? 'Yes' : 'No';

                            if ($AssetScoreReport['Score'] != '')
                                $AssetScoreReportArray[] = $AssetScoreReport;
                        }

//						$AssetScoreReportArray = $commonFunctions->arsort($AssetScoreReportArray, 'Year Recorded');

                        if ($ExportType == 'xls') {
                            $excel = new excel();
                            $excel->setDataArray($AssetScoreReportArray);
                            $excel->extractHeadings();
                            $filename = 'Recording_Date_Report_' . date('Ymd') . '.csv';
                            $Sheettitle = 'Recording_Date_Report';
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

                            $file_name = 'Recording_Date_Report_' . date('Ymd') . '.csv';
                            $intial_dicrectory = '/AssetsScore/csv/';
                            $file_name_with_directory = $intial_dicrectory . $file_name;

                            $csvHandler->CreateCSV($AssetScoreReportArray, $file_name_with_directory);
                            $csvHandler->DownloadCSV($file_name_with_directory, $file_name);
                            $csvHandler->DeleteFile($file_name_with_directory);
                            exit;
                        }
                    } else {
                        $Bug = '<span style="color:#7d110c;font-size:16px;"><b>No record available for export.</b></span>';
                        $this->getResponse()->setSlot('my_slot', $Bug);
                    }
                }
            }
        }
    }

    /**
     * Assets Groups Collection Status Report From reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executeCollectionstatusreport(sfWebRequest $request) {
        $this->form = new ReportsForm(null, array('from' => 'collectionstatusreport', 'user' => $this->getUser()->getGuardUser()));
        if ($request->isMethod(sfRequest::POST)) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $params = $request->getPostParameter('reports');
                $Collection_id = $params['listCollection_RRD'];
                $Units_id = $params['listUnits_RRD'];
                $collectionStatus = $params['collectionStatus'];
                $ExportType = $params['ExportType'];
                $EvaluatorsStartDate = $params['EvaluatorsStartDate'];
                $EvaluatorsEndDate = $params['EvaluatorsEndDate'];
                $collectionStatusReports = array();
                if ($Units_id) {
                    $collections = array();
                    $Collections = Doctrine_Query::Create()
                            ->from('Collection c')
                            ->innerJoin('c.Unit u')
                            ->leftJoin('c.StorageLocations s')
                            ->leftJoin('c.Creator cu')
                            ->leftJoin('c.Editor eu')
                            ->whereIn('u.id', $Units_id);
                    if ($EvaluatorsStartDate && !empty($EvaluatorsStartDate))
                        $Collections = $Collections->andWhere("DATE_FORMAT(c.created_at,'%Y-%m-%d') >= ?", $EvaluatorsStartDate);
                    if ($EvaluatorsEndDate && !empty($EvaluatorsEndDate))
                        $Collections = $Collections->andWhere("DATE_FORMAT(c.created_at,'%Y-%m-%d') <= ?", $EvaluatorsEndDate);
                    if ($Collection_id && !empty($Collection_id))
                        $Collections = $Collections->andWhereIn('c.id', $Collection_id);
                    if ($collectionStatus && !empty($collectionStatus))
                        $Collections = $Collections->andWhereIn('c.status', $collectionStatus);
                    $Collections = $Collections->orderBy('u.id')
                            ->fetchArray();
                    $SolutionArray = array();
                    foreach ($Collections as $Collection) {

                        $SolutionArray['Collection'] = $Collection;
                        $SolutionArray['Unit'] = $Collection['Unit'];
                        $collections[] = $SolutionArray;
                    }


                    if ($collections) {
                        foreach ($collections as $collection) {
                            $collectionStatusReport = array();
                            $collectionStatusReport['Unit ID'] = $collection['Unit']['id'];
                            $collectionStatusReport['Unit Primary ID'] = $collection['Unit']['inst_id'];
                            $collectionStatusReport['Unit Name'] = $collection['Unit']['name'];
                            $collectionStatusReport['Storage Location Name'] = $collection['Collection']['StorageLocations'][0]['name'];
                            $collectionStatusReport['Storage Location Building name/Room number'] = $collection['Collection']['resident_structure_description'];
                            $collectionStatusReport['Collection ID'] = $collection['Collection']['id'];
                            $collectionStatusReport['Collection Primary ID'] = $collection['Collection']['inst_id'];
                            $collectionStatusReport['Collection Name'] = $collection['Collection']['name'];
                            $collectionStatusReport['Status'] = Collection::$statusConstants[$collection['Collection']['status']];
                            $collectionStatusReport['Collection Created On Date'] = date('Y-m-d H:i:s', strtotime($collection['Unit']['created_at']));
                            $collectionStatusReport['Collection Created By'] = $collection['Collection']['Creator']['first_name'] . ' ' . $collection['Collection']['Creator']['last_name'];
                            $collectionStatusReport['Collection Updated On Date'] = date('Y-m-d H:i:s', strtotime($collection['Collection']['updated_at']));
                            $collectionStatusReport['Collection Updated By'] = $collection['Collection']['Editor']['first_name'] . ' ' . $collection['Collection']['Editor']['last_name'];
                            $collectionStatusReports[] = $collectionStatusReport;
                        }


                        if ($ExportType == 'xls') {
                            $excel = new excel();
                            $excel->setDataArray($collectionStatusReports);
                            $excel->extractHeadings();
                            $filename = 'Collection_Status_Report_' . date('Ymd') . '.xlsx';
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

                            $file_name = 'Collection_Status_Report_' . date('Ymd') . '.csv';

                            $intial_dicrectory = '/CollectionStatusReport/csv/';
                            $file_name_with_directory = $intial_dicrectory . $file_name;
                            $csvHandler->CreateCSV($collectionStatusReports, $file_name_with_directory);
                            $csvHandler->DownloadCSV($file_name_with_directory, $file_name);
                            $csvHandler->DeleteFile($file_name_with_directory);
                            exit;
                        }
                    } else {
                        $Bug = '<span style="color:#7d110c;font-size:16px;"><b>No record available for export.</b></span>';
                        $this->getResponse()->setSlot('my_slot', $Bug);
                    }
                }
            }
        }
    }

    /**
     * Problem Media Report  From reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executeProblemmediareport(sfWebRequest $request) {
        $this->form = new ReportsForm(null, array('from' => 'problemmediareport', 'user' => $this->getUser()->getGuardUser()));
        if ($request->isMethod(sfRequest::POST)) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $commonFunctions = new commonFunctions();
                $formatTypeValuesManager = new formatTypeValuesManager();
                $Assets = array();
                $AssetScoreReportArray = array();
                $params = $request->getPostParameter('reports');

                $Collection_id = $params['listCollection_RRD'];
                $where = '1=1';
                $Constraints = $params['Constraints'];
                $ExportType = $params['ExportType'];
                $Constraint_filters = array();
                $collection_filter = array();
                foreach ($Constraints as $value) {
                    if (array_key_exists($value, ReportsForm::$constraintsArray)) {
                        if (strstr($value, 'pack_deformation')) {
                            $explode_pd = explode('-', $value);
                            $where .=" OR ft.{$explode_pd[0]} ={$explode_pd[1]} ";
                        }
                        else
                            $where .=" OR ft.{$value} !='' ";
                        $Constraint_filters[] = ReportsForm::$constraintsArray[$value];
                    }
                }

                if ($Collection_id && $Constraints) {
                    $db_assets = Doctrine_Query::Create()
                            ->from('AssetGroup ag')
                            ->innerJoin("ag.FormatType ft")
                            ->innerJoin('ag.Collection c')
                            ->innerJoin('c.Unit u')
                            ->leftJoin('u.Personnel p ')
                            ->leftJoin('u.StorageLocations sl')
                            ->where("({$where})")
                            ->andWhereIn('c.id', $Collection_id)
                            ->fetchArray();

                    foreach ($db_assets as $assets) {
                        $SolutionArray['AssetGroup'] = $assets;
                        $SolutionArray['Collection'] = $assets['Collection'];
                        $SolutionArray['Unit'] = $assets['Collection']['Unit'];

                        $Assets[] = $SolutionArray;
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
                            $AssetScoreReport['Storage Location Building name/Room number'] = $Asset['Unit']['resident_structure_description']; #resident_structure_description
                            $AssetScoreReport['Storage Location Environment'] = str_replace('Select', '', StorageLocation::$constants[$Asset['Unit']['StorageLocations'][0]['env_rating']]); #
                            $AssetScoreReport['Collection ID'] = $Asset['Collection']['id'];
                            $AssetScoreReport['Collection Primary ID'] = $Asset['Collection']['inst_id'];
                            $AssetScoreReport['Collection Name'] = $Asset['Collection']['name'];
                            if (!in_array($AssetScoreReport['Collection Name'], $collection_filter))
                                $collection_filter[] = $AssetScoreReport['Collection Name'];
                            $AssetScoreReport['Asset Group ID'] = $Asset['AssetGroup']['id'];
                            $AssetScoreReport['Asset Group Primary ID'] = $Asset['AssetGroup']['inst_id'];
                            $AssetScoreReport['Asset Group Name'] = $Asset['AssetGroup']['name'];
                            $AssetScoreReport['Asset Group Description'] = $Asset['AssetGroup']['resident_structure_description']; #
                            $AssetScoreReport['Location'] = $Asset['AssetGroup']['location'];


                            $FormatArray = explode(',', $Asset['AssetGroup']['FormatType']['format']);
                            $format = '';

                            foreach ($FormatArray as $formatValue) {
                                if ($formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue)) {
                                    $format .= $formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue) . ' , ';
                                } else {
                                    $format .= $formatTypeValuesManager->getArrayOfValueTargeted('general', 'formatVersion', $formatValue) . ' , ';
                                }
                            }

                            $AssetScoreReport['Format'] = rtrim(trim(str_replace('NULL', '', $format)), ',');
                            $AssetScoreReport['Quantity'] = $Asset['AssetGroup']['FormatType']['quantity'];
                            $AssetScoreReport['Generation'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'generation', $Asset['AssetGroup']['FormatType']['generation']);
                            $AssetScoreReport['Year Recorded'] = $Asset['AssetGroup']['FormatType']['year_recorded'];
                            $AssetScoreReport['Copies'] = ($Asset['AssetGroup']['FormatType']['copies'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['Stock Brand'] = $Asset['AssetGroup']['FormatType']['stock_brand'];
                            $AssetScoreReport['Off-Brand'] = ($Asset['AssetGroup']['FormatType']['off_brand'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['Fungus'] = ($Asset['AssetGroup']['FormatType']['fungus'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['Other Contaminants'] = ($Asset['AssetGroup']['FormatType']['other_contaminants'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['Duration'] = $Asset['AssetGroup']['FormatType']['duration'];
                            $AssetScoreReport['Duration type'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'duration_type', $Asset['AssetGroup']['FormatType']['duration_type']);
                            $AssetScoreReport['Duration type Methodology'] = $Asset['AssetGroup']['FormatType']['duration_type_methodology'];

                            $AssetScoreReport['format_notes'] = $Asset['AssetGroup']['FormatType']['format_notes'];

                            $AssetScoreReport['type'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'GlobalFormatType', $Asset['AssetGroup']['FormatType']['type']);
                            $AssetScoreReport['material'] = NULL;
                            if ($AssetScoreReport['type'] == 'Metal Disc')
                                $AssetScoreReport['material'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'material', $Asset['AssetGroup']['FormatType']['material']);
                            $AssetScoreReport['oxidationcorrosion'] = ($Asset['AssetGroup']['FormatType']['oxidationCorrosion'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['pack_deformation'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'pack_deformation', $Asset['AssetGroup']['FormatType']['pack_deformation']));
                            $AssetScoreReport['noise_reduction'] = ($Asset['AssetGroup']['FormatType']['noise_reduction'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['tape_type'] = rtrim(trim($formatTypeValuesManager->getArrayOfValueTargeted('general', 'tape_type', $Asset['AssetGroup']['FormatType']['tape_type'])), '|');
                            $AssetScoreReport['thin_tape'] = ($Asset['AssetGroup']['FormatType']['thin_tape'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['slow_speed'] = ($Asset['AssetGroup']['FormatType']['slow_speed'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['sound_field'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'sound_field', $Asset['AssetGroup']['FormatType']['sound_field']);
                            $AssetScoreReport['soft_binder_syndrome'] = ($Asset['AssetGroup']['FormatType']['soft_binder_syndrome'] == '1') ? 'Yes' : 'No';

                            $AssetScoreReport['gauge'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'gauge', $Asset['AssetGroup']['FormatType']['gauge']);
                            $AssetScoreReport['color'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'color', $Asset['AssetGroup']['FormatType']['color']);
                            $AssetScoreReport['colorfade'] = ($Asset['AssetGroup']['FormatType']['colorFade'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['soundtrackformat'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'soundtrackFormat', $Asset['AssetGroup']['FormatType']['soundtrackFormat']));
                            $AssetScoreReport['substrate'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'substrate', $Asset['AssetGroup']['FormatType']['substrate']);
                            $AssetScoreReport['strongodor'] = ($Asset['AssetGroup']['FormatType']['strongOdor'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['vinegarodor'] = ($Asset['AssetGroup']['FormatType']['vinegarOdor'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['adstriplevel'] = $Asset['AssetGroup']['FormatType']['ADStripLevel'];
                            $AssetScoreReport['shrinkage'] = ($Asset['AssetGroup']['FormatType']['shrinkage'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['levelofshrinkage'] = $Asset['AssetGroup']['FormatType']['levelOfShrinkage'];
                            $AssetScoreReport['rust'] = ($Asset['AssetGroup']['FormatType']['rust'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['discoloration'] = ($Asset['AssetGroup']['FormatType']['discoloration'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['surfaceblisteringbubbling'] = ($Asset['AssetGroup']['FormatType']['surfaceBlisteringBubbling'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['thintape'] = ($Asset['AssetGroup']['FormatType']['thinTape'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['1993orearlier'] = ($Asset['AssetGroup']['FormatType']['1993OrEarlier'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['datagradetape'] = ($Asset['AssetGroup']['FormatType']['dataGradeTape'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['longplay32k96k'] = ($Asset['AssetGroup']['FormatType']['longPlay32K96K'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['corrosionrustoxidation'] = ($Asset['AssetGroup']['FormatType']['corrosionRustOxidation'] == '1') ? 'Yes' : 'No';
                            if ($formatTypeValuesManager->getArrayOfValueTargeted('general', 'composition', $Asset['AssetGroup']['FormatType']['composition'])) {
                                $AssetScoreReport['composition'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'composition', $Asset['AssetGroup']['FormatType']['composition']));
                            } else {
                                $AssetScoreReport['composition'] = '';
                            }

                            $AssetScoreReport['nonstandardbrand'] = ($Asset['AssetGroup']['FormatType']['nonStandardBrand'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['trackconfiguration'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'trackConfiguration', $Asset['AssetGroup']['FormatType']['trackConfiguration']);
                            $AssetScoreReport['tapethickness'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'tapeThickness', $Asset['AssetGroup']['FormatType']['tapeThickness']));

                            $SpeedArray = explode(',', $Asset['AssetGroup']['FormatType']['speed']);
                            $SpeedText = '';

                            foreach ($SpeedArray as $Speed) {
                                $SpeedText .= $formatTypeValuesManager->getArrayOfValueTargeted('general', 'speed', $Speed) . ' , ';
                            }
                            $AssetScoreReport['speed'] = rtrim(trim(str_replace('NULL', '', $SpeedText)), ',');

                            $AssetScoreReport['softbindersyndrome'] = ($Asset['AssetGroup']['FormatType']['softBinderSyndrome'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['materialsbreakdown'] = ($Asset['AssetGroup']['FormatType']['materialsBreakdown'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['physicaldamage'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'physicalDamage', $Asset['AssetGroup']['FormatType']['physicalDamage']));
                            $AssetScoreReport['delamination'] = ($Asset['AssetGroup']['FormatType']['delamination'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['plasticizerexudation'] = ($Asset['AssetGroup']['FormatType']['plasticizerExudation'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['recordinglayer'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'recordingLayer', $Asset['AssetGroup']['FormatType']['recordingLayer']);

                            $recordingspeedArray = explode(',', $Asset['AssetGroup']['FormatType']['recordingSpeed']);
                            $recordingspeedText = '';

                            foreach ($recordingspeedArray as $recordingspeed) {
                                $recordingspeedText .= $formatTypeValuesManager->getArrayOfValueTargeted('general', 'recordingSpeed', $recordingspeed) . ' , ';
                            }

                            $AssetScoreReport['recordingspeed'] = str_replace(',', '', $recordingspeedText);
                            $AssetScoreReport['cylindertype'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'cylinderType', $Asset['AssetGroup']['FormatType']['cylinderType']);
                            $AssetScoreReport['reflectivelayer'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'reflectiveLayer', $Asset['AssetGroup']['FormatType']['reflectiveLayer']));
                            $AssetScoreReport['datalayer'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'dataLayer', $Asset['AssetGroup']['FormatType']['dataLayer']));


                            $opticalDiscTypeArray = explode(',', $Asset['AssetGroup']['FormatType']['opticalDiscType']);
                            $opticalDiscTypeText = '';

                            foreach ($opticalDiscTypeArray as $opticalDiscType) {
                                $opticalDiscTypeText .= $formatTypeValuesManager->getArrayOfValueTargeted('general', 'opticalDiscType', $opticalDiscType) . ' , ';
                            }

                            $AssetScoreReport['opticaldisctype'] = rtrim(trim($opticalDiscTypeText), ',');

                            $AssetScoreReport['recordingstandard'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'recordingStandard', $Asset['AssetGroup']['FormatType']['recordingStandard']));
                            $AssetScoreReport['publicationyear'] = $Asset['AssetGroup']['FormatType']['publicationYear'];
                            $AssetScoreReport['capacitylayers'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'capacityLayers', $Asset['AssetGroup']['FormatType']['capacityLayers']);
                            $AssetScoreReport['codec'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'codec', $Asset['AssetGroup']['FormatType']['codec']));
                            $AssetScoreReport['datarate'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'dataRate', $Asset['AssetGroup']['FormatType']['dataRate']));
                            $AssetScoreReport['sheddingsoftbinder'] = $Asset['AssetGroup']['FormatType']['sheddingSoftBinder'];
                            $AssetScoreReport['oxide'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'oxide', $Asset['AssetGroup']['FormatType']['oxide']);
                            $AssetScoreReport['bindersystem'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'binderSystem', $Asset['AssetGroup']['FormatType']['binderSystem']));

                            $reelsizeArray = explode(',', $Asset['AssetGroup']['FormatType']['opticalDiscType']);
                            $reelsizeText = '';
                            foreach ($reelsizeArray as $reelsize) {
                                $reelsizeText .= $formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['FormatType']['type'], 'reelsize', $reelsize) . ' , ';
                            }
                            $AssetScoreReport['reelsize'] = rtrim(trim(str_replace('NULL', '', $reelsizeText)), ',');

                            $reelsizeText = '';
                            $AssetScoreReport['whiteresidue'] = ($Asset['AssetGroup']['FormatType']['whiteResidue'] == '1') ? 'Yes' : 'No';

                            $sizeArray = explode(',', $Asset['AssetGroup']['FormatType']['size']);
                            $sizeText = '';
                            foreach ($sizeArray as $size) {
                                $sizeText .= $formatTypeValuesManager->getArrayOfValueTargeted('general', 'size', $size) . ' , ';
                            }
                            $AssetScoreReport['size'] = rtrim(trim(str_replace('NULL', '', $sizeText)), ',');
                            $AssetScoreReport['formattypedvideorecordingformat'] = ($Asset['AssetGroup']['FormatType']['formatTypedVideoRecordingFormat'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['bitrate'] = str_replace('NULL', '', $formatTypeValuesManager->getArrayOfValueTargeted('general', 'bitrate', $Asset['AssetGroup']['FormatType']['bitrate']));
                            $AssetScoreReport['scanning'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'scanning', $Asset['AssetGroup']['FormatType']['scanning']);
                            if ($AssetScoreReport['score'] != '')
                                $AssetScoreReportArray[] = $AssetScoreReport;
                        }
                        $filters = array(
                            'collection-Filter(s)' => $collection_filter,
                            'Problem-Filter(s)' => $Constraint_filters,
                        );
                        $AssetScoreReportArray = $commonFunctions->arsort($AssetScoreReportArray, 'score');
                        if ($ExportType == 'xls') {
                            $excel = new excel();
                            $excel->setDataArray($AssetScoreReportArray);
                            $excel->extractHeadings();
                            $filename = 'Problem_Media_Report_' . date('Ymd') . '.xlsx';
                            $Sheettitle = 'Problem_Media_Report';
//                $intial_dicrectory = '\AssetsScore\xls\\';
                            $intial_dicrectory = '/AssetsScore/xls/';
                            $file_name_with_directory = $intial_dicrectory . $filename;


                            $excel->setDataArray($AssetScoreReportArray);
                            $excel->extractHeadings();
                            $excel->setFileName($file_name_with_directory);
                            $excel->setSheetTitle($Sheettitle);

                            $excel->createExcel(TRUE, $filters);

                            $excel->SaveFile();
                            $excel->DownloadXLSX($file_name_with_directory, $filename);
                            $excel->DeleteFile($file_name_with_directory);
                            exit;
                        } else {

                            $csvHandler = new csvHandler();

                            $file_name = 'Problem_Media_Report_' . date('Ymd') . '.csv';
//                $intial_dicrectory = '\RecordingDate\csv\\';
                            $intial_dicrectory = '/AssetsScore/csv/';
                            $file_name_with_directory = $intial_dicrectory . $file_name;
                            $csvHandler->CreateCSV($AssetScoreReportArray, $file_name_with_directory, FALSE, 0, TRUE, $filters);
                            $csvHandler->DownloadCSV($file_name_with_directory, $file_name);
                            $csvHandler->DeleteFile($file_name_with_directory);
                            exit;
                        }
                    } else {
                        $Bug = '<span style="color:#7d110c;font-size:16px;"><b>No record available for export.</b></span>';
                        $this->getResponse()->setSlot('my_slot', $Bug);
                    }
                }
            }
        }
    }

    /**
     * All Data Outpul Report for All  Collection, Units ,Formats and Asset Groups 
     * 
     * @param sfWebRequest $request 
     */
    public function executeAlldataoutputreport(sfWebRequest $request) {
        set_time_limit(0);
        @ini_set("memory_limit", "1000M"); # 1GB
        @ini_set("max_execution_time", 999999999999); # 1GB
        $this->form = new ReportsForm(null, array('from' => 'alldataoutputreport'));

        if ($request->isMethod(sfRequest::POST)) {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $formatTypeValuesManager = new formatTypeValuesManager();
                $DataDumpReportArray = array();
                $Assets = array();

                $param = $request->getPostParameters();


                $ExportType = $param['reports']['ExportType'];
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
                                    ->select('a.*, ft.*,eh.*,cu.*,eu.*,sl.*')
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

                    if ($Assets) {
                        foreach ($Assets as $Asset) {

                            $AssetScoreReport = array();
                            $AssetScoreReport['Unit ID'] = $Asset['Unit']['id'];
                            $AssetScoreReport['Unit Primary ID'] = $Asset['Unit']['inst_id'];
                            $AssetScoreReport['Unit Name'] = $Asset['Unit']['name'];

                            $AssetScoreReport['Storage Location Building name/Room number.'] = $Asset['Unit']['StorageLocations'][0]['resident_structure_description'];
                            $AssetScoreReport['Contact Notes.'] = $Asset['Unit']['notes'];
                            $AssetScoreReport['Storage Location Name.'] = $Asset['Unit']['StorageLocations'][0]['name'];

                            $AssetScoreReport['Unit Personnel ID.'] = $Asset['Unit']['Personnel'][0]['id'];
                            $AssetScoreReport['Unit Personnel First Name.'] = $Asset['Unit']['Personnel'][0]['first_name'];
                            $AssetScoreReport['Unit Personnel Last Name.'] = $Asset['Unit']['Personnel'][0]['last_name'];
                            $AssetScoreReport['Unit Personnel Role.'] = $Asset['Unit']['Personnel'][0]['role'];
                            $AssetScoreReport['Unit Personnel Email.'] = $Asset['Unit']['Personnel'][0]['email_address'];
                            $AssetScoreReport['Unit Personnel Phone.'] = $Asset['Unit']['Personnel'][0]['phone'];

                            $AssetScoreReport['Unit Created'] = date('Y-m-d H:i:s', strtotime($Asset['Unit']['created_at']));
                            $AssetScoreReport['Creator Unit Created By'] = $Asset['Unit']['Creator']['first_name'] . ' ' . $Asset['Unit']['Creator']['last_name']; #
                            $AssetScoreReport['CreatorUser ID.'] = $Asset['Unit']['Creator']['id'];
                            $AssetScoreReport['Creator User First Name.'] = $Asset['Unit']['Creator']['first_name'];
                            $AssetScoreReport['Creator User Last Name.'] = $Asset['Unit']['Creator']['last_name'];
                            $AssetScoreReport['Creator User e-mail.'] = $Asset['Unit']['Creator']['email_address'];
                            $AssetScoreReport['Creator User Phone.'] = $Asset['Unit']['Creator']['phone'];
                            $AssetScoreReport['Creator User Role.'] = $Asset['Unit']['Creator']['role'];

                            $AssetScoreReport['Unit Updated On'] = date('Y-m-d H:i:s', strtotime($Asset['Unit']['updated_at']));
                            $AssetScoreReport['Unit Updated By'] = $Asset['Unit']['Editor']['first_name'] . ' ' . $Asset['Unit']['Editor']['last_name'];
                            $AssetScoreReport['Editor User ID ,'] = $Asset['Unit']['Editor']['id'];
                            $AssetScoreReport['Unit Editor User First Name ,'] = $Asset['Unit']['Editor']['first_name'];
                            $AssetScoreReport['Unit Editor User Last Name ,'] = $Asset['Unit']['Editor']['last_name'];
                            $AssetScoreReport['Unit Editor User e-mail ,'] = $Asset['Unit']['Editor']['email_address'];
                            $AssetScoreReport['Unit Editor User Phone ,'] = $Asset['Unit']['Editor']['phone'];
                            $AssetScoreReport['Unit Editor User Role ,'] = $Asset['Unit']['Editor']['role'];

                            $AssetScoreReport['Collection ID'] = $Asset['Collection']['id'];
                            $AssetScoreReport['Collection Primary ID'] = $Asset['Collection']['inst_id'];
                            $AssetScoreReport['Collection Name'] = $Asset['Collection']['name'];
                            $AssetScoreReport['Collection Description'] = $Asset['Collection']['resident_structure_description'];


                            $AssetScoreReport['Storage Location ID ,'] = $Asset['Collection']['StorageLocations']['id'];
                            $AssetScoreReport['Collection Storage Location Name ,'] = $Asset['Collection']['StorageLocations']['name'];
                            $AssetScoreReport['Collection Storage Location ,'] = $Asset['Collection']['StorageLocations']['name'];
                            $AssetScoreReport['Collection Storage Location Building name/Room number ,'] = $Asset['Collection']['StorageLocations']['resident_structure_description'];
                            $AssetScoreReport['Collection Storage Location Environment ,'] = StorageLocation::$constants[$Asset['Collection']['StorageLocations'][0]['env_rating']]; #$Asset['Collection']['StorageLocations']['role'];

                            $AssetScoreReport['Unit Personnel ID ,'] = $Asset['Unit']['Personnel'][0]['id'];
                            $AssetScoreReport['Unit Personnel First Name ,'] = $Asset['Unit']['Personnel'][0]['first_name'];
                            $AssetScoreReport['Unit Personnel Last Name ,'] = $Asset['Unit']['Personnel'][0]['last_name'];
                            $AssetScoreReport['Unit Personnel Role ,'] = $Asset['Unit']['Personnel'][0]['role'];
                            $AssetScoreReport['Unit Personnel Email ,'] = $Asset['Unit']['Personnel'][0]['email_address'];
                            $AssetScoreReport['Unit Personnel Phone ,'] = $Asset['Unit']['Personnel'][0]['phone'];



                            $AssetScoreReport['Collection Created'] = date('Y-m-d H:i:s', strtotime($Asset['Collection']['created_at']));
                            $AssetScoreReport['Collection Created By'] = $Asset['Collection']['Creator']['first_name'] . ' ' . $Asset['Collection']['Creator']['last_name']; #
                            $AssetScoreReport['Collection Creator User ID -'] = $Asset['Collection']['Creator']['id'];
                            $AssetScoreReport['Collection Creator User First Name -'] = $Asset['Collection']['Creator']['first_name'];
                            $AssetScoreReport['Collection Creator User Last Name -'] = $Asset['Collection']['Creator']['last_name'];
                            $AssetScoreReport['Collection Creator User e-mail -'] = $Asset['Collection']['Creator']['email_address'];
                            $AssetScoreReport['Collection CreatorUser Phone -'] = $Asset['Collection']['Creator']['phone'];
                            $AssetScoreReport['Collection Creator User Role -'] = $Asset['Collection']['Creator']['role'];

                            $AssetScoreReport['Collection'] = $Asset['Collection']['name'];
                            $AssetScoreReport['Updated On'] = date('Y-m-d H:i:s', strtotime($Asset['Collection']['updated_at']));
                            $AssetScoreReport['Collection Updated By'] = $Asset['Collection']['Editor']['first_name'] . ' ' . $Asset['Collection']['Editor']['last_name'];
                            $AssetScoreReport['Collection Editor User ID -'] = $Asset['Collection']['Editor']['id'];
                            $AssetScoreReport['Collection Editor User First Name-'] = $Asset['Collection']['Editor']['first_name'];
                            $AssetScoreReport['Collection Editor User Last Name-'] = $Asset['Collection']['Editor']['last_name'];
                            $AssetScoreReport['Collection Editor User e-mail-'] = $Asset['Collection']['Editor']['email_address'];
                            $AssetScoreReport['Collection Editor User Phone-'] = $Asset['Collection']['Editor']['phone'];
                            $AssetScoreReport['Collection Editor User Role-'] = $Asset['Collection']['Editor']['role'];

                            $AssetScoreReport['Asset Group ID'] = $Asset['AssetGroup']['id'];
                            $AssetScoreReport['Asset Group Primary ID'] = $Asset['AssetGroup']['inst_id'];
                            $AssetScoreReport['Asset Group Name'] = $Asset['AssetGroup']['name'];

                            $AssetScoreReport['Storage Location Name'] = $Asset['Collection']['StorageLocations']['name'];
                            $AssetScoreReport['Asset Group Description Location'] = $Asset['AssetGroup']['resident_structure_description'];


                            $AssetScoreReport['Asset Group Created'] = date('Y-m-d H:i:s', strtotime($Asset['AssetGroup']['created_at']));

                            $AssetScoreReport['Asset Group Created By User ID _'] = $Asset['AssetGroup']['Creator']['id'];
                            $AssetScoreReport['AssetGroup User First Name _'] = $Asset['AssetGroup']['Creator']['first_name'];
                            $AssetScoreReport['AssetGroup User Last Name _'] = $Asset['AssetGroup']['Creator']['last_name'];
                            $AssetScoreReport['AssetGroup User e-mail _'] = $Asset['AssetGroup']['Creator']['email_address'];
                            $AssetScoreReport['AssetGroup User Phone _'] = $Asset['AssetGroup']['Creator']['phone'];
                            $AssetScoreReport['AssetGroup User Role _'] = $Asset['AssetGroup']['Creator']['role'];


                            $AssetScoreReport['Asset Group'] = $Asset['AssetGroup']['name'];
                            $AssetScoreReport['Updated On'] = $Asset['AssetGroup']['Editor']['role'];
                            $AssetScoreReport['Asset Group Updated By *'] = $Asset['AssetGroup']['Editor']['first_name'] . ' ' . $Asset['AssetGroup']['Editor']['last_name']; #;
                            $AssetScoreReport['AssetGroup User Editor User ID *'] = $Asset['AssetGroup']['Editor']['id'];
                            $AssetScoreReport['AssetGroup User Editor First Name *'] = $Asset['AssetGroup']['Editor']['first_name'];
                            $AssetScoreReport['AssetGroup User Editor User Last Name *'] = $Asset['AssetGroup']['Editor']['last_name'];
                            $AssetScoreReport['AssetGroup User Editor User e-mail *'] = $Asset['AssetGroup']['Editor']['email_address'];
                            $AssetScoreReport['AssetGroup User Editor User Phone *'] = $Asset['AssetGroup']['Editor']['phone'];
                            $AssetScoreReport['AssetGroup User Editor User Role * '] = $Asset['AssetGroup']['Editor']['role'];


                            $AssetScoreReport['Asset Group Date'] = date('Y-m-d H:i:s', strtotime($Asset['AssetGroup']['created_at']));
                            $AssetScoreReport['Asset Group Person'] = $Asset['Unit']['Personnel']['role'];
                            $AssetScoreReport['Asset Group Personnel User ID  *'] = $Asset['Unit']['Personnel']['role'];
                            $AssetScoreReport['Asset Group Personnel User First Name *'] = $Asset['Unit']['Personnel'][0]['first_name'];
                            $AssetScoreReport['Asset Group Personnel User Last Name *'] = $Asset['Unit']['Personnel'][0]['last_name'];
                            $AssetScoreReport['Asset Group Personnel User e-mail *'] = $Asset['Unit']['Personnel'][0]['email_address'];
                            $AssetScoreReport['Asset Group Personnel User Phone *'] = $Asset['Unit']['Personnel'][0]['phone'];
                            $AssetScoreReport['Asset Group Personnel User Role *'] = $Asset['Unit']['Personnel']['role'];
                            $AssetScoreReport['Asset Group In consultation With *'] = $Asset['AssetGroup']['EvaluatorHistory'][0]['role'];


                            $AssetScoreReport['Unit Asset Group Personnel-ID *'] = $Asset['Unit']['Personnel'][0]['id'];
                            $AssetScoreReport['Unit Asset Group Personnel-First Name *'] = $Asset['Unit']['Personnel'][0]['first_name'];
                            $AssetScoreReport['Unit Asset Group Personnel-Last Name *'] = $Asset['Unit']['Personnel'][0]['last_name'];
                            $AssetScoreReport['Unit Asset Group Personnel-Role *'] = $Asset['Unit']['Personnel'][0]['role'];
                            $AssetScoreReport['Unit Asset Group Personnel Email *'] = $Asset['Unit']['Personnel'][0]['email_address'];
                            $AssetScoreReport['Unit Asset Group Personnel Phone *'] = $Asset['Unit']['Personnel'][0]['phone'];

                            $FormatArray = explode(',', $Asset['AssetGroup']['FormatType']['format']);
                            $format = '';

                            foreach ($FormatArray as $formatValue) {
                                if ($formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue)) {
                                    $format .= $formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['type'], 'formatVersion', $formatValue) . ' , ';
                                } else {
                                    $format .= $formatTypeValuesManager->getArrayOfValueTargeted('general', 'formatVersion', $formatValue) . ' , ';
                                }
                            }

                            $AssetScoreReport['Format'] = $format;
                            $AssetScoreReport['Quantity'] = $Asset['AssetGroup']['FormatType']['quantity'];
                            $AssetScoreReport['Generation'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'generation', $Asset['AssetGroup']['FormatType']['generation']);
                            $AssetScoreReport['Year Recorded'] = $Asset['AssetGroup']['FormatType']['year_recorded'];
                            $AssetScoreReport['Copies'] = ($Asset['AssetGroup']['FormatType']['copies'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['Stock Brand'] = $Asset['AssetGroup']['FormatType']['stock_brand'];
                            $AssetScoreReport['Off-Brand'] = ($Asset['AssetGroup']['FormatType']['off_brand'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['Fungus'] = ($Asset['AssetGroup']['FormatType']['fungus'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['Other Contaminants'] = ($Asset['AssetGroup']['FormatType']['other_contaminants'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['Duration'] = $Asset['AssetGroup']['FormatType']['duration'];
                            $AssetScoreReport['Duration type'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'duration_type', $Asset['AssetGroup']['FormatType']['duration_type']);
                            $AssetScoreReport['Duration type Methodology'] = $Asset['AssetGroup']['FormatType']['duration_type_methodology'];

                            $AssetScoreReport['format_notes'] = $Asset['AssetGroup']['FormatType']['format_notes'];

                            $AssetScoreReport['type'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'GlobalFormatType', $Asset['AssetGroup']['FormatType']['type']);
                            $AssetScoreReport['material'] = NULL;
                            if ($AssetScoreReport['type'] == 'Metal Disc')
                                $AssetScoreReport['material'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'material', $Asset['AssetGroup']['FormatType']['material']);
                            $AssetScoreReport['oxidationcorrosion'] = ($Asset['AssetGroup']['FormatType']['oxidationCorrosion'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['pack_deformation'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'pack_deformation', $Asset['AssetGroup']['FormatType']['pack_deformation']);
                            $AssetScoreReport['noise_reduction'] = ($Asset['AssetGroup']['FormatType']['noise_reduction'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['tape_type'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'tape_type', $Asset['AssetGroup']['FormatType']['tape_type']);
                            $AssetScoreReport['thin_tape'] = ($Asset['AssetGroup']['FormatType']['thin_tape'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['slow_speed'] = ($Asset['AssetGroup']['FormatType']['slow_speed'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['sound_field'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'sound_field', $Asset['AssetGroup']['FormatType']['sound_field']);
                            $AssetScoreReport['soft_binder_syndrome'] = ($Asset['AssetGroup']['FormatType']['soft_binder_syndrome'] == '1') ? 'Yes' : 'No';

                            $AssetScoreReport['gauge'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'gauge', $Asset['AssetGroup']['FormatType']['gauge']);
                            $AssetScoreReport['color'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'color', $Asset['AssetGroup']['FormatType']['color']);
                            $AssetScoreReport['colorfade'] = ($Asset['AssetGroup']['FormatType']['colorFade'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['soundtrackformat'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'soundtrackFormat', $Asset['AssetGroup']['FormatType']['soundtrackFormat']);
                            $AssetScoreReport['substrate'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'substrate', $Asset['AssetGroup']['FormatType']['substrate']);
                            $AssetScoreReport['strongodor'] = ($Asset['AssetGroup']['FormatType']['strongOdor'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['vinegarodor'] = ($Asset['AssetGroup']['FormatType']['vinegarOdor'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['adstriplevel'] = $Asset['AssetGroup']['FormatType']['ADStripLevel'];
                            $AssetScoreReport['shrinkage'] = ($Asset['AssetGroup']['FormatType']['shrinkage'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['levelofshrinkage'] = $Asset['AssetGroup']['FormatType']['levelOfShrinkage'];
                            $AssetScoreReport['rust'] = ($Asset['AssetGroup']['FormatType']['rust'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['discoloration'] = ($Asset['AssetGroup']['FormatType']['discoloration'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['surfaceblisteringbubbling'] = ($Asset['AssetGroup']['FormatType']['surfaceBlisteringBubbling'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['thintape'] = ($Asset['AssetGroup']['FormatType']['thinTape'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['1993orearlier'] = ($Asset['AssetGroup']['FormatType']['1993OrEarlier'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['datagradetape'] = ($Asset['AssetGroup']['FormatType']['dataGradeTape'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['longplay32k96k'] = ($Asset['AssetGroup']['FormatType']['longPlay32K96K'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['corrosionrustoxidation'] = ($Asset['AssetGroup']['FormatType']['corrosionRustOxidation'] == '1') ? 'Yes' : 'No';
                            if ($formatTypeValuesManager->getArrayOfValueTargeted('general', 'composition', $Asset['AssetGroup']['FormatType']['composition'])) {
                                $AssetScoreReport['composition'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'composition', $Asset['AssetGroup']['FormatType']['composition']);
                            } else {
                                $AssetScoreReport['composition'] = '';
                            }

                            $AssetScoreReport['nonstandardbrand'] = ($Asset['AssetGroup']['FormatType']['nonStandardBrand'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['trackconfiguration'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'trackConfiguration', $Asset['AssetGroup']['FormatType']['trackConfiguration']);
                            $AssetScoreReport['tapethickness'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'tapeThickness', $Asset['AssetGroup']['FormatType']['tapeThickness']);

                            $SpeedArray = explode(',', $Asset['AssetGroup']['FormatType']['speed']);
                            $SpeedText = '';

                            foreach ($SpeedArray as $Speed) {
                                $SpeedText .= $formatTypeValuesManager->getArrayOfValueTargeted('general', 'speed', $Speed) . ' , ';
                            }
                            $AssetScoreReport['speed'] = $SpeedText;

                            $AssetScoreReport['softbindersyndrome'] = ($Asset['AssetGroup']['FormatType']['softBinderSyndrome'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['materialsbreakdown'] = ($Asset['AssetGroup']['FormatType']['materialsBreakdown'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['physicaldamage'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'physicalDamage', $Asset['AssetGroup']['FormatType']['physicalDamage']);
                            $AssetScoreReport['delamination'] = ($Asset['AssetGroup']['FormatType']['delamination'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['plasticizerexudation'] = ($Asset['AssetGroup']['FormatType']['plasticizerExudation'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['recordinglayer'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'recordingLayer', $Asset['AssetGroup']['FormatType']['recordingLayer']);

                            $recordingspeedArray = explode(',', $Asset['AssetGroup']['FormatType']['recordingSpeed']);
                            $recordingspeedText = '';

                            foreach ($recordingspeedArray as $recordingspeed) {
                                $recordingspeedText .= $formatTypeValuesManager->getArrayOfValueTargeted('general', 'recordingSpeed', $recordingspeed) . ' , ';
                            }

                            $AssetScoreReport['recordingspeed'] = $recordingspeedText;
                            $AssetScoreReport['cylindertype'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'cylinderType', $Asset['AssetGroup']['FormatType']['cylinderType']);
                            $AssetScoreReport['reflectivelayer'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'reflectiveLayer', $Asset['AssetGroup']['FormatType']['reflectiveLayer']);
                            $AssetScoreReport['datalayer'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'dataLayer', $Asset['AssetGroup']['FormatType']['dataLayer']);


                            $opticalDiscTypeArray = explode(',', $Asset['AssetGroup']['FormatType']['opticalDiscType']);
                            $opticalDiscTypeText = '';

                            foreach ($opticalDiscTypeArray as $opticalDiscType) {
                                $opticalDiscTypeText .= $formatTypeValuesManager->getArrayOfValueTargeted('general', 'opticalDiscType', $opticalDiscType) . ' , ';
                            }

                            $AssetScoreReport['opticaldisctype'] = $opticalDiscTypeText;

//                    $AssetScoreReport['format'] = $Asset['AssetGroup']['FormatType']['format']; #
                            $AssetScoreReport['recordingstandard'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'recordingStandard', $Asset['AssetGroup']['FormatType']['recordingStandard']);
                            $AssetScoreReport['publicationyear'] = $Asset['AssetGroup']['FormatType']['publicationYear'];
                            $AssetScoreReport['capacitylayers'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'capacityLayers', $Asset['AssetGroup']['FormatType']['capacityLayers']);
                            $AssetScoreReport['codec'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'codec', $Asset['AssetGroup']['FormatType']['codec']);
                            $AssetScoreReport['datarate'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'dataRate', $Asset['AssetGroup']['FormatType']['dataRate']);
                            $AssetScoreReport['sheddingsoftbinder'] = $Asset['AssetGroup']['FormatType']['sheddingSoftBinder'];
                            $AssetScoreReport['oxide'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'oxide', $Asset['AssetGroup']['FormatType']['oxide']);
                            $AssetScoreReport['bindersystem'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'binderSystem', $Asset['AssetGroup']['FormatType']['binderSystem']);

                            $reelsizeArray = explode(',', $Asset['AssetGroup']['FormatType']['opticalDiscType']);
                            $reelsizeText = '';

                            foreach ($reelsizeArray as $reelsize) {
                                $reelsizeText .= $formatTypeValuesManager->getArrayOfValueTargeted($Asset['AssetGroup']['FormatType']['type'], 'reelsize', $reelsize) . ' , ';
                            }
                            $AssetScoreReport['reelsize'] = $reelsizeText;
                            $reelsizeText = '';
                            $AssetScoreReport['whiteresidue'] = ($Asset['AssetGroup']['FormatType']['whiteResidue'] == '1') ? 'Yes' : 'No';

                            $sizeArray = explode(',', $Asset['AssetGroup']['FormatType']['size']);
                            $sizeText = '';
                            foreach ($sizeArray as $size) {
                                $sizeText .= $formatTypeValuesManager->getArrayOfValueTargeted('general', 'size', $size) . ' , ';
                            }
                            $AssetScoreReport['size'] = $sizeText;
                            $AssetScoreReport['formattypedvideorecordingformat'] = ($Asset['AssetGroup']['FormatType']['formatTypedVideoRecordingFormat'] == '1') ? 'Yes' : 'No';
                            $AssetScoreReport['bitrate'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'bitrate', $Asset['AssetGroup']['FormatType']['bitrate']);
                            $AssetScoreReport['scanning'] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'scanning', $Asset['AssetGroup']['FormatType']['scanning']);



                            $DataDumpReportArray[] = $AssetScoreReport;
                        }
                    }
                } elseif ($param['reports']['listReports'] == '1') {

                    $Units = Doctrine_Query::Create()
                            ->from('Unit u')
                            ->select('u.*,sl.*,p.*,cu.*,eu.*')
                            ->leftJoin('u.StorageLocations sl')
                            ->fetchArray();
                    foreach ($Units as $Unit) {
                        $Collections = Doctrine_Query::Create()
                                ->from('Collection c')
                                ->select('c.*,sl.*,cu.*,eu.*')
                                ->leftJoin('c.StorageLocations sl')
                                ->where('c.parent_node_id  = ?', $Unit['id'])
                                ->fetchArray();
                        $SolutionArray = array();
                        foreach ($Collections as $Collection) {
                            $SolutionArray['Collection'] = $Collection;
                            $SolutionArray['Unit'] = $Unit;

                            $Assets[] = $SolutionArray;
                        }
                    }


                    if ($Assets) {
                        foreach ($Assets as $Asset) {
                            $AssetScoreReport = array();
                            $AssetScoreReport['Storage Location ID'] = $Asset['Unit']['StorageLocations'][0]['id'];
                            $AssetScoreReport['Storage Location Name'] = $Asset['Unit']['StorageLocations'][0]['name'];
                            $AssetScoreReport['Storage Location Building name/Room number'] = $Asset['Unit']['StorageLocations'][0]['resident_structure_description'];
                            $AssetScoreReport['Storage Location Environment'] = StorageLocation::$constants[$Asset['Unit']['StorageLocations'][0]['env_rating']];
                            $AssetScoreReport['Unit ID'] = $Asset['Unit']['id'];
                            $AssetScoreReport['Unit Primary ID'] = $Asset['Unit']['inst_id'];
                            $AssetScoreReport['Unit Name'] = $Asset['Unit']['name'];
                            $AssetScoreReport['Building name/Room number'] = $Asset['Unit']['StorageLocations'][0]['resident_structure_description'];
                            $AssetScoreReport['Collection ID'] = $Asset['Collection']['id'];
                            $AssetScoreReport['Collection Primary ID'] = $Asset['Collection']['inst_id'];
                            $AssetScoreReport['Collection Name'] = $Asset['Collection']['name'];
                            $AssetScoreReport['Collection Description'] = $Asset['Collection']['notes'];
                            $DataDumpReportArray[] = $AssetScoreReport;
                        }
                    }
                } elseif ($param['reports']['listReports'] == '2') {
                    $Units = Doctrine_Query::Create()
                            ->from('Unit u')
                            ->select('u.*,sl.*,p.*,cu.*,eu.*')
                            ->leftJoin('u.StorageLocations sl')
                            ->leftJoin('u.Personnel p')
                            ->fetchArray();
                    $SolutionArray = array();
                    foreach ($Units as $Unit) {
                        $SolutionArray['Unit'] = $Unit;
                        $Assets[] = $SolutionArray;
                    }

                    if ($Assets) {
                        foreach ($Assets as $Asset) {
                            $AssetScoreReport = array();
                            $AssetScoreReport['Unit Personnel ID'] = $Asset['Unit']['Personnel'][0]['id'];
                            $AssetScoreReport['Unit Personnel First Name'] = $Asset['Unit']['Personnel'][0]['first_name'];
                            $AssetScoreReport['Unit Personnel Last Name'] = $Asset['Unit']['Personnel'][0]['last_name'];
                            $AssetScoreReport['Unit Personnel Role'] = $Asset['Unit']['Personnel'][0]['role'];
                            $AssetScoreReport['Unit Personnel Email'] = $Asset['Unit']['Personnel'][0]['email_address'];
                            $AssetScoreReport['Unit Personnel Phone'] = $Asset['Unit']['Personnel'][0]['phone'];
                            $AssetScoreReport['Unit ID'] = $Asset['Unit']['id'];
                            $AssetScoreReport['Unit Primary ID'] = $Asset['Unit']['inst_id'];
                            $AssetScoreReport['Unit Name'] = $Asset['Unit']['name'];
                            $AssetScoreReport['Building name/Room number'] = $Asset['Unit']['StorageLocations'][0]['resident_structure_description'];

                            $DataDumpReportArray[] = $AssetScoreReport;
                        }
                    }
                } else {
                    $Users = Doctrine_Query::Create()
                            ->from('sfGuardUser u')
                            ->select('u.*')
                            ->fetchArray();

                    $SolutionArray = array();
                    foreach ($Users as $User) {
                        $SolutionArray['User'] = $User;
                        $Assets[] = $SolutionArray;
                    }

                    if ($Assets) {
                        foreach ($Assets as $Asset) {
                            $AssetScoreReport = array();

                            $AssetScoreReport['User ID'] = $Asset['User']['id'];
                            $AssetScoreReport['User First Name'] = $Asset['User']['first_name'];
                            $AssetScoreReport['User Last Name'] = $Asset['User']['last_name'];
                            $AssetScoreReport['User e-mail'] = $Asset['User']['email_address'];
                            $AssetScoreReport['User Phone'] = $Asset['User']['phone'];
                            $AssetScoreReport['User Role'] = $Asset['User']['role'];

                            $DataDumpReportArray[] = $AssetScoreReport;
                        }
                    }
                }

                if ($ExportType == 'xls') {
                    $excel = new excel();

                    $excel->setDataArray($DataDumpReportArray);
                    $excel->extractHeadings();
                    $filename = '';
                    $Sheettitle = '';
                    if ($param['reports']['listReports'] == '0') {
                        $filename = 'Output_All_Asset_Groups_Report_' . date('Ymd') . '.xlsx';
                        $Sheettitle = 'Asset_Groups_Report';
                    } else if ($param['reports']['listReports'] == '1') {
                        $filename = 'Output_All_Asset_Storage_Locations_' . date('Ymd') . '.xlsx';
                        $Sheettitle = 'Assets_Storage_Locations';
                    } else if ($param['reports']['listReports'] == '2') {
                        $filename = 'Output_All_Unit_Personnel_' . date('Ymd') . '.xlsx';
                        $Sheettitle = 'Unit_Personnel';
                    } else {
                        $filename = 'Output_All_Users_Report_' . date('Ymd') . '.xlsx';
                        $Sheettitle = 'Users_Report';
                    }

                    $intial_dicrectory = '/AssetsScore/xls/';
                    $file_name_with_directory = $intial_dicrectory . $filename;

                    $excel->setDataArray($DataDumpReportArray);
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
                    $file_name = '';
                    $intial_dicrectory = '';
                    if ($param['reports']['listReports'] == '0') {

                        $file_name = 'Output_All_Asset_Groups_Report_' . date('Ymd') . '.csv';
                        $intial_dicrectory = '/AssetsScore/csv/';
                    } else if ($param['reports']['listReports'] == '1') {

                        $file_name = 'Output_All_Asset_Storage_Locations_' . date('Ymd') . '.csv';
                        $intial_dicrectory = '/AssetsScore/csv/';
                    } else if ($param['reports']['listReports'] == '2') {

                        $file_name = 'Output_All_Unit_Personnel_' . date('Ymd') . '.csv';
                        $intial_dicrectory = '/AssetsScore/csv/';
                    } else {

                        $file_name = 'Output_All_Users_Report_' . date('Ymd') . '.csv';
                        $intial_dicrectory = '/AssetsScore/csv/';
                    }



                    $file_name_with_directory = $intial_dicrectory . $file_name;
                    $csvHandler->CreateCSV($DataDumpReportArray, $file_name_with_directory);
                    $csvHandler->DownloadCSV($file_name_with_directory, $file_name);
                    $csvHandler->DeleteFile($file_name_with_directory);
                    exit;
                }
            }
        }
    }

    /**
     * User Ealuator Report From reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executeEvaluatorsreport(sfWebRequest $request) {
        $this->form = new ReportsForm(null, array('from' => 'evaluatorsreport'));
        if ($request->getMethod() == 'POST') {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $DataDumpReportArray = array();
                $Assets = array();

                $params = $request->getPostParameters();

                $ListEvaluators = $params['reports']['ListEvaluators'];
                $format_id = $params['reports']['format_id'];
                $EvaluatorsStartDate = $params['reports']['EvaluatorsStartDate'];
                $EvaluatorsEndDate = $params['reports']['EvaluatorsEndDate'];
                $ExportType = $params['reports']['ExportType'];
                if ($ListEvaluators && $format_id) {

                    $EvaluatorHistorys = Doctrine_Query::Create()
                            ->from('AssetGroup as')
                            ->select('as.*,eh.*,ft.*,e.*')
                            ->leftJoin('as.EvaluatorHistory eh')
                            ->leftJoin('as.FormatType ft')
                            ->whereIn('eh.evaluator_id', $ListEvaluators)
                            ->andwhereIn('ft.type', $format_id);
                    if (!empty($EvaluatorsStartDate))
                        $EvaluatorHistorys = $EvaluatorHistorys->andWhere("DATE_FORMAT(eh.updated_at,'%Y-%m-%d') >= ?", $EvaluatorsStartDate);
                    if (!empty($EvaluatorsEndDate))
                        $EvaluatorHistorys = $EvaluatorHistorys->andWhere("DATE_FORMAT(eh.updated_at,'%Y-%m-%d') <= ?", $EvaluatorsEndDate);
                    $EvaluatorHistorys = $EvaluatorHistorys->fetchArray();


                    foreach ($EvaluatorHistorys as $EvaluatorHistory) {

                        $Collection = Doctrine_Query::Create()
                                ->from('Collection c')
                                ->select('c.*')
                                ->where('c.id = ?', $EvaluatorHistory['parent_node_id'])
                                ->fetchArray();

                        $Unit = Doctrine_Query::Create()
                                ->from('Unit u')
                                ->select('u.*')
                                ->where('u.id = ?', $Collection[0]['parent_node_id'])
                                ->fetchArray();
                        $User = Doctrine_Query::Create()
                                ->from('sfGuardUser u')
                                ->select('u.*')
                                ->where('u.id = ?', $EvaluatorHistory['EvaluatorHistory'][0]['evaluator_id'])
                                ->fetchArray();

                        $SolutionArray = array();

                        $SolutionArray['User'] = $User;
                        $SolutionArray['AssetGroup'] = $EvaluatorHistory;
                        $SolutionArray['Collection'] = $Collection;
                        $SolutionArray['Unit'] = $Unit;

                        $Assets[] = $SolutionArray;
                    }

                    if ($Assets) {
                        foreach ($Assets as $Asset) {

                            $AssetScoreReport = array();

//							$AssetScoreReport['User ID'] = $Asset['User'][0]['id'];
                            $AssetScoreReport['User First Name'] = $Asset['User'][0]['first_name'];
                            $AssetScoreReport['User Last Name'] = $Asset['User'][0]['last_name'];
//							$AssetScoreReport['User e-mail'] = $Asset['User'][0]['email_address'];
//							$AssetScoreReport['User Phone'] = $Asset['User'][0]['phone'];
                            $AssetScoreReport['User Role'] = ($Asset['User'][0]['role'] == 0) ? 'User' : 'Admin';
//							$AssetScoreReport['Unit ID'] = $Asset['Unit'][0]['id'];
                            $AssetScoreReport['Unit Name'] = $Asset['Unit'][0]['name'];
//							$AssetScoreReport['Collection ID'] = $Asset['Collection'][0]['id'];
                            $AssetScoreReport['Collection Name'] = $Asset['Collection'][0]['name'];
//							$AssetScoreReport['Asset Group ID'] = $Asset['AssetGroup']['id'];
                            $AssetScoreReport['Asset Group Primary ID'] = $Asset['AssetGroup']['inst_id'];
                            $AssetScoreReport['Asset Group Name'] = $Asset['AssetGroup']['name'];
                            $AssetScoreReport['Date User Created Asset Group'] = date('Y-m-d H:i:s', strtotime($Asset['AssetGroup']['created_at']));
                            $AssetScoreReport['Date User Updated Asset Group'] = date('Y-m-d H:i:s', strtotime($Asset['AssetGroup']['updated_at']));

                            $DataDumpReportArray[] = $AssetScoreReport;
                        }
                        if ($ExportType == 'xls') {
                            $excel = new excel();

                            $excel->setDataArray($DataDumpReportArray);
                            $excel->extractHeadings();
                            $filename = 'User_Report_' . date('Ymd') . '.xlsx';
                            $Sheettitle = 'User_Report';
                            $intial_dicrectory = '/AssetsScore/xls/';
                            $file_name_with_directory = $intial_dicrectory . $filename;

                            $excel->setDataArray($DataDumpReportArray);
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

                            $file_name = 'User_Report_' . date('Ymd') . '.csv';
                            $intial_dicrectory = '/AssetsScore/csv/';
                            $file_name_with_directory = $intial_dicrectory . $file_name;
                            $csvHandler->CreateCSV($DataDumpReportArray, $file_name_with_directory);
                            $csvHandler->DownloadCSV($file_name_with_directory, $file_name);
                            $csvHandler->DeleteFile($file_name_with_directory);
                            exit;
                        }
                    } else {
                        $Bug = '<span style="color:#7d110c;font-size:16px;"><b>No record available for export.</b></span>';
                        $this->getResponse()->setSlot('my_slot', $Bug);
                    }
                }
            }
        }
    }

    /**
     * Percentage Of Holding Report From reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executePercentageofholdings(sfWebRequest $request) {
        $this->form = new ReportsForm(null, array('from' => 'percentageofholdings', 'user' => $this->getUser()->getGuardUser()));
        if ($request->getMethod() == 'POST') {

            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $params = $request->getPostParameters();

                $formatTypeValuesManager = new formatTypeValuesManager();

                $DataDumpReportArray = array();
                $Assets = array();
                $quantity = 0;
                $duration = 0;

                $Collection_id = $params['reports']['listCollection_RRD'];
                $Units_id = $params['reports']['listUnits_RRD'];
                $format_id = $params['reports']['format_id'];
                $ExportType = $params['reports']['ExportType'];
                $ReportType = $params['reports']['ReportType'];
                if ($Collection_id && $Units_id && $format_id) {
                    if ($ReportType == '0') {
                        $Units = Doctrine_Query::Create()
                                ->from('Unit u')
                                ->select('u.*,sl.*,p.*,cu.*,eu.*')
                                ->whereIn('u.id', $Units_id)
                                ->fetchArray();

                        foreach ($Units as $Unit) {

                            $Collections = Doctrine_Query::Create()
                                    ->from('Collection c')
                                    ->select('c.*')
                                    ->where('c.parent_node_id  = ?', $Unit['id'])
                                    ->andWhereIn('c.id', $Collection_id)
                                    ->fetchArray();

                            foreach ($Collections as $Collection) {
                                $Asset = Doctrine_Query::Create()
                                        ->from('AssetGroup a')
                                        ->select('a.*, ft.*')
                                        ->leftJoin("a.FormatType ft")
                                        ->where('a.parent_node_id  = ?', $Collection['id'])
                                        ->andWhereIn('ft.type', $format_id)
                                        ->fetchArray();

                                if ($Asset) {
                                    foreach ($Asset as $key => $A) {
                                        $quantity = $quantity + $A['FormatType']['quantity'];
                                        $duration = $duration + $A['FormatType']['duration'];
                                        $SolutionArray = array();
                                        $SolutionArray[$Unit['id']]['AssetGroup'] = $A;
                                        $SolutionArray[$Unit['id']]['Collection'] = $Collection;
                                        $SolutionArray[$Unit['id']]['Unit'] = $Unit;
                                        $Assets[$Unit['id']][] = $SolutionArray[$Unit['id']];
                                    }
                                }
                            }
                            if ($Assets) {
                                $Assets[$Unit['id']]['Totals']['QuantityTotal'] = $quantity;
                                $Assets[$Unit['id']]['Totals']['DurationTotal'] = $duration;
                            }
                            $quantity = 0;
                            $duration = 0;
                        }


                        if ($Assets) {
                            $j = 1;
                            foreach ($Assets as $Asset) {

                                $i = 1;
                                $AssetScoreReport = array();
                                $AssetScoreReport['Unit ID ' . $j] = $Asset[0]['Unit']['id'];
                                $AssetScoreReport['Unit Name ' . $j] = $Asset[0]['Unit']['name'];

                                foreach ($Asset as $key_reportGen => $reportGen) {

                                    $AssetScoreReport['Format ' . ($i)] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'GlobalFormatType', $reportGen['AssetGroup']['FormatType']['type']);
                                    $AssetScoreReport['Percentage by duration that Format  ' . ($i) . ' makes up of Unit'] = round((($reportGen['AssetGroup']['FormatType']['duration'] * 100) / $Assets[$Asset[0]['Unit']['id']]['Totals']['DurationTotal'])) . ' % ';
                                    $AssetScoreReport['Percentage by quantity that Format ' . ($i) . ' makes up of Unit'] = round((($reportGen['AssetGroup']['FormatType']['quantity'] * 100) / $Assets[$Asset[0]['Unit']['id']]['Totals']['QuantityTotal'])) . ' % ';

                                    $i++;
                                }

                                $j++;
                                $DataDumpReportArray[] = $AssetScoreReport;
                            }
                            $maxCountElementsCount = count($DataDumpReportArray[0]);
                            $maxCountElementsIndex = 0;

                            foreach ($DataDumpReportArray as $key => $DataDump) {

                                if ($maxCountElementsCount < count($DataDump)) {
                                    $maxCountElementsIndex = $key;
                                    $maxCountElementsCount = count($DataDump);
                                }
                            }

                            if ($ExportType == 'xls') {
                                $excel = new excel();

                                $excel->setDataArray($DataDumpReportArray);
                                $excel->extractHeadings();
                                $filename = 'Unit_Format_Makeup_Report_' . date('Ymd') . '.xlsx';
                                $Sheettitle = 'Unit_Format_Makeup_Report';
                                $intial_dicrectory = '/AssetsScore/xls/';
                                $file_name_with_directory = $intial_dicrectory . $filename;

//                        $excel->setDataArray($DataDumpReportArray);

                                $excel->extractHeadings($maxCountElementsIndex);
                                $excel->setFileName($file_name_with_directory);
                                $excel->setSheetTitle($Sheettitle);

                                $excel->createExcel();

                                $excel->SaveFile();
                                $excel->DownloadXLSX($file_name_with_directory, $filename);
                                $excel->DeleteFile($file_name_with_directory);
                                exit;
                            } else {
                                $csvHandler = new csvHandler();

                                $file_name = 'Unit_Format_Makeup_Report_' . date('Ymd') . '.csv';
                                $intial_dicrectory = '/AssetsScore/csv/';
                                $file_name_with_directory = $intial_dicrectory . $file_name;
                                $csvHandler->CreateCSV($DataDumpReportArray, $file_name_with_directory, TRUE, $maxCountElementsIndex);
                                $csvHandler->DownloadCSV($file_name_with_directory, $file_name);
                                $csvHandler->DeleteFile($file_name_with_directory);
                                exit;
                            }
                        } else {
                            $Bug = '<span style="color:#7d110c;font-size:16px;"><b>No record available for export.</b></span>';
                            $this->getResponse()->setSlot('my_slot', $Bug);
                        }
                    } else if ($ReportType == '1') {
                        $Units = Doctrine_Query::Create()
                                ->from('Unit u')
                                ->select('u.*')
                                ->fetchArray();

                        foreach ($Units as $Unit) {

                            $Collections = Doctrine_Query::Create()
                                    ->from('Collection c')
                                    ->select('c.*')
                                    ->where('c.parent_node_id  = ?', $Unit['id'])
                                    ->andWhereIn('c.id', $Collection_id)
                                    ->fetchArray();



                            foreach ($Collections as $Collection) {

                                $Asset = Doctrine_Query::Create()
                                        ->from('AssetGroup a')
                                        ->select('a.*, ft.*')
                                        ->leftJoin("a.FormatType ft")
                                        ->where('a.parent_node_id  = ?', $Collection['id'])
                                        ->andWhereIn('ft.type', $format_id)
                                        ->fetchArray();

                                if ($Asset) {
                                    $SolutionArray = array();
                                    $SolutionArray[$Collection['id']]['Collection'] = $Collection;
                                    $SolutionArray[$Collection['id']]['Unit'] = $Unit;

                                    foreach ($Asset as $key => $A) {
                                        $SolutionArray[$Collection['id']]['Collection']['AssetGroup'][] = $A;
                                    }
                                    $Assets[$Collection['id']] = $SolutionArray[$Collection['id']];
                                }
                            }
                        }
                        if ($Assets) {
                            $j = 1;
                            foreach ($Assets as $Asset) {
                                $AssetScoreReport = array();
                                $AssetScoreReport['Unit ID ' . $j] = $Asset['Unit']['id'];
                                $AssetScoreReport['Unit Name ' . $j] = $Asset['Unit']['name'];

                                $quantity_collection = 0;
                                $duration_collection = 0;
                                $i = 1;
                                foreach ($Asset['Collection']['AssetGroup'] as $report) {
                                    $quantity_collection = $quantity_collection + $report['FormatType']['quantity'];
                                    $duration_collection = $duration_collection + $report['FormatType']['duration'];
                                }

                                foreach ($Asset['Collection']['AssetGroup'] as $key => $report) {
                                    $AssetScoreReport['Collection ID'] = $Asset['Collection']['id'];
                                    $AssetScoreReport['Collection Name'] = $Asset['Collection']['name'];
                                    $AssetScoreReport['Format ' . ($i)] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'GlobalFormatType', $report['FormatType']['type']);
                                    $AssetScoreReport['Percentage by duration that Format ' . ($i) . ' makes up of Collection'] = round(($report['FormatType']['duration'] * 100) / $duration_collection) . ' % ';
                                    $AssetScoreReport['Percentage by quantity that Format ' . ($i) . ' makes up of Collection'] = round(($report['FormatType']['quantity'] * 100) / $quantity_collection) . ' % ';
                                    $i++;
                                }

                                $DataDumpReportArray[] = $AssetScoreReport;
                            }

                            $maxCountElementsCount = count($DataDumpReportArray[0]);
                            $maxCountElementsIndex = 0;

                            foreach ($DataDumpReportArray as $key => $DataDump) {

                                if ($maxCountElementsCount < count($DataDump)) {
                                    $maxCountElementsIndex = $key;
                                    $maxCountElementsCount = count($DataDump);
                                }
                            }

                            if ($ExportType == 'xls') {
                                $excel = new excel();

                                $excel->setDataArray($DataDumpReportArray);
                                $excel->extractHeadings();
                                $filename = 'Collection_Format_Makeup_Report_' . date('Ymd') . '.xlsx';
                                $Sheettitle = 'Collection_Format_Makeup_Report';
                                $intial_dicrectory = '/AssetsScore/xls/';
                                $file_name_with_directory = $intial_dicrectory . $filename;

                                $excel->setDataArray($DataDumpReportArray);

                                $excel->extractHeadings($maxCountElementsIndex);
                                $excel->setFileName($file_name_with_directory);
                                $excel->setSheetTitle($Sheettitle);

                                $excel->createExcel();

                                $excel->SaveFile();
                                $excel->DownloadXLSX($file_name_with_directory, $filename);
                                $excel->DeleteFile($file_name_with_directory);
                                exit;
                            } else {
                                $csvHandler = new csvHandler();

                                $file_name = 'Collection_Format_Makeup_Report_' . date('Ymd') . '.csv';
                                $intial_dicrectory = '/AssetsScore/csv/';
                                $file_name_with_directory = $intial_dicrectory . $file_name;
                                $csvHandler->CreateCSV($DataDumpReportArray, $file_name_with_directory, TRUE, $maxCountElementsIndex);
                                $csvHandler->DownloadCSV($file_name_with_directory, $file_name);
                                $csvHandler->DeleteFile($file_name_with_directory);
                                exit;
                            }
                        } else {
                            $Bug = '<span style="color:#7d110c;font-size:16px;"><b>No record available for export.</b></span>';
                            $this->getResponse()->setSlot('my_slot', $Bug);
                        }
                    } else if ($ReportType == '2') {
                        $Units = Doctrine_Query::Create()
                                ->from('Unit u')
                                ->select('u.*')
                                ->whereIn('u.id', $Units_id)
                                ->fetchArray();

                        foreach ($Units as $Unit) {

                            $Collections = Doctrine_Query::Create()
                                    ->from('Collection c')
                                    ->select('c.*')
                                    ->where('c.parent_node_id = ?', $Unit['id'])
                                    ->andWhereIn('c.id', $Collection_id)
                                    ->fetchArray();


                            foreach ($Collections as $Collection) {
                                $Asset = Doctrine_Query::Create()
                                        ->from('AssetGroup a')
                                        ->select('a.*, ft.*')
                                        ->leftJoin("a.FormatType ft")
                                        ->where('a.parent_node_id = ?', $Collection['id'])
                                        ->andWhereIn('ft.type', $format_id)
                                        ->fetchArray();

                                if ($Asset) {
                                    $SolutionArray = array();
                                    $SolutionArray[$Unit['id']]['Collection'] = $Collection;
                                    $SolutionArray[$Unit['id']]['Unit'] = $Unit;

                                    foreach ($Asset as $key => $A) {
                                        $quantity = $quantity + $A['FormatType']['quantity'];
                                        $duration = $duration + $A['FormatType']['duration'];
                                        $SolutionArray[$Unit['id']]['Collection']['AssetGroup'][] = $A;
                                    }
                                    $Assets[$Unit['id']][] = $SolutionArray[$Unit['id']];
                                }
                            }
                            if ($Assets[$Unit['id']]) {
                                $Assets[$Unit['id']]['Totals']['QuantityTotal'] = $quantity;
                                $Assets[$Unit['id']]['Totals']['DurationTotal'] = $duration;
                            }

                            $quantity = 0;
                            $duration = 0;
                        }
                        if ($Assets) {
                            $j = 1;
                            foreach ($Assets as $Asset) {

                                $AssetScoreReport = array();

                                $AssetScoreReport['Unit ID ' . $j] = $Asset[0]['Unit']['id'];
                                $AssetScoreReport['Unit Name ' . $j] = $Asset[0]['Unit']['name'];
                                $i = 1;
                                foreach ($Asset as $key_reportGen => $reportGen) {
                                    $quantity_collection = 0;
                                    $duration_collection = 0;
                                    foreach ($reportGen['Collection']['AssetGroup'] as $report) {
                                        $quantity_collection = $quantity_collection + $report['FormatType']['quantity'];
                                        $duration_collection = $duration_collection + $report['FormatType']['duration'];
                                    }

                                    $AssetScoreReport['Collection ID for Collection ' . ($i)] = $reportGen['Collection']['id'];
                                    $AssetScoreReport['Collection Name for Collection ' . ($i)] = $reportGen['Collection']['name'];
                                    $AssetScoreReport['Percentage by duration that Collection ' . ($i) . ' makes up of Unit'] = round(($duration_collection * 100) / $Asset['Totals']['DurationTotal']) . ' % ';
                                    $AssetScoreReport['Percentage by quantity that Collection ' . ($i) . ' makes up of Unit'] = round(($quantity_collection * 100) / $Asset['Totals']['QuantityTotal']) . ' % ';

                                    $i++;
                                }

                                $DataDumpReportArray[] = $AssetScoreReport;
                                $j++;
                            }

                            $maxCountElementsCount = count($DataDumpReportArray[0]);
                            $maxCountElementsIndex = 0;

                            foreach ($DataDumpReportArray as $key => $DataDump) {
                                if ($maxCountElementsCount < count($DataDump)) {
                                    $maxCountElementsIndex = $key;
                                    $maxCountElementsCount = count($DataDump);
                                }
                            }

                            if ($ExportType == 'xls') {
                                $excel = new excel();

                                $excel->setDataArray($DataDumpReportArray);
                                $excel->extractHeadings();
                                $filename = 'Unit_Collection_Makeup_Report_' . date('Ymd') . '.xlsx';
                                $Sheettitle = 'Unit_Collection_Makeup_Report';
                                $intial_dicrectory = '/AssetsScore/xls/';

                                $file_name_with_directory = $intial_dicrectory . $filename;
                                $excel->setDataArray($DataDumpReportArray);

                                $excel->extractHeadings($maxCountElementsIndex);
                                $excel->setFileName($file_name_with_directory);
                                $excel->setSheetTitle($Sheettitle);

                                $excel->createExcel();

                                $excel->SaveFile();
                                $excel->DownloadXLSX($file_name_with_directory, $filename);
                                $excel->DeleteFile($file_name_with_directory);
                                exit;
                            } else {
                                $csvHandler = new csvHandler();
                                $file_name = 'Unit_Collection_Makeup_Report_' . date('Ymd') . '.csv';
                                $intial_dicrectory = '/AssetsScore/csv/';
                                $file_name_with_directory = $intial_dicrectory . $file_name;
                                $csvHandler->CreateCSV($DataDumpReportArray, $file_name_with_directory, TRUE, $maxCountElementsIndex);
                                $csvHandler->DownloadCSV($file_name_with_directory, $file_name);
                                $csvHandler->DeleteFile($file_name_with_directory);
                                exit;
                            }
                        } else {
                            $Bug = '<span style="color:#7d110c;font-size:16px;"><b>No record available for export.</b></span>';
                            $this->getResponse()->setSlot('my_slot', $Bug);
                        }
                    }
                }
            }
        }
    }

    /**
     * Asset Groups Duration Report From reporting module
     * 
     * @param sfWebRequest $request 
     */
    public function executeDurationandquantitysearch(sfWebRequest $request) {
        $this->form = new ReportsForm(null, array('from' => 'durationandquantitysearch', 'user' => $this->getUser()->getGuardUser()));
        if ($request->getMethod() == 'POST') {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()) {
                $params = $request->getPostParameters();

                $formatTypeValuesManager = new formatTypeValuesManager();

                $DataDumpReportArray = array();
                $Assets = array();
                $Collection_Filter = array();
                $Unit_Filter = array();
                $Format_Filter = array();
                $quantity = 0;
                $duration = 0;

                $Collection_id = $params['reports']['listCollection_RRD'];
                $Units_id = $params['reports']['listUnits_RRD'];
                $format_id = $params['reports']['format_id'];
                $ExportType = $params['reports']['ExportType'];

                if ($Collection_id || $Units_id || $format_id) {
                    $Asset = Doctrine_Query::Create()
                            ->from('AssetGroup ag')
                            ->innerJoin("ag.FormatType ft")
                            ->innerJoin('ag.Collection c')
                            ->innerJoin('c.Unit u')
                            ->leftJoin('u.Personnel p ')
                            ->leftJoin('u.StorageLocations sl')
                            ->where("1=1");
                    if (!empty($Units_id))
                        $Asset = $Asset->andWhereIn('u.id', $Units_id);
                    if (!empty($Collection_id))
                        $Asset = $Asset->andWhereIn('c.id', $Collection_id);
                    if (!empty($format_id))
                        $Asset = $Asset->andWhereIn('ft.type', $format_id);
                    $Asset = $Asset->fetchArray();


                    if ($Asset) {
                        foreach ($Asset as $key => $A) {
                            $quantity = $quantity + $A['FormatType']['quantity'];
                            $duration = $duration + $A['FormatType']['duration'];
                            $SolutionArray = array();
                            $SolutionArray['AssetGroup'] = $A;
                            $SolutionArray['Collection'] = $A['Collection'];
                            $SolutionArray['Unit'] = $A['Collection']['Unit'];
                            $Assets[] = $SolutionArray;
                        }
                    }
                    foreach ($format_id as $formats) {
                        $Format_Filter[$formats] = $formatTypeValuesManager->getArrayOfValueTargeted('general', 'GlobalFormatType', $formats);
                    }
                    $filters = array(
                        'Unit-Filter(s)' => $Unit_Filter,
                        'Collection-Filter(s)' => $Collection_Filter,
                        'Format-Filter(s)' => $Format_Filter,
                        ' ' => ' ',
                        'TotalDuration' => array($duration),
                        'TotalQuantity' => array($quantity),
                    );

                    if ($Assets) {

                        foreach ($Assets as $Asset) {

                            $AssetScoreReport = array();
                            $AssetScoreReport['Unit ID ' . $j] = $Asset['Unit']['id'];
                            $AssetScoreReport['Unit Name ' . $j] = $Asset['Unit']['name'];
                            $AssetScoreReport['Collection ID'] = $Asset['Collection']['id'];
                            $AssetScoreReport['Collection Primary ID'] = $Asset['Collection']['inst_id'];
                            $AssetScoreReport['Collection Name'] = $Asset['Unit']['name'];
                            $AssetScoreReport['Asset Group ID'] = $Asset['AssetGroup']['id'];
                            $AssetScoreReport['Asset Group Primary ID'] = $Asset['AssetGroup']['inst_id'];
                            $AssetScoreReport['Asset Group Name'] = $Asset['AssetGroup']['name'];
                            $AssetScoreReport['Score'] = $Asset['AssetGroup']['FormatType']['asset_score'];
                            $AssetScoreReport['Quantity'] = $Asset['AssetGroup']['FormatType']['quantity'];
                            $AssetScoreReport['Duration'] = minutesToHour::ConvertMinutes2Hours($Asset['AssetGroup']['FormatType']['duration']);
                            $DataDumpReportArray[] = $AssetScoreReport;
                        }

                        if ($ExportType == 'xls') {
                            $excel = new excel();

                            $excel->setDataArray($DataDumpReportArray);
                            $excel->extractHeadings();
                            $filename = 'Duration_Report_' . date('Ymd') . '.xlsx';
                            $Sheettitle = 'Duration_Report';
                            $intial_dicrectory = '/AssetsScore/xls/';
                            $file_name_with_directory = $intial_dicrectory . $filename;

                            $excel->setDataArray($DataDumpReportArray);

                            $excel->extractHeadings();
                            $excel->setFileName($file_name_with_directory);
                            $excel->setSheetTitle($Sheettitle);

                            $excel->createExcel(TRUE, $filters);

                            $excel->SaveFile();
                            $excel->DownloadXLSX($file_name_with_directory, $filename);
                            $excel->DeleteFile($file_name_with_directory);
                            exit;
                        } else {
                            $csvHandler = new csvHandler();

                            $file_name = 'Duration_Report_' . date('Ymd') . '.csv';
                            $intial_dicrectory = '/AssetsScore/csv/';
                            $file_name_with_directory = $intial_dicrectory . $file_name;
                            $csvHandler->CreateCSV($DataDumpReportArray, $file_name_with_directory, FALSE, 0, TRUE, $filters);
                            $csvHandler->DownloadCSV($file_name_with_directory, $file_name);
                            $csvHandler->DeleteFile($file_name_with_directory);
                            exit;
                        }
                    } else {
                        $Bug = '<span style="color:#7d110c;font-size:16px;"><b>No record available for export.</b></span>';
                        $this->getResponse()->setSlot('my_slot', $Bug);
                    }
                } else {
                    $Bug = '<span style="color:#7d110c;font-size:16px;"><b>Please select filter to export the records.</b></span>';
                    $this->getResponse()->setSlot('my_slot', $Bug);
                }
            }
        }
    }

}