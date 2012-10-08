<?php

/**
 * ReelCassetteFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReelCassetteFormatTypeForm extends BaseReelCassetteFormatTypeForm {

    /**
     * @see FormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('pack_deformation', new sfWidgetFormChoice(array('choices' => ReelCassetteFormatType::$constants, 'expanded' => true), array('title' => 'Note presence of tangles, knots, and/or breaks', 'class' => 'override_required')));
        $this->setValidator('pack_deformation', new sfValidatorString(array('required' => true)));
        $this->getWidget('pack_deformation')->setLabel('<span class="required">*</span>Pack Deformation:&nbsp;');
//          $this->setValidator('packDeformation', new sfValidatorChoice(array('choices' => ReelCassetteFormatType::$constants)));
        $this->setDefault('pack_deformation', -1);
    }

}
