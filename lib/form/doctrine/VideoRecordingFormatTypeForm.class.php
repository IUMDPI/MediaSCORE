<?php

/**
 * VideoRecordingFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VideoRecordingFormatTypeForm extends BaseVideoRecordingFormatTypeForm
{
  /**
   * @see FormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('recordingStandard',new sfWidgetFormChoice(array('choices' => VideoRecordingFormatType::$constants)));
	  $this->setWidget('sheddingSoftBinder',new sfWidgetFormInputCheckbox());

  }
}
