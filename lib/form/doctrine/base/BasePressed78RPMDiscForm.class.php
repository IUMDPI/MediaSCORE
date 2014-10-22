<?php

/**
 * Pressed78RPMDisc form base class.
 *
 * @method Pressed78RPMDisc getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePressed78RPMDiscForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                              => new sfWidgetFormInputHidden(),
      'quantity'                        => new sfWidgetFormInputText(),
      'generation'                      => new sfWidgetFormInputText(),
      'year_recorded'                   => new sfWidgetFormInputText(),
      'copies'                          => new sfWidgetFormInputText(),
      'stock_brand'                     => new sfWidgetFormInputText(),
      'off_brand'                       => new sfWidgetFormInputText(),
      'fungus'                          => new sfWidgetFormInputText(),
      'other_contaminants'              => new sfWidgetFormInputText(),
      'duration'                        => new sfWidgetFormInputText(),
      'duration_type'                   => new sfWidgetFormInputText(),
      'type'                            => new sfWidgetFormInputText(),
      'material'                        => new sfWidgetFormInputText(),
      'oxidationcorrosion'              => new sfWidgetFormInputText(),
      'pack_deformation'                => new sfWidgetFormInputText(),
      'noise_reduction'                 => new sfWidgetFormInputText(),
      'tape_type'                       => new sfWidgetFormInputText(),
      'thin_tape'                       => new sfWidgetFormInputText(),
      'slow_speed'                      => new sfWidgetFormInputText(),
      'sound_field'                     => new sfWidgetFormInputText(),
      'soft_binder_syndrome'            => new sfWidgetFormInputText(),
      'gauge'                           => new sfWidgetFormInputText(),
      'color'                           => new sfWidgetFormInputText(),
      'colorfade'                       => new sfWidgetFormInputText(),
      'soundtrackformat'                => new sfWidgetFormInputText(),
      'substrate'                       => new sfWidgetFormInputText(),
      'strongodor'                      => new sfWidgetFormInputText(),
      'vinegarodor'                     => new sfWidgetFormInputText(),
      'adstriplevel'                    => new sfWidgetFormInputText(),
      'shrinkage'                       => new sfWidgetFormInputText(),
      'levelofshrinkage'                => new sfWidgetFormInputText(),
      'rust'                            => new sfWidgetFormInputText(),
      'discoloration'                   => new sfWidgetFormInputText(),
      'surfaceblisteringbubbling'       => new sfWidgetFormInputText(),
      'thintape'                        => new sfWidgetFormInputText(),
      '1993orearlier'                   => new sfWidgetFormInputText(),
      'datagradetape'                   => new sfWidgetFormInputText(),
      'longplay32k96k'                  => new sfWidgetFormInputText(),
      'corrosionrustoxidation'          => new sfWidgetFormInputText(),
      'composition'                     => new sfWidgetFormInputText(),
      'nonstandardbrand'                => new sfWidgetFormInputText(),
      'trackconfiguration'              => new sfWidgetFormInputText(),
      'tapethickness'                   => new sfWidgetFormInputText(),
      'speed'                           => new sfWidgetFormInputText(),
      'softbindersyndrome'              => new sfWidgetFormInputText(),
      'materialsbreakdown'              => new sfWidgetFormInputText(),
      'physicaldamage'                  => new sfWidgetFormInputText(),
      'delamination'                    => new sfWidgetFormInputText(),
      'plasticizerexudation'            => new sfWidgetFormInputText(),
      'recordinglayer'                  => new sfWidgetFormInputText(),
      'recordingspeed'                  => new sfWidgetFormInputText(),
      'cylindertype'                    => new sfWidgetFormInputText(),
      'reflectivelayer'                 => new sfWidgetFormInputText(),
      'datalayer'                       => new sfWidgetFormInputText(),
      'opticaldisctype'                 => new sfWidgetFormInputText(),
      'format'                          => new sfWidgetFormInputText(),
      'recordingstandard'               => new sfWidgetFormInputText(),
      'publicationyear'                 => new sfWidgetFormDate(),
      'capacitylayers'                  => new sfWidgetFormInputText(),
      'codec'                           => new sfWidgetFormInputText(),
      'datarate'                        => new sfWidgetFormInputText(),
      'sheddingsoftbinder'              => new sfWidgetFormInputText(),
      'formatversion'                   => new sfWidgetFormInputText(),
      'oxide'                           => new sfWidgetFormInputText(),
      'bindersystem'                    => new sfWidgetFormInputText(),
      'reelsize'                        => new sfWidgetFormInputText(),
      'whiteresidue'                    => new sfWidgetFormInputText(),
      'size'                            => new sfWidgetFormInputText(),
      'formattypedvideorecordingformat' => new sfWidgetFormInputText(),
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
      'copies'                          => new sfValidatorInteger(array('required' => false)),
      'stock_brand'                     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'off_brand'                       => new sfValidatorInteger(array('required' => false)),
      'fungus'                          => new sfValidatorInteger(array('required' => false)),
      'other_contaminants'              => new sfValidatorInteger(array('required' => false)),
      'duration'                        => new sfValidatorInteger(),
      'duration_type'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type'                            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'material'                        => new sfValidatorInteger(),
      'oxidationcorrosion'              => new sfValidatorInteger(),
      'pack_deformation'                => new sfValidatorInteger(array('required' => false)),
      'noise_reduction'                 => new sfValidatorInteger(),
      'tape_type'                       => new sfValidatorInteger(),
      'thin_tape'                       => new sfValidatorInteger(array('required' => false)),
      'slow_speed'                      => new sfValidatorInteger(array('required' => false)),
      'sound_field'                     => new sfValidatorInteger(),
      'soft_binder_syndrome'            => new sfValidatorInteger(array('required' => false)),
      'gauge'                           => new sfValidatorInteger(),
      'color'                           => new sfValidatorInteger(),
      'colorfade'                       => new sfValidatorInteger(array('required' => false)),
      'soundtrackformat'                => new sfValidatorInteger(array('required' => false)),
      'substrate'                       => new sfValidatorInteger(),
      'strongodor'                      => new sfValidatorInteger(array('required' => false)),
      'vinegarodor'                     => new sfValidatorInteger(array('required' => false)),
      'adstriplevel'                    => new sfValidatorInteger(array('required' => false)),
      'shrinkage'                       => new sfValidatorInteger(array('required' => false)),
      'levelofshrinkage'                => new sfValidatorInteger(array('required' => false)),
      'rust'                            => new sfValidatorInteger(array('required' => false)),
      'discoloration'                   => new sfValidatorInteger(array('required' => false)),
      'surfaceblisteringbubbling'       => new sfValidatorInteger(array('required' => false)),
      'thintape'                        => new sfValidatorInteger(array('required' => false)),
      '1993orearlier'                   => new sfValidatorInteger(array('required' => false)),
      'datagradetape'                   => new sfValidatorInteger(array('required' => false)),
      'longplay32k96k'                  => new sfValidatorInteger(array('required' => false)),
      'corrosionrustoxidation'          => new sfValidatorInteger(array('required' => false)),
      'composition'                     => new sfValidatorInteger(array('required' => false)),
      'nonstandardbrand'                => new sfValidatorInteger(array('required' => false)),
      'trackconfiguration'              => new sfValidatorInteger(),
      'tapethickness'                   => new sfValidatorInteger(array('required' => false)),
      'speed'                           => new sfValidatorInteger(),
      'softbindersyndrome'              => new sfValidatorInteger(array('required' => false)),
      'materialsbreakdown'              => new sfValidatorInteger(array('required' => false)),
      'physicaldamage'                  => new sfValidatorInteger(array('required' => false)),
      'delamination'                    => new sfValidatorInteger(array('required' => false)),
      'plasticizerexudation'            => new sfValidatorInteger(array('required' => false)),
      'recordinglayer'                  => new sfValidatorInteger(),
      'recordingspeed'                  => new sfValidatorInteger(),
      'cylindertype'                    => new sfValidatorInteger(),
      'reflectivelayer'                 => new sfValidatorInteger(),
      'datalayer'                       => new sfValidatorInteger(),
      'opticaldisctype'                 => new sfValidatorInteger(),
      'format'                          => new sfValidatorInteger(),
      'recordingstandard'               => new sfValidatorInteger(),
      'publicationyear'                 => new sfValidatorDate(),
      'capacitylayers'                  => new sfValidatorInteger(),
      'codec'                           => new sfValidatorInteger(),
      'datarate'                        => new sfValidatorInteger(),
      'sheddingsoftbinder'              => new sfValidatorInteger(array('required' => false)),
      'formatversion'                   => new sfValidatorInteger(),
      'oxide'                           => new sfValidatorInteger(),
      'bindersystem'                    => new sfValidatorInteger(),
      'reelsize'                        => new sfValidatorInteger(),
      'whiteresidue'                    => new sfValidatorInteger(array('required' => false)),
      'size'                            => new sfValidatorInteger(),
      'formattypedvideorecordingformat' => new sfValidatorInteger(),
      'bitrate'                         => new sfValidatorInteger(array('required' => false)),
      'scanning'                        => new sfValidatorInteger(),
      'created_at'                      => new sfValidatorDateTime(),
      'updated_at'                      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('pressed78_rpm_disc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pressed78RPMDisc';
  }

}
