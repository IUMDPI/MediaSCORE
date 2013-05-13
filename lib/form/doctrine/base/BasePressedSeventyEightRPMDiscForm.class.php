<?php

/**
 * PressedSeventyEightRPMDisc form base class.
 *
 * @method PressedSeventyEightRPMDisc getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePressedSeventyEightRPMDiscForm extends PressedAudioDiscFormatTypeForm {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('pressed_seventy_eight_rpm_disc[%s]');
    }

    public function getModelName() {
        return 'PressedSeventyEightRPMDisc';
    }

}
