<?php

/**
 * HDCam form base class.
 *
 * @method HDCam getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHDCamForm extends FormatVersionedVideoRecordingTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('hd_cam[%s]');
  }

  public function getModelName()
  {
    return 'HDCam';
  }

}
