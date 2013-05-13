<?php

/**
 * Project form base class.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine {

    public function render($attributes = array()) {

        foreach ($this as $field) {

            if ($this->getValidator($field->getName())->getOption('required')) {
                $field->getWidget()->setAttribute('class', 'required ' . $field->getWidget()->getAttribute('class'));
            }
        }

        return parent::render($attributes);
    }

    public function setup() {
        // 04/27/12
        // the Validator throws an exception for fields specified in child classes, preventing these values from reaching the Controller layer and updating the serialized Model.
        $this->getValidatorSchema()->setOptions(array(
            'allow_extra_fields' => true,
            'filter_extra_fields' => false
        ));
    }

}
