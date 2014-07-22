<?php

/**
 * Collection form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionForm extends BaseCollectionForm
{

	/**
	 * @see SubUnitForm
	 */
	public function configure()
	{
		parent::configure(); // SubUnitForm invocation

		if ($this->getOption('view') == 'score')
		{
			$voidFields = array('created_at', 'resident_structure_description', 'name_slug', 'characteristics',
				'project_title',
				'iub_unit',
				'iub_work',
				'date_completed',
				'score_subject_interest',
				'notes_subject_interest',
				'score_content_quality',
				'notes_content_quality',
				'score_rareness',
				'notes_rareness',
				'score_documentation',
				'notes_documentation',
				'score_technical_quality',
				'notes_technical_quality',
				'unknown_technical_quality',
				'score_technical_quality',
				'notes_technical_quality',
				'collection_score',
				'generation_statement',
				'generation_statement_notes',
				'ip_statement',
				'ip_statement_notes',
				'general_notes',);

			$forRiverFormOnly = array(
				'characteristics',
				'project_title',
				'iub_unit',
				'iub_work',
				'date_completed',
				'score_subject_interest',
				'notes_subject_interest',
				'score_content_quality',
				'notes_content_quality',
				'score_rareness',
				'notes_rareness',
				'score_documentation',
				'notes_documentation',
				'score_technical_quality',
				'notes_technical_quality',
				'unknown_technical_quality',
				'score_technical_quality',
				'notes_technical_quality',
				'collection_score',
				'generation_statement',
				'generation_statement_notes',
				'ip_statement',
				'ip_statement_notes',
				'general_notes',
			);
			if ($this->getOption('action') == 'edit')
			{
				$voidFields[] = 'creator_id';
				$this->setWidget('parent_node_id', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'multiple' => false, 'add_empty' => false, 'label' => 'Unit:&nbsp;')));
				$this->setWidget('updated_at', new sfWidgetFormInputHidden(array(), array('value' => date('Y-m-d H:i:s'))));
			}
			else
			{
				$voidFields[] = 'updated_at';
				$this->setWidget('creator_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('userID'))));
				$this->setWidget('parent_node_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('unitID'))));
			}

			$this->setWidget('status', new sfWidgetFormChoice(array('choices' => Collection::$statusConstants, 'label' => '<span class="required">*</span>Collection Status:&nbsp;')));


			foreach ($voidFields as $voidField)
			{
				unset($this->widgetSchema[$voidField]);
				unset($this->validatorSchema[$voidField]);
			}


			$this->getWidget('name')->setLabel('<span class="required">*</span> Name:&nbsp;');
			$this->getWidget('inst_id')->setLabel('<span class="required">*</span> Primary ID:&nbsp;');

			$this->setWidget('last_editor_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('userID'))));
			$this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 3)));
			$this->setValidator('status', new sfValidatorString(array('required' => true)));
			$this->setValidator('parent_node_id', new sfValidatorString(array('required' => true)));
			$this->getValidator('name')->setMessages(array('required' => 'This is a required field..', 'invalid' => 'Invalid Unit Name'));
			$this->getValidator('inst_id')->setMessages(array('required' => 'This is a required field.', 'invalid' => 'Invalid ID'));
			$this->getValidator('parent_node_id')->setMessages(array('required' => 'This is a required field.', 'invalid' => 'Invalid Unit'));
			foreach ($forRiverFormOnly as $forRiverFormSingle)
			{
				unset($this->widgetSchema[$forRiverFormSingle]);
			}
		}
		else
		{
			$voidFields = array('created_at', 'resident_structure_description', 'name_slug', 'updated_at',
				'type', 'resident_structure_description', 'format_id'
				, 'location'
			);
			$this->setWidget('status', new sfWidgetFormChoice(array('choices' => Collection::$statusConstants, 'label' => '<span class="required">*</span>Collection Status:&nbsp;')));

			$unit = Doctrine_Query::Create()
			->from('Unit u')
			->select('u.name');

			if (sfContext::getInstance()->getUser()->getGuardUser()->getType() == 3)
			{
				$unit->innerJoin('u.Personnel p')->where('person_id = ?', sfContext::getInstance()->getUser()->getGuardUser()->getId());
			}
			$unit = $unit->fetchArray();
			if ($this->getOption('action') == 'edit')
			{
				$voidFields[] = 'creator_id';
				$Units = array();
				foreach ($unit as $key => $u)
				{
					$Units[$u['id']] = $u['name'];
				}

				$this->setWidget('updated_at', new sfWidgetFormInputHidden(array(), array('value' => date('Y-m-d H:i:s'))));
				$this->setWidget('parent_node_id', new sfWidgetFormChoice(array('choices' => $Units, 'label' => 'Unit:&nbsp;'))); //
			}
			else
			{
				$voidFields[] = 'updated_at';
				$this->setWidget('creator_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('userID'))));
				$this->setWidget('parent_node_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('unitID'))));
			}
			foreach ($voidFields as $voidField)
			{
				unset($this->widgetSchema[$voidField]);
				unset($this->validatorSchema[$voidField]);
			}
			$skipValidation = array(
				'parent_node_id',
				'characteristics',
				'storage_locations_list',
				'project_title',
				'iub_unit',
				'iub_work',
				'date_completed',
				'score_subject_interest',
				'notes_subject_interest',
				'score_content_quality',
				'notes_content_quality',
				'score_rareness',
				'notes_rareness',
				'score_documentation',
				'notes_documentation',
				'score_technical_quality',
				'notes_technical_quality',
				'unknown_technical_quality',
				'score_technical_quality',
				'notes_technical_quality',
				'collection_score',
				'generation_statement',
				'generation_statement_notes',
				'ip_statement',
				'ip_statement_notes',
				'general_notes',
				'status'
			);
			foreach ($skipValidation as $skipValidationSingle)
			{
				unset($this->validatorSchema[$skipValidationSingle]);
			}





			$this->setWidget('last_editor_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('userID'))));
			$this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 3)));

			$this->setWidget('title', new sfWidgetFormInputText(array(), array('style' => 'width:27px;height: 12px;')));
			$this->setWidget('characteristics', new sfWidgetFormTextarea(array(), array('rows' => '1', 'style' => 'width:96.5%;')));
			$this->setWidget('project_title', new sfWidgetFormInputText(array(), array('style' => 'width: 250px;height: 12px;')));

			$this->setWidget('iub_unit', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'add_empty' => false, 'label' => 'IUB Unit:&nbsp;', 'multiple' => FALSE)));
			$userParams = sfContext::getInstance()->getUser()->getGuardUser();

			$this->setWidget('iub_work', new sfWidgetFormInputHidden(array(), array('style' => 'width: 250px;height: 12px;', 'value' => $this->getObject()->getCreator()->getId())));

			$this->setWidget('date_completed', new sfWidgetFormInputText(array('label' => 'Date Completed:&nbsp;'), array('readonly' => 'readonly', 'style' => 'background-color: #F0F0F0;width: 250px;height: 12px;')));

			$this->setWidget('score_subject_interest', new sfWidgetFormInputText(array(), array('style' => 'width:27px;height: 12px;','class'=>'calculate_score')));
			$this->setWidget('notes_subject_interest', new sfWidgetFormTextarea(array(), array('rows' => '1', 'style' => 'width:728px;')));

			$this->setWidget('score_content_quality', new sfWidgetFormInputText(array(), array('style' => 'width:27px;height: 12px;','class'=>'calculate_score')));
			$this->setWidget('notes_content_quality', new sfWidgetFormTextarea(array(), array('rows' => '1', 'style' => 'width:727px;height: 50px;')));

			$this->setWidget('score_rareness', new sfWidgetFormInputText(array(), array('style' => 'width:27px;height: 12px;','class'=>'calculate_score')));
			$this->setWidget('notes_rareness', new sfWidgetFormTextarea(array(), array('rows' => '1', 'style' => 'width:727px;')));

			$this->setWidget('score_documentation', new sfWidgetFormInputText(array(), array('style' => 'width:27px;height: 12px;','class'=>'calculate_score')));
			$this->setWidget('notes_documentation', new sfWidgetFormTextarea(array(), array('rows' => '1', 'style' => 'width:727px;')));


			$this->setWidget('unknown_technical_quality', new sfWidgetFormInputCheckbox(array(), array('onclick' => 'changeTechnicalQuality();')));
			$this->setWidget('score_technical_quality', new sfWidgetFormInputText(array(), array('style' => 'width:27px;height: 12px;','class'=>'calculate_score')));
			$this->setWidget('notes_technical_quality', new sfWidgetFormTextarea(array(), array('rows' => '1', 'style' => 'width: 644px;')));

			$this->setWidget('collection_score', new sfWidgetFormInputText(array(), array('readonly' => 'readonly', 'style' => 'width:27px;height: 12px;')));

			$this->setWidget('generation_statement', new sfWidgetFormInputText(array(), array('style' => 'width:190px;')));
			$this->setWidget('generation_statement_notes', new sfWidgetFormTextarea(array(), array('rows' => '1', 'style' => 'width: 539px;')));

			$this->setWidget('ip_statement', new sfWidgetFormInputText(array(), array('style' => 'width:190px;')));
			$this->setWidget('ip_statement_notes', new sfWidgetFormTextarea(array(), array('rows' => '1', 'style' => 'width: 539px;')));

			$this->setWidget('general_notes', new sfWidgetFormTextarea(array(), array('rows' => '1', 'style' => 'width:96.5%;')));



			$this->getWidget('inst_id')->setLabel('<span class="required">*</span> Primary ID:&nbsp;');
			$this->getWidget('name')->setLabel('<span class="required">*</span> Title:&nbsp;');
			$this->getWidget('parent_node_id')->setLabel('<span class="required"></span> Unit:&nbsp;');
			$this->getWidget('characteristics')->setLabel('<span class="required"></span> Characteristics:&nbsp;');
			$this->getWidget('project_title')->setLabel('<span class="required"></span> Project Title:&nbsp;');
			$this->getWidget('iub_unit')->setLabel('<span class="required"></span> IUB Unit:&nbsp;');
			$this->getWidget('iub_work')->setLabel('<span class="required"></span> IUB Worker:&nbsp;');
			$this->getWidget('date_completed')->setLabel('<span class="required"></span> Date Completed:&nbsp;');
			$this->getWidget('score_subject_interest')->setLabel('<span class="required"></span> Score :&nbsp;');
			$this->getWidget('notes_subject_interest')->setLabel('<span class="required"></span> Notes :&nbsp;');
			$this->getWidget('score_content_quality')->setLabel('<span class="required"></span> Score:&nbsp;');
			$this->getWidget('notes_content_quality')->setLabel('<span class="required"></span> Notes:&nbsp;');
			$this->getWidget('score_rareness')->setLabel('<span class="required"></span> Score:&nbsp;');
			$this->getWidget('notes_rareness')->setLabel('<span class="required"></span> Notes:&nbsp;');
			$this->getWidget('score_documentation')->setLabel('<span class="required"></span> Score:&nbsp;');
			$this->getWidget('notes_documentation')->setLabel('<span class="required"></span> Notes:&nbsp;');
			$this->getWidget('score_technical_quality')->setLabel('<span class="required"></span> Score:&nbsp;');
			$this->getWidget('notes_technical_quality')->setLabel('<span class="required"></span> Notes:&nbsp;');
			$this->getWidget('unknown_technical_quality')->setLabel('<span class="required"></span> Unknown:&nbsp;');
			$this->getWidget('score_technical_quality')->setLabel('<span class="required"></span> Score:&nbsp;');
			$this->getWidget('notes_technical_quality')->setLabel('<span class="required"></span> Notes:&nbsp;');
			$this->getWidget('collection_score')->setLabel('<span class="required"></span> Collection Score:&nbsp;');
			$this->getWidget('generation_statement')->setLabel('<span class="required"></span> Generation Statement:&nbsp;');
			$this->getWidget('generation_statement_notes')->setLabel('<span class="required"></span> Notes:&nbsp;');
			$this->getWidget('ip_statement')->setLabel('<span class="required"></span> IP Statement:&nbsp;');
			$this->getWidget('ip_statement_notes')->setLabel('<span class="required"></span> Notes:&nbsp;');
			$this->getWidget('general_notes')->setLabel('<span class="required"></span> General Notes:&nbsp;');

			$this->setValidator('score_subject_interest', new sfValidatorNumber(array('min' => 0, 'max' => 5, 'required' => FALSE)));
			$this->setValidator('score_content_quality', new sfValidatorNumber(array('min' => 0, 'max' => 5, 'required' => FALSE)));
			$this->setValidator('score_rareness', new sfValidatorNumber(array('min' => 0, 'max' => 5, 'required' => FALSE)));
			$this->setValidator('score_documentation', new sfValidatorNumber(array('min' => 0, 'max' => 5, 'required' => FALSE)));
			$this->setValidator('score_technical_quality', new sfValidatorNumber(array('min' => 0, 'max' => 5, 'required' => FALSE)));
			$this->getValidator('name')->setMessages(array('required' => 'Name is a required field.', 'invalid' => 'Invalid Collection Name'));
			$this->getValidator('inst_id')->setMessages(array('required' => 'Primary ID is a required field..', 'invalid' => 'Invalid Collection Name'));
			$this->getValidator('score_subject_interest')->setMessages(array('required' => 'Score must be integer and less then 5..', 'invalid' => 'Invalid Score,score must be integer', 'max' => 'Invalid Score,score must be less then 5', 'min' => 'Invalid Score,score must be greater then 0'));
			$this->getValidator('score_content_quality')->setMessages(array('required' => 'Score must be integer and less then 5..', 'invalid' => 'Invalid Score,score must be integer', 'max' => 'Invalid Score,score must be less then 5', 'min' => 'Invalid Score,score must be greater then 0'));
			$this->getValidator('score_rareness')->setMessages(array('required' => 'Score must be integer and less then 5..', 'invalid' => 'Invalid Score , score must be integer', 'max' => 'Invalid Score,score must be less then 5', 'min' => 'Invalid Score,score must be greater then 0'));
			$this->getValidator('score_documentation')->setMessages(array('required' => 'Score must be integer and less then 5..', 'invalid' => 'Invalid Score,score must be integer', 'max' => 'Invalid Score,score must be less then 5', 'min' => 'Invalid Score,score must be greater then 0'));
			$this->getValidator('score_technical_quality')->setMessages(array('required' => 'Score must be integer and less then 5.', 'invalid' => 'Invalid Score,score must be integer', 'max' => 'Invalid Score,score must be less then 5', 'min' => 'Invalid Score,score must be greater then 0'));
		}
	}

	public function bind(array $taintedValues = null, array $taintedFiles = null)
	{

		$calculate_total = TRUE;

		if (isset($taintedValues['collection_score']))
		{
			if ($taintedValues['score_subject_interest'] == '' || $taintedValues['score_content_quality'] == '' || $taintedValues['score_rareness'] == '' || $taintedValues['score_documentation'] == '')
				$calculate_total = FALSE;
			if ( ! isset($taintedValues['unknown_technical_quality']) && $taintedValues['unknown_technical_quality'] != 'on')
			{
				if ($taintedValues['score_technical_quality'] == '')
					$calculate_total = FALSE;
			}
			if ( ! $calculate_total)
			{
				$taintedValues['collection_score'] = NULL;
			}
		}
		parent::bind($taintedValues, $taintedFiles);
	}

}
