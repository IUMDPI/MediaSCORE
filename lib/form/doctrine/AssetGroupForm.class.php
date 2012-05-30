<?php

/**
 * AssetGroup form.
 *
 * @package    mediaSCORE
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AssetGroupForm extends BaseAssetGroupForm {

    /**
     * @see SubUnitForm
     */
    public function configure() {
        parent::configure();
        $this->setWidget('storage_location_id', new sfWidgetFormDoctrineChoice(array('model' => 'StorageLocation', 'add_empty' => false,
//                    'method' => 'getStorageLocations',
//                    'query' => Doctrine_Query::create()
//                            ->from('Collection c')
//                            ->where('c.id = ?', $this->getObject()->getParentNodeId())
                )));
        $this->setWidget('location', new sfWidgetFormInputText());
        $this->setValidator('storage_location_id', new sfValidatorString(array('required' => true)));


        $this->getValidator('storage_location_id')->setMessages(array('required' => 'This is a required field.',
            'invalid' => 'Invalid Unit Name'));

        $voidFields = array('created_at', 'updated_at', 'resident_structure_description', 'unit_personnel');
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
        $this->getWidget('storage_location_id')->setLabel('<span class="required">*</span>Storage Location:&nbsp;');
        $this->getValidator('storage_location_id')->setMessages(array('required' => 'Must select Storage Locations at the Unit Level. If the storage location record does not yet exist to select, you must create the storage location and then select it at the Unit level.',
            'invalid' => 'Invalid Unit Name'));
        foreach ($voidFields as $voidField) {
            unset($this->widgetSchema[$voidField]);
            unset($this->validatorSchema[$voidField]);
        }
        // 05/08/12
        // Temporary - Need user plug-in
        //$this->getWidget('creator_id')->setAttribute('value',1);


        $this->getWidget('type')->setAttribute('value', 4);
    }

}
