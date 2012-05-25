<?php

/**
 * sfGuardFormSignin for sfGuardAuth signin action
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
//class sfGuardFormSignin extends BasesfGuardFormSignin
class mediaSCOREFormSignin extends sfGuardFormSignin {

    /**
     * @see sfForm
     */
    // 05/12/12 - James
    public function configure() {

        # For the Work Session values
        foreach (array('allow_extra_fields' => true,
    'filter_extra_fields' => false) as $option => $optionValue)
            $this->getValidatorSchema()->setOption($option, $optionValue);

        $this->getWidget('username')->setLabel('Email');


        $this->setWidget('unit', new sfWidgetFormDoctrineChoice(array('model' => 'Unit','add_empty'=>'Select'), array('class' => 'select_field')));
        $this->setWidget('personnel_list', new sfWidgetFormDoctrineChoice(array('model' => 'Person', 'method' => 'getFullName', 'multiple' => true), array('class' => 'select_field')));
        $this->setWidget('storage_locations_list', new sfWidgetFormDoctrineChoice(array('model' => 'StorageLocation', 'multiple' => true), array('class' => 'select_field')));
        $this->getWidget('personnel_list')->setLabel('Unit Personnel');
        $this->getWidget('storage_locations_list')->setLabel('Storage Location');
        foreach (array('remember') as $voidField) {

            unset($this->widgetSchema['remember']);
            unset($this->validatorSchema['remember']);
        }
    }

    /*
      public function setup()
      {
      $this->setWidgets(array(
      'username' => new sfWidgetFormInputText(),
      'password' => new sfWidgetFormInputPassword(array('type' => 'password')),
      'remember' => new sfWidgetFormInputCheckbox(),
      ));

      $this->setValidators(array(
      'username' => new sfValidatorString(),
      'password' => new sfValidatorString(),
      'remember' => new sfValidatorBoolean(),
      ));

      if (sfConfig::get('app_sf_guard_plugin_allow_login_with_email', true))
      {
      $this->widgetSchema['username']->setLabel('Username or E-Mail');
      }

      $this->validatorSchema->setPostValidator(new sfGuardValidatorUser());

      $this->widgetSchema->setNameFormat('signin[%s]');
      }

     */
}
