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
        $this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => FormatType::$formatTypesValue, 'default' => 1)));
        $this->setWidget('constraint_id', new sfWidgetFormDoctrineChoice(array('model' => 'CharacteristicsConstraints', method => 'getConstraintName', 'add_empty' => true)));
        $this->setWidget('parent_characteristic_id', new sfWidgetFormDoctrineChoice(array('model' => 'CharacteristicsFormat', method => 'getFormatCName', 'add_empty' => true)));

        $unsetValidations = array('created_at', 'updated_at');
        foreach ($unsetValidations as $unsetValidation)
            unset($this->validatorSchema[$unsetValidation]);
    }

}
