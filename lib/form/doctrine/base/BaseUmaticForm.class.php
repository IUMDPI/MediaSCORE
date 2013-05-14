<?php

/**
 * Umatic form base class.
 *
 * @method Umatic getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUmaticForm extends FormatVersionedVideoRecordingTypeForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('umatic[%s]');
  }

  public function getModelName()
  {
    return 'Umatic';
  }

}
