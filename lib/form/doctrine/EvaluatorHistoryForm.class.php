<?php

/**
 * EvaluatorHistory form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EvaluatorHistoryForm extends BaseEvaluatorHistoryForm
{
  public function configure()
  {

//      'type'           => new sfWidgetFormInputText(),
//      'evaluator_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Evaluator'), 'add_empty' => true)),
//      'asset_group_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Store'), 'add_empty' => true)),
//      'created_at'     => new sfWidgetFormDateTime(),

	foreach( array('created_at') as $voidField ) {
		unset($this->widgetSchema[$voidField]);
		unset($this->validatorSchema[$voidField]);
	}


	$this->setWidget('type', new sfWidgetFormChoice(array('choices' => EvaluatorHistory::$actions)));
	$this->setWidget('evaluator_id',new sfWidgetFormInputHidden());
	$this->setWidget('asset_group_id',new sfWidgetFormInputHidden());
	//Debug
	//$this->setWidget('asset_group_id',new sfWidgetFormInputText());
	$this->setWidget('updated_at', new sfWidgetFormDateTime(array(),array('value' => array(
											'year' => date('Y'),
											'month' => date('m'),
											'day' => date('d'),
											'hour' => date('H'),
											'minute' => date('i'),
											'second' => date('s')))));
	$this->getWidget('consulted_personnel_list')->setOption('method','getFullName');


	/*$this->setWidget('person_list', new sfWidgetFormDoctrineChoice(array(
									'multiple' => true,
									'model' => 'Person',
									'method' => 'getFirstName',
								)));*/
	
      //'type'           => new sfWidgetFormInputText(),
      //'evaluator_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Evaluator'), 'add_empty' => true)),
      //'asset_group_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Store'), 'add_empty' => true)),
      //'created_at'     => new sfWidgetFormDateTime(),
//      'updated_at'     => new sfWidgetFormDateTime(),
//      'person_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Person')),
	//    ));
  }
}
