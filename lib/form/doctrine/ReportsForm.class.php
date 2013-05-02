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

    public static $constraintsArray = array(
        'soft_binder_syndrome' => 'SBS',
        'off_brand' => 'Off-Brand',
        'fungus' => 'Fungus',
        'shrinkage' => 'Shrinkage',
        'pack_deformation-1' => 'Pack Deformation: Minor',
        'pack_deformation-2' => 'Pack Deformation: Moderate',
        'pack_deformation-3' => 'Pack Deformation: Severe',
        'other_contaminants' => 'Other Contaminants',
        'materialsbreakdown' => 'Breakdown of materials',
        'oxidationcorrosion' => 'Oxidation/Corrosion',
        'delamination' => 'Delamination',
        'plasticizerexudation' => 'Plasticizer Exudation'
    );

    public function configure() {
//        $Units = Unit::getUnitNameCustome('All Units');
//        $Collections = Collection::getCollectionNameCustom('All Collections');
//        $arrayOfFormats = FormatType::$formatTypesValue1d;
//        array_unshift($arrayOfFormats, 'All Formats');

        $ListReports = array(
            0 => 'Output All Asset Groups Report',
            1 => 'Output All Asset Storage_ Locations',
            2 => 'Output All Unit Personnel',
            3 => 'Output All Users Report',
        );


        $this->setWidget('listUnits', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', method => 'getName', 'multiple' => true)));
        $this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', method => 'getName', 'multiple' => true)));

        $this->setWidget('listCollection_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Collection', method => 'getName', 'multiple' => true)));
        $this->setWidget('listCollections', new sfWidgetFormDoctrineChoice(array('model' => 'Collection', method => 'getName', 'multiple' => true)));

        $this->setWidget('ExportType', new sfWidgetFormChoice(array('choices' => array('csv' => 'CSV', 'xls' => 'XLS'))));

        $this->setWidget('collectionStatus', new sfWidgetFormSelect(array('choices' => array(0 => 'Incomplete', 1 => 'In Progress', 2 => 'Completed'), 'default' => '', 'multiple' => true)));

        $this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => FormatType::$formatTypesValue1d, 'multiple' => true)));

        $this->setWidget('Constraints', new sfWidgetFormSelect(array("choices" => ReportsForm::$constraintsArray, 'multiple' => true)));

        $this->setWidget('listReports', new sfWidgetFormSelect(array("choices" => $ListReports)));




        $this->getWidget('listUnits_RRD')->setLabel('Units : &nbsp;');
        $this->getWidget('listUnits')->setLabel('Units : &nbsp;');


        $this->getWidget('listCollections')->setLabel('Collectinos : &nbsp;');
        $this->getWidget('listCollection_RRD')->setLabel('Collection: &nbsp;');

        $this->getWidget('collectionStatus')->setLabel('Collection Status: &nbsp;');

        $this->getWidget('ExportType')->setLabel('Export Type : &nbsp;');

        $this->getWidget('format_id')->setLabel('Format Type : &nbsp;');

        $this->getWidget('Constraints')->setLabel('Problem Type : &nbsp;');

        $this->getWidget('listReports')->setLabel('Type of Report to Export : &nbsp;');
    }

}
