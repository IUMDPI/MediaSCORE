<?php

/**
 * LacquerDisc form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LacquerDiscForm extends BaseLacquerDiscForm
{
  /**
   * @see SoftDiskFormatTypeForm
   */
  public function configure()
  {
	parent::configure();
	$this->setWidget('substrate',new sfWidgetFormChoice(array('choices' => LacquerDisc::$constants)));
	$this->setWidget('delamination',new sfWidgetFormInputCheckbox());
	$this->setWidget('plasticizerExudation',new sfWidgetFormInputCheckbox());

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}
