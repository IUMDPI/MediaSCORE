<?php

/**
 * Person form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PersonForm extends BasePersonForm {

    /**
     * @see UserForm
     */
    public function configure() {
        parent::configure();
        unset(
                $this['last_login'], $this['created_at'], $this['updated_at'], $this['salt'], $this['groups_list'], $this['permissions_list'], $this['salt'], $this['algorithm'], $this['is_super_admin'], $this['contact_info'], $this['unit_id'], $this['password'], $this['password_again'], $this['units_list'], $this['activation_key'], $this['forgot_password'], $this['consultation_records_list']
        );
        $this->setWidget('role', new sfWidgetFormInputText(array(), array('title' => 'Enter the role of the person within the Unit.')));
        $this->getWidget('first_name')->setLabel('<span class="required">*</span>Unit Personnel First Name:');
        $this->getWidget('last_name')->setLabel('<span class="required">*</span>Unit Personnel Last Name:');
        $this->getWidget('email_address')->setLabel('<span class="required">*</span>Unit Personnel Email:');

        $this->setValidator('first_name', new sfValidatorString(array('required' => true)));
        $this->setValidator('last_name', new sfValidatorString(array('required' => true)));
        $this->setValidator('role', new sfValidatorString(array('required' => false)));
        $this->setValidator('phone', new sfValidatorRegex(array('pattern' => "/^[\s-.()0-9]*$/i"),
                        array('invalid' => 'Phone # must be numeric only.'))
        );
        $this->setValidator('username', new sfValidatorPass());


        $this->getValidator('first_name')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Invalid First Name.'));
        $this->getValidator('last_name')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Invalid Last Name.'));
        $this->getValidator('email_address')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Must be a valid email address'));
        $this->getValidator('phone')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Phone # must be numeric only.'));

        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 3)));
        $this->setWidget('is_active', new sfWidgetFormInputHidden(array(), array('value' => 0)));
        $this->setWidget('username', new sfWidgetFormInputHidden());
    }

}
