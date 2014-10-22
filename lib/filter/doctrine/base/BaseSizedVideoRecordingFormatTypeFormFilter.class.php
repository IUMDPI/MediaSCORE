<?php

/**
 * SizedVideoRecordingFormatType filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSizedVideoRecordingFormatTypeFormFilter extends VideoRecordingFormatTypeFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('sized_video_recording_format_type_filters[%s]');
  }

  public function getModelName()
  {
    return 'SizedVideoRecordingFormatType';
  }
}
