<?php

/**
 * PressedLPDisc form base class.
 *
 * @method PressedLPDisc getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePressedLPDiscForm extends PressedAudioDiscFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('pressed_lp_disc[%s]');
  }

  public function getModelName()
  {
    return 'PressedLPDisc';
  }

}
