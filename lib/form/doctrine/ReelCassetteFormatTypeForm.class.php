<?php

/**
 * ReelCassetteFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReelCassetteFormatTypeForm extends BaseReelCassetteFormatTypeForm
{
  /**
   * @see FormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('packDeformation',new sfWidgetFormChoice(array('choices' => ReelCassetteFormatType::$constants)));
  }
}
