<?php

/**
 * Pressed78RPMDisc form base class.
 *
 * @method Pressed78RPMDisc getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePressed78RPMDiscForm extends PressedAudioDiscFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('pressed78_rpm_disc[%s]');
  }

  public function getModelName()
  {
    return 'Pressed78RPMDisc';
  }

}
