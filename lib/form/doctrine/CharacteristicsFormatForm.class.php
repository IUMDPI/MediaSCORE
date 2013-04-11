<?php

/**
 * CharacteristicsFormat form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CharacteristicsFormatForm extends BaseCharacteristicsFormatForm {

    public function configure() {
        $this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => FormatType::$formatTypesValue, 'default' => 1)));

        $unsetvalidations = array('id', 'created_at', 'updated_at');

        foreach ($unsetvalidations as $unsetvalidation) {
            unset($this->validatorSchema[$unsetvalidation]);
        }
    }

}
