<?php

/**
 * AssetGroup form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AssetGroupForm extends BaseAssetGroupForm {

    /**
     * @see SubUnitForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('resident_structure_description', new sfWidgetFormDoctrineChoice(array('model' => 'StorageLocation', 'add_empty' => false,
//                    'method' => 'getStorageLocations',
//                    'query' => Doctrine_Query::create()
//                            ->from('Collection c')
//                            ->where('c.id = ?', $this->getObject()->getParentNodeId())
                )));
        $this->setWidget('location', new sfWidgetFormInputText());
        $this->setValidator('resident_structure_description', new sfValidatorString(array('required' => true)));




        $voidFields = array('created_at', 'updated_at', 'storage_location_id', 'unit_personnel', 'name_slug');
        foreach (array('format_id', 'parent_node_id', 'type') as $hiddenField)
            $this->setWidget($hiddenField, new sfWidgetFormInputHidden());

        $this->getWidget('parent_node_id')->setAttribute('value', $this->getOption('collectionID'));

        if ($this->getOption('action') == 'edit')
            $voidFields[] = 'creator_id';
        else
            $this->setWidget('creator_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('creatorID'))));

        $this->setWidget('last_editor_id', new sfWidgetFormInputHidden(array(), array('value' => $this->getOption('creatorID'))));


        $this->getWidget('inst_id')->setLabel('<span class="required">*</span>Primary ID:&nbsp;');
        $this->getWidget('name')->setLabel('<span class="required">*</span>Name:&nbsp;');
        $this->getWidget('location')->setLabel('Location in room:&nbsp;');
        $this->getWidget('resident_structure_description')->setLabel('<span class="required">*</span>Storage Location:&nbsp;');
        $this->getValidator('resident_structure_description')->setMessages(array('required' => 'Must select Storage Locations at the Unit Level. If the storage location record does not yet exist to select, you must create the storage location and then select it at the Unit level.',
            'invalid' => 'Invalid Unit Name'));
        foreach ($voidFields as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }



        $this->getWidget('type')->setAttribute('value', 4);
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {



        parent::bind($taintedValues, $taintedFiles);
    }

}
