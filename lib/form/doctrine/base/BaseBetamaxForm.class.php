<?php

/**
 * Betamax form base class.
 *
 * @method Betamax getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBetamaxForm extends VideoRecordingFormatTypeForm {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('betamax[%s]');
    }

    public function getModelName() {
        return 'Betamax';
    }

}
