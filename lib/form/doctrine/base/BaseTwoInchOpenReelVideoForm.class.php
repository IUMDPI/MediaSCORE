<?php

/**
 * TwoInchOpenReelVideo form base class.
 *
 * @method TwoInchOpenReelVideo getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTwoInchOpenReelVideoForm extends OpenReelVideoFormatTypeForm {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('two_inch_open_reel_video[%s]');
    }

    public function getModelName() {
        return 'TwoInchOpenReelVideo';
    }

}
