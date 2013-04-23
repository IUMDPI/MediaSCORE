<?php

/**
 * SoundWireReel form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SoundWireReelForm extends BaseSoundWireReelForm {

    /**
     * @see ReelCassetteFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('corrosionRustOxidation', new sfWidgetFormInputCheckbox());
//        $this->setWidget('composition', new sfWidgetFormChoice(array('choices' => SoundWireReel::$constants), array('class' => 'override_required')));
        $this->setWidget('composition', new sfWidgetFormChoice(array('choices' => array('' => 'Select', 0 => 'Stainless steel', 1 => ' Composition-other', 2 => 'Iron', 3 => 'Unknown')), array('class' => 'override_required')));
        $this->setWidget('nonStandardBrand', new sfWidgetFormInputCheckbox());

        $this->getWidget('corrosionRustOxidation')->setLabel('Corrosion, rust or oxidation:&nbsp;');
        $this->getWidget('composition')->setLabel('<span class="required">*</span>Composition:&nbsp;');
        $this->getWidget('nonStandardBrand')->setLabel('Pre-WWII, non-standard size and/or Armour brand:&nbsp;');

        $this->setValidator('corrosionRustOxidation', new sfValidatorBoolean());
        $this->setValidator('composition', new sfValidatorString(array('required' => true)));
        $this->setValidator('nonStandardBrand', new sfValidatorBoolean());

        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));


        foreach (array('noise_reduction',
    'duration_type_methodology',
    'format_notes',
    'tape_type',
    'slow_speed',
    'sound_field',
    'soft_binder_syndrome',
    'thinTape',
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
