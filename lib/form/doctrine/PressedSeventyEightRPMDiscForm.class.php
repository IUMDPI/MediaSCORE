<?php

/**
 * PressedSeventyEightRPMDisc form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PressedSeventyEightRPMDiscForm extends BasePressedSeventyEightRPMDiscForm {

    /**
     * @see PressedAudioDiscFormatTypeForm
     */
    public function configure() {
        parent::configure();

        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));

        $this->setWidget('physicalDamage', new sfWidgetFormChoice(array('choices' => MetalDisc::$damage, 'expanded' => true),array('title'=>'Note the presence of cracks, chips, and other externally caused damage. This does not include cracks from actual delamination.','class'=>'override_required')));
        $this->setWidget('materialsBreakdown', new sfWidgetFormInputCheckbox(array(),array('title'=>'Note presence of exudation of any type')));
        $this->setDefault('physicalDamage', -1);


        $this->setValidator('physicalDamage', new sfValidatorString(array('required' => true)));
        $this->setValidator('materialsBreakdown', new sfValidatorBoolean());


        $this->getWidget('physicalDamage')->setLabel('<span class="required">*</span>Physical Damage:&nbsp;');
        $this->getWidget('materialsBreakdown')->setLabel('Breakdown of Materials:&nbsp;');

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
    'quantity') as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }
    }

}
