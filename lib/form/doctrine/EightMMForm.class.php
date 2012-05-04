<?php

/**
 * EightMM form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EightMMForm extends BaseEightMMForm
{
  /**
   * @see ReelVideoRecordingFormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('format',new sfWidgetFormChoice(array('choices' => EightMM::$constants[0])));
	  $this->setWidget('recordingSpeed',new sfWidgetFormChoice(array('choices' => EightMM::$constants[1])));
	  $this->setWidget('binderSystem',new sfWidgetFormChoice(array('choices' => EightMM::$constants[2])));

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}
