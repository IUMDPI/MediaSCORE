<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardRegisterForm extends BasesfGuardRegisterForm
{
  /**
   * @see sfForm
   */
    static public $role = array(0 => 'User', 1 => 'Admin');
  public function configure()
  {
      unset(
                $this['last_login'], 
                $this['created_at'], 
                $this['updated_at'], 
                $this['salt'], 
                $this['groups_list'], 
                $this['permissions_list'], 
                $this['salt'], 
                $this['algorithm'], 
                $this['is_super_admin'], 
                $this['contact_info'], 
                $this['unit_id']
        );



        $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password']->setOption('required', false);
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];

        $this->widgetSchema->moveField('password_again', 'after', 'password');
        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 1)));
        $this->setWidget('is_active', new sfWidgetFormInputHidden(array(), array('value' => 0)));
        $this->setWidget('role', new sfWidgetFormChoice(array('choices' => self::$role)));

        $this->setValidator('email_address', new sfValidatorEmail());
        $this->getValidator('email_address')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Please enter a valid email address.'));
        $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));
  }
}