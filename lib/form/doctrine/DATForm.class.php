<?php

/**
 * DAT form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DATForm extends BaseDATForm
{
  /**
   * @see ReelCassetteFormatTypeForm
   */
  public function configure()
  {
	parent::configure();
	$this->setWidget('thin_tape',new sfWidgetFormInputCheckbox());
	$this->setWidget('1993OrEarlier',new sfWidgetFormInputCheckbox());
	$this->setWidget('dataGradeTape',new sfWidgetFormInputCheckbox());
	$this->setWidget('longPlay32K96K',new sfWidgetFormInputCheckbox());
  }
}
