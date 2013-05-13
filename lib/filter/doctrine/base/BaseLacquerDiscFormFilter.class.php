<?php

/**
 * LacquerDisc filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLacquerDiscFormFilter extends SoftDiskFormatTypeFormFilter {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('lacquer_disc_filters[%s]');
    }

    public function getModelName() {
        return 'LacquerDisc';
    }

}
