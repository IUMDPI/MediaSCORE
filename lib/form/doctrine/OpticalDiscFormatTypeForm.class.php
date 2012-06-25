<?php

/**
 * OpticalDiscFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OpticalDiscFormatTypeForm extends BaseOpticalDiscFormatTypeForm
{
  /**
   * @see SoftDiskFormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('reflectiveLayer',new sfWidgetFormChoice(array('choices' => OpticalDiscFormatType::$constants[0]),array('class'=>'override_required')));
           $this->setValidator('reflectiveLayer', new sfValidatorString(array('required' => true)));
           $this->getWidget('reflectiveLayer')->setLabel('<span class="required">*</span>Reflective Layer:&nbsp;');
	  
          
          $this->setWidget('dataLayer',new sfWidgetFormChoice(array('choices' => OpticalDiscFormatType::$constants[1]),array('class'=>'override_required')));
           $this->setValidator('dataLayer', new sfValidatorString(array('required' => false)));
           $this->getWidget('dataLayer')->setLabel('Data Layer:&nbsp;');

  }
}
