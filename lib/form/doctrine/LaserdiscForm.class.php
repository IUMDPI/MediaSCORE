<?php

/**
 * Laserdisc form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LaserdiscForm extends BaseLaserdiscForm {

    /**
     * @see StandardizedRecordingFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('recordingSpeed', new sfWidgetFormChoice(array('choices' => Laserdisc::$constants), array('class' => 'override_required')));
        $this->setValidator('recordingSpeed', new sfValidatorString(array('required' => true)));
        $this->getWidget('recordingSpeed')->setLabel('<span class="required">*</span>Recording Speed:&nbsp;');

        $this->setWidget('publicationYear', new sfWidgetFormInputText(array(), array('class' => 'override_required')));

        $this->setValidator('publicationYear', new sfValidatorAnd(array(
                    new sfValidatorString(array('min_length' => 4, 'max_length' => 4), array('min_length' => 'Year must be of 4 Numbers (yyyy).', 'max_length' => 'Year must be of 4 Numbers (yyyy).')),
                    new sfValidatorInteger(array('required' => true), array('required' => 'Please enter a four digit numeric value (yyyy).', 'invalid' => 'Please enter a four digit numeric value (yyyy).')),
                )));
        $this->getWidget('publicationYear')->setLabel('<span class="required">*</span>Year of publication:&nbsp;');

        $this->setWidget('physicalDamage', new sfWidgetFormChoice(array('choices' => MetalDisc::$damage, 'expanded' => true), array('class' => 'override_required')));
        $this->setDefault('physicalDamage', -1);
        $this->setValidator('physicalDamage', new sfValidatorString(array('required' => true)));
        $this->getWidget('physicalDamage')->setLabel('<span class="required">*</span>Physical Damage:&nbsp;');

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
    'cylinderType',
    'reflectiveLayer',
    'dataLayer',
    'opticalDiscType',
    'format',
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
