<?php

/**
 * Store form base class.
 *
 * @method Store getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStoreForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'inst_id' => new sfWidgetFormInputText(),
            'notes' => new sfWidgetFormInputText(),
            'creator_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
            'last_editor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Editor'), 'add_empty' => true)),
            'type' => new sfWidgetFormInputText(),
            'resident_structure_description' => new sfWidgetFormInputText(),
            'parent_node_id' => new sfWidgetFormInputText(),
            'status' => new sfWidgetFormInputText(),
            'characteristics' => new sfWidgetFormInputText(),
            'project_title' => new sfWidgetFormInputText(),
            'iub_unit' => new sfWidgetFormInputText(),
            'iub_work' => new sfWidgetFormInputText(),
            'date_completed' => new sfWidgetFormInputText(),
            'score_subject_interest' => new sfWidgetFormInputText(),
            'notes_subject_interest' => new sfWidgetFormInputText(),
            'score_content_quality' => new sfWidgetFormInputText(),
            'notes_content_quality' => new sfWidgetFormInputText(),
            'score_rareness' => new sfWidgetFormInputText(),
            'notes_rareness' => new sfWidgetFormInputText(),
            'score_documentation' => new sfWidgetFormInputText(),
            'notes_documentation' => new sfWidgetFormInputText(),
            'score_technical_quality' => new sfWidgetFormInputText(),
            'notes_technical_quality' => new sfWidgetFormInputText(),
            'unknown_technical_quality' => new sfWidgetFormInputCheckbox(),
            'collection_score' => new sfWidgetFormInputText(),
            'generation_statement' => new sfWidgetFormInputText(),
            'generation_statement_notes' => new sfWidgetFormInputText(),
            'ip_statement' => new sfWidgetFormInputText(),
            'ip_statement_notes' => new sfWidgetFormInputText(),
            'general_notes' => new sfWidgetFormInputText(),
            'location' => new sfWidgetFormInputText(),
            'format_id' => new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
            'name_slug' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 255)),
            'inst_id' => new sfValidatorString(array('max_length' => 255)),
            'notes' => new sfValidatorPass(array('required' => false)),
            'creator_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'required' => false)),
            'last_editor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Editor'), 'required' => false)),
            'type' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'resident_structure_description' => new sfValidatorPass(array('required' => false)),
            'parent_node_id' => new sfValidatorInteger(array('required' => false)),
            'status' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'characteristics' => new sfValidatorPass(array('required' => false)),
            'project_title' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'iub_unit' => new sfValidatorInteger(array('required' => false)),
            'iub_work' => new sfValidatorInteger(array('required' => false)),
            'date_completed' => new sfValidatorPass(array('required' => false)),
            'score_subject_interest' => new sfValidatorNumber(array('required' => false)),
            'notes_subject_interest' => new sfValidatorPass(array('required' => false)),
            'score_content_quality' => new sfValidatorNumber(array('required' => false)),
            'notes_content_quality' => new sfValidatorPass(array('required' => false)),
            'score_rareness' => new sfValidatorNumber(array('required' => false)),
            'notes_rareness' => new sfValidatorPass(array('required' => false)),
            'score_documentation' => new sfValidatorNumber(array('required' => false)),
            'notes_documentation' => new sfValidatorPass(array('required' => false)),
            'score_technical_quality' => new sfValidatorInteger(array('required' => false)),
            'notes_technical_quality' => new sfValidatorPass(array('required' => false)),
            'unknown_technical_quality' => new sfValidatorBoolean(array('required' => false)),
            'collection_score' => new sfValidatorInteger(array('required' => false)),
            'generation_statement' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'generation_statement_notes' => new sfValidatorPass(array('required' => false)),
            'ip_statement' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'ip_statement_notes' => new sfValidatorPass(array('required' => false)),
            'general_notes' => new sfValidatorPass(array('required' => false)),
            'location' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'format_id' => new sfValidatorInteger(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
            'name_slug' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Store', 'column' => array('name_slug')))
        );

        $this->widgetSchema->setNameFormat('store[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Store';
    }

}
