<?php

/**
 * VHS filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVHSFormFilter extends FormatTypedVideoRecordingFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('vhs_filters[%s]');
  }

  public function getModelName()
  {
    return 'VHS';
  }
}
