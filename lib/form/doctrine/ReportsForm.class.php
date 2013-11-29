<?php

/**
 * Reports form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReportsForm extends BaseReportsForm
{

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

	public function configure()
	{
		$ListReports = array(
			0 => 'Output All Asset Groups Report',
			1 => 'Output All Asset Storage Locations',
//			2 => 'Output All Unit Personnel',
			3 => 'Output All Users Report',
		);
		$actionName = $this->getOption('from');
		if ($actionName == 'collectionstatusreport')
		{
			if ($this->getOption('user')->getType() == 3)
			{
				$this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array(
					'query' => Doctrine_Query::create()->from('Unit u')->innerJoin('u.Personnel p')->where('person_id = ?', $this->getOption('user')->getId()),
					'model' => 'Unit', 'multiple' => true)));
			}
			else
				$this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'method' => 'getName', 'multiple' => true)));

			$this->setValidator('listUnits_RRD', new sfValidatorString(array('required' => true)));
			$this->setWidget('listCollection_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Collection', 'method' => 'getName', 'multiple' => true)));
			$this->setValidator('listCollection_RRD', new sfValidatorString(array('required' => false)));
			$this->setWidget('collectionStatus', new sfWidgetFormSelect(array('choices' => array(0 => 'Incomplete', 1 => 'In Progress', 2 => 'Completed'), 'default' => '', 'multiple' => true)));
			$this->setValidator('collectionStatus', new sfValidatorString(array('required' => false)));
			$this->setWidget('EvaluatorsStartDate', new sfWidgetFormInputText(array()));
			$this->setValidator('EvaluatorsStartDate', new sfValidatorDate(array('required' => false)));
			$this->validatorSchema->setPostValidator(
			new sfValidatorCallback(array(
				'callback' => array($this, 'postValidate')
			))
			);
			$this->setWidget('EvaluatorsEndDate', new sfWidgetFormInputText(array()));
			$this->setValidator('EvaluatorsEndDate', new sfValidatorDate(array('required' => false)));

			$this->getWidget('listUnits_RRD')->setLabel('Units: &nbsp;');
			$this->getWidget('listCollection_RRD')->setLabel('Collection: &nbsp;');
			$this->getWidget('collectionStatus')->setLabel('Collection Status: &nbsp;');
			$this->getWidget('EvaluatorsStartDate')->setLabel('Start Date: &nbsp;');
			$this->getWidget('EvaluatorsEndDate')->setLabel('End Date: &nbsp;');
		}
		elseif ($actionName == 'assetsgroupsscoringreports')
		{
			if ($this->getOption('user')->getType() == 3)
			{
				$this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array(
					'query' => Doctrine_Query::create()->from('Unit u')->innerJoin('u.Personnel p')->where('person_id = ?', $this->getOption('user')->getId()),
					'model' => 'Unit', 'multiple' => true)));
			}
			else
				$this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', method => 'getName', 'multiple' => true)));
			$this->setValidator('listUnits_RRD', new sfValidatorString(array('required' => true)));
			$this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => FormatType::$formatTypesValue1d, 'multiple' => true)));
			$this->setValidator('format_id', new sfValidatorString(array('required' => true)));
			$this->getWidget('listUnits_RRD')->setLabel('Units: &nbsp;');
			$this->getWidget('format_id')->setLabel('Format Type: &nbsp;');
		}
		elseif ($actionName == 'evaluatorsreport')
		{

			$this->setWidget('ListEvaluators', new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'method' => 'getName', 'add_empty' => 'Select'), array('onchange' => 'getFormats();')));
			$this->setValidator('ListEvaluators', new sfValidatorString(array('required' => true)));
			$this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => FormatType::$formatTypesValue1d, 'multiple' => true)));
			$this->setValidator('format_id', new sfValidatorString(array('required' => true)));
			$this->setWidget('EvaluatorsStartDate', new sfWidgetFormInputText(array()));
			$this->setValidator('EvaluatorsStartDate', new sfValidatorDate(array('required' => false)));
			$this->validatorSchema->setPostValidator(
			new sfValidatorCallback(array(
				'callback' => array($this, 'postValidate')
			))
			);
			$this->setWidget('EvaluatorsEndDate', new sfWidgetFormInputText(array()));
			$this->setValidator('EvaluatorsEndDate', new sfValidatorDate(array('required' => false)));

			$this->getWidget('format_id')->setLabel('Format Type: &nbsp;');
			$this->getWidget('ListEvaluators')->setLabel('List of Evaluators: &nbsp;');
			$this->getWidget('EvaluatorsStartDate')->setLabel('Start Date: &nbsp;');
			$this->getWidget('EvaluatorsEndDate')->setLabel('End Date: &nbsp;');
		}
		elseif ($actionName == 'alldataoutputreport')
		{

			$this->setWidget('listReports', new sfWidgetFormSelect(array("choices" => $ListReports)));
			$this->getWidget('listReports')->setLabel('Type of Report to Export: &nbsp;');
		}
		elseif ($actionName == 'problemmediareport')
		{
			if ($this->getOption('user')->getType() == 3)
			{
				$this->setWidget('listCollection_RRD', new sfWidgetFormDoctrineChoice(array(
					'query' => Doctrine_Query::create()->from('Collection c')->innerJoin('c.Unit u')->innerJoin('u.Personnel p')->where('person_id = ?', $this->getOption('user')->getId()),
					'model' => 'Collection', 'multiple' => true)));
			}
			else
				$this->setWidget('listCollection_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Collection', 'method' => 'getName', 'multiple' => true)));
			$this->setValidator('listCollection_RRD', new sfValidatorString(array('required' => true)));
			$this->setWidget('Constraints', new sfWidgetFormSelect(array("choices" => ReportsForm::$constraintsArray, 'multiple' => true)));
			$this->setValidator('Constraints', new sfValidatorString(array('required' => true)));
			$this->getWidget('listCollection_RRD')->setLabel('Collection: &nbsp;');
			$this->getWidget('Constraints')->setLabel('Problem Type: &nbsp;');
		}
		elseif ($actionName == 'recordingdatereport')
		{
			if ($this->getOption('user')->getType() == 3)
			{
				$this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array(
					'query' => Doctrine_Query::create()->from('Unit u')->innerJoin('u.Personnel p')->where('person_id = ?', $this->getOption('user')->getId()),
					'model' => 'Unit', 'multiple' => true)));
			}
			else
				$this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'method' => 'getName', 'multiple' => true)));
			$this->setValidator('listUnits_RRD', new sfValidatorString(array('required' => true)));
			$this->getWidget('listUnits_RRD')->setLabel('Units: &nbsp;');
		}
		elseif ($actionName == 'percentageofholdings')
		{

			if ($this->getOption('user')->getType() == 3)
			{
				$this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array(
					'query' => Doctrine_Query::create()->from('Unit u')->innerJoin('u.Personnel p')->where('person_id = ?', $this->getOption('user')->getId()),
					'model' => 'Unit', 'multiple' => true)));
			}
			else
				$this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'method' => 'getName', 'multiple' => true)));
			$this->setWidget('listCollection_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Collection', 'method' => 'getName', 'multiple' => true)));
			$this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => FormatType::$formatTypesValue1d, 'multiple' => true))); #array('required' => true
			$this->setWidget('ReportType', new sfWidgetFormChoice(array('choices' => array('0' => 'Unit Format Makeup Report', '1' => 'Collection Format Makeup Report', '2' => 'Unit Collection Makeup Report'))));
			$this->setValidator('listUnits_RRD', new sfValidatorString(array('required' => true)));
			$this->setValidator('listCollection_RRD', new sfValidatorString(array('required' => true)));
			$this->setValidator('format_id', new sfValidatorString(array('required' => true)));
			$this->setValidator('ReportType', new sfValidatorString(array('required' => true)));
			$this->getWidget('ReportType')->setLabel('Report Type: &nbsp;');
			$this->getWidget('listUnits_RRD')->setLabel('Units: &nbsp;');
			$this->getWidget('listCollection_RRD')->setLabel('Collection: &nbsp;');
			$this->getWidget('format_id')->setLabel('Format Type: &nbsp;');
		}
		elseif ($actionName == 'durationandquantitysearch')
		{

			if ($this->getOption('user')->getType() == 3)
			{
				$this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array(
					'query' => Doctrine_Query::create()->from('Unit u')->innerJoin('u.Personnel p')->where('person_id = ?', $this->getOption('user')->getId()),
					'model' => 'Unit', 'multiple' => true)));
			}
			else
			{
				$this->setWidget('listUnits_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'method' => 'getName', 'multiple' => true)));
			}
			
			$this->setWidget('format_id', new sfWidgetFormSelect(array("choices" => FormatType::$formatTypesValue1d, 'multiple' => true))); #array('required' => true)
			$this->setWidget('listCollection_RRD', new sfWidgetFormDoctrineChoice(array('model' => 'Collection', 'method' => 'getName', 'multiple' => true)));

			$this->setValidator('listUnits_RRD', new sfValidatorString(array('required' => false)));
			$this->setValidator('listCollection_RRD', new sfValidatorString(array('required' => false)));
			$this->setValidator('format_id', new sfValidatorString(array('required' => false)));



			$this->getWidget('listUnits_RRD')->setLabel('Units: &nbsp;');
			$this->getWidget('listCollection_RRD')->setLabel('Collection: &nbsp;');
			$this->getWidget('format_id')->setLabel('Format Type: &nbsp;');
		}

		$this->setWidget('ExportType', new sfWidgetFormChoice(array('choices' => array('csv' => '.CSV', 'xls' => '.XLSX'))));
		$this->getWidget('ExportType')->setLabel('Export Type : &nbsp;');
	}

	public function postValidate($validator, $values)
	{
		$start_date = $values["EvaluatorsStartDate"];
		$end_date = $values["EvaluatorsEndDate"];

		if (strtotime($start_date) > strtotime($end_date))
		{
			$error = new sfValidatorError($validator, "Start date cannot be greater than end date.");
			throw new sfValidatorErrorSchema($validator, array('EvaluatorsStartDate' => $error));
		}
		return TRUE;

		// etc...
	}

}
