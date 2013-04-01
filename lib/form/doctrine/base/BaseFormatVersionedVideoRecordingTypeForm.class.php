<?php

/**
 * FormatVersionedVideoRecordingType form base class.
 *
 * @method FormatVersionedVideoRecordingType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFormatVersionedVideoRecordingTypeForm extends SizedVideoRecordingFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('format_versioned_video_recording_type[%s]');
  }

  public function getModelName()
  {
    return 'FormatVersionedVideoRecordingType';
  }

}
