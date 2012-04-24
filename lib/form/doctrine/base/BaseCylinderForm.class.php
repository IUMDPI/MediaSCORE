<?php

/**
 * Cylinder form base class.
 *
 * @method Cylinder getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCylinderForm extends SoftDiskFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('cylinder[%s]');
  }

  public function getModelName()
  {
    return 'Cylinder';
  }

}
