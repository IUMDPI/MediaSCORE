<?php

/**
 * DAT form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DATForm extends BaseDATForm {

    /**
     * @see ReelCassetteFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('thin_tape', new sfWidgetFormInputCheckbox());
        $this->setWidget('1993OrEarlier', new sfWidgetFormInputCheckbox());
        $this->setWidget('dataGradeTape', new sfWidgetFormInputCheckbox());
        $this->setWidget('longPlay32K96K', new sfWidgetFormInputCheckbox());

        $this->getWidget('thin_tape')->setLabel('Thin Tape:&nbsp;');
        $this->getWidget('1993OrEarlier')->setLabel('1993 or Earlier:&nbsp;');
        $this->getWidget('dataGradeTape')->setLabel('Data Grade Tape:&nbsp;');
        $this->getWidget('longPlay32K96K')->setLabel('Long Play, 32K or 96K:&nbsp;');

        $this->setValidator('thin_tape', new sfValidatorBoolean());
        $this->setValidator('1993OrEarlier', new sfValidatorBoolean());
        $this->setValidator('dataGradeTape', new sfValidatorBoolean());
        $this->setValidator('longPlay32K96K', new sfValidatorBoolean());


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
