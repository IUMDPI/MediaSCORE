<?php

/**
 * Film form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FilmForm extends BaseFilmForm
{
  /**
   * @see ReelCassetteFormatTypeForm
   */
  public function configure()
  {
	parent::configure();
	$this->setWidget('gauge',new sfWidgetFormChoice(array('choices' => Film::$constants[0])));
	$this->setWidget('color',new sfWidgetFormChoice(array('choices' => Film::$constants[1])));
	$this->setWidget('colorFade',new sfWidgetFormInputCheckbox());
	$this->setWidget('soundtrackFormat',new sfWidgetFormChoice(array('choices' => Film::$constants[2])));
	$this->setWidget('substrate',new sfWidgetFormChoice(array('choices' => Film::$constants[3])));
	$this->setWidget('strongOdor',new sfWidgetFormInputCheckbox());
	$this->setWidget('vinegarOdor',new sfWidgetFormInputCheckbox());
	$this->setWidget('ADStripLevel',new sfWidgetFormInputText());
	$this->setWidget('shrinkage',new sfWidgetFormInputCheckbox());
	$this->setWidget('levelOfShrinkage',new sfWidgetFormInputText());
	$this->setWidget('rust',new sfWidgetFormInputCheckbox());
	$this->setWidget('discoloration',new sfWidgetFormInputCheckbox());
	$this->setWidget('surfaceBlisteringBubbling',new sfWidgetFormInputCheckbox());

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));

  }
}
