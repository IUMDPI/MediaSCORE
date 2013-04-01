<?php

/**
 * FormatTypedVideoRecording form base class.
 *
 * @method FormatTypedVideoRecording getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFormatTypedVideoRecordingForm extends SizedVideoRecordingFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('format_typed_video_recording[%s]');
  }

  public function getModelName()
  {
    return 'FormatTypedVideoRecording';
  }

}
