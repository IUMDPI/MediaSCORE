<?php

/**
 * VHS form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VHSForm extends BaseVHSForm {

    /**
     * @see FormatTypedVideoRecordingForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('size', new sfWidgetFormChoice(array('choices' => VHS::$constants[0])));
        $this->setValidator('size', new sfValidatorString(array('required' => false)));
        $this->getWidget('size')->setLabel('<span class="required">*</span>Size:&nbsp;');
        
        $this->setWidget('format', new sfWidgetFormChoice(array('choices' => VHS::$constants[1])));
        $this->setValidator('format', new sfValidatorString(array('required' => false)));
        $this->getWidget('format')->setLabel('<span class="required">*</span>Format:&nbsp;');
        
        $this->setWidget('recordingSpeed', new sfWidgetFormChoice(array('choices' => VHS::$constants[2])));
        $this->setValidator('recordingSpeed', new sfValidatorString(array('required' => false)));
        $this->getWidget('recordingSpeed')->setLabel('<span class="required">*</span>Recording Speed:&nbsp;');
        
        $this->setWidget('soft_binder_syndrome', new sfWidgetFormChoice(array('choices' => DV::$constants1)));
        $this->setValidator('soft_binder_syndrome', new sfValidatorString(array('required' => false)));
        $this->getWidget('soft_binder_syndrome')->setLabel('Soft Binder Syndrome including Sticky Shed:&nbsp;');

        $this->setWidget('pack_deformation', new sfWidgetFormChoice(array('choices' => Film::$constants[4], 'expanded' => true)));
        $this->setDefault('pack_deformation', 0);
        $this->setValidator('pack_deformation', new sfValidatorString(array('required' => false)));
        $this->getWidget('pack_deformation')->setLabel('<span class="required">*</span>Pack  Deformation:&nbsp;');

        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));
        
         foreach (array('noise_reduction',
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
    'softBinderSyndrome',
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
