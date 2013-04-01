<?php

/**
 * OneInchOpenReelVideo form base class.
 *
 * @method OneInchOpenReelVideo getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOneInchOpenReelVideoForm extends OpenReelVideoFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('one_inch_open_reel_video[%s]');
  }

  public function getModelName()
  {
    return 'OneInchOpenReelVideo';
  }

}
