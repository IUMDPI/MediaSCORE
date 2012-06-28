<?php

/**
 * SoundOpticalDisc form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SoundOpticalDiscForm extends BaseSoundOpticalDiscForm {

    /**
     * @see OpticalDiscFormatTypeForm
     */
    public static $type = array(''=>'Select',0 => 'Pressed CD',1 => 'CD-R');
    public function configure() {
        parent::configure();

        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));
        $this->setWidget('physicalDamage', new sfWidgetFormChoice(array('choices' => MetalDisc::$damage, 'expanded' => true),array('class'=>'override_required')));
        $this->setWidget('opticaldisctype', new sfWidgetFormChoice(array('choices' => self::$type),array('class'=>'override_required')));
        $this->setWidget('materialsBreakdown', new sfWidgetFormInputCheckbox(array(),array('title'=>'Note presence of hazing, oxidation, discoloration or delamination'))); 
        $this->setDefault('physicalDamage', -1);
 
        $this->setValidator('physicalDamage', new sfValidatorString(array('required' => false)));
        $this->setValidator('opticaldisctype', new sfValidatorString(array('required' => true)));
        $this->setValidator('materialsBreakdown', new sfValidatorBoolean());

        $this->getWidget('physicalDamage')->setLabel('<span class="required">*</span>Physical Damage:&nbsp;');
        $this->getWidget('materialsBreakdown')->setLabel('Breakdown of Materials:&nbsp;');
        $this->getWidget('opticaldisctype')->setLabel('<span class="required">*</span>Type:&nbsp;');

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
