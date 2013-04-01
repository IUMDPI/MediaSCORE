<?php

/**
 * MiniDisc form base class.
 *
 * @method MiniDisc getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMiniDiscForm extends SoftDiskFormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('mini_disc[%s]');
  }

  public function getModelName()
  {
    return 'MiniDisc';
  }

}
