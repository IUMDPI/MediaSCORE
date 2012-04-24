<?php

/**
 * VideoRecordingFormatType form base class.
 *
 * @method VideoRecordingFormatType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVideoRecordingFormatTypeForm extends FormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('video_recording_format_type[%s]');
  }

  public function getModelName()
  {
    return 'VideoRecordingFormatType';
  }

}
