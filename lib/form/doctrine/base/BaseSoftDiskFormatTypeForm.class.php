<?php

/**
 * SoftDiskFormatType form base class.
 *
 * @method SoftDiskFormatType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSoftDiskFormatTypeForm extends DiskFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('soft_disk_format_type[%s]');
  }

  public function getModelName()
  {
    return 'SoftDiskFormatType';
  }

}
