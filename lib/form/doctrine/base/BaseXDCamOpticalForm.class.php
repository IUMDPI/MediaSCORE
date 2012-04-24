<?php

/**
 * XDCamOptical form base class.
 *
 * @method XDCamOptical getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseXDCamOpticalForm extends StandardizedRecordingFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('xd_cam_optical[%s]');
  }

  public function getModelName()
  {
    return 'XDCamOptical';
  }

}
