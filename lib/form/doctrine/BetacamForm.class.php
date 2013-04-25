<?php

/**
 * Betacam form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BetacamForm extends BaseBetacamForm {

    /**
     * @see FormatTypedVideoRecordingForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('size', new sfWidgetFormChoice(array('choices' => Betacam::$constants[0]), array('class' => 'override_required')));
        $this->setValidator('size', new sfValidatorString(array('required' => true)));
        $this->getWidget('size')->setLabel('<span class="required">*</span>Size:&nbsp;');

        $this->setWidget('format', new sfWidgetFormChoice(array('choices' => Betacam::$constants[1]), array('class' => 'override_required')));
        $this->setValidator('format', new sfValidatorString(array('required' => true)));
        $this->getWidget('format')->setLabel('<span class="required">*</span>Format Version:&nbsp;');

        $this->setWidget('softBinderSyndrome', new sfWidgetFormInputCheckbox());
        $this->setValidator('softBinderSyndrome', new sfValidatorBoolean());
        $this->getWidget('softBinderSyndrome')->setLabel('Soft Binder Syndrome including Sticky Shed:&nbsp;');

        $this->setWidget('pack_deformation', new sfWidgetFormChoice(array('choices' => array(1 => 'Misc. damage'), 'expanded' => true), array('class' => 'override_required')));
        $this->setDefault('pack_deformation', 0);
        $this->setValidator('pack_deformation', new sfValidatorString(array('required' => true)));
        $this->getWidget('pack_deformation')->setLabel('<span class="required">*</span>Pack  Deformation:&nbsp;');

        $this->setDefault('pack_deformation', -1);
        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));
        
        //constaints applyed
        $this->setWidget('recordingStandard', new sfWidgetFormChoice(array('choices' => FormatTypedVideoRecording::$constants[0]), array('class' => 'override_required')));
        $this->widgetSchema->moveField('format', 'before', 'recordingStandard');

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
    'speed',
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
    'formatVersion',
    'oxide',
    'binderSystem',
    'reelSize',
    'whiteResidue',
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
