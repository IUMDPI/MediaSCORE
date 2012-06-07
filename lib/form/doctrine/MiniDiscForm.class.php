<?php

/**
 * MiniDisc form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MiniDiscForm extends BaseMiniDiscForm {

    /**
     * @see SoftDiskFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('recordingLayer', new sfWidgetFormChoice(array('choices' => MiniDisc::$constants[0])));
        $this->setWidget('recordingSpeed', new sfWidgetFormChoice(array('choices' => MiniDisc::$constants[1])));
        $this->setWidget('physicalDamage',new sfWidgetFormChoice(array('choices' => MetalDisc::$damage,'expanded' => true))); 
        $this->setWidget('materialsBreakdown', new sfWidgetFormInputCheckbox(array(),array('title'=>'Note presence of hazing, oxidation, discoloration or delamination')));
        $this->setDefault('physicalDamage', 0);
        

        $this->setValidator('recordingLayer', new sfValidatorString(array('required' => false)));
        $this->setValidator('recordingSpeed', new sfValidatorString(array('required' => false)));
         $this->setValidator('physicalDamage', new sfValidatorString(array('required' => false)));
         $this->setValidator('materialsBreakdown', new sfValidatorBoolean());
        

        $this->getWidget('recordingLayer')->setLabel('<span class="required">*</span>Recording Layer:&nbsp;');
        $this->getWidget('recordingSpeed')->setLabel('<span class="required">*</span>Recording speed:&nbsp;');
        $this->getWidget('physicalDamage')->setLabel('<span class="required">*</span>Physical Damage:&nbsp;');
        $this->getWidget('materialsBreakdown')->setLabel('Breakdown of Materials:&nbsp;');

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
    'delamination',
    'plasticizerExudation',
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
