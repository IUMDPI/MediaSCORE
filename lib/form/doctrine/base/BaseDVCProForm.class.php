<?php

/**
 * DVCPro form base class.
 *
 * @method DVCPro getObject() Returns the current form's model object
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDVCProForm extends FormatVersionedVideoRecordingTypeForm {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema->setNameFormat('dvc_pro[%s]');
    }

    public function getModelName() {
        return 'DVCPro';
    }

}
