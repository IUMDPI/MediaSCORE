<?php

/**
 * OpenReelAudiotapeAcetate form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OpenReelAudiotapeAcetateForm extends BaseOpenReelAudiotapeAcetateForm {

    /**
     * @see OpenReelAudioTapeFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('vinegarOdor', new sfWidgetFormInputCheckbox());
        $this->setWidget('tapethickness', new sfWidgetFormChoice(array('choices' => OpenReelAudioTapeFormatType::$constants[3]),array('class'=>'override_required')));
        $this->setWidget('speed', new sfWidgetFormChoice(array('choices' => OpenReelAudioTapeFormatType::$constants[2]),array('class'=>'override_required')));
        $this->setWidget('noise_reduction', new sfWidgetFormInputCheckbox());
        $this->setWidget('trackConfiguration', new sfWidgetFormChoice(array('choices' => OpenReelAudioTapeFormatType::$constants[0]),array('class'=>'override_required')));
        $this->setWidget('softBinderSyndrome', new sfWidgetFormChoice(array('choices' => OpenReelAudioTapeFormatType::$constants[1]),array('class'=>'override_required')));




        $this->setValidator('vinegarOdor', new sfValidatorBoolean());
        $this->setValidator('speed', new sfValidatorString(array('required' => true)));
        $this->setValidator('tapethickness', new sfValidatorString(array('required' => false)));
        $this->setValidator('noise_reduction', new sfValidatorBoolean());
        $this->setValidator('trackConfiguration', new sfValidatorString(array('required' => true)));
        $this->setValidator('softBinderSyndrome', new sfValidatorString(array('required' => false)));

        $this->getWidget('vinegarOdor')->setLabel('Vinegar Odor:&nbsp;');
        $this->getWidget('speed')->setLabel('<span class="required">*</span>Speed:&nbsp;');
        $this->getWidget('tapethickness')->setLabel('Tape Thickness:&nbsp;');
        $this->getWidget('noise_reduction')->setLabel('Noise Reduction:&nbsp;');
        $this->getWidget('trackConfiguration')->setLabel('<span class="required">*</span>Track Configuration / Sound Field:&nbsp;');
        $this->getWidget('softBinderSyndrome')->setLabel('Soft Binder Syndrome including Sticky Shed:&nbsp;');

        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));

        foreach (array('tape_type',
            'duration_type_methodology',
            'format_notes',
    'thin_tape',
    'slow_speed',
    'sound_field',
    'soft_binder_syndrome',
    'thinTape',
    '1993OrEarlier',
    'dataGradeTape',
    'longPlay32K96K',
    'corrosionRustOxidation',
    'composition',
    'nonStandardBrand',
    'materialsBreakdown',
    'delamination',
    'plasticizerExudation',
    'recordingLayer',
    'recordingSpeed',
    'cylinderType',
    'reflectiveLayer',
    'dataLayer',
    'opticalDiscType',
    'format',
    'recordingStandard',
    'publicationYear',
    'capacityLayers',
    'codec',
    'dataRate',
    'sheddingSoftBinder',
    'formatVersion',
    'oxide',
    'binderSystem',
    'reelSize',
    'whiteResidue',
    'size',
    'formatTypedVideoRecordingFormat',
    'bitrate',
    'scanning',
    'created_at',
    'updated_at',
    'generation',
    'year_recorded',
    'copies',
    'stock_brand',
    'off_brand',
    'fungus',
    'other_contaminants',
    'duration',
    'duration_type',
    'material',
    'oxidationCorrosion',
    'physicalDamage',
    'quantity') as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }
    }

}
