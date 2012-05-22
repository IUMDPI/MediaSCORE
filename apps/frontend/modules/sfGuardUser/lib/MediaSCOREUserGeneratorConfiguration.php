<?php

abstract class MediaSCOREUserGeneratorConfiguration extends BaseSfGuardUserGeneratorConfiguration
{
  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL);
  }

  public function getListParams()
  {
    return '%%=first_name%% - %%last_name%% - %%email_address%%';
  }

  public function getEditTitle()
  {
    return 'Edit User';
  }

  public function getNewTitle()
  {
    return 'Create User';
  }

  public function getFormDisplay()
  {
    return array(  'User' =>   array(    0 => 'first_name',    1 => 'last_name',    2 => 'email_address',    3 => 'username',    4 => 'password',    5 => 'password_again'));
  }

  public function getListDisplay()
  {
    return array(  0 => '=first_name',  1 => 'last_name',  2 => 'email_address');
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'first_name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'last_name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'email_address' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'username' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'algorithm' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'salt' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'password' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'is_active' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'is_super_admin' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'last_login' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'groups_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'permissions_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'password_again' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Password (again)',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'first_name' => array(),
      'last_name' => array(),
      'email_address' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'last_login' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'groups_list' => array(),
      'permissions_list' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'first_name' => array(),
      'last_name' => array(),
      'email_address' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'last_login' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'groups_list' => array(),
      'permissions_list' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'first_name' => array(),
      'last_name' => array(),
      'email_address' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'last_login' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'groups_list' => array(),
      'permissions_list' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'first_name' => array(),
      'last_name' => array(),
      'email_address' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'last_login' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'groups_list' => array(),
      'permissions_list' => array(),
    );
  }

}

