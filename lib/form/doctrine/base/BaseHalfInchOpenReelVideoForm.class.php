<?php

/**
 * HalfInchOpenReelVideo form base class.
 *
 * @method HalfInchOpenReelVideo getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHalfInchOpenReelVideoForm extends OpenReelVideoFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('half_inch_open_reel_video[%s]');
  }

  public function getModelName()
  {
    return 'HalfInchOpenReelVideo';
  }

}
