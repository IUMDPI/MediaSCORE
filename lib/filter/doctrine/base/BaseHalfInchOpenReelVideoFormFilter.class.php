<?php

/**
 * HalfInchOpenReelVideo filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHalfInchOpenReelVideoFormFilter extends OpenReelVideoFormatTypeFormFilter {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('half_inch_open_reel_video_filters[%s]');
    }

    public function getModelName() {
        return 'HalfInchOpenReelVideo';
    }

}
