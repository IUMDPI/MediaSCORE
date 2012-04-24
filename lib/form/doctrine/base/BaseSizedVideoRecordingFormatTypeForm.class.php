<?php

/**
 * SizedVideoRecordingFormatType form base class.
 *
 * @method SizedVideoRecordingFormatType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSizedVideoRecordingFormatTypeForm extends VideoRecordingFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('sized_video_recording_format_type[%s]');
  }

  public function getModelName()
  {
    return 'SizedVideoRecordingFormatType';
  }

}
