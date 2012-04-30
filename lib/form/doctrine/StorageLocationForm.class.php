<?php

/**
 * StorageLocation form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StorageLocationForm extends BaseStorageLocationForm
{
  public function configure()
  {
	/*
	  //'env_rating' => new sfWidgetFormInputText(),
		//      //'created_at' => new sfWidgetFormDateTime(),
		//            //'updated_at' => new sfWidgetFormDateTime(),
		//
	 */

	  $this->setWidget('env_rating',new sfWidgetFormChoice(array('choices' => StorageLocation::$constants)));
  }
}
