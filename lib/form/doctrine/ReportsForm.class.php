<?php

/**
 * Reports form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReportsForm extends BaseReportsForm {

    public function configure() {
        $Units = Unit::getUnitNameCustome('All Units');

//        $this->setWidget('listUnits', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', method => 'getName', 'add_empty' => true)));
        $this->setWidget('listUnits_RRD', new sfWidgetFormChoice(array('choices' => $Units)));
        $this->setWidget('ExportType', new sfWidgetFormChoice(array('choices' => array('csv' => 'CSV', 'xls' => 'XLS'))));


        $array = FormatType::$formatTypesValue1d;
        array_unshift($array, 'All Formats');

        

        $this->setWidget('listUnits', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'method' => 'getName')));
        $this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => $array, 'default' => 0)));
    }

}
