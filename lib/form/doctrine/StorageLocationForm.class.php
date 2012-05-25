<?php

/**
 * StorageLocation form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StorageLocationForm extends BaseStorageLocationForm {

    public function configure() {
        /*
          //'env_rating' => new sfWidgetFormInputText(),
          //      //'created_at' => new sfWidgetFormDateTime(),
          //            //'updated_at' => new sfWidgetFormDateTime(),
          //
         */

        //unset($this->validatorSchema['id']);

        $this->setWidget('env_rating', new sfWidgetFormChoice(array('choices' => StorageLocation::$constants)));
        $this->getWidget('env_rating')->setLabel('Location Environmental Rating:&nbsp;');
        $this->getWidget('name')->setLabel('<span class="required">*</span>Name:&nbsp;');
        $this->getWidget('resident_structure_description')->setLabel('<span class="required">*</span>ID:&nbsp;');

        $this->setValidator('resident_structure_description', new sfValidatorString(array('required' => true)));
       
        
        $this->getValidator('name')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Invalid Unit Name'));
        $this->getValidator('resident_structure_description')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Invalid ID'));
        
        
        foreach (array('created_at', 'updated_at', 'units_list', 'collections_list') as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }
    }

}
