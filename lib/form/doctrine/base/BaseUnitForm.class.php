<?php

/**
 * Unit form base class.
 *
 * @method Unit getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUnitForm extends StoreForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['storage_locations_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'StorageLocation'));
    $this->validatorSchema['storage_locations_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'StorageLocation', 'required' => false));

    $this->widgetSchema   ['personnel_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Person'));
    $this->validatorSchema['personnel_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Person', 'required' => false));

    $this->widgetSchema->setNameFormat('unit[%s]');
  }

  public function getModelName()
  {
    return 'Unit';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['storage_locations_list']))
    {
      $this->setDefault('storage_locations_list', $this->object->StorageLocations->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['personnel_list']))
    {
      $this->setDefault('personnel_list', $this->object->Personnel->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveStorageLocationsList($con);
    $this->savePersonnelList($con);

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

  public function savePersonnelList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['personnel_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Personnel->getPrimaryKeys();
    $values = $this->getValue('personnel_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Personnel', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Personnel', array_values($link));
    }
  }

}
