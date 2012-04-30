<?php

/**
 * FormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FormatTypeForm extends BaseFormatTypeForm
{

	public function configure() {

		foreach( array(	'material',
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
				'updated_at' ) as $voidField)
				unset($this->getWidgetSchema[$voidField]);
  }
}
