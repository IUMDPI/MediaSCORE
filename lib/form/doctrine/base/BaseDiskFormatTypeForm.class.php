<?php

/**
 * DiskFormatType form base class.
 *
 * @method DiskFormatType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDiskFormatTypeForm extends FormatTypeForm {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('disk_format_type[%s]');
    }

    public function getModelName() {
        return 'DiskFormatType';
    }

}
