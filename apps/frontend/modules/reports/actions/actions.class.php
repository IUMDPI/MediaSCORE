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
     * PressedSeventyEightRPMDisc List all
     * 
     * @param sfWebRequest $request 
     */
    public function executeRecordingdatereport(sfWebRequest $request) {

        $this->form = new ReportsForm();

        if ($request->isMethod(sfRequest::POST)) {
            $csvHandler = new csvHandler();
            $commonFunctions = new commonFunctions();
            $ExportArray = array();
            $params = $request->getPostParameter('reports');
            $unit_id = $params['listUnits'];

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

            $file_name = 'Recording_Date_Report_' . time() . '.csv';
            $intial_dicrectory = '\reports\\';

            $file_name_with_directory = $intial_dicrectory . $file_name;

            $csvHandler->CreateCSV($ExportArray, $file_name_with_directory);
            $csvHandler->DownloadCSV($file_name_with_directory);
            $csvHandler->DeleteFile($file_name_with_directory);
            exit;
        }
    }

}
