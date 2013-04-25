<?php

/**
 * HalfInchOpenReelVideo form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class HalfInchOpenReelVideoForm extends BaseHalfInchOpenReelVideoForm {

    /**
     * @see OpenReelVideoFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('format', new sfWidgetFormChoice(array('choices' => HalfInchOpenReelVideo::$constants[0]), array('class' => 'override_required')));
        $this->setWidget('reelSize', new sfWidgetFormChoice(array('choices' => HalfInchOpenReelVideo::$constants[1], 'multiple' => true), array('class' => 'override_required')));
        $this->setWidget('pack_deformation', new sfWidgetFormChoice(array('choices' => Film::$constants[4], 'expanded' => true), array('class' => 'override_required')));

        $this->setDefault('pack_deformation', -1);

        $this->setValidator('format', new sfValidatorString(array('required' => true)));
        $this->setValidator('reelSize', new sfValidatorString(array('required' => true)));
        $this->setValidator('pack_deformation', new sfValidatorString(array('required' => true)));


        $this->getWidget('format')->setLabel('<span class="required">*</span>Format Version:&nbsp;');
        $this->getWidget('reelSize')->setLabel('<span class="required">*</span>Reel Size:&nbsp;');
        $this->getWidget('pack_deformation')->setLabel('<span class="required">*</span>Pack  Deformation:&nbsp;');
//constaints applyed
        $this->setWidget('recordingStandard', new sfWidgetFormChoice(array('choices' => FormatTypedVideoRecording::$constants[0]), array('class' => 'override_required')));
        
        $this->widgetSchema->moveField('format', 'before', 'recordingStandard');

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

    public function bind(array $taintedValues = null, array $taintedFiles = null) {

        if (isset($taintedValues['reelSize']) && $taintedValues['reelSize'] != null) {
            $reelSize = implode(',', $taintedValues['reelSize']);
            $taintedValues['reelSize'] = $reelSize;
        }




        parent::bind($taintedValues, $taintedFiles);
    }

}
