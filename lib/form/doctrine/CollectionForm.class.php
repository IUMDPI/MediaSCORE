<?php

/**
 * Collection form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionForm extends BaseCollectionForm
{
  /**
   * @see SubUnitForm
   */
  public function configure()
  {
	parent::configure(); // SubUnitForm invocation
	
	$this->setWidget('parent_node_id',new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'add_empty' => false,'label' => 'Unit:&nbsp;')));
	//$this->getWidget('parent_node_id')->setLabel('Unit:&nbsp;');
	$this->setWidget('status',new sfWidgetFormChoice(array('choices' => Collection::$statusConstants,'label' => 'Collection Status:&nbsp;')));


	foreach( array( 'creator_id','last_editor_id','resident_structure_description', 'created_at','updated_at') as $voidField) {
		unset($this->widgetSchema[$voidField]);
		unset($this->validatorSchema[$voidField]);
	}

	$this->setWidget('type', new sfWidgetFormInputHidden(array(),array('value' => 3)));
  }
}
