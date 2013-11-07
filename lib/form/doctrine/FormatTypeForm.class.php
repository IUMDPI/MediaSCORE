<?php

/**
 * FormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FormatTypeForm extends BaseFormatTypeForm {

    public static $durationtype = array('' => 'Select', 0 => 'Calculated', 1 => 'estimated', 2 => 'max estimate');

    public function configure() {
        $this->setWidget('duration_type', new sfWidgetFormChoice(array('choices' => self::$durationtype), array('title' => 'Calculated is when it is known definitively. Estimate is when you have some evidence available to inform a best guess. If you have no evidence the max estimate is used based on the maximum media duration.')));
        $this->setWidget('generation', new sfWidgetFormChoice(array('choices' => MetalDisc::$generation)));
        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => 0)));
        $this->setWidget('year_recorded', new sfWidgetFormInputText(array(), array('title' => 'If a range, enter a midpoint or a significant year')));
        $this->setWidget('copies', new sfWidgetFormInputCheckbox(array(), array('title' => 'Check the box if copies exist')));
        $this->setWidget('other_contaminants', new sfWidgetFormInputCheckbox(array(), array('title' => 'Check the box if the object contains dirt, oil, powder, crystals, foreign objects or other particulate matter')));
        $this->setWidget('duration', new sfWidgetFormInputText(array(), array('onblur' => 'makeTime();', 'onfocus' => 'convertToMinutues();', 'title' => 'Enter the actual or estimated playback time for the collection or asset group. This is the total duration for the entire asset group, in minutes. Not the average number of minutes per item.')));
        $this->setWidget('duration_type_methodology', new sfWidgetFormInputText(array(), array('title' => 'Describe the methodology and evidence used to calculate duration')));
        $this->setWidget('format_notes', new sfWidgetFormTextarea(array()));

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
        $this->getWidget('format_notes')->setLabel('Notes:&nbsp;');


        $this->setValidator('quantity', new sfValidatorInteger(array('required' => true)));
        $this->setValidator('generation', new sfValidatorString(array('required' => true)));
//        $this->setValidator('year_recorded', new sfValidatorString(array('required' => true)));
        $this->setValidator('duration', new sfValidatorNumber(array('required' => true)));
        $this->setValidator('duration_type', new sfValidatorString(array('required' => true)));
        $this->setValidator('duration_type_methodology', new sfValidatorString(array('required' => false)));
        $this->setValidator('format_notes', new sfValidatorString(array('required' => false)));
        $this->getValidator('duration')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Please enter the duration in minutes using numbers only.'));
        $this->setValidator('year_recorded', new sfValidatorRegex(array('pattern' => "/^([\s-0-9]*|unknown|UNKNOWN)$/i"),
                        array('invalid' => 'Please enter the year in numbers or "unknown".'))
        );
        $this->setWidget('asset_score', new sfWidgetFormInputText(array(), array('style' => 'cursor:not-allowed;background: #E1E3ED !important;display:none;', 'readonly' => 'readonly')));

//$this->widgetSchema->moveField('asset_score', 'last');
//        $this->widgetSchema->moveField('asset_score', sfWidgetFormSchema::LAST);

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
