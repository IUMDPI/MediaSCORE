<?php

/**
 * SubUnit form base class.
 *
 * @method SubUnit getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSubUnitForm extends StoreForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('sub_unit[%s]');
  }

  public function getModelName()
  {
    return 'SubUnit';
  }

}
