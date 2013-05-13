<?php

/**
 * Set form base class.
 *
 * @method Set getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSetForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(),
            'inst_id' => new sfWidgetFormInputText(),
            'notes' => new sfWidgetFormInputText(),
            'creator_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Evaluator'), 'add_empty' => false)),
            'last_editor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
            'type' => new sfWidgetFormInputText(),
            'resident_structure_description' => new sfWidgetFormInputText(),
            'storage_location_id' => new sfWidgetFormInputText(),
            'unit_personnel' => new sfWidgetFormInputText(),
            'parent_node_id' => new sfWidgetFormInputText(),
            'status' => new sfWidgetFormInputText(),
            'location' => new sfWidgetFormInputText(),
            //'format_id'			=> new sfWidgetFormInputText(),
            'created_at' => new sfWidgetFormDateTime(),
            'updated_at' => new sfWidgetFormDateTime(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 255)),
            'inst_id' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'notes' => new sfValidatorPass(array('required' => false)),
            'creator_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Evaluator'))),
            'last_editor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
            'type' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'resident_structure_description' => new sfValidatorPass(array('required' => false)),
            'storage_location_id' => new sfValidatorInteger(array('required' => false)),
            'unit_personnel' => new sfValidatorInteger(array('required' => false)),
            'parent_node_id' => new sfValidatorInteger(array('required' => false)),
            'status' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'location' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            // This is only displayed for AssetGroup Models
            // 'format_id'                      => new sfValidatorInteger(array('required' => false)),
            'created_at' => new sfValidatorDateTime(),
            'updated_at' => new sfValidatorDateTime(),
        ));

        $this->widgetSchema->setNameFormat('set[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'Set';
    }

}
