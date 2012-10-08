<?php

/**
 * Cylinder form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CylinderForm extends BaseCylinderForm {

    /**
     * @see SoftDiskFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('cylinderType', new sfWidgetFormChoice(array('choices' => Cylinder::$constants), array('title' => 'Cut wax is softer than molded wax; Amberol wax is notoriously brittle; celluloid is susceptible to shrinkage which can lead to cracking, warping, and other problems.', 'class' => 'override_required')));
        $this->setWidget('physicalDamage', new sfWidgetFormChoice(array('choices' => MetalDisc::$damage, 'expanded' => true), array('title' => 'Note presence of breakage, cracks, and splits in surface material or substrate', 'class' => 'override_required')));
        $this->setWidget('materialsBreakdown', new sfWidgetFormInputCheckbox(array(), array('title' => 'Note presence of hazing or efflorescence')));
        $this->setDefault('physicalDamage', -1);

        $this->setValidator('cylinderType', new sfValidatorString(array('required' => true)));
        $this->setValidator('physicalDamage', new sfValidatorString(array('required' => true)));
        $this->setValidator('materialsBreakdown', new sfValidatorBoolean());

        $this->getWidget('cylinderType')->setLabel('<span class="required">*</span>Type:&nbsp;');
        $this->getWidget('physicalDamage')->setLabel('<span class="required">*</span>Physical Damage:&nbsp;');
        $this->getWidget('materialsBreakdown')->setLabel('Breakdown of Materials:&nbsp;');

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
    'recordingSpeed',
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
