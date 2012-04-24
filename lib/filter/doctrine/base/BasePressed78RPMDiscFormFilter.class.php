<?php

/**
 * Pressed78RPMDisc filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePressed78RPMDiscFormFilter extends PressedAudioDiscFormatTypeFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('pressed78_rpm_disc_filters[%s]');
  }

  public function getModelName()
  {
    return 'Pressed78RPMDisc';
  }
}
