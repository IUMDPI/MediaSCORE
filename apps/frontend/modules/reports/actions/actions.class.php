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

    public function executeAlgo(sfWebRequest $request) {
        $assetId = 28;
        echo '<pre>';
        $score = 0;

        $Assets = Doctrine_Query::Create()
                ->from('AssetGroup a')
                ->select('a.*,ft.*')
                ->leftJoin('a.FormatType ft WITH ft.id=a.format_id')
                ->addWhere("a.id = '$assetId'")
                ->fetchArray();

        $type = $Assets[0]['type'];

        $Assets_characteristics = Doctrine_Query::Create()
                ->from('CharacteristicsValues cv')
                ->select('cv.*,cc.*,cf.*')
                ->leftJoin('cv.CharacteristicsConstraints cc')
                ->leftJoin('cv.CharacteristicsFormat cf')
                ->addWhere("format_id = '4'")
                ->fetchArray();

        # 15 default
        # 4 skiping1_analog_audio_cassette
        #
        #
        #
        $constraints = array(
            'skiping1_sound_wire_reel',
            'skiping1_analog_audio_cassette',
            'skiping1',
            'skiping2',
            'default_score',
            'skiping3',
            'skiping4',
            'skiping5'
        );
        $constraints_exists = FALSE;
        $constraints_exists_index = null;
        $constraints_exists_value = '';


        foreach ($Assets_characteristics as $key => $Assets_characteristic) {
            if (in_array($Assets_characteristic['CharacteristicsConstraints']['constraint_name'], $constraints)) {
                $constraints_exists = TRUE;
                $constraints_exists_index = $key;
                $constraints_exists_value = $Assets_characteristic['CharacteristicsConstraints']['constraint_value'];
                if ($Assets_characteristic['CharacteristicsConstraints']['constraint_name'] == 'skiping2')
                    break;
            }
        }
//         surfaceblisteringbubbling , strongodor , stock_brand , 'soundtrackformat' , softbindersyndrome 'slow_speed'
//         
//         
//         
//         thin_tape ,tapethickness , year_recorded , delamination , tapethickness ,other_contaminants ,  'shrinkage',sheddingsoftbinder',
//         base_score , whiteresidue , vinegarodor ,tape_type,trackconfiguration ,tape_type , substrate ,  'speed' 'size','rust' 'reflectivelayer'

        array('year_recorded', 'year_recorded', 'whiteresidue', 'vinegarodor', 'type', 'trackconfiguration', 'thintape', 'thin_tape', 'tapethickness', 'tape_type'
            , 'surfaceblisteringbubbling', 'substrate', 'strongodor', 'stock_brand', 'speed', 'soundtrackformat', 'sound_field', 'softbindersyndrome', 'soft_binder_syndrome', 'slow_speed',
            'size', 'shrinkage', 'sheddingsoftbinder', 'scanning', 'rust', 'reflectivelayer', 'reelsize', 'recordingstandard', 'recordingspeed', 'recordinglayer', 'quantity', 'publicationyear',
            'plasticizerexudation', 'physicaldamage', 'pack_deformation', 'oxide', 'oxidationCorrosion', 'other_contaminants', 'opticaldisctype', 'off_brand', 'off-brand', 'nonstandardbrand', 'noise_reduction',
            'materialsbreakdown', 'material', 'longplay32k96k', 'levelofshrinkage', 'generation', 'gauge', 'fungus', 'formatversion', 'format_notes', 'format', 'duration_type_methodology', 'duration_type',
            'duration', 'discoloration', 'delamination', 'datarate', 'datalayer', 'datagradetape', 'cylindertype', 'corrosionrustoxidation', 'copies', 'copies', 'composition', 'colorfade',
            'color', 'codec', 'capacitylayers', 'bindersystem', 'base_score', 'adstriplevel', '1993orearlier');


        array(
            'reelsize', 'recordingstandard', 'recordingspeed', 'recordinglayer', 'quantity', 'publicationyear',
            'plasticizerexudation', 'physicaldamage', 'pack_deformation', 'oxide', 'oxidationCorrosion', 'other_contaminants', 'opticaldisctype', 'off_brand', 'off-brand', 'nonstandardbrand', 'noise_reduction',
            'materialsbreakdown', 'material', 'longplay32k96k', 'levelofshrinkage', 'generation', 'gauge', 'fungus', 'formatversion', 'format_notes', 'format', 'duration_type_methodology', 'duration_type',
            'duration', 'discoloration', 'delamination', 'datarate', 'datalayer', 'datagradetape', 'cylindertype', 'corrosionrustoxidation', 'copies', 'copies', 'composition', 'colorfade',
            'color', 'codec', 'capacitylayers', 'bindersystem', 'base_score', 'adstriplevel', '1993orearlier');

//       
//        0 => array('' => 'Select', 0 => 'Full Track', 1 => 'Mono', 2 => 'Half-Track Mono', 3 => 'Half-Track Stereo', 4 => 'Quarter-Track Mono', 5 => 'Quarter-Track Stereo', 6 => 'Unknown'),
//        1 => array(0 => 'Problem Brand A', 1 => 'Problem Brand B', 2 => 'Playback experience'),
//        2 => array(0 => '0.9375 ips', 1 => '1.875 ips', 2 => '3.75 ips', 3 => '7.5 ips', 4 => '15 ips', 5 => '30 ips', 6 => 'unknown'),
//        3 => array('' => 'Select', 0 => 'Standard Play', 1 => 'Long Play', 2 => 'Double Play', 3 => 'Triple Play', 4 => 'Unknown'));
//        echo '2 for Speed';
//        echo '3 for thick ness';
        echo ' 0 Track Configuration / Sound Field: ';

        var_dump(OpenReelAudioTapeFormatType::$constants);



        echo '0 Type';
        echo '2 for Speed';
//        0 => array('' => 'Select', 0 => 'Type I (Normal)', 1 => 'Type II (High Bias: CrO2 or Cobalt Doped)', 2 => 'Type III (Ferric Chrome)', 3 => 'Type IV (Metal)'),
//        1 => array('' => 'Select', 0 => 'Mono', 1 => 'Stereo', 2 => 'Unknown'));
        var_dump(AnalogAudiocassette::$constants);


        FormatTypeForm::$durationtype;

        MetalDisc::$generation;
        MetalDisc::$damage;
        MetalDisc::$constants;
        $multiselection_value = array(
            'trackconfiguration' => OpenReelAudioTapeFormatType::$constants[0],
            'playback' => OpenReelAudioTapeFormatType::$constants[1],
            'speed' => OpenReelAudioTapeFormatType::$constants[2],
            'tape_thickness' => OpenReelAudioTapeFormatType::$constants[3],
            'tape_type' => AnalogAudiocassette::$constants[0],
            'sound_field' => AnalogAudiocassette::$constants[1],
            'b' => MetalDisc::$generation,
            'c' => MetalDisc::$damage,
            'Material' => MetalDisc::$constants,
            'substrate' => LacquerDisc::$constants,
            'copies' => '0-1',
            'thin_tape' => '0-1',
            'off_brand' => 'same',
            'soft_binder_syndrome' => 'same',
            'size' => SizedVideoRecordingFormatType::$constants,
            'scanning' => HDCam::$constants[2],
            'reflectivelayer' => OpticalDiscFormatType::$constants[0],
        );
        if ($constraints_exists) {
            $score = $score + $Assets_characteristics[$constraints_exists_index]['c_score'];

            $base_score_flag = FALSE;
            $year_rec_flag = FALSE;
            $copies_flag = FALSE;
            $thin_tape_flag = FALSE;
            $score_flag = FALSE;
            $tape_thickness_flag = FALSE;

            foreach ($Assets_characteristics as $key => $Assets_characteristic) {
                $constraint_values = explode(',', $constraints_exists_value);
                foreach ($constraint_values as $constraint_value) {

                    if (strstr($constraint_value, 'base_score') && $Assets_characteristic['c_name'] == 'base_score') {
                        $score = $score + $Assets_characteristic['c_score'];
                        $base_score_flag = TRUE;
                    }
                    if (strstr($constraint_value, 'year_rec') && !$year_rec_flag) {
                        $year = date('Y');
                        $score = $score + (float) (($year - $Assets[0]['FormatType']['year_recorded']) * .1);
                        $year_rec_flag = TRUE;
                    }

                    if (strstr($constraint_value, 'copies') && !$copies_flag) {
                        if ($Assets[0]['FormatType']['copies']) {
                            $copies = (($Assets[0]['FormatType']['copies'] == 1) ? (float) $Assets_characteristic['c_score'] : (float) 0);
                            $score = (float) $score + $copies;
                        }
                        $copies_flag = TRUE;
                    }

                    if (strstr($constraint_value, 'tape_thickness') && !$tape_thickness_flag && $Assets_characteristic['CharacteristicsFormat']['format_c_name'] == 'tapethickness') {
                        if (!empty($Assets[0]['FormatType']['tapeThickness'])) {
                            $Tape_thikness_value = OpenReelAudioTapeFormatType::$constants[3][$Assets[0]['FormatType']['tapeThickness']];
                            $Tape_thikness_value = str_replace(' ', '_', strtolower($Tape_thikness_value));
                            if ($Assets_characteristic['c_name'] == $Tape_thikness_value) {
                                $score = $score + (float) ($Assets_characteristic['c_score']);
                                $tape_thickness_flag = TRUE;
                            }
                        }
                    }

                    if (strstr($constraint_value, 'thin_tape') && !$thin_tape_flag) {
                        if ($Assets[0]['FormatType']['thin_tape']) {
                            $thin_tape = (($Assets[0]['FormatType']['thin_tape'] == 1) ? (float) $Assets_characteristic['c_score'] : (float) 0);
                            $score = (float) ($score + $thin_tape);
                        }
                    }


                    if (strstr($constraint_value, 'score=100') && !$score_flag) {
                        if ($Assets[0]['FormatType'][$Assets_characteristic['CharacteristicsFormat']['format_c_name']]) {
                            if ($Assets[0]['FormatType'][$Assets_characteristic['CharacteristicsFormat']['format_c_name']] == '1') {
                                $score = 100.0;
                                $score_flag = TRUE;
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($Assets_characteristics as $key => $Assets_characteristic) {
//                $Assets_characteristic['CharacteristicsFormat']['format_c_name']
//                $Assets_characteristic['CharacteristicsConstraints']['constraint_name']
//                remove , score<12 , per_year , breakdown_of_materials
                if (strstr($Assets_characteristic['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                    continue;
                } elseif ($Assets_characteristic['c_name'] == 'base_score') {
                    $score = $score + $Assets_characteristic['c_score'];
                } elseif (strstr($Assets_characteristic['c_name'], 'year_rec')) {
                    if ($Assets_characteristic['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                        $year = date('Y');
                        $score = (float) $score + (float) (($year - $Assets[0]['FormatType']['year_recorded']) * .1);
                    } else {
                        $score = (float) $score + 0.0;
                    }
                } elseif (strstr($Assets_characteristic['c_name'], 'copies')) {
                    if ($Assets[0]['FormatType']['copies']) {
                        $copies = (($Assets[0]['FormatType']['copies'] == 1) ? (float) $Assets_characteristic['c_score'] : (float) 0);
                        $score = (float) $score + $copies;
                    }
                } elseif (strstr($Assets_characteristic['c_name'], 'tape_thickness') && $Assets_characteristic['CharacteristicsFormat']['format_c_name'] == 'tapethickness') {
                    if (!empty($Assets[0]['FormatType']['tapeThickness'])) {
                        $Tape_thikness_value = $multiselection_value['tape_thickness'][$Assets[0]['FormatType']['tapeThickness']];
                        $Tape_thikness_value = str_replace(' ', '_', strtolower($Tape_thikness_value));
                        if ($Assets_characteristic['c_name'] == $Tape_thikness_value) {
                            $score = $score + (float) ($Assets_characteristic['c_score']);
                        }
                    }
                } elseif (strstr($Assets_characteristic['c_name'], 'thin_tape')) {
                    if ($Assets[0]['FormatType']['thin_tape']) {
                        $thin_tape = (($Assets[0]['FormatType']['thin_tape'] == 1) ? (float) $Assets_characteristic['c_score'] : (float) 0);
                        $score = (float) $score + (float) $thin_tape;
                    }
                } elseif (strstr($Assets_characteristic['CharacteristicsFormat']['format_c_name'], 'tape_type')) {
                    if ($Assets[0]['FormatType']['tape_type']) {
                        if (strstr($multiselection_value['tape_type'][$Assets[0]['FormatType']['tape_type']], $Assets_characteristic['c_name'])) {
                            $tape_type = (($Assets[0]['FormatType']['tape_type'] == 1) ? (float) $Assets_characteristic['c_score'] : (float) 0);
                            $score = (float) $score + (float) $tape_type;
                        }
                    }
                } elseif (strstr($Assets_characteristic['CharacteristicsFormat']['format_c_name'], 'trackconfiguration')) {
                    if ($Assets[0]['FormatType']['trackconfiguration']) {
                        if (strstr($multiselection_value[$Assets_characteristic['CharacteristicsFormat']['format_c_name']][$Assets[0]['FormatType']['trackconfiguration']], $Assets_characteristic['c_name'])) {
                            $tape_type = (($Assets[0]['FormatType']['trackconfiguration'] == 1) ? (float) $Assets_characteristic['c_score'] : (float) 0);
                            $score = (float) $score + (float) $tape_type;
                        }
                    }
                } else {
                    if ($Assets[0]['FormatType'][$Assets_characteristic['CharacteristicsFormat']['format_c_name']]) {
                        if (strstr($multiselection_value[$Assets_characteristic['CharacteristicsFormat']['format_c_name']][$Assets[0]['FormatType'][$Assets_characteristic['CharacteristicsFormat']['format_c_name']]], $Assets_characteristic['c_name'])) {
                            $tape_type = (($Assets[0]['FormatType'][$Assets_characteristic['CharacteristicsFormat']['format_c_name']] == 1) ? (float) $Assets_characteristic['c_score'] : (float) 0);
                            $score = (float) $score + (float) $tape_type;
                        }
                    }
                    #for non multiple values
                    if (!empty($Assets[0]['FormatType'][$Assets_characteristic['CharacteristicsFormat']['format_c_name']]) && $Assets[0]['FormatType'][$Assets_characteristic['CharacteristicsFormat']['format_c_name']]) {
                        $score = (float) $score + (float) $Assets_characteristic['c_score'];
                    }

//                $Assets_characteristic['CharacteristicsFormat']['format_c_name']
//                $Assets_characteristic['CharacteristicsConstraints']['constraint_name']
//                remove , score<12 , per_year , breakdown_of_materials
                }




                if (strstr($Assets_characteristic['CharacteristicsConstraints']['constraint_name'], 'breakdown_of_materials')) {
                    continue;
                    $score = $score + $Assets_characteristic['c_score'];
                }
            }
        }
        echo 'your score is = ' . $score;

        print_r($Assets_characteristics);
        print_r($Assets);
        exit;
        exit;





        #Collection
        $Assets_Collection = Doctrine_Query::Create()
                ->from('Collection c')
                ->select('c.*')
                ->addWhere("c.id = '" . $Assets[0]['parent_node_id'] . "'")
                ->fetchArray();


        #Format Type 
        $format = Doctrine_Query::Create()
                ->from('FormatType ft')
                ->select('ft.*')
                ->addWhere("ft.type = '" . $Assets[0]['type'] . "'")
                ->fetchArray();



        echo $collectionID = $Assets_Collection[0][id];
        echo '<br>';
        echo $unitID = $Assets_Collection[0]['parent_node_id'];
        print_r($format);
        exit;
        $Unit_id = null;
        $Collection_id = null;
        if ($store[0]->type == '') {
            
        }
        #Storage Location
//        if ($unitID) {
        $storageLocationsUnit = Doctrine_Core::getTable('Unit')->find($unitID)->getStorageLocations();

//        } elseif ($collectionID) {
        $storageLocationsCollection = Doctrine_Core::getTable('Collection')->find($collectionID)->getStorageLocations();
        exit;
        if ($new) {
            return $this->renderText(json_encode(array('s' => $storageLocations->toArray(), 'n' => $this->getUser()->getAttribute('storage_locations_list'))));
        }
        return $this->renderText(json_encode($storageLocations->toArray()));
//        } else {
        $this->storage_locations = Doctrine_Core::getTable('StorageLocation')
                ->createQuery('a')
                ->execute();
//        }
        #Collection for Unit
        $unitID = $request->getParameter('id');
        $collections = Doctrine_Core::getTable('Collection')
                ->createQuery('c')
                ->where('parent_node_id =?', $unitID)
                ->execute()
                ->toArray();







        echo '<pre>';
        var_dump($store);
        exit;
    }

}

