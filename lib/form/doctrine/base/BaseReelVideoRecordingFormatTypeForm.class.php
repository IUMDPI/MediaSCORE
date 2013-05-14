<?php

/**
 * ReelVideoRecordingFormatType form base class.
 *
 * @method ReelVideoRecordingFormatType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReelVideoRecordingFormatTypeForm extends VideoRecordingFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('reel_video_recording_format_type[%s]');
  }

  public function getModelName()
  {
    return 'ReelVideoRecordingFormatType';
  }

}
