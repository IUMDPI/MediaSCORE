<?php

/**
 * Unit filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUnitFormFilter extends StoreFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['storage_locations_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'StorageLocation'));
    $this->validatorSchema['storage_locations_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'StorageLocation', 'required' => false));

    $this->widgetSchema   ['personnel_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Person'));
    $this->validatorSchema['personnel_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Person', 'required' => false));

    $this->widgetSchema->setNameFormat('unit_filters[%s]');
  }

  public function addStorageLocationsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.UnitStorageLocation UnitStorageLocation')
      ->andWhereIn('UnitStorageLocation.storage_location_id', $values)
    ;
  }

  public function addPersonnelListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.UnitPerson UnitPerson')
      ->andWhereIn('UnitPerson.person_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Unit';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'storage_locations_list' => 'ManyKey',
      'personnel_list' => 'ManyKey',
    ));
  }
}
