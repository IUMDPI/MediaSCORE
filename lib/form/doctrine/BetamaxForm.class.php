<?php

/**
 * Betamax form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BetamaxForm extends BaseBetamaxForm
{
  /**
   * @see VideoRecordingFormatTypeForm
   */
  public function configure()
  {
	parent::configure();
	$this->setWidget('formatVersion',new sfWidgetFormChoice(array('choices' => Betamax::$constants[0])));
	$this->setWidget('oxide',new sfWidgetFormChoice(array('choices' => Betamax::$constants[1])));

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}
