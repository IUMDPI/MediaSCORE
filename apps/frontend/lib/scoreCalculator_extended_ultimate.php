<?php

include('scoreCalculator_extended_moderate.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of scoreCalculator_extended_1
 *
 * @author Furqan
 */
class scoreCalculator_extended_ultimate extends scoreCalculator_extended_moderate {

    //put your code here

    public function PressedLPDiscCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
        $constraint_will_be_applied = FALSE;

        if ($AssetInformatoin[0]['FormatType']['materialsBreakdown'] != '' && $AssetInformatoin[0]['FormatType']['materialsBreakdown'] != NULL) {
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


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'materialsBreakdown')) {
                if (isset($AssetInformatoin[0]['FormatType']['materialsBreakdown'])) {
                    echo 'materialsBreakdown = ';
                    echo $materialsBreakdown = (($AssetInformatoin[0]['FormatType']['materialsBreakdown'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $materialsBreakdown;
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
        }

        return $this->score;
    }

    public function Pressed45RPMDiscCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
        $constraint_will_be_applied = FALSE;

        if ($AssetInformatoin[0]['FormatType']['materialsBreakdown'] != '' && $AssetInformatoin[0]['FormatType']['materialsBreakdown'] != NULL) {
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


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'materialsBreakdown')) {
                if (isset($AssetInformatoin[0]['FormatType']['materialsBreakdown'])) {
                    echo 'materialsBreakdown = ';
                    echo $materialsBreakdown = (($AssetInformatoin[0]['FormatType']['materialsBreakdown'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $materialsBreakdown;
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
        }

        return $this->score;
    }

    public function LaserDiscCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
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


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'materialsBreakdown')) {
                if (isset($AssetInformatoin[0]['FormatType']['materialsBreakdown'])) {
                    echo 'materialsBreakdown = ';
                    echo $materialsBreakdown = (($AssetInformatoin[0]['FormatType']['materialsBreakdown'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $materialsBreakdown;
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
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'publicationYear')) {
                if (isset($AssetInformatoin[0]['FormatType']['publicationYear'])) {
                    echo 'publicationYear = ';
                    echo $publicationYear = (($AssetInformatoin[0]['FormatType']['publicationYear'] != '' && $AssetInformatoin[0]['FormatType']['publicationYear'] != NULL) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $publicationYear;
                    echo '<br/>';
                    echo '<br/>';
                }
            }





            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard')) {
                if (isset($AssetInformatoin[0]['FormatType']['recordingStandard'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'recordingStandard = ';
                        echo $recordingStandard = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $recordingStandard;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingSpeed')) {
                if (isset($AssetInformatoin[0]['FormatType']['recordingSpeed'])) {
                    if (strstr(strtolower($this->multiselection_value['LaserdiscrecordingSpeed'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'recordingSpeed = ';
                        echo $recordingSpeed = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $recordingSpeed;
                        echo '<br/>';
                        echo '<br/>';
                    }
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

    public function XDCAMOpticalCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
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


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'materialsBreakdown')) {
                if (isset($AssetInformatoin[0]['FormatType']['materialsBreakdown'])) {
                    echo 'materialsBreakdown = ';
                    echo $materialsBreakdown = (($AssetInformatoin[0]['FormatType']['materialsBreakdown'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $materialsBreakdown;
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





            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'formatVersion')) {
                if (isset($AssetInformatoin[0]['FormatType']['formatVersion'])) {
                    if (strstr(strtolower($this->multiselection_value['XDCAMformatVersion'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'formatVersion = ';
                        echo $formatVersion = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $formatVersion;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard')) {
                if (isset($AssetInformatoin[0]['FormatType']['recordingStandard'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'recordingStandard = ';
                        echo $recordingStandard = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $recordingStandard;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'capacityLayers')) {

                if (isset($AssetInformatoin[0]['FormatType']['recordingSpeed'])) {

                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'capacityLayers = ';
                        echo $capacityLayers = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $capacityLayers;
                        echo '<br/>';
                        echo '<br/>';
                    }
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

    public function BetamaxCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
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

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'formatVersion')) {
                    if (isset($AssetInformatoin[0]['FormatType']['formatVersion'])) {
                        if (strstr(strtolower($this->multiselection_value['BetamaxformatVersion'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'formatVersion = ';
                            echo $formatVersion = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $formatVersion;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard')) {
                    if (isset($AssetInformatoin[0]['FormatType']['recordingStandard'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'recordingStandard = ';
                            echo $recordingStandard = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $recordingStandard;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }



                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'oxide')) {
                    if (isset($AssetInformatoin[0]['FormatType']['oxide'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'oxide = ';
                            echo $oxide = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $oxide;
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

    public function EightMMCalc($AssetInformatoin = array(), $characteristicsValues = array()) {

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

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'formatVersion')) {
                if (isset($AssetInformatoin[0]['FormatType']['formatVersion'])) {
                    if (strstr(strtolower($this->multiselection_value['EightMMformatVersion'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'formatVersion = ';
                        echo $formatVersion = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $formatVersion;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard')) {
                if (isset($AssetInformatoin[0]['FormatType']['recordingStandard'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'recordingStandard = ';
                        echo $recordingStandard = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $recordingStandard;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingSpeed')) {
                if (isset($AssetInformatoin[0]['FormatType']['recordingSpeed'])) {
                    if (strstr(strtolower($this->multiselection_value['EightMMrecordingSpeed'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'recordingSpeed = ';
                        echo $recordingSpeed = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $recordingSpeed;
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

        return $this->score;
    }

    public function OpenReelVideo2Calc($AssetInformatoin = array(), $characteristicsValues = array()) {
        $constraint_will_be_applied = FALSE;

        if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != '' && $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] != NULL) {
            $constraint_will_be_applied = TRUE;
        }
        foreach ($characteristicsValues as $characteristicsValue) {
            if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                continue;
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'softBinderSyndrome')) {
                if (isset($AssetInformatoin[0]['FormatType']['softBinderSyndrome'])) {
                    echo 'softBinderSyndrome = ';
                    if ($AssetInformatoin[0]['FormatType']['softBinderSyndrome'] == 1 || $AssetInformatoin[0]['FormatType']['softBinderSyndrome'] == TRUE) {
                        return $this->score = 100;
                    }
                    echo '<br/>';
                    echo '<br/>';
                }
            }
            if (!$constraint_will_be_applied) {
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

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'formatVersion')) {
                    if (isset($AssetInformatoin[0]['FormatType']['formatVersion'])) {
                        if (strstr(strtolower($this->multiselection_value['OpenReelVideo2formatVersion'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'formatVersion = ';
                            echo $formatVersion = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $formatVersion;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard')) {
                    if (isset($AssetInformatoin[0]['FormatType']['recordingStandard'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'recordingStandard = ';
                            echo $recordingStandard = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $recordingStandard;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }


                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'format')) {
                    if (isset($AssetInformatoin[0]['FormatType']['format'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'format = ';
                            echo $format = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $format;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'reelSize')) {

                    if (isset($AssetInformatoin[0]['FormatType']['reelSize'])) {

                        if (strstr(strtolower($this->multiselection_value['TwoInchReelSize'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'reelSize = ';
                            echo $reelSize = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $reelSize;
                            echo '<br/>';
                            echo '<br/>';
                        }
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
                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'whiteResidue')) {
                    echo 'Glue of Reel = ';
                    if (isset($AssetInformatoin[0]['FormatType']['whiteResidue'])) {
                        echo $whiteResidue = (($AssetInformatoin[0]['FormatType']['whiteResidue'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $whiteResidue;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }
        }

        return $this->score;
    }

    public function OpenReelVideo1Calc($AssetInformatoin = array(), $characteristicsValues = array()) {

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

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'formatVersion')) {
                if (isset($AssetInformatoin[0]['FormatType']['formatVersion'])) {
                    if (strstr(strtolower($this->multiselection_value['OpenReelVideo1formatVersion'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'formatVersion = ';
                        echo $formatVersion = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $formatVersion;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingStandard')) {
                if (isset($AssetInformatoin[0]['FormatType']['recordingStandard'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'recordingStandard = ';
                        echo $recordingStandard = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $recordingStandard;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'format')) {
                if (isset($AssetInformatoin[0]['FormatType']['format'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'format = ';
                        echo $format = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $format;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'reelSize')) {
                if (isset($AssetInformatoin[0]['FormatType']['reelSize'])) {
                    if (strstr(strtolower($this->multiselection_value['OneInchReelSize'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'reelSize = ';
                        echo $reelSize = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $reelSize;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'whiteResidue')) {
                echo 'Glue of Reel = ';
                if (isset($AssetInformatoin[0]['FormatType']['whiteResidue'])) {
                    echo $whiteResidue = (($AssetInformatoin[0]['FormatType']['whiteResidue'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $whiteResidue;
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
        }

        return $this->score;
    }

}

?>
