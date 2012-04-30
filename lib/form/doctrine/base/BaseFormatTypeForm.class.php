<?php

/**
 * FormatType form base class.
 *
 * @method FormatType getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFormatTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                              => new sfWidgetFormInputHidden(),
      'quantity'                        => new sfWidgetFormInputText(),
      'generation'                      => new sfWidgetFormInputText(),
      'year_recorded'                   => new sfWidgetFormInputText(),
      'copies'                          => new sfWidgetFormInputCheckbox(),
      'stock_brand'                     => new sfWidgetFormInputText(),
      'off_brand'                       => new sfWidgetFormInputCheckbox(),
      'fungus'                          => new sfWidgetFormInputCheckbox(),
      'other_contaminants'              => new sfWidgetFormInputCheckbox(),
      'duration'                        => new sfWidgetFormInputText(),
      'duration_type'                   => new sfWidgetFormInputText(),
      'type'                            => new sfWidgetFormInputText(),
      'material'                        => new sfWidgetFormInputText(),
      'oxidationCorrosion'              => new sfWidgetFormInputCheckbox(),
      'pack_deformation'                => new sfWidgetFormInputText(),
      'noise_reduction'                 => new sfWidgetFormInputCheckbox(),
      'tape_type'                       => new sfWidgetFormInputText(),
      'thin_tape'                       => new sfWidgetFormInputCheckbox(),
      'slow_speed'                      => new sfWidgetFormInputCheckbox(),
      'sound_field'                     => new sfWidgetFormInputText(),
      'soft_binder_syndrome'            => new sfWidgetFormInputCheckbox(),
      'gauge'                           => new sfWidgetFormInputText(),
      'color'                           => new sfWidgetFormInputCheckbox(),
      'colorFade'                       => new sfWidgetFormInputCheckbox(),
      'soundtrackFormat'                => new sfWidgetFormInputText(),
      'substrate'                       => new sfWidgetFormInputText(),
      'strongOdor'                      => new sfWidgetFormInputCheckbox(),
      'vinegarOdor'                     => new sfWidgetFormInputCheckbox(),
      'ADStripLevel'                    => new sfWidgetFormInputText(),
      'shrinkage'                       => new sfWidgetFormInputCheckbox(),
      'levelOfShrinkage'                => new sfWidgetFormInputText(),
      'rust'                            => new sfWidgetFormInputCheckbox(),
      'discoloration'                   => new sfWidgetFormInputCheckbox(),
      'surfaceBlisteringBubbling'       => new sfWidgetFormInputCheckbox(),
      'thinTape'                        => new sfWidgetFormInputCheckbox(),
      '1993OrEarlier'                   => new sfWidgetFormInputCheckbox(),
      'dataGradeTape'                   => new sfWidgetFormInputCheckbox(),
      'longPlay32K96K'                  => new sfWidgetFormInputCheckbox(),
      'corrosionRustOxidation'          => new sfWidgetFormInputCheckbox(),
      'composition'                     => new sfWidgetFormInputText(),
      'nonStandardBrand'                => new sfWidgetFormInputCheckbox(),
      'trackConfiguration'              => new sfWidgetFormInputText(),
      'tapeThickness'                   => new sfWidgetFormInputText(),
      'speed'                           => new sfWidgetFormInputText(),
      'softBinderSyndrome'              => new sfWidgetFormInputText(),
      'materialsBreakdown'              => new sfWidgetFormInputCheckbox(),
      'physicalDamage'                  => new sfWidgetFormInputText(),
      'delamination'                    => new sfWidgetFormInputCheckbox(),
      'plasticizerExudation'            => new sfWidgetFormInputCheckbox(),
      'recordingLayer'                  => new sfWidgetFormInputText(),
      'recordingSpeed'                  => new sfWidgetFormInputText(),
      'cylinderType'                    => new sfWidgetFormInputText(),
      'reflectiveLayer'                 => new sfWidgetFormInputText(),
      'dataLayer'                       => new sfWidgetFormInputText(),
      'opticalDiscType'                 => new sfWidgetFormInputText(),
      'format'                          => new sfWidgetFormInputText(),
      'recordingStandard'               => new sfWidgetFormInputText(),
      'publicationYear'                 => new sfWidgetFormDateTime(),
      'capacityLayers'                  => new sfWidgetFormInputText(),
      'codec'                           => new sfWidgetFormInputText(),
      'dataRate'                        => new sfWidgetFormInputText(),
      'sheddingSoftBinder'              => new sfWidgetFormInputCheckbox(),
      'formatVersion'                   => new sfWidgetFormInputText(),
      'oxide'                           => new sfWidgetFormInputText(),
      'binderSystem'                    => new sfWidgetFormInputCheckbox(),
      'reelSize'                        => new sfWidgetFormInputText(),
      'whiteResidue'                    => new sfWidgetFormInputCheckbox(),
      'size'                            => new sfWidgetFormInputCheckbox(),
      'formatTypedVideoRecordingFormat' => new sfWidgetFormInputText(),
      'bitrate'                         => new sfWidgetFormInputText(),
      'scanning'                        => new sfWidgetFormInputText(),
      'created_at'                      => new sfWidgetFormDateTime(),
      'updated_at'                      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'quantity'                        => new sfValidatorInteger(array('required' => false)),
      'generation'                      => new sfValidatorInteger(array('required' => false)),
      'year_recorded'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'copies'                          => new sfValidatorBoolean(array('required' => false)),
      'stock_brand'                     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'off_brand'                       => new sfValidatorBoolean(array('required' => false)),
      'fungus'                          => new sfValidatorBoolean(array('required' => false)),
      'other_contaminants'              => new sfValidatorBoolean(array('required' => false)),
      'duration'                        => new sfValidatorInteger(array('required' => false)),
      'duration_type'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type'                            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'material'                        => new sfValidatorInteger(array('required' => false)),
      'oxidationCorrosion'              => new sfValidatorBoolean(array('required' => false)),
      'pack_deformation'                => new sfValidatorInteger(array('required' => false)),
      'noise_reduction'                 => new sfValidatorBoolean(array('required' => false)),
      'tape_type'                       => new sfValidatorInteger(array('required' => false)),
      'thin_tape'                       => new sfValidatorBoolean(array('required' => false)),
      'slow_speed'                      => new sfValidatorBoolean(array('required' => false)),
      'sound_field'                     => new sfValidatorInteger(array('required' => false)),
      'soft_binder_syndrome'            => new sfValidatorBoolean(array('required' => false)),
      'gauge'                           => new sfValidatorInteger(array('required' => false)),
      'color'                           => new sfValidatorBoolean(array('required' => false)),
      'colorFade'                       => new sfValidatorBoolean(array('required' => false)),
      'soundtrackFormat'                => new sfValidatorInteger(array('required' => false)),
      'substrate'                       => new sfValidatorInteger(array('required' => false)),
      'strongOdor'                      => new sfValidatorBoolean(array('required' => false)),
      'vinegarOdor'                     => new sfValidatorBoolean(array('required' => false)),
      'ADStripLevel'                    => new sfValidatorInteger(array('required' => false)),
      'shrinkage'                       => new sfValidatorBoolean(array('required' => false)),
      'levelOfShrinkage'                => new sfValidatorInteger(array('required' => false)),
      'rust'                            => new sfValidatorBoolean(array('required' => false)),
      'discoloration'                   => new sfValidatorBoolean(array('required' => false)),
      'surfaceBlisteringBubbling'       => new sfValidatorBoolean(array('required' => false)),
      'thinTape'                        => new sfValidatorBoolean(array('required' => false)),
      '1993OrEarlier'                   => new sfValidatorBoolean(array('required' => false)),
      'dataGradeTape'                   => new sfValidatorBoolean(array('required' => false)),
      'longPlay32K96K'                  => new sfValidatorBoolean(array('required' => false)),
      'corrosionRustOxidation'          => new sfValidatorBoolean(array('required' => false)),
      'composition'                     => new sfValidatorInteger(array('required' => false)),
      'nonStandardBrand'                => new sfValidatorBoolean(array('required' => false)),
      'trackConfiguration'              => new sfValidatorInteger(array('required' => false)),
      'tapeThickness'                   => new sfValidatorInteger(array('required' => false)),
      'speed'                           => new sfValidatorInteger(array('required' => false)),
      'softBinderSyndrome'              => new sfValidatorInteger(array('required' => false)),
      'materialsBreakdown'              => new sfValidatorBoolean(array('required' => false)),
      'physicalDamage'                  => new sfValidatorInteger(array('required' => false)),
      'delamination'                    => new sfValidatorBoolean(array('required' => false)),
      'plasticizerExudation'            => new sfValidatorBoolean(array('required' => false)),
      'recordingLayer'                  => new sfValidatorInteger(array('required' => false)),
      'recordingSpeed'                  => new sfValidatorInteger(array('required' => false)),
      'cylinderType'                    => new sfValidatorInteger(array('required' => false)),
      'reflectiveLayer'                 => new sfValidatorInteger(array('required' => false)),
      'dataLayer'                       => new sfValidatorInteger(array('required' => false)),
      'opticalDiscType'                 => new sfValidatorInteger(array('required' => false)),
      'format'                          => new sfValidatorInteger(array('required' => false)),
      'recordingStandard'               => new sfValidatorInteger(array('required' => false)),
      'publicationYear'                 => new sfValidatorDateTime(array('required' => false)),
      'capacityLayers'                  => new sfValidatorInteger(array('required' => false)),
      'codec'                           => new sfValidatorInteger(array('required' => false)),
      'dataRate'                        => new sfValidatorInteger(array('required' => false)),
      'sheddingSoftBinder'              => new sfValidatorBoolean(array('required' => false)),
      'formatVersion'                   => new sfValidatorInteger(array('required' => false)),
      'oxide'                           => new sfValidatorInteger(array('required' => false)),
      'binderSystem'                    => new sfValidatorBoolean(array('required' => false)),
      'reelSize'                        => new sfValidatorInteger(array('required' => false)),
      'whiteResidue'                    => new sfValidatorBoolean(array('required' => false)),
      'size'                            => new sfValidatorBoolean(array('required' => false)),
      'formatTypedVideoRecordingFormat' => new sfValidatorInteger(array('required' => false)),
      'bitrate'                         => new sfValidatorInteger(array('required' => false)),
      'scanning'                        => new sfValidatorInteger(array('required' => false)),
      'created_at'                      => new sfValidatorDateTime(),
      'updated_at'                      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('format_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FormatType';
  }

}
