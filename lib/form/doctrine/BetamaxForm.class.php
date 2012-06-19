<?php

/**
 * Betamax form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BetamaxForm extends BaseBetamaxForm {

    /**
     * @see VideoRecordingFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('formatVersion', new sfWidgetFormChoice(array('choices' => Betamax::$constants[0])));
        $this->setWidget('oxide', new sfWidgetFormChoice(array('choices' => Betamax::$constants[1])));
        $this->setWidget('pack_deformation',new sfWidgetFormChoice(array('choices' => Film::$constants[4],'expanded'=>true)));
	
        $this->setDefault('pack_deformation',0);


        $this->setValidator('formatVersion', new sfValidatorString(array('required' => true)));
        $this->setValidator('oxide', new sfValidatorString(array('required' => true)));
        $this->setValidator('pack_deformation', new sfValidatorString(array('required' => false)));

        $this->getWidget('formatVersion')->setLabel('<span class="required">*</span>Format Version:&nbsp;');
        $this->getWidget('oxide')->setLabel('<span class="required">*</span>Oxide:&nbsp;');
        $this->getWidget('pack_deformation')->setLabel('<span class="required">*</span>Pack  Deformation:&nbsp;');
        
        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));

        foreach (array('noise_reduction',
            'duration_type_methodology',
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
    'softBinderSyndrome',
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
