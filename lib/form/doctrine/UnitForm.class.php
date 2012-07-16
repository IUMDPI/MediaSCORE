<?php

/**
 * Unit form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UnitForm extends BaseUnitForm {

    public function configure() {
        $this->setWidget('notes', new sfWidgetFormTextarea());
        $this->getWidget('notes')->setLabel('Contact&nbsp;Notes:&nbsp;');
//        $this->setWidget('creator_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('userID'))));


        $this->setWidget('notes', new sfWidgetFormTextarea());
        $this->getWidget('notes')->setLabel('Contact&nbsp;Notes:&nbsp;');

        $voidFields = array('storage_location_id', 'parent_node_id', 'status', 'location', 'format_id', 'created_at', 'updated_at','name_slug', 'unit_personnel');
        if ($this->getOption('action') == 'edit')
            $voidFields[] = 'creator_id';
        else
            $this->setWidget('creator_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('userID'))));

        $this->setWidget('last_editor_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('userID'))));

        $this->setWidget('resident_structure_description', new sfWidgetFormInputText());
        $this->setWidget('personnel_list', new sfWidgetFormDoctrineChoice(array('model' => 'Person', 'add_empty' => false, 'method' => 'getFullName', 'multiple' => true)));

        // Custom validators not developed yet
        //unset($this->validatorSchema['storage_location']);
        //unset($this->validatorSchema['personnel_list']);

        $this->getWidget('name')->setLabel('<span class="required">*</span>Name:&nbsp;');
        $this->getWidget('inst_id')->setLabel('Unit Abbreviation:&nbsp;');
        $this->getWidget('resident_structure_description')->setLabel('Building Name/Room Number:&nbsp;');
        $this->getWidget('storage_locations_list')->setLabel('Storage Location:&nbsp;');
        $this->getWidget('personnel_list')->setLabel('Unit Personnel List:&nbsp;');

        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 1)));
        $this->setValidator('inst_id',new sfValidatorString(array('required'=>false)));
        $this->getValidator('name')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Invalid Unit Name'));
        $this->getValidator('inst_id')->setMessages(array('required' => 'This is a required field.',
            'inst_id' => 'Invalid ID'));
        foreach( $voidFields as $voidField) {
		unset($this->widgetSchema[$voidField]);
		unset($this->validatorSchema[$voidField]);
	}
        
    }
 public function bind(array $taintedValues = null, array $taintedFiles = null) {
         
//            $taintedValues['name_slug'] = $taintedValues['name'];
        
        parent::bind($taintedValues, $taintedFiles);
    }
    
}

