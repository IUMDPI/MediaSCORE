<?php

/**
 * OpenReelAudiotapePolyster form base class.
 *
 * @method OpenReelAudiotapePolyster getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpenReelAudiotapePolysterForm extends OpenReelAudioTapeFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('open_reel_audiotape_polyster[%s]');
  }

  public function getModelName()
  {
    return 'OpenReelAudiotapePolyster';
  }

}
