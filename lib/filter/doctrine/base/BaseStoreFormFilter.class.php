<?php

/**
 * Store filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
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
      'characteristics'                => new sfWidgetFormFilterInput(),
      'project_title'                  => new sfWidgetFormFilterInput(),
      'iub_unit'                       => new sfWidgetFormFilterInput(),
      'iub_work'                       => new sfWidgetFormFilterInput(),
      'date_completed'                 => new sfWidgetFormFilterInput(),
      'score_subject_interest'         => new sfWidgetFormFilterInput(),
      'notes_subject_interest'         => new sfWidgetFormFilterInput(),
      'score_content_quality'          => new sfWidgetFormFilterInput(),
      'notes_content_quality'          => new sfWidgetFormFilterInput(),
      'score_rareness'                 => new sfWidgetFormFilterInput(),
      'notes_rareness'                 => new sfWidgetFormFilterInput(),
      'score_documentation'            => new sfWidgetFormFilterInput(),
      'notes_documentation'            => new sfWidgetFormFilterInput(),
      'score_technical_quality'        => new sfWidgetFormFilterInput(),
      'notes_technical_quality'        => new sfWidgetFormFilterInput(),
      'unknown_technical_quality'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'collection_score'               => new sfWidgetFormFilterInput(),
      'generation_statement'           => new sfWidgetFormFilterInput(),
      'generation_statement_notes'     => new sfWidgetFormFilterInput(),
      'ip_statement'                   => new sfWidgetFormFilterInput(),
      'ip_statement_notes'             => new sfWidgetFormFilterInput(),
      'general_notes'                  => new sfWidgetFormFilterInput(),
      'location'                       => new sfWidgetFormFilterInput(),
      'format_id'                      => new sfWidgetFormFilterInput(),
      'is_imported'                    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'name_slug'                      => new sfWidgetFormFilterInput(),
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
      'characteristics'                => new sfValidatorPass(array('required' => false)),
      'project_title'                  => new sfValidatorPass(array('required' => false)),
      'iub_unit'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'iub_work'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_completed'                 => new sfValidatorPass(array('required' => false)),
      'score_subject_interest'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'notes_subject_interest'         => new sfValidatorPass(array('required' => false)),
      'score_content_quality'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'notes_content_quality'          => new sfValidatorPass(array('required' => false)),
      'score_rareness'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'notes_rareness'                 => new sfValidatorPass(array('required' => false)),
      'score_documentation'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'notes_documentation'            => new sfValidatorPass(array('required' => false)),
      'score_technical_quality'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notes_technical_quality'        => new sfValidatorPass(array('required' => false)),
      'unknown_technical_quality'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'collection_score'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'generation_statement'           => new sfValidatorPass(array('required' => false)),
      'generation_statement_notes'     => new sfValidatorPass(array('required' => false)),
      'ip_statement'                   => new sfValidatorPass(array('required' => false)),
      'ip_statement_notes'             => new sfValidatorPass(array('required' => false)),
      'general_notes'                  => new sfValidatorPass(array('required' => false)),
      'location'                       => new sfValidatorPass(array('required' => false)),
      'format_id'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_imported'                    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'name_slug'                      => new sfValidatorPass(array('required' => false)),
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
      'characteristics'                => 'Text',
      'project_title'                  => 'Text',
      'iub_unit'                       => 'Number',
      'iub_work'                       => 'Number',
      'date_completed'                 => 'Text',
      'score_subject_interest'         => 'Number',
      'notes_subject_interest'         => 'Text',
      'score_content_quality'          => 'Number',
      'notes_content_quality'          => 'Text',
      'score_rareness'                 => 'Number',
      'notes_rareness'                 => 'Text',
      'score_documentation'            => 'Number',
      'notes_documentation'            => 'Text',
      'score_technical_quality'        => 'Number',
      'notes_technical_quality'        => 'Text',
      'unknown_technical_quality'      => 'Boolean',
      'collection_score'               => 'Number',
      'generation_statement'           => 'Text',
      'generation_statement_notes'     => 'Text',
      'ip_statement'                   => 'Text',
      'ip_statement_notes'             => 'Text',
      'general_notes'                  => 'Text',
      'location'                       => 'Text',
      'format_id'                      => 'Number',
      'is_imported'                    => 'Boolean',
      'created_at'                     => 'Date',
      'updated_at'                     => 'Date',
      'name_slug'                      => 'Text',
    );
  }
}
