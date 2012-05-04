<?php

/**
 * OpenReelAudioTapeFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OpenReelAudioTapeFormatTypeForm extends BaseOpenReelAudioTapeFormatTypeForm
{
  /**
   * @see AudiotapeFormatTypeForm
   */
  public function configure()
  {
	  parent::configure();

	  $this->setWidget('trackConfiguration',new sfWidgetFormChoice(array('choices' => OpenReelAudioTapeFormatType::$constants[0])));
//	  $this->setWidget('tapeThickness',new sfWidgetFormChoice(array('choices' => OpenReelAudioTapeFormatType::$constants[1])));
//	  $this->setWidget('speed',new sfWidgetFormChoice(array('choices' => OpenReelAudioTapeFormatType::$constants[2])));
	  $this->setWidget('softBinderSyndrome',new sfWidgetFormChoice(array('choices' => OpenReelAudioTapeFormatType::$constants[1])));

  }
}
