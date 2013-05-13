<?php

/**
 * EvaluatorHistoryPersonnel filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEvaluatorHistoryPersonnelFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'evaluator_history_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EvaluatorHistory'), 'add_empty' => true)),
            'person_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Person'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'evaluator_history_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EvaluatorHistory'), 'column' => 'id')),
            'person_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Person'), 'column' => 'id')),
        ));

        $this->widgetSchema->setNameFormat('evaluator_history_personnel_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function getModelName() {
        return 'EvaluatorHistoryPersonnel';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'evaluator_history_id' => 'ForeignKey',
            'person_id' => 'ForeignKey',
        );
    }

}
