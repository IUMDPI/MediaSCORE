<?php

/**
 * sfGuardUser filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserFormFilter extends BaseFormFilterDoctrine {

    public function setup() {
        $this->setWidgets(array(
            'first_name' => new sfWidgetFormFilterInput(),
            'last_name' => new sfWidgetFormFilterInput(),
            'email_address' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'username' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'algorithm' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'salt' => new sfWidgetFormFilterInput(),
            'password' => new sfWidgetFormFilterInput(),
            'is_active' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
            'activation_key' => new sfWidgetFormFilterInput(),
            'forgot_password' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'is_super_admin' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
            'last_login' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
            'type' => new sfWidgetFormFilterInput(),
            'phone' => new sfWidgetFormFilterInput(),
            'role' => new sfWidgetFormFilterInput(array('with_empty' => false)),
            'contact_info' => new sfWidgetFormFilterInput(),
            'unit_id' => new sfWidgetFormFilterInput(),
            'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
            'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
            'groups_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup')),
            'permissions_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
        ));

        $this->setValidators(array(
            'first_name' => new sfValidatorPass(array('required' => false)),
            'last_name' => new sfValidatorPass(array('required' => false)),
            'email_address' => new sfValidatorPass(array('required' => false)),
            'username' => new sfValidatorPass(array('required' => false)),
            'algorithm' => new sfValidatorPass(array('required' => false)),
            'salt' => new sfValidatorPass(array('required' => false)),
            'password' => new sfValidatorPass(array('required' => false)),
            'is_active' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'activation_key' => new sfValidatorPass(array('required' => false)),
            'forgot_password' => new sfValidatorPass(array('required' => false)),
            'is_super_admin' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'last_login' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
            'type' => new sfValidatorPass(array('required' => false)),
            'phone' => new sfValidatorPass(array('required' => false)),
            'role' => new sfValidatorPass(array('required' => false)),
            'contact_info' => new sfValidatorPass(array('required' => false)),
            'unit_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
            'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
            'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
            'groups_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup', 'required' => false)),
            'permissions_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('sf_guard_user_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();

        parent::setup();
    }

    public function addGroupsListColumnQuery(Doctrine_Query $query, $field, $values) {
        if (!is_array($values)) {
            $values = array($values);
        }

        if (!count($values)) {
            return;
        }

        $query
                ->leftJoin($query->getRootAlias() . '.sfGuardUserGroup sfGuardUserGroup')
                ->andWhereIn('sfGuardUserGroup.group_id', $values)
        ;
    }

    public function addPermissionsListColumnQuery(Doctrine_Query $query, $field, $values) {
        if (!is_array($values)) {
            $values = array($values);
        }

        if (!count($values)) {
            return;
        }

        $query
                ->leftJoin($query->getRootAlias() . '.sfGuardUserPermission sfGuardUserPermission')
                ->andWhereIn('sfGuardUserPermission.permission_id', $values)
        ;
    }

    public function getModelName() {
        return 'sfGuardUser';
    }

    public function getFields() {
        return array(
            'id' => 'Number',
            'first_name' => 'Text',
            'last_name' => 'Text',
            'email_address' => 'Text',
            'username' => 'Text',
            'algorithm' => 'Text',
            'salt' => 'Text',
            'password' => 'Text',
            'is_active' => 'Boolean',
            'activation_key' => 'Text',
            'forgot_password' => 'Text',
            'is_super_admin' => 'Boolean',
            'last_login' => 'Date',
            'type' => 'Text',
            'phone' => 'Text',
            'role' => 'Text',
            'contact_info' => 'Text',
            'unit_id' => 'Number',
            'created_at' => 'Date',
            'updated_at' => 'Date',
            'groups_list' => 'ManyKey',
            'permissions_list' => 'ManyKey',
        );
    }

}
