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
	  $this->setWidget('pack_deformation',new sfWidgetFormChoice(array('choices' => ReelCassetteFormatType::$constants,'expanded'=>true)));
           $this->setValidator('pack_deformation', new sfValidatorString(array('required' => false)));
           $this->getWidget('pack_deformation')->setLabel('<span class="required">*</span>Pack Deformation:&nbsp;');
//          $this->setValidator('packDeformation', new sfValidatorChoice(array('choices' => ReelCassetteFormatType::$constants)));
          $this->setDefault('pack_deformation',0);
  }
}
