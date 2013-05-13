<?php

/**
 * AudiotapeFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AudiotapeFormatTypeForm extends BaseAudiotapeFormatTypeForm {

    /**
     * @see ReelCassetteFormatTypeForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('noise_reduction', new sfWidgetFormInputCheckbox());
        $this->setValidator('noise_reduction', new sfValidatorString(array('required' => false)));
    }

}
