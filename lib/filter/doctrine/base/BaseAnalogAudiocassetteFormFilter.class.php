<?php

/**
 * AnalogAudiocassette filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAnalogAudiocassetteFormFilter extends AudiotapeFormatTypeFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('analog_audiocassette_filters[%s]');
  }

  public function getModelName()
  {
    return 'AnalogAudiocassette';
  }
}
