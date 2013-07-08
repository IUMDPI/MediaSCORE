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
        $ListReports = array(
            0 => 'Output All Asset Groups Report',
            1 => 'Output All Asset Storage Locations',
            2 => 'Output All Unit Personnel',
            3 => 'Output All Users Report',
        );
        $actionName = $this->getOption('from');
        if ($actionName == 'collectionstatusreport') {

            $this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', method => 'getName', 'multiple' => true), array('required' => true)));
            $this->setWidget('listCollection_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Collection', method => 'getName', 'multiple' => true), array('required' => true)));
            $this->setWidget('collectionStatus', new sfWidgetFormSelect(array('choices' => array(0 => 'Incomplete', 1 => 'In Progress', 2 => 'Completed'), 'default' => '', 'multiple' => true), array('required' => true)));
            $this->setWidget('EvaluatorsStartDate', new sfWidgetFormInputText(array(), array('required' => true)));
            $this->setWidget('EvaluatorsEndDate', new sfWidgetFormInputText(array(), array('required' => true)));

            $this->getWidget('listUnits_RRD')->setLabel('Units : &nbsp;');
            $this->getWidget('listCollection_RRD')->setLabel('Collection: &nbsp;');
            $this->getWidget('collectionStatus')->setLabel('Collection Status: &nbsp;');
            $this->getWidget('EvaluatorsStartDate')->setLabel('Start Date : &nbsp;');
            $this->getWidget('EvaluatorsEndDate')->setLabel('End Date : &nbsp;');
        } elseif ($actionName == 'assetsgroupsscoringreports') {

            $this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', method => 'getName', 'multiple' => true)));
			$this->setValidator('listUnits_RRD', new sfValidatorString(array('required' => true)));
            $this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => FormatType::$formatTypesValue1d, 'multiple' => true)));
			$this->setValidator('format_id', new sfValidatorString(array('required' => true)));
            $this->getWidget('listUnits_RRD')->setLabel('Units : &nbsp;');
            $this->getWidget('format_id')->setLabel('Format Type : &nbsp;');
        } elseif ($actionName == 'evaluatorsreport') {

            $this->setWidget('ListEvaluators', new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', method => 'getName')));
            $this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => FormatType::$formatTypesValue1d, 'multiple' => true)));
            $this->setWidget('EvaluatorsStartDate', new sfWidgetFormInputText(array(), array('required' => true)));
            $this->setWidget('EvaluatorsEndDate', new sfWidgetFormInputText(array(), array('required' => true)));


            $this->getWidget('format_id')->setLabel('Format Type : &nbsp;');
            $this->getWidget('ListEvaluators')->setLabel('List of Evaluators : &nbsp;');
            $this->getWidget('EvaluatorsStartDate')->setLabel('Start Date : &nbsp;');
            $this->getWidget('EvaluatorsEndDate')->setLabel('End Date : &nbsp;');
        } elseif ($actionName == 'alldataoutputreport') {

            $this->setWidget('listReports', new sfWidgetFormSelect(array("choices" => $ListReports)));
            $this->getWidget('listReports')->setLabel('Type of Report to Export : &nbsp;');
        } elseif ($actionName == 'problemmediareport') {

            $this->setWidget('listCollection_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Collection', 'method' => 'getName', 'multiple' => true), array('required' => true)));
            $this->setWidget('Constraints', new sfWidgetFormSelect(array("choices" => ReportsForm::$constraintsArray, 'multiple' => true)));

            $this->getWidget('listCollection_RRD')->setLabel('Collection: &nbsp;');
            $this->getWidget('Constraints')->setLabel('Problem Type : &nbsp;');
        } elseif ($actionName == 'recordingdatereport') {
            $this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'method' => 'getName', 'multiple' => true)));
            $this->getWidget('listUnits_RRD')->setLabel('Units : &nbsp;');
        } elseif ($actionName == 'percentageofholdings') {

            $this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'method' => 'getName', 'multiple' => true)));
            $this->setWidget('listCollection_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Collection', 'method' => 'getName', 'multiple' => true)));
            $this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => FormatType::$formatTypesValue1d, 'multiple' => true))); #array('required' => true
            $this->setWidget('ReportType', new sfWidgetFormChoice(array('choices' => array('0' => 'Unit Format Makeup Report', '1' => 'Collection Format Makeup Report', '2' => 'Unit Collection Makeup Report'))));

            $this->getWidget('ReportType')->setLabel('Report Type : &nbsp;');
            $this->getWidget('listUnits_RRD')->setLabel('Units : &nbsp;');
            $this->getWidget('listCollection_RRD')->setLabel('Collection: &nbsp;');
            $this->getWidget('format_id')->setLabel('Format Type : &nbsp;');
        } elseif ($actionName == 'durationandquantitysearch') {

            $this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', method => 'getName', 'multiple' => true)));
            $this->setWidget('listCollection_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Collection', method => 'getName', 'multiple' => true)));
            $this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => FormatType::$formatTypesValue1d, 'multiple' => true))); #array('required' => true)
            $this->setWidget('ReportType', new sfWidgetFormChoice(array('choices' => array('0' => 'Unit Format Makeup Report', '1' => 'Collection Format Makeup Report', '2' => 'Unit Collection Makeup Report'))));

            $this->getWidget('ReportType')->setLabel('Report Type : &nbsp;');
            $this->getWidget('listUnits_RRD')->setLabel('Units : &nbsp;');
            $this->getWidget('listCollection_RRD')->setLabel('Collection: &nbsp;');
            $this->getWidget('format_id')->setLabel('Format Type : &nbsp;');
        }

        $this->setWidget('ExportType', new sfWidgetFormChoice(array('choices' => array('csv' => '.CSV', 'xls' => '.XLSX'))));
        $this->getWidget('ExportType')->setLabel('Export Type : &nbsp;');
    }

}
