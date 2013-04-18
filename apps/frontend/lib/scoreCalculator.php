<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ScoreCalculator
 *
 * @author Furqan
 */
class scoreCalculator {

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
            'physicalDamage' => MetalDisc::$damage,
            'material' => MetalDisc::$constants,
            'substrate' => LacquerDisc::$constants,
            'composition' => SoundWireReel::$constants,
            'copies' => '0-1',
            'thin_tape' => '0-1',
            'oxidationCorrosion' => '0-1',
            'off_brand' => 'same',
            'soft_binder_syndrome' => 'same',
            'softBinderSyndrome' => 'same',
            'size' => SizedVideoRecordingFormatType::$constants,
            'scanning' => HDCam::$constants[2],
            'reflectivelayer' => OpticalDiscFormatType::$constants[0],
            'GlobalFormatType' => FormatType::$formatTypesValue1d,
        );
        $this->formatTypesFunctionCalls = array(
            '1' => 'metalDiscCalc',
            '4' => 'AnalogAudioCassetteCalc',
            '5' => 'Film',
            '6' => 'DATCalc',
            '7' => 'SoundWireReelCalc',
            '9' => 'PolysterOpenReelAudioTapeCalc',
            '10' => 'Acetate Open Reel Audio Tape',
            '11' => 'Paper Open Reel Audio Tape',
            '12' => 'PVC Open Reel Audio Tape',
            '15' => 'Lacquer Disc',
            '16' => 'MiniDisc',
            '17' => 'Cylinder',
            '19' => 'Sound Optical Disc',
            '20' => 'Optical Video',
            '22' => 'Pressed 78RPM Disc',
            '23' => 'Pressed LP Disc',
            '24' => 'Pressed 45RPM Disc',
            '26' => 'LaserDisc',
            '27' => 'XDCAM Optical',
            '29' => 'Betamax',
            '31' => '8MM',
            '33' => '2" Open Reel Video',
            '34' => '1" Open Reel Video',
            '35' => '½" Open Reel Video',
            '37' => 'DV',
            '38' => 'DVCAM',
            '40' => 'Betacam',
            '41' => 'VHS',
            '42' => 'Digital Betacam',
            '44' => 'U-matic',
            '45' => 'HDCAM',
            '46' => 'DVCPro',
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
                $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    $year = date('Y');
                    $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                } else {
                    $this->score = (float) $this->score + 0.0;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {
                if (isset($AssetInformatoin[0]['FormatType']['copies'])) {

                    $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + (float) $copies;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus')) {
                if (isset($AssetInformatoin[0]['FormatType']['fungus'])) {
                    $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $fungus;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                    $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $other_contaminants;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'material')) {

                if (isset($AssetInformatoin[0]['FormatType']['material'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        $material = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $material;
                    }
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'oxidationCorrosion')) {
                if (isset($AssetInformatoin[0]['FormatType']['oxidationCorrosion'])) {
                    $oxidationCorrosion = (($AssetInformatoin[0]['FormatType']['oxidationCorrosion'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $oxidationCorrosion;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'physicalDamage')) {
                if (isset($AssetInformatoin[0]['FormatType']['physicalDamage'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        $physicalDamage = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $physicalDamage;
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
                $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    $year = date('Y');
                    $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                } else {
                    $this->score = (float) $this->score + 0.0;
                }
            }



            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {
                if (isset($AssetInformatoin[0]['FormatType']['copies'])) {

                    $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + (float) $copies;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus')) {
                if (isset($AssetInformatoin[0]['FormatType']['fungus'])) {
                    $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $fungus;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                    $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $other_contaminants;
                }
            }
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation')) {
                if (isset($AssetInformatoin[0]['FormatType']['pack_deformation'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {

                        $pack_deformation = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $pack_deformation;
                    }
                }
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'thin_tape')) {
                if (isset($AssetInformatoin[0]['FormatType']['thin_tape'])) {
                    $thin_tape = (($AssetInformatoin[0]['FormatType']['thin_tape'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $thin_tape;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], '1993OrEarlier')) {
                if (isset($AssetInformatoin[0]['FormatType']['1993OrEarlier'])) {
                    $a_1993OrEarlier = (($AssetInformatoin[0]['FormatType']['1993OrEarlier'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $a_1993OrEarlier;
                }
            }
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'dataGradeTape')) {
                if (isset($AssetInformatoin[0]['FormatType']['dataGradeTape'])) {
                    $dataGradeTape = (($AssetInformatoin[0]['FormatType']['dataGradeTape'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $dataGradeTape;
                }
            }
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'longPlay32K96K')) {
                if (isset($AssetInformatoin[0]['FormatType']['longPlay32K96K'])) {
                    $longPlay32K96K = (($AssetInformatoin[0]['FormatType']['longPlay32K96K'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $longPlay32K96K;
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
        var_dump($constraint_will_be_applied);
        foreach ($characteristicsValues as $characteristicsValue) {
            if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                continue;
            }

            if ($characteristicsValue['c_name'] == 'base_score') {
                $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    $year = date('Y');
                    $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                } else {
                    $this->score = (float) $this->score + 0.0;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'corrosionRustOxidation')) {
                if (isset($AssetInformatoin[0]['FormatType']['corrosionRustOxidation'])) {
                    $oxidationCorrosion = (($AssetInformatoin[0]['FormatType']['corrosionRustOxidation'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $oxidationCorrosion;
                }
            }
            if (!$constraint_will_be_applied) {
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {
                    if (isset($AssetInformatoin[0]['FormatType']['copies'])) {

                        $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + (float) $copies;
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                    if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                        $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $other_contaminants;
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation')) {
                    if (isset($AssetInformatoin[0]['FormatType']['pack_deformation'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            $pack_deformation = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $pack_deformation;
                        }
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'composition')) {
                    if (isset($AssetInformatoin[0]['FormatType']['composition'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            $composition = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $composition;
                        }
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'nonStandardBrand')) {
                    if (isset($AssetInformatoin[0]['FormatType']['nonStandardBrand'])) {
                        $nonStandardBrand = (($AssetInformatoin[0]['FormatType']['nonStandardBrand'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $nonStandardBrand;
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
                $this->score = (float) $this->score + (float) $characteristicsValue['c_score'];
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'year_rec')) {
                if ($characteristicsValue['CharacteristicsConstraints']['constraint_name'] == 'per year') {
                    $year = date('Y');
                    $this->score = (float) $this->score + (float) (($year - $AssetInformatoin[0]['FormatType']['year_recorded']) * .1);
                } else {
                    $this->score = (float) $this->score + 0.0;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'thin_tape')) {
                if (isset($AssetInformatoin[0]['FormatType']['thin_tape'])) {
                    $thin_tape = (($AssetInformatoin[0]['FormatType']['thin_tape'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score;
                    $this->score = (float) $this->score + (float) $thin_tape;
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome')) {

                if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome'])) {
                    $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + (float) $softBinderSyndrome;
                }
            }
            if (!$constraint_will_be_applied) {
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'copies')) {

                    if (isset($AssetInformatoin[0]['FormatType']['copies'])) {

                        $copies = (($AssetInformatoin[0]['FormatType']['copies'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + (float) $copies;
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'off_brand')) {
                    if (isset($AssetInformatoin[0]['FormatType']['off_brand'])) {

                        $off_brand = (($AssetInformatoin[0]['FormatType']['off_brand'] != '' && $AssetInformatoin[0]['FormatType']['off_brand'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + (float) $off_brand;
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'fungus')) {
                    if (isset($AssetInformatoin[0]['FormatType']['fungus'])) {
                        $fungus = (($AssetInformatoin[0]['FormatType']['fungus'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $fungus;
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'other_contaminants')) {
                    if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                        $other_contaminants = (($AssetInformatoin[0]['FormatType']['other_contaminants'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $other_contaminants;
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'tape_type')) {
                    if (isset($AssetInformatoin[0]['FormatType']['tape_type'])) {
                        if ($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]] == $characteristicsValue['c_name']) {
                            $tape_type = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $tape_type;
                        }
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'slow_speed')) {
                    if (isset($AssetInformatoin[0]['FormatType']['slow_speed'])) {
                        $slow_speed = (($AssetInformatoin[0]['FormatType']['slow_speed'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $slow_speed;
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'sound_field')) {
                    if (isset($AssetInformatoin[0]['FormatType']['sound_field'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            $sound_field = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $sound_field;
                        }
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'noise_reduction')) {
                    if (isset($AssetInformatoin[0]['FormatType']['noise_reduction'])) {
                        $noise_reduction = (($AssetInformatoin[0]['FormatType']['noise_reduction'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $noise_reduction;
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'pack_deformation')) {
                    if (isset($AssetInformatoin[0]['FormatType']['pack_deformation'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            $pack_deformation = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $pack_deformation;
                        }
                    }
                }
            }
        }
        $this->score;

        return $this->score;
    }

    public function PolysterOpenReelAudioTapeCalc($AssetInformatoin = array(), $characteristicsValues = array()) {

        $constraint_will_be_applied = FALSE;

        if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) {
            $constraint_will_be_applied = TRUE;
        }
        $constraint_will_be_applied = FALSE;
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

//            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome')) {
//                if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome'])) {
//                    $softBinderSyndrome = (($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
//                    $this->score = (float) $this->score + (float) $softBinderSyndrome;
//                }
//            }
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

//    public function check() {
//        echo 'i am in ';
//    }

    public function callFormatCalculator($AssetInformatoin = array(), $characteristicsValues = array()) {
        echo '<pre>';
//        print_r($AssetInformatoin);
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
