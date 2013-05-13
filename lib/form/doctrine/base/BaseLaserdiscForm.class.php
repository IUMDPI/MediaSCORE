<?php

/**
 * Laserdisc form base class.
 *
 * @method Laserdisc getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLaserdiscForm extends StandardizedRecordingFormatTypeForm {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('laserdisc[%s]');
    }

    public function getModelName() {
        return 'Laserdisc';
    }

}
