<?php

/**
 * AnalogAudiocassette form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnalogAudiocassetteForm extends BaseAnalogAudiocassetteForm
{
	public function configure() {
		parent::configure();
		$this->setWidget('tape_type',new sfWidgetFormChoice(array('choices' => AnalogAudiocassette::$constants[0])));
		$this->setWidget('thin_tape',new sfWidgetFormInputCheckbox(array(),array('title'=>'Check the box if 120 or 180 minute cassettes')));
		$this->setWidget('slow_speed',new sfWidgetFormInputCheckbox(array(),array('title'=>'Check the box if cassette is marked as recorded at 0.9375 ips')));
		$this->setWidget('noise_reduction',new sfWidgetFormInputCheckbox());
		$this->setWidget('sound_field',new sfWidgetFormChoice(array('choices' => AnalogAudiocassette::$constants[1])));
		$this->setWidget('softBinderSyndrome',new sfWidgetFormInputCheckbox());
		
                $this->getWidget('tape_type')->setLabel('<span class="required">*</span>Tape Type:&nbsp;');
                $this->getWidget('thin_tape')->setLabel('Thin Tape:&nbsp;');
                $this->getWidget('slow_speed')->setLabel('Slow Speed:&nbsp;');
                $this->getWidget('noise_reduction')->setLabel('Noise Reduction:&nbsp;');
                $this->getWidget('sound_field')->setLabel('<span class="required">*</span>Sound Field:&nbsp;');
                $this->getWidget('softBinderSyndrome')->setLabel('Soft Binder Syndrome:&nbsp;');
                
                $this->setValidator('thin_tape', new sfValidatorBoolean());
                $this->setValidator('slow_speed', new sfValidatorBoolean());
                $this->setValidator('noise_reduction', new sfValidatorBoolean());
                $this->setValidator('softBinderSyndrome', new sfValidatorBoolean());
                $this->setValidator('tape_type', new sfValidatorString(array('required' => false)));
                $this->setValidator('sound_field', new sfValidatorString(array('required' => false)));
                
                $this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
                
                
                foreach (array('corrosionRustOxidation',
                    'duration_type_methodology',
    'composition',
    'nonStandardBrand',
    'trackConfiguration',
    'tapeThickness',
    'speed',
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
