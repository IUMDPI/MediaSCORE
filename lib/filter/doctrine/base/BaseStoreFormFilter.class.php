<?php

/**
 * Store filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseStoreFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'inst_id'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'notes'                          => new sfWidgetFormFilterInput(),
      'creator_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
      'last_editor_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Editor'), 'add_empty' => true)),
      'type'                           => new sfWidgetFormFilterInput(),
      'resident_structure_description' => new sfWidgetFormFilterInput(),
      'parent_node_id'                 => new sfWidgetFormFilterInput(),
      'status'                         => new sfWidgetFormFilterInput(),
      'location'                       => new sfWidgetFormFilterInput(),
      'format_id'                      => new sfWidgetFormFilterInput(),
      'created_at'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'                           => new sfValidatorPass(array('required' => false)),
      'inst_id'                        => new sfValidatorPass(array('required' => false)),
      'notes'                          => new sfValidatorPass(array('required' => false)),
      'creator_id'                     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Creator'), 'column' => 'id')),
      'last_editor_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Editor'), 'column' => 'id')),
      'type'                           => new sfValidatorPass(array('required' => false)),
      'resident_structure_description' => new sfValidatorPass(array('required' => false)),
      'parent_node_id'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'                         => new sfValidatorPass(array('required' => false)),
      'location'                       => new sfValidatorPass(array('required' => false)),
      'format_id'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('store_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Store';
  }

  public function getFields()
  {
    return array(
      'id'                             => 'Number',
      'name'                           => 'Text',
      'inst_id'                        => 'Text',
      'notes'                          => 'Text',
      'creator_id'                     => 'ForeignKey',
      'last_editor_id'                 => 'ForeignKey',
      'type'                           => 'Text',
      'resident_structure_description' => 'Text',
      'parent_node_id'                 => 'Number',
      'status'                         => 'Text',
      'location'                       => 'Text',
      'format_id'                      => 'Number',
      'created_at'                     => 'Date',
      'updated_at'                     => 'Date',
    );
  }
}
