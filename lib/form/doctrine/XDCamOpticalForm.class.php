<?php

/**
 * XDCamOptical form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class XDCamOpticalForm extends BaseXDCamOpticalForm
{
  /**
   * @see StandardizedRecordingFormatTypeForm
   */
  public function configure()
  {
	  parent::configure();
	  $this->setWidget('format',new sfWidgetFormChoice(array('choices' => XDCamOptical::$constants[0])));
	  $this->setWidget('capacityLayers',new sfWidgetFormChoice(array('choices' => XDCamOptical::$constants[1])));
	  $this->setWidget('codec',new sfWidgetFormChoice(array('choices' => XDCamOptical::$constants[2]),array('title'=>'Only active if SD is selected as format version')));
	  $this->setWidget('dataRate',new sfWidgetFormChoice(array('choices' => XDCamOptical::$constants[3]),array('title'=>'Only active if IMX is selected as codec')));
          $this->setWidget('physicalDamage', new sfWidgetFormChoice(array('choices' => MetalDisc::$damage, 'expanded' => true)));
        
        $this->setDefault('physicalDamage', 0);
          
          $this->setValidator('format', new sfValidatorString(array('required' => false)));
          $this->setValidator('capacityLayers', new sfValidatorString(array('required' => false)));
          $this->setValidator('codec', new sfValidatorString(array('required' => false)));
          $this->setValidator('dataRate', new sfValidatorString(array('required' => false)));
          $this->setValidator('physicalDamage', new sfValidatorString(array('required' => false)));
          
          $this->getWidget('format')->setLabel('<span class="required">*</span>Format Version:&nbsp;');
          $this->getWidget('capacityLayers')->setLabel('<span class="required">*</span>Capacity (Layers):&nbsp;');
          $this->getWidget('codec')->setLabel('<span class="required">*</span>Codec:&nbsp;');
          $this->getWidget('dataRate')->setLabel('<span class="required">*</span>Data Rate (Mbps):&nbsp;');
          $this->getWidget('physicalDamage')->setLabel('<span class="required">*</span>Physical Damage:&nbsp;');

	$this->setWidget('type',new sfWidgetFormInputHidden(array(),array('value' => $this->getObject()->getTypeValue() )));
        
        foreach (array('noise_reduction',
            'duration_type_methodology',
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
    'cylinderType',
    'reflectiveLayer',
    'dataLayer',
    'opticalDiscType',
    'publicationYear',
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
