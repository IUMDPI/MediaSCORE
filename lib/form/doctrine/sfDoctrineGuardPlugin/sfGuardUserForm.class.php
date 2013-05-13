<?php

/**
 * sfGuardUser form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm {

    static public $role = array('' => 'Select', 0 => 'User', 1 => 'Admin');

    public function configure() {
        unset(
                $this['last_login'], $this['created_at'], $this['updated_at'], $this['salt'], $this['groups_list'], $this['permissions_list'], $this['salt'], $this['algorithm'], $this['is_super_admin'], $this['contact_info'], $this['unit_id']
        );



        $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password']->setOption('required', false);
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];

        $this->widgetSchema->moveField('password_again', 'after', 'password');
        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 1)));

        if ($this->getOption('action') == 'edit')
            $this->setWidget('is_active', new sfWidgetFormInputHidden(array(), array('value' => 1)));
        $this->setWidget('role', new sfWidgetFormChoice(array('choices' => self::$role)));

        $this->setValidator('email_address', new sfValidatorEmail());
        $this->setValidator('username', new sfValidatorPass());
        $this->getValidator('email_address')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Please enter a valid email address.'));
        $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));

        $this->setWidget('username', new sfWidgetFormInputHidden());

        $this->getWidget('first_name')->setLabel('<span class="required">*</span>First Name:');
        $this->getWidget('last_name')->setLabel('<span class="required">*</span>Last Name:');
        $this->getWidget('email_address')->setLabel('<span class="required">*</span>Email Address:');
        $this->getWidget('password')->setLabel('<span class="required">*</span>Password:');
        $this->getWidget('password_again')->setLabel('<span class="required">*</span>Password Again:');
        $this->getWidget('role')->setLabel('<span class="required">*</span>Role:');
        $this->getWidget('phone')->setLabel('Phone:');
        $this->setValidator('first_name', new sfValidatorString(array('required' => true)));
        $this->setValidator('last_name', new sfValidatorString(array('required' => true)));
        $this->setValidator('password', new sfValidatorString(array('required' => true)));
        $this->setValidator('password_again', new sfValidatorString(array('required' => true)));
        $this->setValidator('role', new sfValidatorString(array('required' => true)));
//        $this->setValidator('phone', new sfValidatorInteger(array('required' => false)));
        $this->setValidator('phone', new sfValidatorRegex(array('pattern' => "/^[\s-.()0-9]*$/i"),
                        array('invalid' => 'Phone # must be numeric only.'))
        );

        $this->getValidator('first_name')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Invalid First Name.'));
        $this->getValidator('last_name')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Invalid Last Name.'));
        $this->getValidator('password')->setMessages(array('required' => 'This is a required field.'));
        $this->getValidator('password_again')->setMessages(array('required' => 'This is a required field.'));
        $this->getValidator('role')->setMessages(array('required' => 'This is a required field.'));
//        $this->getValidator('phone')->setMessages(array('invalid' => 'Phone # must be numeric only.'));
    }

}
