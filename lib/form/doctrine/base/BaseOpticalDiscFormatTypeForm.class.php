<?php

/**
 * OpticalDiscFormatType form base class.
 *
 * @method OpticalDiscFormatType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOpticalDiscFormatTypeForm extends SoftDiskFormatTypeForm {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('optical_disc_format_type[%s]');
    }

    public function getModelName() {
        return 'OpticalDiscFormatType';
    }

}
