<?php

/**
 * CharacteristicsValues form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CharacteristicsValuesForm extends BaseCharacteristicsValuesForm {

    public function configure() {
		
        $this->setWidget('c_name', new sfWidgetFormInput(array()));
        $this->setWidget('c_score', new sfWidgetFormInput(array()));
        
        $this->setWidget('format_id', new sfWidgetFormChoice(array("choices" => FormatType::$formatTypesValue1d, 'label' => 'Format')));
        $this->setWidget('constraint_id', new sfWidgetFormDoctrineChoice(array('model' => 'CharacteristicsConstraints', method => 'getConstraintReadable', 'add_empty' => 'Select')));
        $this->setWidget('parent_characteristic_id', new sfWidgetFormDoctrineChoice(array('model' => 'CharacteristicsFormat', method => 'getFormatCName', 'add_empty' => true)));

		if(!$this->isNew())
			$this->getWidget('c_name')->setAttribute('readonly', 'readonly');
		$this->getWidget('c_name')->setLabel('Characteristic Name:&nbsp;');
		$this->getWidget('c_score')->setLabel('Characteristic Score:&nbsp;');
		
		$this->setValidator('c_score', new sfValidatorNumber(array('required' => true)));
        $unsetValidations = array('created_at', 'updated_at');
        foreach ($unsetValidations as $unsetValidation)
            unset($this->validatorSchema[$unsetValidation]);
    }

}
