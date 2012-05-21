<?php

/**
 * StorageLocation filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseStorageLocationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resident_structure_description' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'env_rating'                     => new sfWidgetFormFilterInput(),
      'created_at'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'units_list'                     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Unit')),
      'collections_list'               => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Collection')),
    ));

    $this->setValidators(array(
      'name'                           => new sfValidatorPass(array('required' => false)),
      'resident_structure_description' => new sfValidatorPass(array('required' => false)),
      'env_rating'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'units_list'                     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Unit', 'required' => false)),
      'collections_list'               => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Collection', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('storage_location_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addUnitsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('UnitStorageLocation.unit_id', $values)
    ;
  }

  public function addCollectionsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.CollectionStorageLocation CollectionStorageLocation')
      ->andWhereIn('CollectionStorageLocation.collection_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'StorageLocation';
  }

  public function getFields()
  {
    return array(
      'id'                             => 'Number',
      'name'                           => 'Text',
      'resident_structure_description' => 'Text',
      'env_rating'                     => 'Number',
      'created_at'                     => 'Date',
      'updated_at'                     => 'Date',
      'units_list'                     => 'ManyKey',
      'collections_list'               => 'ManyKey',
    );
  }
}
