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
	  $this->setWidget('format_id',new sfWidgetFormInputHidden());
	  $this->setWidget('parent_node_id',new sfWidgetFormDoctrineChoice(array('model' => 'Collection', 'add_empty' => false)));
  }
}
