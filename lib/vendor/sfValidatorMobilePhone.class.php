<?php


class sfValidatorMobilePhone extends sfValidatorBase {

    protected function doClean($value) {
        $value = preg_replace('/\s/', '', $value);

        if (
                (0 !== strpos($value, '07')) ||
                (13 < strlen($value)) ||
                (0 !== preg_match('/[^\d]/', $value))
        ) {
            throw new sfValidatorError($this, 'invalid', array('value' => $value));
        } else {
            return $value;
        }
    }

}
