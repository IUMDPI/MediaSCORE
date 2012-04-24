<?php

/**
 * SoundWireReel form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SoundWireReelForm extends BaseSoundWireReelForm
{
  /**
   * @see ReelCassetteFormatTypeForm
   */
  public function configure()
  {
	parent::configure();
	$this->setWidget('corrosionRustOxidation',new sfWidgetFormInputCheckbox());
	$this->setWidget('composition',new sfWidgetFormChoice(array('choices' => SoundWireReel::$constants)));
	$this->setWidget('nonStandardBrand',new sfWidgetFormInputCheckbox());
  }
}
