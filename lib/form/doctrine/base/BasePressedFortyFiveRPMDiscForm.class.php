<?php

/**
 * PressedFortyFiveRPMDisc form base class.
 *
 * @method PressedFortyFiveRPMDisc getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePressedFortyFiveRPMDiscForm extends PressedAudioDiscFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('pressed_forty_five_rpm_disc[%s]');
  }

  public function getModelName()
  {
    return 'PressedFortyFiveRPMDisc';
  }

}
