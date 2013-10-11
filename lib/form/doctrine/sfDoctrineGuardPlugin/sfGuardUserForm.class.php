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

    static public $role = array('' => 'Select', 0 => 'User', 1 => 'Admin', 2 => 'Unit Personnel');

    public function configure() {
        unset(
                $this['last_login'], $this['created_at'], $this['updated_at'], $this['salt'], $this['groups_list'], $this['permissions_list'], $this['salt'], $this['algorithm'], $this['is_super_admin'], $this['contact_info'], $this['unit_id']
        );

        if ($this->getOption('userType') == 3) {
            $this->setWidget('mediascore_access', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getMediascoreAccess())));
            $this->setWidget('mediariver_access', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getMediariverAccess())));
        }
        $this->setWidget('mediascore_access', new sfWidgetFormInputCheckbox(array(), array('value' => $this->getObject()->getMediascoreAccess())));
        $this->setWidget('mediariver_access', new sfWidgetFormInputCheckbox(array(), array('value' => $this->getObject()->getMediariverAccess())));
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password']->setOption('required', false);
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];


        $this->widgetSchema->moveField('password_again', 'after', 'password');
        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 1)));
        $this->setWidget('units_list', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', 'add_empty' => false, 'method' => 'getName', 'multiple' => true)));
        if ($this->getOption('action') == 'edit')
            $this->setWidget('is_active', new sfWidgetFormInputHidden(array(), array('value' => 1)));
        $this->setWidget('role', new sfWidgetFormChoice(array('choices' => self::$role), array('onchange' => 'checkRole();')));

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
        $this->getWidget('mediascore_access')->setLabel('MediaSCORE Access:');
        $this->getWidget('mediariver_access')->setLabel('MediaRIVERS Access:');
        $this->setValidator('first_name', new sfValidatorString(array('required' => true)));
        $this->setValidator('last_name', new sfValidatorString(array('required' => true)));
        if ($this->isNew()) {
            $this->setValidator('password', new sfValidatorString(array('required' => true)));
            $this->setValidator('password_again', new sfValidatorString(array('required' => true)));
        }
        $this->setValidator('role', new sfValidatorString(array('required' => true)));

        $this->setValidator('phone', new sfValidatorRegex(array('pattern' => "/^[\s-.()0-9]*$/i"), array('invalid' => 'Phone # must be numeric only.'))
        );

        $this->getValidator('first_name')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Invalid First Name.'));
        $this->getValidator('last_name')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Invalid Last Name.'));
        $this->getValidator('password')->setMessages(array('required' => 'This is a required field.'));
        $this->getValidator('password_again')->setMessages(array('required' => 'This is a required field.'));
        $this->getValidator('role')->setMessages(array('required' => 'This is a required field.'));
   
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {


        if ($taintedValues['role'] == 2) {
            $taintedValues['type'] = 3;
        }
        parent::bind($taintedValues, $taintedFiles);
    }

    public function updateDefaultsFromObject() {
        parent::updateDefaultsFromObject();

        if ($this->getOption('action') != 'new' && $this->getObject()->getType() == 3) {
            $this->setDefault('units_list', $this->getObject()->getUnits()->getPrimaryKeys());
        }
    }

    public function doSave($con = null) {

        if ($this->getObject()->getType() == 3) {
            $this->saveUnitsList($con);
            parent::doSave($con);
        } else if ($this->getValue('type') == 3) {
            parent::doSave($con);
            $this->addNewUnits($con);
        } else {
            parent::doSave($con);
        }
    }

    public function addNewUnits($con = null) {
        $values = $this->getValue('units_list');
        $person_id = $this->getObject()->getId();

        if (count($values) > 0) {
            foreach ($values as $unit) {
                $unit_person = new UnitPerson();
                $unit_person->setPersonId($person_id);
                $unit_person->setUnitId($unit);
                $unit_person->save();
            }
        }
    }

    public function saveUnitsList($con = null) {
        if (!$this->isValid()) {
            throw $this->getErrorSchema();
        }

        if (!isset($this->widgetSchema['units_list'])) {
            // somebody has unset this widget
            return;
        }

        if (null === $con) {
            $con = $this->getConnection();
        }

        $existing = $this->object->Units->getPrimaryKeys();


        $values = $this->getValue('units_list');
        if (!is_array($values)) {
            $values = array();
        }

        $unlink = array_diff($existing, $values);
        if (count($unlink)) {
            $this->object->unlink('Units', array_values($unlink));
        }

        $link = array_diff($values, $existing);
        if (count($link)) {

            $this->object->link('Units', array_values($link));
        }
    }

}
