<?php

/**
 * EvaluatorHistory form base class.
 *
 * @method EvaluatorHistory getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEvaluatorHistoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'type'                     => new sfWidgetFormInputText(),
      'evaluator_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Evaluator'), 'add_empty' => true)),
      'asset_group_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Store'), 'add_empty' => true)),
      'updated_at'               => new sfWidgetFormDate(),
      'consulted_personnel_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Person')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'type'                     => new sfValidatorInteger(array('required' => false)),
      'evaluator_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Evaluator'), 'required' => false)),
      'asset_group_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Store'), 'required' => false)),
      'updated_at'               => new sfValidatorDate(array('required' => false)),
      'consulted_personnel_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Person', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('evaluator_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EvaluatorHistory';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['consulted_personnel_list']))
    {
      $this->setDefault('consulted_personnel_list', $this->object->consultedPersonnel->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveconsultedPersonnelList($con);

    parent::doSave($con);
  }

  public function saveconsultedPersonnelList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['consulted_personnel_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->consultedPersonnel->getPrimaryKeys();
    $values = $this->getValue('consulted_personnel_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('consultedPersonnel', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('consultedPersonnel', array_values($link));
    }
  }

}
