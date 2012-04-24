<?php

/**
 * AnalogAudiocassette form base class.
 *
 * @method AnalogAudiocassette getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAnalogAudiocassetteForm extends AudiotapeFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('analog_audiocassette[%s]');
  }

  public function getModelName()
  {
    return 'AnalogAudiocassette';
  }

}
