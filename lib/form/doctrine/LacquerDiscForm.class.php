<?php

/**
 * LacquerDisc form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LacquerDiscForm extends BaseLacquerDiscForm
{
  /**
   * @see SoftDiskFormatTypeForm
   */
  public function configure()
  {
	parent::configure();
	$this->setWidget('substrate',new sfWidgetFormChoice(array('choices' => LacquerDisc::$constants)));
	$this->setWidget('delamination',new sfWidgetFormInputCheckbox());
	$this->setWidget('plasticizerExudation',new sfWidgetFormInputCheckbox());
        $this->setWidget('physicalDamage',new sfWidgetFormChoice(array('choices' => MetalDisc::$damage,'expanded' => true),array('title'=>'Note the presence of cracks, chips, and other externally caused damage. This does not include cracks from actual delamination.'))); 
        
        $this->getWidget('substrate')->setLabel('<span class="required">*</span>Substrate:&nbsp;');
        $this->getWidget('delamination')->setLabel('Delamination:&nbsp;');
        $this->getWidget('plasticizerExudation')->setLabel('Plasticizer Exudation:&nbsp;');
        $this->getWidget('physicalDamage')->setLabel('<span class="required">*</span>Physical Damage:&nbsp;');
          
          $this->setDefault('physicalDamage', 0);  
        
        $this->setValidator('substrate',new sfValidatorString(array('required' => true))); 
        $this->setValidator('delamination', new sfValidatorBoolean());
         $this->setValidator('plasticizerExudation', new sfValidatorBoolean());
         $this->setValidator('physicalDamage', new sfValidatorString(array('required' => false)));

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
        
        foreach (array('noise_reduction',
    'tape_type',
            'duration_type_methodology',
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
    'quantity') as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }
  }
}
