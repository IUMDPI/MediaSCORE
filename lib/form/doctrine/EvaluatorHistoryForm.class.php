<?php

/**
 * EvaluatorHistory form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EvaluatorHistoryForm extends BaseEvaluatorHistoryForm {

    public function configure() {

//      'type'           => new sfWidgetFormInputText(),
//      'evaluator_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Evaluator'), 'add_empty' => true)),
//      'asset_group_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Store'), 'add_empty' => true)),
//      'created_at'     => new sfWidgetFormDateTime(),

        foreach (array('created_at', 'type') as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }




        $this->setWidget('evaluator_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('creatorID'))));
        $this->setWidget('asset_group_id', new sfWidgetFormInputHidden());


        $this->setWidget('updated_at', new sfWidgetFormInputText());

        $this->getWidget('consulted_personnel_list')->setOption('method', 'getFullName');
    }

    public function updateDefaultsFromObject() {
        parent::updateDefaultsFromObject();
        if ($this->getOption('action') == 'new') {
            $this->setDefault('consulted_personnel_list', sfContext::getInstance()->getUser()->getAttribute('personnel_list'));
        }
    }

}
