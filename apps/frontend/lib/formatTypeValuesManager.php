<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of formatTypeValuesManager
 *
 * @author Furqan
 */
class formatTypeValuesManager {

    protected $ArrayOfValues = array();

    function __construct() {

//        $this->multiselection_value = array(
//            'b' => MetalDisc::$generation,
//            'trackConfiguration' => OpenReelAudioTapeFormatType::$constants[0],
//            'playback' => OpenReelAudioTapeFormatType::$constants[1],
//            'speed' => OpenReelAudioTapeFormatType::$constants[2],
//            'tapeThickness' => OpenReelAudioTapeFormatType::$constants[3],
//            'tape_type' => array('' => 'Select', 0 => 'Type I', 1 => 'Type II', 2 => 'Type III', 3 => 'Type IV'),
//            'sound_field' => AnalogAudiocassette::$constants[1],
//            'pack_deformation' => Film::$constants[4],
//            'AnalogAudiocassettePack_deformation' => array(3 => 'Misc. damage'),
//            'NewPack_deformation' => array(3 => 'Misc. damage'),
//            'physicalDamage' => MetalDisc::$damage,
//            'material' => MetalDisc::$constants,
//            'substrate' => LacquerDisc::$constants,
//            'SoundWireReelcomposition' => array('' => 'Select', 0 => 'Stainless steel', 1 => ' Composition-other', 2 => 'Unknown'),
//            'composition' => SoundWireReel::$constants,
//            'recordingLayer' => MiniDisc::$constants[0],
//            'recordingSpeed' => MiniDisc::$constants[1],
//            'LaserdiscrecordingSpeed' => Laserdisc::$constants,
//            'DVrecordingSpeed' => DV::$constants,
//            'recordingStandard' => StandardizedRecordingFormatType::$constants,
//            'NewrecordingStandard' => array('' => 'Select', 0 => 'NTSC', 1 => 'PAL', 2 => 'SECAM', 3 => 'Unknown', 4 => 'Non-native'),
//            'opticalDiscType' => OpticalVideo::$constants[0],
//            'soundOpticalDiscType' => SoundOpticalDisk::$constants,
//            'formatVersion' => OpticalVideo::$constants[1],
//            'cylinderType' => Cylinder::$constants,
//            'capacityLayers' => XDCamOptical::$constants[1],
//            'XDCAMformatVersion' => XDCamOptical::$constants[0],
//            'BetamaxformatVersion' => Betamax::$constants[0],
//            'oxide' => Betamax::$constants[1],
//            'Newoxide' => array('' => 'Select', 0 => 'Chromium Dioxide', 1 => 'Ferric Oxide', 2 => 'Metal Oxide', 3 => 'Unknown'),
//            'EightMMformatVersion' => EightMM::$constants[0],
//            'EightMMrecordingSpeed' => EightMM::$constants[1],
//            'OpenReelVideo2formatVersion' => Film::$constants[5],
//            'OpenReelVideo1formatVersion' => OneInchOpenReelVideo::$constants[0],
//            'OpenReelVideoHALFformatVersion' => HalfInchOpenReelVideo::$constants[0],
//            'BetaCamformatVersion' => Betacam::$constants[1],
//            'DigitalBetacamformatVersion' => array('' => 'Select', 'Digital', 'Format Version Betacam SX', 'Format Version IMX'),
//            'VHSSize' => VHS::$constants[0],
//            'VHSformatVersion' => VHS::$constants[1],
//            'VHSrecordingSpeed' => VHS::$constants[2],
//            'UmaticformatVersion' => Umatic::$constants[1],
//            'HDCAMformatVersion' => array('' => 'Select', 0 => 'Standard', 1 => 'Format Version SR'),
//            'DVCProformatVersion' => DVCPro::$constants[0],
//            'DVCProrecordingSpeed' => DVCPro::$constants[1],
//            'scanning' => HDCam::$constants[2],
//            'format' => TwoInchOpenReelVideo::$constants[0],
//            'TwoInchReelSize' => TwoInchOpenReelVideo::$constants[1],
//            'OneInchReelSize' => OneInchOpenReelVideo::$constants[1],
//            'HalfInchReelSize' => HalfInchOpenReelVideo::$constants[1],
//            'copies' => '0-1',
//            'thin_tape' => '0-1',
//            'oxidationCorrosion' => '0-1',
//            'off_brand' => 'same',
//            'soft_binder_syndrome' => 'same',
//            'softBinderSyndrome' => 'same',
//            'size' => SizedVideoRecordingFormatType::$constants,
//            'DigitalBetacamsize' => DigitalBetacam::$constants[0],
//            'U-maticsize' => Umatic::$constants[0],
//            'reflectiveLayer' => OpticalDiscFormatType::$constants[0],
//            'dataLayer' => OpticalDiscFormatType::$constants[1],
//            'GlobalFormatType' => FormatType::$formatTypesValue1d,
//        );

        $this->ArrayOfValues = array(
            '1' => array(), #'metalDiscCalc'
            '4' => array(
                'pack_deformation' => array(3 => 'Misc. damage')
            ), #'AnalogAudioCassetteCalc'
            '5' => array(), #'Film'
            '6' => array(), #'DATCalc'
            '7' => array(
                'composition' => array('' => 'Select', 0 => 'Stainless steel', 1 => ' Composition-other', 2 => 'Unknown'),
            ), #'SoundWireReelCalc'
            '9' => array(), #'PolysterOpenReelAudioTapeCalc'
            '10' => array(), #'AcetateOpenReelAudioTapeCalc'
            '11' => array(), #'PaperOpenReelAudioTapeCalc'
            '12' => array(), #'PVCOpenReelAudioTapeCalc'
            '15' => array(), #'LacquerDiscCalc'
            '16' => array(), #'MiniDiscCalc'
            '17' => array(), #'CylinderCalc'
            '19' => array(
                'opticalDiscType' => SoundOpticalDisk::$constants,
            ), #'SoundOpticalDiscCalc'
            '20' => array(#OpticalVideoCalc
                'formatVersion' => OpticalVideo::$constants[1]
            ),
            '22' => array(), #'Pressed78RPMDiscCalc'
            '23' => array(), #'PressedLPDiscCalc'
            '24' => array(), #'Pressed45RPMDiscCalc'
            '26' => array(
                'recordingSpeed' => Laserdisc::$constants,
            ), #'LaserDiscCalc'
            '27' => array(#XDCAMOpticalCalc
                'formatVersion' => XDCamOptical::$constants[0]
            ),
            '29' => array(#BetamaxCalc
                'formatVersion' => Betamax::$constants[0]
            ),
            '31' => array(#EightMMCalc
                'formatVersion' => EightMM::$constants[0],
                'recordingSpeed' => EightMM::$constants[1],
            ),
            '33' => array(#OpenReelVideo2Calc
                'size' => TwoInchOpenReelVideo::$constants[1],
                'formatVersion' => Film::$constants[5]
            ),
            '34' => array(#OpenReelVideo1Calc
                'formatVersion' => OneInchOpenReelVideo::$constants[0],
                'size' => OneInchOpenReelVideo::$constants[1],
            ),
            '35' => array(#OpenReelVideoHalfCalc
                'formatVersion' => HalfInchOpenReelVideo::$constants[0],
                'size' => HalfInchOpenReelVideo::$constants[1],
            ),
            '37' => array(
                'recordingSpeed' => DV::$constants,
            ), #'DVCalc'
            '38' => array(), #'DVCAMCalc'
            '40' => array(#BetaCamCalc
                'formatVersion' => Betacam::$constants[1]
            ),
            '41' => array(#VHSCalc
                'formatVersion' => VHS::$constants[1],
                'size' => VHS::$constants[0],
                'recordingSpeed' => VHS::$constants[2],
            ),
            '42' => array(#DigitalBetaCamCalc
                'formatVersion' => DigitalBetacam::$constants[1],
                'size' => DigitalBetacam::$constants[0],
            ),
            '44' => array(#UmaticCalc
                'formatVersion' => Umatic::$constants[1],
                'size' => Umatic::$constants[0],
            ),
            '45' => array(#HDCAMCalc
                'formatVersion' => HDCam::$constants[0]
            ),
            '46' => array(#DVCProCalc
                'formatVersion' => DVCPro::$constants[0],
                'recordingSpeed' => DVCPro::$constants[1],
            ),
            'general' => array(
                'trackConfiguration' => OpenReelAudioTapeFormatType::$constants[0],
                'duration_type' => FormatTypeForm::$durationtype,
                'playback' => OpenReelAudioTapeFormatType::$constants[1],
                'speed' => OpenReelAudioTapeFormatType::$constants[2],
                'tapeThickness' => OpenReelAudioTapeFormatType::$constants[3],
                'tape_type' => array('' => 'Select', 0 => 'Type I', 1 => 'Type II', 2 => 'Type III', 3 => 'Type IV'),
                'sound_field' => AnalogAudiocassette::$constants[1],
                'gauge' => Film::$constants[0],
                'color' => Film::$constants[1],
                'pack_deformation' => Film::$constants[4],
                'physicalDamage' => MetalDisc::$damage,
                'material' => MetalDisc::$constants,
                'substrate' => LacquerDisc::$constants,
                'soundtrackFormat' => Film::$constants[2],
                'substrate' => Film::$constants[3],
                'composition' => SoundWireReel::$constants,
                'recordingLayer' => MiniDisc::$constants[0],
                'recordingSpeed' => MiniDisc::$constants[1],
                'recordingStandard' => StandardizedRecordingFormatType::$constants,
                'NewrecordingStandard' => array('' => 'Select', 0 => 'NTSC', 1 => 'PAL', 2 => 'SECAM', 3 => 'Unknown', 4 => 'Non-native'),
                'opticalDiscType' => OpticalVideo::$constants[0],
                'formatVersion' => OpticalVideo::$constants[1],
                'cylinderType' => Cylinder::$constants,
                'capacityLayers' => XDCamOptical::$constants[1],
                'codec' => XDCamOptical::$constants[2],
                'scanning' => HDCam::$constants[2],
                'format' => TwoInchOpenReelVideo::$constants[0],
                'size' => SizedVideoRecordingFormatType::$constants,
                'reflectiveLayer' => OpticalDiscFormatType::$constants[0],
                'dataLayer' => OpticalDiscFormatType::$constants[1],
                'datarate' => XDCamOptical::$constants[3],
                'oxide' => array('' => 'Select', 0 => 'Chromium Dioxide', 1 => 'Ferric Oxide', 2 => 'Metal Oxide', 3 => 'Unknown'),
                'bitrate' => DigitalBetacam::$constants[2],
                'GlobalFormatType' => FormatType::$formatTypesValue1d,
                
            )
        );
    }

    /**
     * 
     * @param Array $ArrayOfValues
     * 
     */
    public function setArrayOfValues($ArrayOfValues) {
        $this->ArrayOfValues = $ArrayOfValues;
    }

    /**
     * 
     * @return Array 
     * 
     */
    public function getArrayOfValues() {
        return $this->ArrayOfValues;
    }

    /**
     * 
     * @param  Integer $Format_id
     * 
     * @return Array $Array_of_all_values_related_to_format_id
     * 
     */
    public function getOneValuesArray($FormatTypekey) {
        return $this->ArrayOfValues[$FormatTypekey];
    }

    /**
     * 
     * @param Integer $Format_id
     * @param String $Name_Of_Format_Value
     * 
     * @return Array $all_values_related_to_format_id_and_type_of_value
     * 
     */
    public function getArrayOfValue($FormatTypekey, $ValueKey) {
        return $this->ArrayOfValues[$FormatTypekey][$ValueKey];
    }

    /**
     * 
     * @param Integer $Format_id
     * @param String $Name_Of_Format_Value
     * @param Integer $index_of_format_value_type
     * 
     * @return String $single_values_related_to_format_id_and_type_of_value's_index
     * 
     */
    public function getArrayOfValueTargeted($FormatTypekey, $ValueKey, $index) {

        return ($this->ArrayOfValues[$FormatTypekey][$ValueKey][$index]) ? $this->ArrayOfValues[$FormatTypekey][$ValueKey][$index] : '';
    }

}

?>
