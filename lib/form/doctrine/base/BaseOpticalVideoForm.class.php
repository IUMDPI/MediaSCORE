<?php

/**
 * OpticalVideo form base class.
 *
 * @method OpticalVideo getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpticalVideoForm extends OpticalDiscFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('optical_video[%s]');
  }

  public function getModelName()
  {
    return 'OpticalVideo';
  }

}
