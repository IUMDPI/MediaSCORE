<?php

/**
 * SoundWireReel form base class.
 *
 * @method SoundWireReel getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSoundWireReelForm extends ReelCassetteFormatTypeForm {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('sound_wire_reel[%s]');
    }

    public function getModelName() {
        return 'SoundWireReel';
    }

}
