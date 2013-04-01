<?php

/**
 * SoundOpticalDisk filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSoundOpticalDiskFormFilter extends OpticalDiscFormatTypeFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('sound_optical_disk_filters[%s]');
  }

  public function getModelName()
  {
    return 'SoundOpticalDisk';
  }
}
