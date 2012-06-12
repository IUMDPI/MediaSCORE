<?php

/**
 * Collection form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionForm extends BaseCollectionForm {

    /**
     * @see SubUnitForm
     */
    public function configure() {
        parent::configure(); // SubUnitForm invocation

        $voidFields = array('created_at', 'resident_structure_description');
        if ($this->getOption('action') == 'edit') {
            $voidFields[] = 'creator_id';
            $this->setWidget('parent_node_id', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'add_empty' => false, 'label' => 'Unit:&nbsp;')));
            $this->setWidget('updated_at', new sfWidgetFormInputHidden(array(), array('value' => date('Y-m-d H:i:s'))));
        } else {
            $voidFields[] = 'updated_at';
            $this->setWidget('creator_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('userID'))));
            $this->setWidget('parent_node_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('unitID'))));
        }

        $this->setWidget('status', new sfWidgetFormChoice(array('choices' => Collection::$statusConstants, 'label' => 'Collection Status:&nbsp;')));


        foreach ($voidFields as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }

        $this->getWidget('name')->setLabel('<span class="required">*</span> Name:&nbsp;');
        $this->getWidget('inst_id')->setLabel('<span class="required">*</span> Primary ID:&nbsp;');

        $this->setWidget('last_editor_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('userID'))));
        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 3)));

        $this->getValidator('name')->setMessages(array('required' => 'This is a required field..',
            'invalid' => 'Invalid Unit Name'));
        $this->getValidator('inst_id')->setMessages(array('required' => 'This is a required field.',
            'inst_id' => 'Invalid ID'));
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {

        $taintedValues['name_slug'] = $taintedValues['name'];

        parent::bind($taintedValues, $taintedFiles);
    }

}
