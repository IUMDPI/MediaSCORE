<?php

/**
 * OpenReelVideoFormatType form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OpenReelVideoFormatTypeForm extends BaseOpenReelVideoFormatTypeForm {

    /**
     * @see ReelVideoRecordingFormatTypeForm
     */
    public function configure() {
        parent::configure();

        $this->setWidget('type', new sfWidgetFormInputHidden(array(), array('value' => $this->getObject()->getTypeValue())));
    }

}
