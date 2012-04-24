<?php

/**
 * DV form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DVForm extends BaseDVForm
{
  /**
   * @see SizedVideoRecordingFormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('recordingSpeed',new sfWidgetFormChoice(array('choices' => DV::$constants)));
  }
}
