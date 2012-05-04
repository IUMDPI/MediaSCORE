<?php

/**
 * AnalogAudiocassette form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnalogAudiocassetteForm extends BaseAnalogAudiocassetteForm
{
  public function configure()
  {
	$this->setWidget('tape_type',new sfWidgetFormChoice(array('choices' => AnalogAudiocassette::$constants[0])));
	$this->setWidget('thin_tape',new sfWidgetFormInputCheckbox());
	$this->setWidget('slow_speed',new sfWidgetFormInputCheckbox());
	$this->setWidget('sound_field',new sfWidgetFormChoice(array('choices' => AnalogAudiocassette::$constants[1])));
	$this->setWidget('softBinderSyndrome',new sfWidgetFormInputCheckbox());

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}
