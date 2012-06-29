<?php

/**
 * VideoRecordingFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VideoRecordingFormatTypeForm extends BaseVideoRecordingFormatTypeForm
{
  /**
   * @see FormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('recordingStandard',new sfWidgetFormChoice(array('choices' => VideoRecordingFormatType::$constants),array('class'=>'override_required')));
	  $this->setWidget('softBinderSyndrome',new sfWidgetFormChoice(array('choices' => OpenReelAudioTapeFormatType::$constants[1]),array('class'=>'override_required')));
          
          $this->setValidator('recordingStandard', new sfValidatorString(array('required' => true)));
         $this->setValidator('softBinderSyndrome', new sfValidatorBoolean());
         
         $this->getWidget('recordingStandard')->setLabel('<span class="required">*</span>Recording Standard:&nbsp;');
         $this->getWidget('softBinderSyndrome')->setLabel('Soft Binder Syndrome including Sticky Shed:&nbsp;');

  }
}
