<?php

/**
 * PressedFortyFiveRPMDisc filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePressedFortyFiveRPMDiscFormFilter extends PressedAudioDiscFormatTypeFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('pressed_forty_five_rpm_disc_filters[%s]');
  }

  public function getModelName()
  {
    return 'PressedFortyFiveRPMDisc';
  }
}
