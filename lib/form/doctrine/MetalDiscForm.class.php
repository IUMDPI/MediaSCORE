<?php

/**
 * MetalDisc form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MetalDiscForm extends BaseMetalDiscForm
{
  /**
   * @see FormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  /*$this->setWidgets(array(
			'material' => new sfWidgetFormChoice(array('choices' => MetalDisc::$constants)),
			'oxidationCorrosion' => new sfWidgetFormInputCheckbox()
		));*/
	  $this->setWidget('material',new sfWidgetFormChoice(array('choices' => MetalDisc::$constants)));
	  $this->setWidget('oxidationCorrosion',new sfWidgetFormInputCheckbox());

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
  }
}
