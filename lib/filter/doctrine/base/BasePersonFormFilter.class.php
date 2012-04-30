<?php

/**
 * Person filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePersonFormFilter extends UserFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['units_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Unit'));
    $this->validatorSchema['units_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Unit', 'required' => false));

    $this->widgetSchema   ['consulted_for_asset_groups_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'EvaluatorHistory'));
    $this->validatorSchema['consulted_for_asset_groups_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'EvaluatorHistory', 'required' => false));

    $this->widgetSchema->setNameFormat('person_filters[%s]');
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
      ->leftJoin($query->getRootAlias().'.UnitPerson UnitPerson')
      ->andWhereIn('UnitPerson.unit_id', $values)
    ;
  }

  public function addConsultedForAssetGroupsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.EvaluatorHistoryPersonnel EvaluatorHistoryPersonnel')
      ->andWhereIn('EvaluatorHistoryPersonnel.evaluator_history_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Person';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'units_list' => 'ManyKey',
      'consulted_for_asset_groups_list' => 'ManyKey',
    ));
  }
}
