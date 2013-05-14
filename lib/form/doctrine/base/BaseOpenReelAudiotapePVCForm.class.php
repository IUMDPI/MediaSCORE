<?php

/**
 * OpenReelAudiotapePVC form base class.
 *
 * @method OpenReelAudiotapePVC getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpenReelAudiotapePVCForm extends OpenReelAudioTapeFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('open_reel_audiotape_pvc[%s]');
  }

  public function getModelName()
  {
    return 'OpenReelAudiotapePVC';
  }

}
