<?php

/**
 * OpenReelAudioTapeFormatType form base class.
 *
 * @method OpenReelAudioTapeFormatType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpenReelAudioTapeFormatTypeForm extends AudiotapeFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('open_reel_audio_tape_format_type[%s]');
  }

  public function getModelName()
  {
    return 'OpenReelAudioTapeFormatType';
  }

}
