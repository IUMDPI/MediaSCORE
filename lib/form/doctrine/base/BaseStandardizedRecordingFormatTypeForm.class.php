<?php

/**
 * StandardizedRecordingFormatType form base class.
 *
 * @method StandardizedRecordingFormatType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStandardizedRecordingFormatTypeForm extends DiskFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('standardized_recording_format_type[%s]');
  }

  public function getModelName()
  {
    return 'StandardizedRecordingFormatType';
  }

}
