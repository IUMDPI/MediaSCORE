<?php

/**
 * Collection filter form base class.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Nouman Tayyab
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCollectionFormFilter extends SubUnitFormFilter {

    protected function setupInheritance() {
        parent::setupInheritance();

        $this->widgetSchema ['storage_locations_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'StorageLocation'));
        $this->validatorSchema['storage_locations_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'StorageLocation', 'required' => false));

        $this->widgetSchema->setNameFormat('collection_filters[%s]');
    }

    public function addStorageLocationsListColumnQuery(Doctrine_Query $query, $field, $values) {
        if (!is_array($values)) {
            $values = array($values);
        }

        if (!count($values)) {
            return;
        }

        $query
                ->leftJoin($query->getRootAlias() . '.CollectionStorageLocation CollectionStorageLocation')
                ->andWhereIn('CollectionStorageLocation.storage_location_id', $values)
        ;
    }

    public function getModelName() {
        return 'Collection';
    }

    public function getFields() {
        return array_merge(parent::getFields(), array(
                    'storage_locations_list' => 'ManyKey',
                ));
    }

}
