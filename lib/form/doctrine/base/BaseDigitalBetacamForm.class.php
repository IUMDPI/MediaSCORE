<?php

/**
 * DigitalBetacam form base class.
 *
 * @method DigitalBetacam getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDigitalBetacamForm extends FormatTypedVideoRecordingForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('digital_betacam[%s]');
  }

  public function getModelName()
  {
    return 'DigitalBetacam';
  }

}
