<?php

/**
 * PressedFortyFiveRPMDisc form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PressedFortyFiveRPMDiscForm extends BasePressedFortyFiveRPMDiscForm
{
  /**
   * @see PressedAudioDiscFormatTypeForm
   */
  public function configure()
  {
	parent::configure();
	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}
