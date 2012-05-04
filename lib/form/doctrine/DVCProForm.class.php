<?php

/**
 * DVCPro form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DVCProForm extends BaseDVCProForm
{
  /**
   * @see FormatVersionedVideoRecordingTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('formatVersion',new sfWidgetFormChoice(array('choices' => DVCPro::$constants[0])));
	  $this->setWidget('recordingSpeed',new sfWidgetFormChoice(array('choices' => DVCPro::$constants[1])));

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}
