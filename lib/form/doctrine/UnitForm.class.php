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
	  //$this->setWidget('notes',new sfWidgetFormTextarea());
	$this->getWidget('notes')->setLabel('Contact&nbsp;Notes:&nbsp;');
	$this->setWidget('creator_id',new sfWidgetFormInputHidden(array(),array( 'value' => $this->getOption('creatorID'))));

	$this->setWidget('last_editor_id',new sfWidgetFormInputHidden);

	$this->setWidget('resident_structure_description',new sfWidgetFormInputText(array('label' => 'Building Name and Room Number:&nbsp;')));
	$this->setWidget('personnel_list',new sfWidgetFormDoctrineChoice(array('model' => 'Person', 'add_empty' => false,'method' => 'getFullName','multiple' => true)));
	
	// Custom validators not developed yet
	//unset($this->validatorSchema['storage_location']);
	//unset($this->validatorSchema['personnel_list']);

	$this->getWidget('inst_id')->setLabel('ID:&nbsp;');

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => 1)));

	foreach( array('storage_location_id','parent_node_id','status','location','format_id','created_at','updated_at','unit_personnel') as $voidField) {
		unset($this->widgetSchema[$voidField]);
		unset($this->validatorSchema[$voidField]);
	}
  }
}
