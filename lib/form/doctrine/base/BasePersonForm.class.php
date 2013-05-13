<?php

/**
 * Person form base class.
 *
 * @method Person getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePersonForm extends UserForm {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema ['units_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Unit'));
        $this->validatorSchema['units_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Unit', 'required' => false));

        $this->widgetSchema ['consultation_records_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'EvaluatorHistory'));
        $this->validatorSchema['consultation_records_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'EvaluatorHistory', 'required' => false));

        $this->widgetSchema->setNameFormat('person[%s]');
    }

    public function getModelName() {
        return 'Person';
    }

    public function updateDefaultsFromObject() {
        parent::updateDefaultsFromObject();

        if (isset($this->widgetSchema['units_list'])) {
            $this->setDefault('units_list', $this->object->Units->getPrimaryKeys());
        }

        if (isset($this->widgetSchema['consultation_records_list'])) {
            $this->setDefault('consultation_records_list', $this->object->consultationRecords->getPrimaryKeys());
        }
    }

    protected function doSave($con = null) {
        $this->saveUnitsList($con);
        $this->saveconsultationRecordsList($con);

        parent::doSave($con);
    }

    public function saveUnitsList($con = null) {
        if (!$this->isValid()) {
            throw $this->getErrorSchema();
        }

        if (!isset($this->widgetSchema['units_list'])) {
            // somebody has unset this widget
            return;
        }

        if (null === $con) {
            $con = $this->getConnection();
        }

        $existing = $this->object->Units->getPrimaryKeys();
        $values = $this->getValue('units_list');
        if (!is_array($values)) {
            $values = array();
        }

        $unlink = array_diff($existing, $values);
        if (count($unlink)) {
            $this->object->unlink('Units', array_values($unlink));
        }

        $link = array_diff($values, $existing);
        if (count($link)) {
            $this->object->link('Units', array_values($link));
        }
    }

    public function saveconsultationRecordsList($con = null) {
        if (!$this->isValid()) {
            throw $this->getErrorSchema();
        }

        if (!isset($this->widgetSchema['consultation_records_list'])) {
            // somebody has unset this widget
            return;
        }

        if (null === $con) {
            $con = $this->getConnection();
        }

        $existing = $this->object->consultationRecords->getPrimaryKeys();
        $values = $this->getValue('consultation_records_list');
        if (!is_array($values)) {
            $values = array();
        }

        $unlink = array_diff($existing, $values);
        if (count($unlink)) {
            $this->object->unlink('consultationRecords', array_values($unlink));
        }

        $link = array_diff($values, $existing);
        if (count($link)) {
            $this->object->link('consultationRecords', array_values($link));
        }
    }

}
