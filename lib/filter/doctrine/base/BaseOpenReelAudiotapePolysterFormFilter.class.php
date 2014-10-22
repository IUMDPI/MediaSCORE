<?php

/**
 * OpenReelAudiotapePolyster filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOpenReelAudiotapePolysterFormFilter extends OpenReelAudioTapeFormatTypeFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('open_reel_audiotape_polyster_filters[%s]');
  }

  public function getModelName()
  {
    return 'OpenReelAudiotapePolyster';
  }
}
