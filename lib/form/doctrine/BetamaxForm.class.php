<?php

/**
 * Betamax form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BetamaxForm extends BaseBetamaxForm {

    /**
     * @see VideoRecordingFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('formatVersion', new sfWidgetFormChoice(array('choices' => Betamax::$constants[0]), array('class' => 'override_required')));
        $this->setWidget('oxide', new sfWidgetFormChoice(array('choices' => array('' => 'Select', 0 => 'Chromium Dioxide', 1 => 'Ferric Oxide', 2 => 'Metal Oxide', 3 => 'Unknown')), array('class' => 'override_required')));
//        $this->setWidget('pack_deformation', new sfWidgetFormChoice(array('choices' => Film::$constants[4], 'expanded' => true), array('class'=>'override_required')));
        $this->setWidget('pack_deformation', new sfWidgetFormChoice(array('choices' => array(0=>'None',3 => 'Misc. damage'), 'expanded' => true), array('class' => 'override_required')));
        $this->setWidget('recordingStandard', new sfWidgetFormChoice(array('choices' => array('' => 'Select', 0 => 'NTSC', 1 => 'PAL', 2 => 'SECAM', 3 => 'Unknown')), array('class' => 'override_required')));

        $this->setValidator('formatVersion', new sfValidatorString(array('required' => true)));
        $this->setValidator('oxide', new sfValidatorString(array('required' => true)));
        $this->setValidator('pack_deformation', new sfValidatorString(array('required' => false)));

        $this->getWidget('formatVersion')->setLabel('<span class="required">*</span>Format Version:&nbsp;');
        $this->getWidget('oxide')->setLabel('<span class="required">*</span>Oxide:&nbsp;');
        $this->getWidget('pack_deformation')->setLabel('Pack  Deformation:&nbsp;');
        $this->setDefault('pack_deformation', -1);
        $this->widgetSchema->moveField('formatVersion', 'before', 'recordingStandard');
        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));

        foreach (array('noise_reduction',
    'duration_type_methodology',
    'format_notes',
    'tape_type',
    'slow_speed',
    'sound_field',
    'soft_binder_syndrome',
    'thinTape',
    'corrosionRustOxidation',
    'composition',
    'nonStandardBrand',
    'trackConfiguration',
    'tapeThickness',
    'speed',
    'sheddingSoftBinder',
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
    'publicationYear',
    'capacityLayers',
    'codec',
    'dataRate',
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
