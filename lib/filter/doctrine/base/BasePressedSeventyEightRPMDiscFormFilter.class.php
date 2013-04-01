<?php

/**
 * PressedSeventyEightRPMDisc filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePressedSeventyEightRPMDiscFormFilter extends PressedAudioDiscFormatTypeFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('pressed_seventy_eight_rpm_disc_filters[%s]');
  }

  public function getModelName()
  {
    return 'PressedSeventyEightRPMDisc';
  }
}
