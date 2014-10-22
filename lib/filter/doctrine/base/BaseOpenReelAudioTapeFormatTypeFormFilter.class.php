<?php

/**
 * OpenReelAudioTapeFormatType filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOpenReelAudioTapeFormatTypeFormFilter extends AudiotapeFormatTypeFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('open_reel_audio_tape_format_type_filters[%s]');
  }

  public function getModelName()
  {
    return 'OpenReelAudioTapeFormatType';
  }
}
