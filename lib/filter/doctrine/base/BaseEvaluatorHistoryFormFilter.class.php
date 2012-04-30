<?php

/**
 * EvaluatorHistory filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEvaluatorHistoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'                     => new sfWidgetFormFilterInput(),
      'evaluator_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Evaluator'), 'add_empty' => true)),
      'asset_group_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Store'), 'add_empty' => true)),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'consulted_personnel_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Person')),
    ));

    $this->setValidators(array(
      'type'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evaluator_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Evaluator'), 'column' => 'id')),
      'asset_group_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Store'), 'column' => 'id')),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'consulted_personnel_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Person', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('evaluator_history_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addConsultedPersonnelListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('EvaluatorHistoryPersonnel.person_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'EvaluatorHistory';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'type'                     => 'Number',
      'evaluator_id'             => 'ForeignKey',
      'asset_group_id'           => 'ForeignKey',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
      'consulted_personnel_list' => 'ManyKey',
    );
  }
}
