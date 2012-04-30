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
	parent::configure();
	
	$this->setWidget('parent_node_id',new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'add_empty' => false,'label' => 'Unit:&nbsp;')));
	//$this->getWidget('parent_node_id')->setLabel('Unit:&nbsp;');
	$this->setWidget('status',new sfWidgetFormChoice(array('choices' => Collection::$statusConstants,'label' => 'Collection Status:&nbsp;')));

	$this->getWidget('type')->setAttribute('value',3);
  }
}
