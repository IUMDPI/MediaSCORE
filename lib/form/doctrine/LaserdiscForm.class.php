<?php

/**
 * Laserdisc form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LaserdiscForm extends BaseLaserdiscForm
{
  /**
   * @see StandardizedRecordingFormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('recordingSpeed',new sfWidgetFormChoice(array('choices' => Laserdisc::$constants)));
          $this->setValidator('recordingSpeed', new sfValidatorString(array('required' => false)));
          $this->getWidget('recordingSpeed')->setLabel('<span class="required">*</span>Recording Speed:&nbsp;');
          
	  $this->setWidget('publicationYear',new sfWidgetFormDate());

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}
