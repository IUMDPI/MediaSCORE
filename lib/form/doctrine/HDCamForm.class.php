<?php

/**
 * HDCam form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class HDCamForm extends BaseHDCamForm
{
  /**
   * @see FormatVersionedVideoRecordingTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('formatVersion',new sfWidgetFormChoice(array('choices' => HDCam::$constants[0])));
	  $this->setWidget('speed',new sfWidgetFormChoice(array('choices' => HDCam::$constants[1])));
	  $this->setWidget('scanning',new sfWidgetFormChoice(array('choices' => HDCam::$constants[2])));

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}
