<?php

/**
 * AssetGroup form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AssetGroupForm extends BaseAssetGroupForm
{
  /**
   * @see SubUnitForm
   */
  public function configure()
  {
	  parent::configure();

	foreach( array( 'created_at','updated_at','last_editor_id','resident_structure_description','unit_personnel' ) as $voidField ) {
		unset($this->widgetSchema[$voidField]);
		unset($this->validatorSchema[$voidField]);
	}

	foreach( array('creator_id','format_id','parent_node_id','type') as $hiddenField )
		$this->setWidget($hiddenField,new sfWidgetFormInputHidden());

	$this->setWidget('storage_location_id',new sfWidgetFormDoctrineChoice(array('model' => 'StorageLocation', 'add_empty' => false,'method' => 'getName')));
	$this->getWidget('type')->setAttribute('value',4);
  }
}
