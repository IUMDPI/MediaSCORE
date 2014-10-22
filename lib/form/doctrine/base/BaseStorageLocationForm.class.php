<?php

/**
 * StorageLocation form base class.
 *
 * @method StorageLocation getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStorageLocationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                   => new sfWidgetFormInputHidden(),
      'name'                                 => new sfWidgetFormInputText(),
      'resident_structure_description'       => new sfWidgetFormInputText(),
      'env_rating'                           => new sfWidgetFormInputText(),
      'created_at'                           => new sfWidgetFormDateTime(),
      'updated_at'                           => new sfWidgetFormDateTime(),
      'units_list'                           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Unit')),
      'collections_list'                     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Collection')),
      'unit_multiple_collection_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'UnitMultipleCollection')),
      'collection_multiple_asset_group_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'CollectionMultipleAssetGroup')),
    ));

    $this->setValidators(array(
      'id'                                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                                 => new sfValidatorString(array('max_length' => 255)),
      'resident_structure_description'       => new sfValidatorPass(),
      'env_rating'                           => new sfValidatorInteger(array('required' => false)),
      'created_at'                           => new sfValidatorDateTime(),
      'updated_at'                           => new sfValidatorDateTime(),
      'units_list'                           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Unit', 'required' => false)),
      'collections_list'                     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Collection', 'required' => false)),
      'unit_multiple_collection_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'UnitMultipleCollection', 'required' => false)),
      'collection_multiple_asset_group_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'CollectionMultipleAssetGroup', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('storage_location[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'StorageLocation';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['units_list']))
    {
      $this->setDefault('units_list', $this->object->Units->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['collections_list']))
    {
      $this->setDefault('collections_list', $this->object->Collections->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['unit_multiple_collection_list']))
    {
      $this->setDefault('unit_multiple_collection_list', $this->object->UnitMultipleCollection->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['collection_multiple_asset_group_list']))
    {
      $this->setDefault('collection_multiple_asset_group_list', $this->object->CollectionMultipleAssetGroup->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveUnitsList($con);
    $this->saveCollectionsList($con);
    $this->saveUnitMultipleCollectionList($con);
    $this->saveCollectionMultipleAssetGroupList($con);

    parent::doSave($con);
  }

  public function saveUnitsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['units_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Units->getPrimaryKeys();
    $values = $this->getValue('units_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Units', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Units', array_values($link));
    }
  }

  public function saveCollectionsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['collections_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Collections->getPrimaryKeys();
    $values = $this->getValue('collections_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Collections', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Collections', array_values($link));
    }
  }

  public function saveUnitMultipleCollectionList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['unit_multiple_collection_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->UnitMultipleCollection->getPrimaryKeys();
    $values = $this->getValue('unit_multiple_collection_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('UnitMultipleCollection', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('UnitMultipleCollection', array_values($link));
    }
  }

  public function saveCollectionMultipleAssetGroupList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['collection_multiple_asset_group_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->CollectionMultipleAssetGroup->getPrimaryKeys();
    $values = $this->getValue('collection_multiple_asset_group_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('CollectionMultipleAssetGroup', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('CollectionMultipleAssetGroup', array_values($link));
    }
  }

}
