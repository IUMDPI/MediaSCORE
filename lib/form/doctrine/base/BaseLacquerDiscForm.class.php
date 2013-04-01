<?php

/**
 * LacquerDisc form base class.
 *
 * @method LacquerDisc getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLacquerDiscForm extends SoftDiskFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('lacquer_disc[%s]');
  }

  public function getModelName()
  {
    return 'LacquerDisc';
  }

}
