<?php

/**
 * Store form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StoreForm extends BaseStoreForm
{
  public function configure()
  {
	//$widgetSchema=$this->getWidgetSchema();
	foreach( array('parent_node_id', 'status', 'location', 'format_id') as $voidField) {
		unset($this->widgetSchema[$voidField]);
		unset($this->widgetSchema[$voidField]);
	}
	//$this->setWidgetSchema($widgetSchema);

	  $this->setWidget('notes',new sfWidgetFormTextarea());

	  $this->getWidget('inst_id')->setLabel('ID:&nbsp;');
	// 04/27/12
	// the Validator throws an exception for fields specified in child classes, preventing these values from reaching the Controller layer and updating the serialized Model.

  }

}
