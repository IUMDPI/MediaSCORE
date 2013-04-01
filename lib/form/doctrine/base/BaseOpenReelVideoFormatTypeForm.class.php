<?php

/**
 * OpenReelVideoFormatType form base class.
 *
 * @method OpenReelVideoFormatType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpenReelVideoFormatTypeForm extends ReelVideoRecordingFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('open_reel_video_format_type[%s]');
  }

  public function getModelName()
  {
    return 'OpenReelVideoFormatType';
  }

}
