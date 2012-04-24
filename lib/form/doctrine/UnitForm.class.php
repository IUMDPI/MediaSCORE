<?php

/**
 * Unit form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UnitForm extends BaseUnitForm
{
  public function configure()
  {
	$this->setWidget('resident_structure_description',new sfWidgetFormInputText());
	$this->setWidget('unit_personnel',new sfWidgetFormDoctrineChoice(array('model' => 'Person', 'add_empty' => false)));
  }
}
