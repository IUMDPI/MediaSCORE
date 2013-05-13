<?php

/**
 * OpenReelAudiotapePVC filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOpenReelAudiotapePVCFormFilter extends OpenReelAudioTapeFormatTypeFormFilter {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('open_reel_audiotape_pvc_filters[%s]');
    }

    public function getModelName() {
        return 'OpenReelAudiotapePVC';
    }

}
