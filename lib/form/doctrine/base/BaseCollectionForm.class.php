<?php

/**
 * Collection form base class.
 *
 * @method Collection getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCollectionForm extends SubUnitForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['storage_locations_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'StorageLocation'));
    $this->validatorSchema['storage_locations_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'StorageLocation', 'required' => false));

    $this->widgetSchema->setNameFormat('collection[%s]');
  }

  public function getModelName()
  {
    return 'Collection';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['storage_locations_list']))
    {
      $this->setDefault('storage_locations_list', $this->object->StorageLocations->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveStorageLocationsList($con);

    parent::doSave($con);
  }

  public function saveStorageLocationsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['storage_locations_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->StorageLocations->getPrimaryKeys();
    $values = $this->getValue('storage_locations_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('StorageLocations', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('StorageLocations', array_values($link));
    }
  }

}
