<?php

/**
 * ReelCassetteFormatType form base class.
 *
 * @method ReelCassetteFormatType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReelCassetteFormatTypeForm extends FormatTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('reel_cassette_format_type[%s]');
  }

  public function getModelName()
  {
    return 'ReelCassetteFormatType';
  }

}
