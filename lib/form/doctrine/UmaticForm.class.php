<?php

/**
 * Umatic form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UmaticForm extends BaseUmaticForm
{
  /**
   * @see FormatVersionedVideoRecordingTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('size',new sfWidgetFormChoice(array('choices' => Umatic::$constants[0])));
	  $this->setWidget('formatVersion',new sfWidgetFormChoice(array('choices' => Umatic::$constants[1])));

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}
