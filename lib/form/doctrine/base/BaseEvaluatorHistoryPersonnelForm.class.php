<?php

/**
 * EvaluatorHistoryPersonnel form base class.
 *
 * @method EvaluatorHistoryPersonnel getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEvaluatorHistoryPersonnelForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'evaluator_history_id' => new sfWidgetFormInputHidden(),
      'person_id'            => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'evaluator_history_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('evaluator_history_id')), 'empty_value' => $this->getObject()->get('evaluator_history_id'), 'required' => false)),
      'person_id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('person_id')), 'empty_value' => $this->getObject()->get('person_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('evaluator_history_personnel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EvaluatorHistoryPersonnel';
  }

}
