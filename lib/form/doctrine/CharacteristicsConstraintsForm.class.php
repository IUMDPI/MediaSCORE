<?php

/**
 * CharacteristicsConstraints form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CharacteristicsConstraintsForm extends BaseCharacteristicsConstraintsForm {

    public function configure() {
        $unsetValidations = array('created_at', 'updated_at');
        foreach ($unsetValidations as $unsetValidation)
            unset($this->validatorSchema[$unsetValidation]);
    }

}
