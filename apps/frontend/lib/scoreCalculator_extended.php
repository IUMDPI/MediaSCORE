<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of scoreCalculator_extended
 *
 * @author Furqan
 */
class scoreCalculator_extended {

//put your code here
    public function PaperOpenReelAudioTapeCalc($AssetInformatoin = array(), $characteristicsValues = array()) {


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
        }
        return $this->score;
    }

    public function PVCOpenReelAudioTapeCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
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
                    var_dump($characteristicsValue);
                    var_dump($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]);
                    var_dump($characteristicsValue['c_name']);
                    var_dump(strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name'])));

                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        var_dump($characteristicsValue);
                        var_dump($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]);
                        exit;
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

    public function LacquerDiscCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
        $constraint_will_be_applied = FALSE;

        if ($AssetInformatoin[0]['FormatType']['delamination'] != '' && $AssetInformatoin[0]['FormatType']['delamination'] != NULL) {
            $constraint_will_be_applied = TRUE;
        }

        foreach ($characteristicsValues as $characteristicsValue) {
            if (strstr($characteristicsValue['CharacteristicsConstraints']['constraint_name'], 'remove')) {
                continue;
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'delamination')) {
                if (isset($AssetInformatoin[0]['FormatType']['other_contaminants'])) {
                    echo 'delamination = ';
                    if ($AssetInformatoin[0]['FormatType']['delamination'] == 1 || $AssetInformatoin[0]['FormatType']['delamination'] == TRUE) {
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



                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'substrate')) {
                    if (isset($AssetInformatoin[0]['FormatType']['substrate'])) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'substrate = ';
                            echo $substrate = $characteristicsValue['c_score'];
                            $this->score = (float) $this->score + (float) $substrate;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'plasticizerExudation')) {
                    if (isset($AssetInformatoin[0]['FormatType']['plasticizerExudation'])) {
                        echo 'plasticizerExudation = ';
                        echo $plasticizerExudation = (($AssetInformatoin[0]['FormatType']['plasticizerExudation'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                        $this->score = (float) $this->score + $plasticizerExudation;
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

    public function MiniDiscCalc($AssetInformatoin = array(), $characteristicsValues = array()) {

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

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'materialsBreakdown')) {
                if (isset($AssetInformatoin[0]['FormatType']['materialsBreakdown'])) {
                    echo 'materialsBreakdown = ';
                    echo $materialsBreakdown = (($AssetInformatoin[0]['FormatType']['materialsBreakdown'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $materialsBreakdown;
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
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingLayer')) {
                if (isset($AssetInformatoin[0]['FormatType']['recordingLayer'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'recordingLayer = ';
                        echo $recordingLayer = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $recordingLayer;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }
            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'recordingSpeed')) {
                if (isset($AssetInformatoin[0]['FormatType']['recordingSpeed'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'recordingSpeed = ';
                        echo $recordingSpeed = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $recordingSpeed;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }
        }
        return $this->score;
    }

    public function CylinderCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
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
            if (!$constraint_will_be_applied) {
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

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'cylinderType')) {
                if (isset($AssetInformatoin[0]['FormatType']['cylinderType'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'cylinderType = ';
                        echo $cylinderType = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $cylinderType;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }
        }
        return $this->score;
    }

    public function SoundOpticalDiscCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
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



                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'reflectiveLayer')) {

                    if (isset($AssetInformatoin[0]['FormatType']['reflectiveLayer'])) {
                        $reflectiveLayer_array = explode(',', $AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]);

                        foreach ($reflectiveLayer_array as $reflectiveLayer_one) {
                            if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$reflectiveLayer_one]), strtolower($characteristicsValue['c_name']))) {
                                echo 'reflectiveLayer = ';
                                echo $reflectiveLayer = $characteristicsValue['c_score'];

                                $this->score = (float) $this->score + (float) $reflectiveLayer;
                                echo '<br/>';
                                echo '<br/>';
                            }
                        }
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'dataLayer')) {

                    if (isset($AssetInformatoin[0]['FormatType']['dataLayer'])) {
                        $dataLayer_array = explode(',', $AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]);

                        foreach ($dataLayer_array as $dataLayer_one) {
                            if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$dataLayer_one]), strtolower($characteristicsValue['c_name']))) {
                                echo 'reflectiveLayer = ';
                                echo $dataLayer = $characteristicsValue['c_score'];

                                $this->score = (float) $this->score + (float) $dataLayer;
                                echo '<br/>';
                                echo '<br/>';
                            }
                        }
                    }
                }

                if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'opticalDiscType')) {
                    if (isset($AssetInformatoin[0]['FormatType']['opticalDiscType'])) {
                        if (strstr(strtolower($this->multiselection_value['soundOpticalDiscType'][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                            echo 'opticalDiscType = ';
                            echo $opticalDiscType = $characteristicsValue['c_score'];
                            $this->score = (float) $tshis->score + (float) opticalDiscType;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }
            }
        }

        return $this->score;
    }

    public function OpticalVideoCalc($AssetInformatoin = array(), $characteristicsValues = array()) {

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
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'formatVersion = ';
                        echo $formatVersion = $characteristicsValue['c_score'];
                        $this->score = (float) $this->score + (float) $formatVersion;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'opticalDiscType')) {
                if (isset($AssetInformatoin[0]['FormatType']['opticalDiscType'])) {
                    if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]]), strtolower($characteristicsValue['c_name']))) {
                        echo 'opticalDiscType = ';
                        echo $opticalDiscType = $characteristicsValue['c_score'];
                        $this->score = (float) $tshis->score + (float) $opticalDiscType;
                        echo '<br/>';
                        echo '<br/>';
                    }
                }
            }

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'reflectiveLayer')) {

                if (isset($AssetInformatoin[0]['FormatType']['reflectiveLayer'])) {
                    $reflectiveLayer_array = explode(',', $AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]);

                    foreach ($reflectiveLayer_array as $reflectiveLayer_one) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$reflectiveLayer_one]), strtolower($characteristicsValue['c_name']))) {
                            echo 'reflectiveLayer = ';
                            echo $reflectiveLayer = $characteristicsValue['c_score'];

                            $this->score = (float) $this->score + (float) $reflectiveLayer;
                            echo '<br/>';
                            echo '<br/>';
                        }
                    }
                }
            }


            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'dataLayer')) {

                if (isset($AssetInformatoin[0]['FormatType']['dataLayer'])) {
                    $dataLayer_array = explode(',', $AssetInformatoin[0]['FormatType'][$characteristicsValue['CharacteristicsFormat']['format_c_name']]);

                    foreach ($dataLayer_array as $dataLayer_one) {
                        if (strstr(strtolower($this->multiselection_value[$characteristicsValue['CharacteristicsFormat']['format_c_name']][$dataLayer_one]), strtolower($characteristicsValue['c_name']))) {
                            echo 'reflectiveLayer = ';
                            echo $dataLayer = $characteristicsValue['c_score'];

                            $this->score = (float) $this->score + (float) $dataLayer;
                            echo '<br/>';
                            echo '<br/>';
                        }
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

            if (strstr($characteristicsValue['CharacteristicsFormat']['format_c_name'], 'materialsBreakdown')) {
                if (isset($AssetInformatoin[0]['FormatType']['materialsBreakdown'])) {
                    echo 'materialsBreakdown = ';
                    echo $materialsBreakdown = (($AssetInformatoin[0]['FormatType']['materialsBreakdown'] == 1) ? (float) $characteristicsValue['c_score'] : (float) 0);
                    $this->score = (float) $this->score + $materialsBreakdown;
                    echo '<br/>';
                    echo '<br/>';
                }
            }
        }


        return $this->score;
    }

    public function Pressed78RPMDiscCalc($AssetInformatoin = array(), $characteristicsValues = array()) {
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

}

?>
