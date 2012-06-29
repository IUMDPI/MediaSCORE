<?php

/**
 * OpticalVideo form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OpticalVideoForm extends BaseOpticalVideoForm {

    /**
     * @see OpticalDiscFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('opticalDiscType', new sfWidgetFormChoice(array('choices' => OpticalVideo::$constants[0]),array('class'=>'override_required')));
        $this->setWidget('format', new sfWidgetFormChoice(array('choices' => OpticalVideo::$constants[1]),array('class'=>'override_required')));
        $this->setWidget('physicalDamage', new sfWidgetFormChoice(array('choices' => MetalDisc::$damage, 'expanded' => true),array('class'=>'override_required')));
        $this->setWidget('materialsBreakdown', new sfWidgetFormInputCheckbox(array(),array('title'=>'Note presence of hazing, oxidation, discoloration or delamination')));
        $this->setDefault('physicalDamage', -1);

        $this->setValidator('opticalDiscType', new sfValidatorString(array('required' => true)));
        $this->setValidator('format', new sfValidatorString(array('required' => true)));
        $this->setValidator('physicalDamage', new sfValidatorString(array('required' => true)));
        $this->setValidator('materialsBreakdown', new sfValidatorBoolean());


        $this->getWidget('opticalDiscType')->setLabel('<span class="required">*</span>Type:&nbsp;');
        $this->getWidget('format')->setLabel('<span class="required">*</span>Format:&nbsp;');
        $this->getWidget('physicalDamage')->setLabel('<span class="required">*</span>Physical Damage:&nbsp;');
        $this->getWidget('materialsBreakdown')->setLabel('Breakdown of Materials:&nbsp;');

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
    'softBinderSyndrome',
    'delamination',
    'plasticizerExudation',
    'recordingLayer',
    'recordingSpeed',
    'cylinderType',
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
    'quantity') as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }
    }

}
