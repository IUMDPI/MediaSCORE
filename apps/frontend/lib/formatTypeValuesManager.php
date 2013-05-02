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
        $this->ArrayOfValues = array(
            '20' => array(
                'formatVersion' => OpticalVideo::$constants[1]
            ),
            '27' => array(
                'formatVersion' => XDCamOptical::$constants[0]
            ),
            '29' => array(
                'formatVersion' => Betamax::$constants[0]
            ),
            '31' => array(
                'formatVersion' => EightMM::$constants[0]
            ),
            '33' => array(
                'formatVersion' => Film::$constants[5]
            ),
            '34' => array(
                'formatVersion' => OneInchOpenReelVideo::$constants[0]
            ),
            '35' => array(
                'formatVersion' => HalfInchOpenReelVideo::$constants[0]
            ),
            '40' => array(
                'formatVersion' => Betacam::$constants[1]
            ),
            '41' => array(
                'formatVersion' => VHS::$constants[1]
            ),
            '42' => array(
                'formatVersion' => DigitalBetacam::$constants[1]
            ),
            '44' => array(
                'formatVersion' => Umatic::$constants[1]
            ),
            '45' => array(
                'formatVersion' => HDCam::$constants[0]
            ),
            '46' => array(
                'formatVersion' => DVCPro::$constants[0]
            ),
        );
    }

    public function setArrayOfValues($ArrayOfValues) {
        $this->ArrayOfValues = $ArrayOfValues;
    }

    public function getArrayOfValues() {
        return $this->ArrayOfValues;
    }

    public function getOneValuesArray($FormatTypekey) {
        return $this->ArrayOfValues[$FormatTypekey];
    }

    public function getArrayOfValue($FormatTypekey, $ValueKey) {
        return $this->ArrayOfValues[$FormatTypekey][$ValueKey];
    }

    public function getArrayOfValueTargeted($FormatTypekey, $ValueKey, $index) {

        return ($this->ArrayOfValues[$FormatTypekey][$ValueKey][$index]) ? $this->ArrayOfValues[$FormatTypekey][$ValueKey][$index] : '';
    }

}

?>
