<?php

/**
 * OpenReelVideoFormatType filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOpenReelVideoFormatTypeFormFilter extends ReelVideoRecordingFormatTypeFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('open_reel_video_format_type_filters[%s]');
  }

  public function getModelName()
  {
    return 'OpenReelVideoFormatType';
  }
}
