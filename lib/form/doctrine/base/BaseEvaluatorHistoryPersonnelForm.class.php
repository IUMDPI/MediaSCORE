<?php

/**
 * EvaluatorHistoryPersonnel form base class.
 *
 * @method EvaluatorHistoryPersonnel getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEvaluatorHistoryPersonnelForm extends BaseFormDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'evaluator_history_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EvaluatorHistory'), 'add_empty' => true)),
            'person_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Person'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'evaluator_history_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EvaluatorHistory'), 'required' => false)),
            'person_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Person'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('evaluator_history_personnel[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'EvaluatorHistoryPersonnel';
    }

}
