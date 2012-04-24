<?php

/**
 * OpenReelAudiotapePaper form base class.
 *
 * @method OpenReelAudiotapePaper getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpenReelAudiotapePaperForm extends OpenReelAudioTapeFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('open_reel_audiotape_paper[%s]');
  }

  public function getModelName()
  {
    return 'OpenReelAudiotapePaper';
  }

}
