<?php

/**
 * MiniDisc form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MiniDiscForm extends BaseMiniDiscForm
{
  /**
   * @see SoftDiskFormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('recordingLayer',new sfWidgetFormChoice(array('choices' => MiniDisc::$constants[0])));
	  $this->setWidget('recordingSpeed',new sfWidgetFormChoice(array('choices' => MiniDisc::$constants[1])));

  }
}
