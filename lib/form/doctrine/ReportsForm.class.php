<?php

/**
 * Reports form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReportsForm extends BaseReportsForm {

    public function configure() {
        $this->setWidget('listUnits', new sfWidgetFormDoctrineChoice(array('model' => 'Unit', method => 'getName', 'add_empty' => true)));
    }

}
