<?php

/**
 * TwoInchOpenReelVideo form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TwoInchOpenReelVideoForm extends BaseTwoInchOpenReelVideoForm {

    /**
     * @see OpenReelVideoFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('format', new sfWidgetFormChoice(array('choices' => TwoInchOpenReelVideo::$constants[0]),array('class'=>'override_required')));
        $this->setWidget('reelSize', new sfWidgetFormChoice(array('choices' => TwoInchOpenReelVideo::$constants[1]),array('class'=>'override_required')));
        $this->setWidget('pack_deformation', new sfWidgetFormChoice(array('choices' => Film::$constants[4], 'expanded' => true),array('class'=>'override_required')));
        $this->setWidget('formatVersion', new sfWidgetFormChoice(array('choices' => Film::$constants[5]),array('class'=>'override_required')));
        $this->setWidget('whiteResidue', new sfWidgetFormInputCheckbox());

        $this->setDefault('pack_deformation', -1);

        $this->setValidator('format', new sfValidatorString(array('required' => true)));
        $this->setValidator('reelSize', new sfValidatorString(array('required' => true)));
        $this->setValidator('pack_deformation', new sfValidatorString(array('required' => true)));
        $this->setValidator('formatVersion', new sfValidatorString(array('required' => true)));
        $this->setValidator('whiteResidue', new sfValidatorBoolean());


        $this->getWidget('format')->setLabel('<span class="required">*</span>Format:&nbsp;');
        $this->getWidget('reelSize')->setLabel('<span class="required">*</span>Reel Size:&nbsp;');
        $this->getWidget('pack_deformation')->setLabel('<span class="required">*</span>Pack  Deformation:&nbsp;');
        $this->getWidget('formatVersion')->setLabel('<span class="required">*</span>Format Version:&nbsp;');
        $this->getWidget('whiteResidue')->setLabel('Glue on reel:&nbsp;');




        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));
        $this->widgetSchema->moveField('formatVersion', 'before', 'recordingStandard');

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
    'publicationYear',
    'capacityLayers',
    'codec',
    'dataRate',
    'oxide',
    'binderSystem',
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
