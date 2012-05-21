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
      'publicationYear'                 => new sfWidgetFormDate(),
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
      'quantity'                        => new sfValidatorInteger(),
      'generation'                      => new sfValidatorInteger(),
      'year_recorded'                   => new sfValidatorString(array('max_length' => 255)),
      'copies'                          => new sfValidatorBoolean(array('required' => false)),
      'stock_brand'                     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'off_brand'                       => new sfValidatorBoolean(array('required' => false)),
      'fungus'                          => new sfValidatorBoolean(array('required' => false)),
      'other_contaminants'              => new sfValidatorBoolean(array('required' => false)),
      'duration'                        => new sfValidatorInteger(),
      'duration_type'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type'                            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'material'                        => new sfValidatorInteger(),
      'oxidationCorrosion'              => new sfValidatorBoolean(),
      'pack_deformation'                => new sfValidatorInteger(array('required' => false)),
      'noise_reduction'                 => new sfValidatorBoolean(),
      'tape_type'                       => new sfValidatorInteger(),
      'thin_tape'                       => new sfValidatorBoolean(array('required' => false)),
      'slow_speed'                      => new sfValidatorBoolean(array('required' => false)),
      'sound_field'                     => new sfValidatorInteger(),
      'soft_binder_syndrome'            => new sfValidatorBoolean(array('required' => false)),
      'gauge'                           => new sfValidatorInteger(),
      'color'                           => new sfValidatorBoolean(),
      'colorFade'                       => new sfValidatorBoolean(array('required' => false)),
      'soundtrackFormat'                => new sfValidatorInteger(array('required' => false)),
      'substrate'                       => new sfValidatorInteger(),
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
      'trackConfiguration'              => new sfValidatorInteger(),
      'tapeThickness'                   => new sfValidatorInteger(array('required' => false)),
      'speed'                           => new sfValidatorInteger(),
      'softBinderSyndrome'              => new sfValidatorInteger(array('required' => false)),
      'materialsBreakdown'              => new sfValidatorBoolean(array('required' => false)),
      'physicalDamage'                  => new sfValidatorInteger(array('required' => false)),
      'delamination'                    => new sfValidatorBoolean(array('required' => false)),
      'plasticizerExudation'            => new sfValidatorBoolean(array('required' => false)),
      'recordingLayer'                  => new sfValidatorInteger(),
      'recordingSpeed'                  => new sfValidatorInteger(),
      'cylinderType'                    => new sfValidatorInteger(),
      'reflectiveLayer'                 => new sfValidatorInteger(),
      'dataLayer'                       => new sfValidatorInteger(),
      'opticalDiscType'                 => new sfValidatorInteger(),
      'format'                          => new sfValidatorInteger(),
      'recordingStandard'               => new sfValidatorInteger(),
      'publicationYear'                 => new sfValidatorDate(),
      'capacityLayers'                  => new sfValidatorInteger(),
      'codec'                           => new sfValidatorInteger(),
      'dataRate'                        => new sfValidatorInteger(),
      'sheddingSoftBinder'              => new sfValidatorBoolean(array('required' => false)),
      'formatVersion'                   => new sfValidatorInteger(),
      'oxide'                           => new sfValidatorInteger(),
      'binderSystem'                    => new sfValidatorBoolean(),
      'reelSize'                        => new sfValidatorInteger(),
      'whiteResidue'                    => new sfValidatorBoolean(array('required' => false)),
      'size'                            => new sfValidatorBoolean(),
      'formatTypedVideoRecordingFormat' => new sfValidatorInteger(),
      'bitrate'                         => new sfValidatorInteger(array('required' => false)),
      'scanning'                        => new sfValidatorInteger(),
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
