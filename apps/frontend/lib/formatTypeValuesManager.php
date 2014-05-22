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
class formatTypeValuesManager
{

	/**
	 *
	 * @var Array 
	 */
	protected $ArrayOfValues = array();
	protected $FormatSpecificFields = array();

	function __construct()
	{
		$this->FormatSpecificFields = array(
			'1' => array('material', 'oxidationcorrosion', 'physicaldamage'),
			#'metalDiscCalc'
			'4' => array('tape_type', 'thin_tape', 'slow_speed', 'sound_field', 'noise_reduction', 'pack_deformation', 'softbindersyndrome'),
			#'AnalogAudioCassetteCalc'
			'5' => array('gauge', 'color', 'colorfade', 'soundtrackformat', 'substrate', 'vinegarodor', 'strongodor', 'adstriplevel', 'shrinkage', 'levelofshrinkage', 'rust', 'pack_deformation'),
			#'Film'
			'6' => array('pack_deformation', 'thin_tape', '1993orearlier', 'datagradetape', 'longplay32k96k'),
			#'DATCalc'
			'7' => array('pack_deformation', 'corrosionrustoxidation', 'composition', 'nonstandardbrand'),
			#'SoundWireReelCalc'
			'9' => array('pack_deformation', 'noise_reduction', 'trackconfiguration', 'softbindersyndrome', 'speed', 'tapethickness'),
			#'PolysterOpenReelAudioTapeCalc'
			'10' => array('pack_deformation', 'noise_reduction', 'trackconfiguration', 'softbindersyndrome', 'vinegarodor', 'tapethickness', 'speed'),
			#'AcetateOpenReelAudioTapeCalc'
			'11' => array('pack_deformation', 'noise_reduction', 'trackconfiguration', 'tapethickness', 'speed'),
			#'PaperOpenReelAudioTapeCalc'
			'12' => array('pack_deformation', 'noise_reduction', 'trackconfiguration', 'softbindersyndrome', 'tapethickness', 'speed'),
			#'PVCOpenReelAudioTapeCalc'
			'15' => array('physicaldamage', 'substrate', 'delamination', 'plasticizerexudation'),
			#'LacquerDiscCalc'
			'16' => array('physicaldamage', 'materialsbreakdown', 'recordinglayer', 'recordingspeed'),
			#'MiniDiscCalc'
			'17' => array('materialsbreakdown', 'physicaldamage', 'cylindertype'),
			#'CylinderCalc'
			'19' => array('materialsbreakdown', 'physicaldamage', 'reflectivelayer', 'datalayer', 'opticaldisctype'),
			#'SoundOpticalDiscCalc'
			'20' => array('formatversion', 'opticaldisctype', 'reflectivelayer', 'datalayer', 'physicaldamage', 'materialsbreakdown'),
			#OpticalVideoCalc
			'22' => array('materialsbreakdown', 'physicaldamage'),
			#'Pressed78RPMDiscCalc'
			'23' => array('materialsbreakdown', 'physicaldamage'),
			#'PressedLPDiscCalc'
			'24' => array('materialsbreakdown', 'physicaldamage'),
			#'Pressed45RPMDiscCalc'
			'26' => array('materialsbreakdown', 'recordingstandard', 'recordingspeed', 'publicationyear', 'physicaldamage'),
			#'LaserDiscCalc'
			'27' => array('formatversion', 'materialsbreakdown', 'recordingstandard', 'capacitylayers', 'physicaldamage'),
			#XDCAMOpticalCalc
			'29' => array('formatversion', 'softbindersyndrome', 'recordingstandard', 'oxide', 'pack_deformation'),
			#BetamaxCalc
			'31' => array(
				'formatversion', 'recordingstandard', 'softbindersyndrome', 'recordingspeed', 'bindersystem', 'pack_deformation'
			),
			#EightMMCalc
			'33' => array('formatversion', 'recordingstandard', 'softbindersyndrome', 'format', 'reelsize', 'pack_deformation', 'whiteresidue'),
			#OpenReelVideo2Calc
			'34' => array('formatversion', 'recordingstandard', 'softbindersyndrome', 'reelsize', 'whiteresidue', 'pack_deformation'
			),
			#OpenReelVideo1Calc
			'35' => array(#OpenReelVideoHalfCalc
				'formatversion', 'recordingstandard', 'softbindersyndrome', 'reelsize', 'pack_deformation'
			),
			'37' => array(
				'recordingstandard', 'softbindersyndrome', 'size', 'recordingspeed', 'pack_deformation'
			), #'DVCalc'
			'38' => array('recordingstandard', 'softbindersyndrome', 'size', 'pack_deformation'), #'DVCAMCalc'
			'40' => array(#BetaCamCalc
				'formatversion', 'recordingstandard', 'softbindersyndrome', 'size', 'pack_deformation'
			),
			'41' => array(#VHSCalc
				'formatversion', 'recordingstandard', 'softbindersyndrome', 'size', 'recordingspeed', 'pack_deformation'
			),
			'42' => array(#DigitalBetaCamCalc
				'formatversion', 'recordingstandard', 'softbindersyndrome', 'pack_deformation', 'bitrate'
			),
			'44' => array(#UmaticCalc
				'formatversion', 'recordingstandard', 'softbindersyndrome', 'size', 'pack_deformation'
			),
			'45' => array(#HDCAMCalc
				'formatversion', 'recordingstandard', 'softbindersyndrome', 'size', 'speed', 'scanning', 'pack_deformation'
			)
			,
			'46' => array(#DVCProCalc
				'formatversion', 'recordingstandard', 'softbindersyndrome', 'size', 'recordingspeed', 'pack_deformation'
		));

		$this->ArrayOfValues = array(
			'1' => array(), #'metalDiscCalc'
			'4' => array(
				'pack_deformation' => array(3 => 'Misc. damage')
			), #'AnalogAudioCassetteCalc'
			'5' => array(), #'Film'
			'6' => array(), #'DATCalc'
			'7' => array(
				'composition' => array('' => 'Select', 0 => 'Stainless steel', 1 => ' Composition-other', 2 => 'Unknown'),
				'pack_deformation' => ReelCassetteFormatType::$constants,
			), #'SoundWireReelCalc'
			'9' => array('pack_deformation' => ReelCassetteFormatType::$constants), #'PolysterOpenReelAudioTapeCalc'
			'10' => array('pack_deformation' => ReelCassetteFormatType::$constants), #'AcetateOpenReelAudioTapeCalc'
			'11' => array('pack_deformation' => ReelCassetteFormatType::$constants), #'PaperOpenReelAudioTapeCalc'
			'12' => array('pack_deformation' => ReelCassetteFormatType::$constants), #'PVCOpenReelAudioTapeCalc'
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
				'reelsize' => TwoInchOpenReelVideo::$constants[1],
				'formatVersion' => Film::$constants[5],
				'format' => TwoInchOpenReelVideo::$constants[0],
				'pack_deformation' => ReelCassetteFormatType::$constants
			),
			'34' => array(#OpenReelVideo1Calc
				'formatVersion' => OneInchOpenReelVideo::$constants[0],
				'reelsize' => OneInchOpenReelVideo::$constants[1],
				'pack_deformation' => ReelCassetteFormatType::$constants
			),
			'35' => array(#OpenReelVideoHalfCalc
				'formatVersion' => HalfInchOpenReelVideo::$constants[0],
				'reelsize' => HalfInchOpenReelVideo::$constants[1],
				'pack_deformation' => ReelCassetteFormatType::$constants
			),
			'37' => array(
				'recordingSpeed' => DV::$constants,
			), #'DVCalc'
			'38' => array(), #'DVCAMCalc'
			'40' => array(#BetaCamCalc
				'formatVersion' => Betacam::$constants[1],
				'size' => Betacam::$constants[0]
			),
			'41' => array(#VHSCalc
				'formatVersion' => VHS::$constants[1],
				'size' => VHS::$constants[0],
				'recordingSpeed' => VHS::$constants[2],
			),
			'42' => array(#DigitalBetaCamCalc
				'formatVersion' => DigitalBetacam::$constants[1],
				'size' => DigitalBetacam::$constants[0],
				'recordingStandard' => FormatTypedVideoRecording::$constants[0]
			),
			'44' => array(#UmaticCalc
				'formatVersion' => Umatic::$constants[1],
				'size' => Umatic::$constants[0],
			),
			'45' => array(#HDCAMCalc
				'formatVersion' => HDCam::$constants[0],
				'speed' => HDCam::$constants[1]
			)
			,
			'46' => array(#DVCProCalc
				'formatVersion' => DVCPro::$constants[0],
				'recordingSpeed' => DVCPro::$constants[1],
				'size' => Umatic::$constants[0]
			)
			,
			'general' => array(
				'trackConfiguration' => OpenReelAudioTapeFormatType::$constants[0],
				'duration_type' => FormatTypeForm::$durationtype,
				'playback' => OpenReelAudioTapeFormatType::$constants[1],
				'speed' => OpenReelAudioTapeFormatType::$constants[2],
				'tapeThickness' => OpenReelAudioTapeFormatType::$constants[3],
				'tape_type' => AnalogAudiocassette::$constants[0],
				'sound_field' => AnalogAudiocassette::$constants[1],
				'gauge' => Film::$constants[0],
				'color' => Film::$constants[1],
				'pack_deformation' => array(0 => 'None', 1 => 'Minor', 2 => 'Moderate', 3 => 'Misc. damage'),
				'physicalDamage' => MetalDisc::$damage,
				'material' => MetalDisc::$constants,
				'substrate' => LacquerDisc::$constants,
				'soundtrackFormat' => Film::$constants[2],
				'filmsubstrate' => Film::$constants[3],
				'composition' => SoundWireReel::$constants,
				'recordingLayer' => MiniDisc::$constants[0],
				'recordingSpeed' => MiniDisc::$constants[1],
				'recordingStandard' => StandardizedRecordingFormatType::$constants,
				'NewrecordingStandard' => array('' => 'Select', 0 => 'NTSC', 1 => 'PAL', 2 => 'SECAM', 3 => 'Unknown', 4 => 'Non-native'),
				'opticalDiscType' => OpticalVideo::$constants[0],
				'formatVersion' => OpticalVideo::$constants[1],
				'cylinderType' => Cylinder::$constants,
				'binderSystem' => EightMM::$constants[2],
				'capacityLayers' => XDCamOptical::$constants[1],
				'codec' => XDCamOptical::$constants[2],
				'scanning' => HDCam::$constants[2],
				'format' => TwoInchOpenReelVideo::$constants[0],
				'size' => SizedVideoRecordingFormatType::$constants,
				'reflectiveLayer' => OpticalDiscFormatType::$constants[0],
				'dataLayer' => OpticalDiscFormatType::$constants[1],
				'dataRate' => XDCamOptical::$constants[3],
				'oxide' => array('' => 'Select', 0 => 'Chromium Dioxide', 1 => 'Ferric Oxide', 2 => 'Metal Oxide', 3 => 'Unknown'),
				'bitrate' => DigitalBetacam::$constants[2],
				'generation' => array(0 => 'Original', 1 => 'Copy', 2 => 'Unknown'),
				'GlobalFormatType' => FormatType::$formatTypesValue1d,
			)
		);
	}

	/**
	 * 
	 * @param Array $FullArrayOfValues
	 * 
	 */
	public function setArrayOfValues($ArrayOfValues)
	{
		$this->ArrayOfValues = $ArrayOfValues;
	}

	/**
	 * 
	 * @return Array $FullArrayOfValues
	 * 
	 */
	public function getArrayOfValues()
	{
		return $this->ArrayOfValues;
	}

	/**
	 * 
	 * @param  Integer $Format_id
	 * 
	 * @return Array $Array_of_all_values_related_to_format_id
	 * 
	 */
	public function getOneValuesArray($FormatTypekey)
	{
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
	public function getArrayOfValue($FormatTypekey, $ValueKey)
	{
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
	public function getArrayOfValueTargeted($FormatTypekey, $ValueKey, $index)
	{
		return (isset($this->ArrayOfValues[$FormatTypekey][$ValueKey][$index]) && $this->ArrayOfValues[$FormatTypekey][$ValueKey][$index] && strtolower($this->ArrayOfValues[$FormatTypekey][$ValueKey][$index]) != 'select') ? $this->ArrayOfValues[$FormatTypekey][$ValueKey][$index] : 'NULL';
	}

	public function getFormatRelatedFields($FormatTypekey, $fullArray)
	{

		foreach ($fullArray as $key => $value)
		{

			if ( ! in_array(trim($key), $this->FormatSpecificFields[$FormatTypekey]))
			{
				$fullArray[$key] = 'N/A';
			}
			else if ($fullArray[$key] === 'NULL')
				$fullArray[$key] = 'N/A';
		}

		return $fullArray;
	}

}
