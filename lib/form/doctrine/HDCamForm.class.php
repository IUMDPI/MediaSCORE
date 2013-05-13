<?php

/**
 * HDCam form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class HDCamForm extends BaseHDCamForm {

    /**
     * @see FormatVersionedVideoRecordingTypeForm
     */
    public function configure() {
        parent::configure();
//        $this->setWidget('formatVersion', new sfWidgetFormChoice(array('choices' => array('' => 'Select', 0 => 'Standard', 1 => 'SR')), array('title' => 'HDCAM tapes are black with an orange lid, and HDCAM SR tapes black with a cyan lid.', 'onchange' => 'checkFormat();', 'class' => 'override_required')));
        $this->setWidget('formatVersion', new sfWidgetFormChoice(array('choices' => array('' => 'Select', 0 => 'Standard', 1 => 'Format Version SR')), array('title' => 'HDCAM tapes are black with an orange lid, and HDCAM SR tapes black with a cyan lid.', 'onchange' => 'checkFormat();', 'class' => 'override_required')));
        $this->setValidator('formatVersion', new sfValidatorString(array('required' => true)));
        $this->getWidget('formatVersion')->setLabel('<span class="required">*</span>Format Version:&nbsp;');

        $this->setWidget('speed', new sfWidgetFormChoice(array('choices' => HDCam::$constants[1]), array('class' => 'override_required')));
        $this->setValidator('speed', new sfValidatorString(array('required' => true)));
        $this->getWidget('speed')->setLabel('<span class="required">*</span>Speed:&nbsp;');

        $this->setWidget('scanning', new sfWidgetFormChoice(array('choices' => HDCam::$constants[2]), array('class' => 'override_required')));
        $this->setValidator('scanning', new sfValidatorString(array('required' => true)));
        $this->getWidget('scanning')->setLabel('<span class="required">*</span>Scanning:&nbsp;');

        $this->setWidget('size', new sfWidgetFormChoice(array('choices' => Umatic::$constants[0]), array('class' => 'override_required')));
        $this->setValidator('size', new sfValidatorString(array('required' => true)));
        $this->getWidget('size')->setLabel('<span class="required">*</span>Size:&nbsp;');

        $this->setWidget('softBinderSyndrome', new sfWidgetFormInputCheckbox());
        $this->setValidator('softBinderSyndrome', new sfValidatorBoolean());
        $this->getWidget('softBinderSyndrome')->setLabel('Soft Binder Syndrome including Sticky Shed:&nbsp;');

//        $this->setWidget('pack_deformation', new sfWidgetFormChoice(array('choices' => Film::$constants[4], 'expanded' => true), array('class' => 'override_required')));
        $this->setWidget('pack_deformation', new sfWidgetFormChoice(array('choices' => array(1 => 'Misc. damage'), 'expanded' => true), array('class' => 'override_required')));
        $this->setDefault('pack_deformation', -1);
        $this->setValidator('pack_deformation', new sfValidatorString(array('required' => true)));
        $this->getWidget('pack_deformation')->setLabel('<span class="required">*</span>Pack  Deformation:&nbsp;');

        //constaints applyed
        $this->setWidget('recordingStandard', new sfWidgetFormChoice(array('choices' => FormatTypedVideoRecording::$constants[0]), array('class' => 'override_required')));
        $this->widgetSchema->moveField('formatVersion', 'before', 'recordingStandard');

        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));

        foreach (array('noise_reduction',
    'duration_type_methodology',
    'format_notes',
    'tape_type',
    'slow_speed',
    'sound_field',
    'thinTape',
    'corrosionRustOxidation',
    'composition',
    'nonStandardBrand',
    'trackConfiguration',
    'tapeThickness',
    'materialsBreakdown',
    'delamination',
    'plasticizerExudation',
    'recordingLayer',
    'cylinderType',
    'reflectiveLayer',
    'dataLayer',
    'opticalDiscType',
    'publicationYear',
    'capacityLayers',
    'codec',
    'dataRate',
    'sheddingSoftBinder',
    'oxide',
    'binderSystem',
    'reelSize',
    'whiteResidue',
    'formatTypedVideoRecordingFormat',
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
