<?php

/**
 * Film form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FilmForm extends BaseFilmForm
{
  /**
   * @see ReelCassetteFormatTypeForm
   */
  public function configure()
  {
	parent::configure();
	$this->setWidget('gauge',new sfWidgetFormChoice(array('choices' => Film::$constants[0])));
	$this->setWidget('color',new sfWidgetFormChoice(array('choices' => Film::$constants[1])));
	$this->setWidget('colorFade',new sfWidgetFormInputCheckbox(array(),array('title'=>'Will often give film a magenta appearance')));
	$this->setWidget('soundtrackFormat',new sfWidgetFormChoice(array('choices' => Film::$constants[2])));
	$this->setWidget('substrate',new sfWidgetFormChoice(array('choices' => Film::$constants[3])));
	$this->setWidget('strongOdor',new sfWidgetFormInputCheckbox());
	$this->setWidget('vinegarOdor',new sfWidgetFormInputCheckbox());
	$this->setWidget('ADStripLevel',new sfWidgetFormInputText());
	$this->setWidget('shrinkage',new sfWidgetFormInputCheckbox()); 
	$this->setWidget('levelOfShrinkage',new sfWidgetFormInputText());
	$this->setWidget('rust',new sfWidgetFormInputCheckbox());
	$this->setWidget('discoloration',new sfWidgetFormInputCheckbox());
	$this->setWidget('surfaceBlisteringBubbling',new sfWidgetFormInputCheckbox());
//	$this->setWidget('packDeformation',new sfWidgetFormChoice(array('choices' => Film::$constants[4],'expanded'=>true)));
	
//        $this->setDefault('packDeformation',1);

	$this->getWidget('gauge')->setLabel('<span class="required">*</span>Gauge / Type:&nbsp;');
	$this->getWidget('color')->setLabel('<span class="required">*</span>Presence of Color?:&nbsp;');
	$this->getWidget('colorFade')->setLabel('Color Fade:&nbsp;');
	$this->getWidget('soundtrackFormat')->setLabel('<span class="required">*</span>Soundtrack Format:&nbsp;');
	$this->getWidget('substrate')->setLabel('<span class="required">*</span>Substrate:&nbsp;');
	$this->getWidget('strongOdor')->setLabel('Strong odor:&nbsp;');
	$this->getWidget('vinegarOdor')->setLabel('Vinegar odor:&nbsp;');
	$this->getWidget('ADStripLevel')->setLabel('A-D strip level:&nbsp;');
	$this->getWidget('shrinkage')->setLabel('Shrinkage:&nbsp;');
	$this->getWidget('levelOfShrinkage')->setLabel('Level of shrinkage:&nbsp;');
	$this->getWidget('rust')->setLabel('Rust:&nbsp;');
	$this->getWidget('discoloration')->setLabel(' Amber, brown, or yellowish discoloration:&nbsp;');
	$this->getWidget('surfaceBlisteringBubbling')->setLabel('surface blistering or bubbling:&nbsp;');
//	$this->getWidget('packDeformation')->setLabel('Pack Deformation:&nbsp;');
	
        
        $this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
        
        $this->setValidator('gauge', new sfValidatorString(array('required' => true)));
        $this->setValidator('color', new sfValidatorString(array('required' => true)));
        $this->setValidator('colorFade', new sfValidatorBoolean());
        $this->setValidator('soundtrackFormat', new sfValidatorString(array('required' => false)));
        $this->setValidator('substrate', new sfValidatorString(array('required' => true)));
        $this->setValidator('strongOdor', new sfValidatorBoolean());
        $this->setValidator('vinegarOdor', new sfValidatorBoolean());
        $this->setValidator('ADStripLevel', new sfValidatorString(array('required' => false)));
        $this->setValidator('shrinkage', new sfValidatorBoolean());
        $this->setValidator('levelOfShrinkage', new sfValidatorString(array('required' => false)));
        $this->setValidator('rust', new sfValidatorBoolean());
        $this->setValidator('discoloration', new sfValidatorBoolean());
        $this->setValidator('surfaceBlisteringBubbling', new sfValidatorBoolean());
//        $this->setValidator('packDeformation', new sfValidatorString(array('required' => true)));
        
        
         foreach (array('noise_reduction',
    'tape_type',
    'thin_tape',
    'slow_speed',
    'sound_field',
    'soft_binder_syndrome',
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
    'material',
    'oxidationCorrosion',
    'physicalDamage',
            'quantity') as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));

  }
}
