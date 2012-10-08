<?php

/**
 * DiskFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DiskFormatTypeForm extends BaseDiskFormatTypeForm {

    /**
     * @see FormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('materialsBreakdown', new sfWidgetFormInputCheckbox(array(), array('title' => 'Note presence of hazing, oxidation, discoloration or delamination')));
        $this->setValidator('materialsBreakdown', new sfValidatorBoolean());
        $this->getWidget('materialsBreakdown')->setLabel('Breakdown of Materials:&nbsp;');
    }

}
