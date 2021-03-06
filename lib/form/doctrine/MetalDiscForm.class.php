<?php

/**
 * MetalDisc form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MetalDiscForm extends BaseMetalDiscForm {

    /**
     * @see FormatTypeForm
     */
    public function configure() {
        parent::configure();

        $this->setWidget('material', new sfWidgetFormChoice(array('choices' => MetalDisc::$constants)));
        $this->setWidget('oxidationCorrosion', new sfWidgetFormInputCheckbox());
        $this->setWidget('physicalDamage', new sfWidgetFormChoice(array('choices' => MetalDisc::$damage, 'expanded' => true), array('title' => 'Note the presence of cracks, chips, and other externally caused damage. This does not include cracks from actual delamination.', 'class' => 'override_required')));

        $this->getWidget('material')->setLabel('<span class="required">*</span>Material:&nbsp;');
        $this->getWidget('oxidationCorrosion')->setLabel('Oxidation / Corrosion:&nbsp;');
        $this->getWidget('physicalDamage')->setLabel('<span class="required">*</span>Physical Damage:&nbsp;');

        $this->setDefault('physicalDamage', -1);

        $this->setValidator('material', new sfValidatorString(array('required' => true)));
        $this->setValidator('oxidationCorrosion', new sfValidatorBoolean());
        $this->setValidator('physicalDamage', new sfValidatorString(array('required' => true)));


        $this->getValidator('material')->setMessages(array('required' => 'Required.',
            'invalid' => 'Invalid.'));
        $this->getValidator('physicalDamage')->setMessages(array('required' => 'Required.',
            'invalid' => 'Invalid.'));


        foreach (array('pack_deformation',
    'noise_reduction',
    'format_notes',
    'tape_type',
    'thin_tape',
    'slow_speed',
    'sound_field',
    'soft_binder_syndrome',
    'gauge',
    'color',
    'colorFade',
    'soundtrackFormat',
    'substrate',
    'strongOdor',
    'vinegarOdor',
    'ADStripLevel',
    'shrinkage',
    'levelOfShrinkage',
    'rust',
    'discoloration',
    'surfaceBlisteringBubbling',
    'thinTape',
    '1993OrEarlier',
    'dataGradeTape',
    'longPlay32K96K',
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
    'quantity') as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }

        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));
    }

}
