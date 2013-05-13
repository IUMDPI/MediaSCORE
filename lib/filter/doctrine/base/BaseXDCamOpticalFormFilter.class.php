<?php

/**
 * XDCamOptical filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseXDCamOpticalFormFilter extends StandardizedRecordingFormatTypeFormFilter {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('xd_cam_optical_filters[%s]');
    }

    public function getModelName() {
        return 'XDCamOptical';
    }

}
