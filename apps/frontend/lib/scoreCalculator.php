<?php

include('scoreCalculator_extended.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ScoreCalculator
 *
 * @author Furqan
 */
class scoreCalculator extends scoreCalculator_extended {

    //put your code here
    protected $score;
    protected $multiselection_value;
    protected $formatTypesFunctionCalls;

    public function __construct($score = 0) {
        $this->score = $score;
        $this->multiselection_value = array(
            'trackConfiguration' => OpenReelAudioTapeFormatType::$constants[0],
            'playback' => OpenReelAudioTapeFormatType::$constants[1],
            'speed' => OpenReelAudioTapeFormatType::$constants[2],
            'tapeThickness' => OpenReelAudioTapeFormatType::$constants[3],
            'tape_type' => array('' => 'Select', 0 => 'Type I', 1 => 'Type II', 2 => 'Type III', 3 => 'Type IV'),
            'sound_field' => AnalogAudiocassette::$constants[1],
            'b' => MetalDisc::$generation,
            'pack_deformation' => Film::$constants[4],
            'AnalogAudiocassettePack_deformation' => array(3 => 'Misc. damage'),
            'NewPack_deformation' => array(3 => 'Misc. damage'),
            'physicalDamage' => MetalDisc::$damage,
            'material' => MetalDisc::$constants,
            'substrate' => LacquerDisc::$constants,
            'SoundWireReelcomposition' => array('' => 'Select', 0 => 'Stainless steel', 1 => ' Composition-other', 2 => 'Unknown'),
            'composition' => SoundWireReel::$constants,
            'recordingLayer' => MiniDisc::$constants[0],
            'recordingSpeed' => MiniDisc::$constants[1],
            'LaserdiscrecordingSpeed' => Laserdisc::$constants,
            'DVrecordingSpeed' => DV::$constants,
            'recordingStandard' => StandardizedRecordingFormatType::$constants,
            'NewrecordingStandard' => array('' => 'Select', 0 => 'NTSC', 1 => 'PAL', 2 => 'SECAM', 3 => 'Unknown', 4 => 'Non-native'),
            'opticalDiscType' => OpticalVideo::$constants[0],
            'soundOpticalDiscType' => SoundOpticalDisk::$constants,
            'formatVersion' => OpticalVideo::$constants[1],
            'cylinderType' => Cylinder::$constants,
            'capacityLayers' => XDCamOptical::$constants[1],
            'XDCAMformatVersion' => XDCamOptical::$constants[0],
            'BetamaxformatVersion' => Betamax::$constants[0],
            'oxide' => Betamax::$constants[1],
            'Newoxide' => array('' => 'Select', 0 => 'Chromium Dioxide', 1 => 'Ferric Oxide', 2 => 'Metal Oxide', 3 => 'Unknown'),
            'EightMMformatVersion' => EightMM::$constants[0],
            'EightMMrecordingSpeed' => EightMM::$constants[1],
            'OpenReelVideo2formatVersion' => Film::$constants[5],
            'OpenReelVideo1formatVersion' => OneInchOpenReelVideo::$constants[0],
            'OpenReelVideoHALFformatVersion' => HalfInchOpenReelVideo::$constants[0],
            'BetaCamformatVersion' => Betacam::$constants[1],
            'DigitalBetacamformatVersion' => array('' => 'Select', 'Digital', 'Format Version Betacam SX', 'Format Version IMX'),
            'VHSSize' => VHS::$constants[0],
            'VHSformatVersion' => VHS::$constants[1],
            'VHSrecordingSpeed' => VHS::$constants[2],
            'UmaticformatVersion' => Umatic::$constants[1],
            'HDCAMformatVersion' => array('' => 'Select', 0 => 'Standard', 1 => 'Format Version SR'),
            'DVCProformatVersion' => DVCPro::$constants[0],
            'DVCProrecordingSpeed' => DVCPro::$constants[1],
            'scanning' => HDCam::$constants[2],
            'format' => TwoInchOpenReelVideo::$constants[0],
            'TwoInchReelSize' => TwoInchOpenReelVideo::$constants[1],
            'OneInchReelSize' => OneInchOpenReelVideo::$constants[1],
            'HalfInchReelSize' => HalfInchOpenReelVideo::$constants[1],
            'copies' => '0-1',
            'thin_tape' => '0-1',
            'oxidationCorrosion' => '0-1',
            'off_brand' => 'same',
            'soft_binder_syndrome' => 'same',
            'softBinderSyndrome' => 'same',
            'size' => SizedVideoRecordingFormatType::$constants,
            'DigitalBetacamsize' => DigitalBetacam::$constants[0],
            'U-maticsize' => Umatic::$constants[0],
            'reflectiveLayer' => OpticalDiscFormatType::$constants[0],
            'dataLayer' => OpticalDiscFormatType::$constants[1],
            'GlobalFormatType' => FormatType::$formatTypesValue1d,
        );
        $this->formatTypesFunctionCalls = array(
            '1' => 'metalDiscCalc',
            '4' => 'AnalogAudioCassetteCalc',
            '5' => 'Film',
            '6' => 'DATCalc',
            '7' => 'SoundWireReelCalc',
            '9' => 'PolysterOpenReelAudioTapeCalc',
            '10' => 'AcetateOpenReelAudioTapeCalc',
            '11' => 'PaperOpenReelAudioTapeCalc',
            '12' => 'PVCOpenReelAudioTapeCalc',
            '15' => 'LacquerDiscCalc',
            '16' => 'MiniDiscCalc',
            '17' => 'CylinderCalc',
            '19' => 'SoundOpticalDiscCalc',
            '20' => 'OpticalVideoCalc',
            '22' => 'Pressed78RPMDiscCalc',
            '23' => 'PressedLPDiscCalc',
            '24' => 'Pressed45RPMDiscCalc',
            '26' => 'LaserDiscCalc',
            '27' => 'XDCAMOpticalCalc',
            '29' => 'BetamaxCalc',
            '31' => 'EightMMCalc',
            '33' => 'OpenReelVideo2Calc',
            '34' => 'OpenReelVideo1Calc',
            '35' => 'OpenReelVideoHalfCalc',
            '37' => 'DVCalc',
            '38' => 'DVCAMCalc',
            '40' => 'BetaCamCalc',
            '41' => 'VHSCalc',
            '42' => 'DigitalBetaCamCalc',
            '44' => 'UmaticCalc',
            '45' => 'HDCAMCalc',
            '46' => 'DVCProCalc',
            '100' => 'check'
        );
    }

    /**
     * To get current socre
     * @return float $Score_of_this_asset   
     * 
     * */
    public function getScore() {
        return $this->score;
    }

    /**
     * To set Score
     * @param float $Score_to_set 
     * */
    public function setScore($score = 0) {
        $this->score = $score;
    }

    /**
     * To ADD Score to existing score
     * @param float $Score_to_add
     * 
     * */
    public function addScore($score) {
        $this->score = $this->score + $score;
    }

    /**
     * returns Value For Score 
     * @param Array $AssetInformatoin_with_format_type_infortmation
     * @param Array $characteristicsValue_containing_score
     * @return float $Score_of_this_asset   
     * 

     * */
    public function metalDiscCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
        foreach ($characteristicsValues as $characteristicsValue) {
            if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                continue;
            }

            if ($characteristicsValue['c_name'] == 'base_score') {
                echo 'base_score = ';
                echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
                echo '<br/>';
                echo '<br/>';
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    echo 'year_rec = ';
                    $year = date('Y');
                    echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                    echo '<br/>';
                    echo '<br/>';
                } else {
                    $this->score = (float) $this->score + 0.0;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {
                if (isset($AssetInformatoin[0]['FormatType']['copies'])) {
                    echo 'copies = ';
                    echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + (float) $copies;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus')) {
                echo 'fungus = ';
                if (isset($AssetInformatoin[0]['FormatType']['fungus'])) {
                    echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $fungus;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                    echo 'other_contaminants = ';
                    echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $other_contaminants;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'material')) {

                if (isset($AssetInformatoin[0]['FormatType']['material'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'material = ';
                        echo $material = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $material;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'oxidationCorrosion')) {
                if (isset($AssetInformatoin[0]['FormatType']['oxidationCorrosion'])) {
                    echo 'oxidationCorrosion = ';
                    echo $oxidationCorrosion = (($AssetInformatoin[0]['FormatType']['oxidationCorrosion'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $oxidationCorrosion;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'physicalDamage')) {
                if (isset($AssetInformatoin[0]['FormatType']['physicalDamage'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'physicalDamage = ';
                        echo $physicalDamage = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $physicalDamage;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }
        }
        return $this->score;
    }

    public function DATCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
        foreach ($characteristicsValues as $characteristicsValue) {
            if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                continue;
            }

            if ($characteristicsValue['c_name'] == 'base_score') {
                echo 'base_score = ';
                echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
                echo '<br/>';
                echo '<br/>';
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    echo 'year_rec = ';
                    $year = date('Y');
                    echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                    echo '<br/>';
                    echo '<br/>';
                } else {

                    $this->score = (float) $this->score + 0.0;
                    echo '<br/>';
                    echo '<br/>';
                }
            }



            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {
                if (isset($AssetInformatoin[0]['FormatType']['copies'])) {
                    echo 'copies = ';
                    echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + (float) $copies;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus')) {
                if (isset($AssetInformatoin[0]['FormatType']['fungus'])) {
                    echo 'fungus = ';
                    echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $fungus;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                    echo 'other_contaminants = ';
                    echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $other_contaminants;
                    echo '<br/>';
                    echo '<br/>';
                }
            }
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation')) {
                if (isset($AssetInformatoin[0]['FormatType']['pack_deformation'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'pack_deformation = ';
                        echo $pack_deformation = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $pack_deformation;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'thin_tape')) {
                if (isset($AssetInformatoin[0]['FormatType']['thin_tape'])) {
                    echo 'thin_tape = ';
                    echo $thin_tape = (($AssetInformatoin[0]['FormatType']['thin_tape'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $thin_tape;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], '1993OrEarlier')) {
                if (isset($AssetInformatoin[0]['FormatType']['1993OrEarlier'])) {
                    echo '1993OrEarlier = ';
                    echo $a_1993OrEarlier = (($AssetInformatoin[0]['FormatType']['1993OrEarlier'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $a_1993OrEarlier;
                    echo '<br/>';
                    echo '<br/>';
                }
            }
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'dataGradeTape')) {
                if (isset($AssetInformatoin[0]['FormatType']['dataGradeTape'])) {
                    echo 'dataGradeTape = ';
                    echo $dataGradeTape = (($AssetInformatoin[0]['FormatType']['dataGradeTape'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $dataGradeTape;
                    echo '<br/>';
                    echo '<br/>';
                }
            }
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'longPlay32K96K')) {
                if (isset($AssetInformatoin[0]['FormatType']['longPlay32K96K'])) {
                    echo 'longPlay32K96K = ';
                    echo $longPlay32K96K = (($AssetInformatoin[0]['FormatType']['longPlay32K96K'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $longPlay32K96K;
                    echo '<br/>';
                    echo '<br/>';
                }
            }
        }
        return $this->score;
    }

    public function SoundWireReelCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
        $constraint_will_be_applied = FALSE;
        if ($AssetInformatoin[0]['FormatType']['corrosionRustOxidation'] != '' && $AssetInformatoin[0]['FormatType']['corrosionRustOxidation'] != NULL) {
            $constraint_will_be_applied = TRUE;
        }

        foreach ($characteristicsValues as $characteristicsValue) {
            if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                continue;
            }

            if ($characteristicsValue['c_name'] == 'base_score') {
                echo 'base_score = ';
                echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
                echo '<br/>';
                echo '<br/>';
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    $year = date('Y');
                    echo 'year_rec = ';
                    echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                    echo '<br/>';
                    echo '<br/>';
                } else {
                    $this->score = (float) $this->score + 0.0;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'corrosionRustOxidation')) {
                if (isset($AssetInformatoin[0]['FormatType']['corrosionRustOxidation'])) {
                    echo 'corrosionRustOxidation = ';
                    echo $oxidationCorrosion = (($AssetInformatoin[0]['FormatType']['corrosionRustOxidation'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $oxidationCorrosion;
                    echo '<br/>';
                    echo '<br/>';
                }
            }
            if (!$constraint_will_be_applied) {
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {
                    if (isset($AssetInformatoin[0]['FormatType']['copies'])) {
                        echo 'copies = ';
                        echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + (float) $copies;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                    if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                        echo 'other_contaminants = ';
                        echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $other_contaminants;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation')) {
                    if (isset($AssetInformatoin[0]['FormatType']['pack_deformation'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'pack_deformation = ';
                            echo $pack_deformation = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $pack_deformation;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'composition')) {

                    if (isset($AssetInformatoin[0]['FormatType']['composition'])) {
//                        var_dump($characteristicsValue);
//                        var_dump($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']]);
//                        exit;
                        if (strstr(strtolower($this->multiselection_value['SoundWireReelcomposition'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {

                            echo 'composition = ';
                            echo $composition = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $composition;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'nonStandardBrand')) {
                    if (isset($AssetInformatoin[0]['FormatType']['nonStandardBrand'])) {
                        echo 'nonStandardBrand = ';
                        echo $nonStandardBrand = (($AssetInformatoin[0]['FormatType']['nonStandardBrand'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $nonStandardBrand;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }
        }
        return $this->score;
    }

    public function AnalogAudioCassetteCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
        $constraint_will_be_applied = FALSE;

        if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) {
            $constraint_will_be_applied = TRUE;
        }

        foreach ($characteristicsValues as $characteristicsValue) {
            if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                continue;
            }

            if ($characteristicsValue['c_name'] == 'base_score') {
                echo 'Base_score= ';
                echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
                echo '<br/>';
                echo '<br/>';
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    echo 'year_rec= ';
                    $year = date('Y');
                    echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                    echo '<br/>';
                    echo '<br/>';
                } else {
                    $this->score = (float) $this->score + 0.0;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'thin_tape')) {
                if (isset($AssetInformatoin[0]['FormatType']['thin_tape'])) {
                    echo 'thin_tape = ';
                    echo $thin_tape = (($AssetInformatoin[0]['FormatType']['thin_tape'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + (float) $thin_tape;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome')) {

                if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome'])) {
                    echo 'softBinderSyndrome = ';
                    echo $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + (float) $softBinderSyndrome;
                    echo '<br/>';
                    echo '<br/>';
                }
            }
            if (!$constraint_will_be_applied) {
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {

                    if (isset($AssetInformatoin[0]['FormatType']['copies'])) {
                        echo 'copies = ';
                        echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + (float) $copies;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand')) {
                    if (isset($AssetInformatoin[0]['FormatType']['off_brand'])) {
                        echo 'off_brand = ';
                        echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + (float) $off_brand;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus')) {
                    if (isset($AssetInformatoin[0]['FormatType']['fungus'])) {
                        echo 'fungus = ';
                        echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $fungus;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                    if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                        echo 'other_contaminants = ';
                        echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $other_contaminants;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'tape_type')) {
                    if (isset($AssetInformatoin[0]['FormatType']['tape_type'])) {
                        if ($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]] == $characteristicsValue['c_name']) {
                            echo 'tape_type = ';
                            echo $tape_type = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $tape_type;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'slow_speed')) {
                    if (isset($AssetInformatoin[0]['FormatType']['slow_speed'])) {
                        echo 'slow_speed = ';
                        echo $slow_speed = (($AssetInformatoin[0]['FormatType']['slow_speed'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $slow_speed;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'sound_field')) {
                    if (isset($AssetInformatoin[0]['FormatType']['sound_field'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'sound_field = ';
                            echo $sound_field = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $sound_field;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'noise_reduction')) {
                    if (isset($AssetInformatoin[0]['FormatType']['noise_reduction'])) {
                        echo 'noise_reduction = ';
                        echo $noise_reduction = (($AssetInformatoin[0]['FormatType']['noise_reduction'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $noise_reduction;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation')) {
                    if (isset($AssetInformatoin[0]['FormatType']['pack_deformation'])) {
                        if (strstr(strtolower($this->multiselection_value['AnalogAudiocassettePack_deformation'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'pack_deformation = ';
                            echo $pack_deformation = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $pack_deformation;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }
            }
        }

        return $this->score;
    }

    public function PolysterOpenReelAudioTapeCalc($AssetInformatoin = array(), $characteristicsValues = array()) {

        $constraint_will_be_applied = FALSE;

        if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) {
            $constraint_will_be_applied = TRUE;
        }

        foreach ($characteristicsValues as $characteristicsValue) {
            if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                echo 'remove <br/> ' . $characteristicsValue['CharacteristicsFormat']['format_c_name'];
                echo '<br/>';
                echo '<br/>';
                continue;
            }

            if ($characteristicsValue['c_name'] == 'base_score') {
                echo ' <br/> base_score =';
                echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
                echo '<br/>';
                echo '<br/>';
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    $year = date('Y');
                    echo 'year_rec =';
                    echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                    echo '<br/>';
                    echo '<br/>';
                } else {
                    $this->score = (float) $this->score + 0.0;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {
                if (isset($AssetInformatoin[0]['FormatType']['copies'])) {
                    echo 'copies =';
                    echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    echo '<br/>';
                    $this->score = (float) $this->score + (float) $copies;

                    echo '<br/>';
                }
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'tapeThickness')) {

                if (isset($AssetInformatoin[0]['FormatType']['tapeThickness'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'tapeThickness =';
                        echo $tapeThickness = $characteristicsValue['c_score'];
                        echo '<br/>';
                        $this->score = (float) $this->score + (float) $tapeThickness;

                        echo '<br/>';
                    }
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome')) {
                if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome'])) {
                    $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + (float) $softBinderSyndrome;
                }
            }
            if (!$constraint_will_be_applied) {
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus')) {
                    if (isset($AssetInformatoin[0]['FormatType']['fungus'])) {
                        echo 'fungus = ';
                        echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);

                        $this->score = (float) $this->score + $fungus;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                    if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                        echo 'other_contaminants = ';
                        echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        echo '<br/>';
                        $this->score = (float) $this->score + $other_contaminants;

                        echo '<br/>';
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation')) {
                    if (isset($AssetInformatoin[0]['FormatType']['pack_deformation'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'pack_deformation = ';
                            echo $pack_deformation = $characteristicsValue['c_score'];
                            echo '<br/>';
                            $this->score = (float) $this->score + (float) $pack_deformation;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'noise_reduction')) {
                    if (isset($AssetInformatoin[0]['FormatType']['noise_reduction'])) {
                        echo 'noise_reduction = ';
                        echo $noise_reduction = (($AssetInformatoin[0]['FormatType']['noise_reduction'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        echo '<br/>';
                        $this->score = (float) $this->score + $noise_reduction;

                        echo '<br/>';
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand')) {
                    if (isset($AssetInformatoin[0]['FormatType']['off_brand'])) {
                        echo 'off_brand = ';
                        echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        echo '<br/>';
                        $this->score = (float) $this->score + (float) $off_brand;

                        echo '<br/>';
                        echo '<br/>';
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'trackConfiguration')) {

                    if (isset($AssetInformatoin[0]['FormatType']['trackConfiguration'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'trackConfiguration = ';
                            echo $trackConfiguration = $characteristicsValue['c_score'];
                            echo '<br/>';
                            $this->score = (float) $this->score + (float) $trackConfiguration;

                            echo '<br/>';
                        }
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'speed')) {

                    if (isset($AssetInformatoin[0]['FormatType']['speed'])) {
                        $speed_array = explode(',', $AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]);

                        foreach ($speed_array as $speed_one) {
                            if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$speed_one]), strtolower($characteristicsValue['c_name']))) {
                                echo 'speed = ';
                                echo $Speed = $characteristicsValue['c_score'];

                                $this->score = (float) $this->score + (float) $Speed;
                                echo '<br/>';
                                echo '<br/>';
                            }
                        }
                    }
                }
            }
        }
        return $this->score;
    }

    public function AcetateOpenReelAudioTapeCalc($AssetInformatoin = array(), $characteristicsValues = array()) {

        $constraint_will_be_applied = FALSE;
        $precedence_flag = FALSE;
        if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) {
            $constraint_will_be_applied = TRUE;
        }
        if ($AssetInformatoin[0]['FormatType']['vinegarOdor'] != '' && $AssetInformatoin[0]['FormatType']['vinegarOdor'] != NULL) {
            $constraint_will_be_applied = TRUE;
            $precedence_flag = TRUE;
        }

        foreach ($characteristicsValues as $characteristicsValue) {

            if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                echo 'remove <br/> ' . $characteristicsValue['CharacteristicsFormat']['format_c_name'];
                echo '<br/>';
                echo '<br/>';
                continue;
            }

            if ($characteristicsValue['c_name'] == 'base_score') {
                echo ' <br/> base_score =';
                echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
                echo '<br/>';
                echo '<br/>';
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    $year = date('Y');
                    echo 'year_rec =';
                    echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                    echo '<br/>';
                    echo '<br/>';
                } else {
                    $this->score = (float) $this->score + 0.0;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {
                if (isset($AssetInformatoin[0]['FormatType']['copies'])) {
                    echo 'copies =';
                    echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    echo '<br/>';
                    $this->score = (float) $this->score + (float) $copies;

                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'tapeThickness')) {

                if (isset($AssetInformatoin[0]['FormatType']['tapeThickness'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'tapeThickness =';
                        echo $tapeThickness = $characteristicsValue['c_score'];
                        echo '<br/>';
                        $this->score = (float) $this->score + (float) $tapeThickness;
                        echo '<br/>';
                    }
                }
            }
            if ($constraint_will_be_applied && !$precedence_flag) {
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome')) {
                    if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome'])) {
                        echo 'softBinderSyndrome = ';
                        echo $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + (float) $softBinderSyndrome;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }
            if ($precedence_flag) {
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'vinegarOdor')) {
                    if (isset($AssetInformatoin[0]['FormatType']['vinegarOdor'])) {
                        echo 'vinegarOdor = ';
                        echo $vinegarOdor = (($AssetInformatoin[0]['FormatType']['vinegarOdor'] != '' && $AssetInformatoin[0]['FormatType']['vinegarOdor'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + (float) $vinegarOdor;

                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }

            if (!$constraint_will_be_applied) {
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand')) {
                    if (isset($AssetInformatoin[0]['FormatType']['off_brand'])) {
                        echo 'off_brand = ';
                        echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        echo '<br/>';
                        $this->score = (float) $this->score + (float) $off_brand;

                        echo '<br/>';
                        echo '<br/>';
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus')) {
                    if (isset($AssetInformatoin[0]['FormatType']['fungus'])) {
                        echo 'fungus = ';
                        echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);

                        $this->score = (float) $this->score + $fungus;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                    if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                        echo 'other_contaminants = ';
                        echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        echo '<br/>';
                        $this->score = (float) $this->score + $other_contaminants;

                        echo '<br/>';
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation')) {
                    if (isset($AssetInformatoin[0]['FormatType']['pack_deformation'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'pack_deformation = ';
                            echo $pack_deformation = $characteristicsValue['c_score'];
                            echo '<br/>';
                            $this->score = (float) $this->score + (float) $pack_deformation;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'noise_reduction')) {
                    if (isset($AssetInformatoin[0]['FormatType']['noise_reduction'])) {
                        echo 'noise_reduction = ';
                        echo $noise_reduction = (($AssetInformatoin[0]['FormatType']['noise_reduction'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        echo '<br/>';
                        $this->score = (float) $this->score + $noise_reduction;

                        echo '<br/>';
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'trackConfiguration')) {

                    if (isset($AssetInformatoin[0]['FormatType']['trackConfiguration'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'trackConfiguration = ';
                            echo $trackConfiguration = $characteristicsValue['c_score'];
                            echo '<br/>';
                            $this->score = (float) $this->score + (float) $trackConfiguration;

                            echo '<br/>';
                        }
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'speed')) {

                    if (isset($AssetInformatoin[0]['FormatType']['speed'])) {
                        $speed_array = explode(',', $AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]);

                        foreach ($speed_array as $speed_one) {
                            if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$speed_one]), strtolower($characteristicsValue['c_name']))) {
                                echo 'speed = ';
                                echo $Speed = $characteristicsValue['c_score'];

                                $this->score = (float) $this->score + (float) $Speed;
                                echo '<br/>';
                                echo '<br/>';
                            }
                        }
                    }
                }
            }
        }
        return $this->score;
    }

    public function DigitalBetaCamCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
        $constraint_will_be_applied = FALSE;
        if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) {
            $constraint_will_be_applied = TRUE;
        }

        foreach ($characteristicsValues as $characteristicsValue) {
            if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                continue;
            }

            if ($characteristicsValue['c_name'] == 'base_score') {
                echo 'base_score = ';
                echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
                echo '<br/>';
                echo '<br/>';
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    echo 'year_rec = ';
                    $year = date('Y');
                    echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                    echo '<br/>';
                    echo '<br/>';
                } else {
                    $this->score = (float) $this->score + 0.0;
                    echo '<br/>';
                    echo '<br/>';
                }
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {
                if (isset($AssetInformatoin[0]['FormatType']['copies'])) {
                    echo 'copies = ';
                    echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + (float) $copies;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome')) {

                if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome'])) {
                    echo 'softBinderSyndrome = ';
                    echo $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + (float) $softBinderSyndrome;
                    echo '<br/>';
                    echo '<br/>';
                }
            }


            if (!$constraint_will_be_applied) {
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand')) {
                    if (isset($AssetInformatoin[0]['FormatType']['off_brand'])) {
                        echo 'off_brand = ';
                        echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        echo '<br/>';
                        $this->score = (float) $this->score + (float) $off_brand;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }



                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus')) {
                    echo 'fungus = ';
                    if (isset($AssetInformatoin[0]['FormatType']['fungus'])) {
                        echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $fungus;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                    if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                        echo 'other_contaminants = ';
                        echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $other_contaminants;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }



                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard')) {
                    if (isset($AssetInformatoin[0]['FormatType']['recordingStandard'])) {
                        if (strstr(strtolower($this->multiselection_value['NewrecordingStandard'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'recordingStandard = ';
                            echo $recordingStandard = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $recordingStandard;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'size')) {
                    if (isset($AssetInformatoin[0]['FormatType']['size'])) {
                        if (strstr(strtolower($this->multiselection_value['DigitalBetacamsize'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'size = ';
                            echo $size = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $size;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'formatVersion')) {
                    if (isset($AssetInformatoin[0]['FormatType']['formatVersion'])) {
                        if (strstr(strtolower($this->multiselection_value['DigitalBetacamformatVersion'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'VHSformatVersion = ';
                            echo $VHSformatVersion = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $VHSformatVersion;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation')) {
                    if (isset($AssetInformatoin[0]['FormatType']['pack_deformation'])) {
                        if (strstr(strtolower($this->multiselection_value['NewPack_deformation'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'pack_deformation = ';
                            echo $pack_deformation = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $pack_deformation;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }
            }
        }
        return $this->score;
    }

    public function UmaticCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
        $constraint_will_be_applied = FALSE;
        if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) {
            $constraint_will_be_applied = TRUE;
        }

        foreach ($characteristicsValues as $characteristicsValue) {
            if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                continue;
            }

            if ($characteristicsValue['c_name'] == 'base_score') {
                echo 'base_score = ';
                echo $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
                echo '<br/>';
                echo '<br/>';
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    echo 'year_rec = ';
                    $year = date('Y');
                    echo $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                    echo '<br/>';
                    echo '<br/>';
                } else {
                    $this->score = (float) $this->score + 0.0;
                    echo '<br/>';
                    echo '<br/>';
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome')) {

                if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome'])) {
                    echo 'softBinderSyndrome = ';
                    echo $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + (float) $softBinderSyndrome;
                    echo '<br/>';
                    echo '<br/>';
                }
            }


            if (!$constraint_will_be_applied) {
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {
                    if (isset($AssetInformatoin[0]['FormatType']['copies'])) {
                        echo 'copies = ';
                        echo $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + (float) $copies;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand')) {
                    if (isset($AssetInformatoin[0]['FormatType']['off_brand'])) {
                        echo 'off_brand = ';
                        echo $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        echo '<br/>';
                        $this->score = (float) $this->score + (float) $off_brand;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus')) {
                    echo 'fungus = ';
                    if (isset($AssetInformatoin[0]['FormatType']['fungus'])) {
                        echo $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $fungus;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                    if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                        echo 'other_contaminants = ';
                        echo $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $other_contaminants;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }



                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard')) {
                    if (isset($AssetInformatoin[0]['FormatType']['recordingStandard'])) {
                        if (strstr(strtolower($this->multiselection_value['NewrecordingStandard'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'recordingStandard = ';
                            echo $recordingStandard = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $recordingStandard;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'size')) {
                    if (isset($AssetInformatoin[0]['FormatType']['size'])) {
                        if (strstr(strtolower($this->multiselection_value['U-maticsize'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'size = ';
                            echo $size = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $size;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'formatVersion')) {
                    if (isset($AssetInformatoin[0]['FormatType']['formatVersion'])) {
                        if (strstr(strtolower($this->multiselection_value['UmaticformatVersion'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'VHSformatVersion = ';
                            echo $VHSformatVersion = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $VHSformatVersion;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation')) {
                    if (isset($AssetInformatoin[0]['FormatType']['pack_deformation'])) {
                        if (strstr(strtolower($this->multiselection_value['NewPack_deformation'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'pack_deformation = ';
                            echo $pack_deformation = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $pack_deformation;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }
            }
        }
        return $this->score;
    }

    public function check() {
        echo 'i am in ';
    }

    public function callFormatCalculator($AssetInformatoin = array(), $characteristicsValues = array()) {
        echo '<pre style="color:red;font-weight:bold;">';
        print_r($AssetInformatoin);
//        print_r($characteristicsValues);
        echo $funcationName = $this->formatTypesFunctionCalls[$AssetInformatoin[0]['FormatType']['type']];
        echo '<pre>';
        echo $this->$funcationName($AssetInformatoin, $characteristicsValues);
        exit;
        return FALSE;
        exit;
    }

}

?>
