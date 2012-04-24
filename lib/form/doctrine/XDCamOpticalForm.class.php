<?php

/**
 * XDCamOptical form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class XDCamOpticalForm extends BaseXDCamOpticalForm
{
  /**
   * @see StandardizedRecordingFormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('format',new sfWidgetFormChoice(array('choices' => XDCamOptical::$constants[0])));
	  $this->setWidget('capacityLayers',new sfWidgetFormChoice(array('choices' => XDCamOptical::$constants[1])));
	  $this->setWidget('codec',new sfWidgetFormChoice(array('choices' => XDCamOptical::$constants[2])));
	  $this->setWidget('dataRate',new sfWidgetFormChoice(array('choices' => XDCamOptical::$constants[3])));

  }
}
