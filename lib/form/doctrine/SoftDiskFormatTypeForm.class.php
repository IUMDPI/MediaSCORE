<?php

/**
 * SoftDiskFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SoftDiskFormatTypeForm extends BaseSoftDiskFormatTypeForm {

    /**
     * @see DiskFormatTypeForm
     */
    public function configure() {
        parent::configure();

        $this->setWidget('physicalDamage', new sfWidgetFormChoice(array('choices' => SoftDiskFormatType::$constants)));
    }

}
