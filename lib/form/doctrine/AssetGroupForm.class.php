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

	foreach( array('format_id','parent_node_id','type') as $hiddenField )
		$this->setWidget($hiddenField,new sfWidgetFormInputHidden());

	$this->getWidget('parent_node_id')->setAttribute('value',$this->getOption('collectionID'));

	$this->setWidget('creator_id',new sfWidgetFormInputHidden(array(),array( 'value' => $this->getOption('creatorID'))));

	// 05/08/12
	// Temporary - Need user plug-in
	//$this->getWidget('creator_id')->setAttribute('value',1);

	$this->setWidget('storage_location_id',new sfWidgetFormDoctrineChoice(array('model' => 'StorageLocation', 'add_empty' => false,
		/*'method' => 'getStorageLocations',
		'query' => Doctrine_Query::create()
				->from('Collection c')
				->where('c.id = ?',$this->getObject()->getParentNodeId())*/
	)));
	$this->getWidget('type')->setAttribute('value',4);
  }
}
