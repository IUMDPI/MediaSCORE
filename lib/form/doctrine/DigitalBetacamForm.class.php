<?php

/**
 * DigitalBetacam form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DigitalBetacamForm extends BaseDigitalBetacamForm {

    /**
     * @see FormatTypedVideoRecordingForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('size', new sfWidgetFormChoice(array('choices' => DigitalBetacam::$constants[0]), array('class' => 'override_required')));
        $this->setValidator('size', new sfValidatorString(array('required' => true)));
        $this->getWidget('size')->setLabel('<span class="required">*</span>Size:&nbsp;');


        $this->setWidget('format', new sfWidgetFormChoice(array('choices' => array('' => 'Select', 'Digital', 'Format Version Betacam SX', 'Format Version IMX')), array('onchange' => 'checkFormat();', 'class' => 'override_required')));
        $this->setValidator('format', new sfValidatorString(array('required' => true)));
        $this->getWidget('format')->setLabel('<span class="required">*</span>Format Version:&nbsp;');


        $this->setWidget('bitrate', new sfWidgetFormChoice(array('choices' => DigitalBetacam::$constants[2], 'multiple' => true), array('title' => 'Mbps. Only active if IMX is selected as format', 'class' => 'override_required')));
        $this->setValidator('bitrate', new sfValidatorString(array('required' => false)));
        $this->getWidget('bitrate')->setLabel('<span class="required">*</span>Bitrate:&nbsp;');

        $this->setWidget('softBinderSyndrome', new sfWidgetFormInputCheckbox());
        $this->setValidator('softBinderSyndrome', new sfValidatorBoolean());
        $this->getWidget('softBinderSyndrome')->setLabel('Soft Binder Syndrome including Sticky Shed:&nbsp;');

        $this->setWidget('pack_deformation', new sfWidgetFormChoice(array('choices' => array(1 => 'Misc. damage'), 'expanded' => true), array('class' => 'override_required')));
        $this->setDefault('pack_deformation', -1);
        $this->setValidator('pack_deformation', new sfValidatorString(array('required' => true)));
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
    'thinTape',
    'corrosionRustOxidation',
    'composition',
    'nonStandardBrand',
    'trackConfiguration',
    'tapeThickness',
    'speed',
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

        if (isset($taintedValues['bitrate']) && $taintedValues['bitrate'] != null) {
            $bitRate = implode(',', $taintedValues['bitrate']);
            $taintedValues['bitrate'] = $bitRate;
        }



        parent::bind($taintedValues, $taintedFiles);
    }

}
