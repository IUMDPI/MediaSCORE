<?php

/**
 * FormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FormatTypeForm extends BaseFormatTypeForm {
    public static $durationtype=array(0=>'Calculated',1=>'estimated',2=>'max estimate');

    public function configure() {
        $this->setWidget('duration_type', new sfWidgetFormChoice(array('choices'=>  self::$durationtype)));
        $this->getWidget('quantity')->setLabel('<span class="required">*</span>Quantity:&nbsp;');
        $this->getWidget('generation')->setLabel('<span class="required">*</span>Generation:&nbsp;');
        $this->getWidget('year_recorded')->setLabel('<span class="required">*</span>Year Recorded:&nbsp;');
        $this->getWidget('copies')->setLabel('Copies:&nbsp;');
        $this->getWidget('stock_brand')->setLabel('Stock Brand:&nbsp;');
        $this->getWidget('off_brand')->setLabel('Off-Brand:&nbsp;');
        $this->getWidget('fungus')->setLabel('Fungus:&nbsp;');
        $this->getWidget('other_contaminants')->setLabel('Other Contaminants:&nbsp;');
        $this->getWidget('duration')->setLabel('<span class="required">*</span>Duration:&nbsp;');
        $this->getWidget('duration_type')->setLabel('<span class="required">*</span>Duration Type:&nbsp;');
        $this->getWidget('duration_type_methodology')->setLabel('Duration type methodology:&nbsp;');
        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 0)));
        
        $this->setValidator('quantity', new sfValidatorString(array('required' => true)));
        $this->setValidator('generation', new sfValidatorString(array('required' => true)));
        $this->setValidator('year_recorded', new sfValidatorString(array('required' => true)));
        $this->setValidator('duration', new sfValidatorString(array('required' => true)));
        $this->setValidator('duration_type', new sfValidatorString(array('required' => true)));
        $this->setValidator('duration_type_methodology', new sfValidatorString(array('required' => false)));
        
        $this->setWidget('generation',new sfWidgetFormChoice(array('choices' => MetalDisc::$generation)));

        foreach (array('material',
    'oxidationCorrosion', 
    'pack_deformation',
    'noise_reduction',
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
    'physicalDamage',
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
    'updated_at') as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }
    }

}
