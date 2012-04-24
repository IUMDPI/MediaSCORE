<?php

/**
 * SoundOpticalDisk form base class.
 *
 * @method SoundOpticalDisk getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSoundOpticalDiskForm extends OpticalDiscFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('sound_optical_disk[%s]');
  }

  public function getModelName()
  {
    return 'SoundOpticalDisk';
  }

}
