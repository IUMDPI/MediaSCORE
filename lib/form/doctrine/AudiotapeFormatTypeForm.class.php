<?php

/**
 * AudiotapeFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AudiotapeFormatTypeForm extends BaseAudiotapeFormatTypeForm
{
  /**
   * @see ReelCassetteFormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('noiseReduction',new sfWidgetFormInputCheckbox());
  }
}
