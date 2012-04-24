<?php

/**
 * SoftDiskFormatType filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSoftDiskFormatTypeFormFilter extends DiskFormatTypeFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('soft_disk_format_type_filters[%s]');
  }

  public function getModelName()
  {
    return 'SoftDiskFormatType';
  }
}
