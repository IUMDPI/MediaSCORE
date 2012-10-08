<?php

/**
 * SizedVideoRecordingFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SizedVideoRecordingFormatTypeForm extends BaseSizedVideoRecordingFormatTypeForm {

    /**
     * @see VideoRecordingFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('size', new sfWidgetFormChoice(array('choices' => SizedVideoRecordingFormatType::$constants), array('class' => 'override_required')));
        $this->setValidator('size', new sfValidatorString(array('required' => true)));
        $this->getWidget('size')->setLabel('<span class="required">*</span>Size:&nbsp;');
    }

}
