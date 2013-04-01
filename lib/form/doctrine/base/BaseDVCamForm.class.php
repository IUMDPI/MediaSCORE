<?php

/**
 * DVCam form base class.
 *
 * @method DVCam getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDVCamForm extends SizedVideoRecordingFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('dv_cam[%s]');
  }

  public function getModelName()
  {
    return 'DVCam';
  }

}
