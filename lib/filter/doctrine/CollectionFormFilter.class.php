<?php

/**
 * Collection filter form.
 *
 * @package    mediaSCORE
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CollectionFormFilter extends BaseCollectionFormFilter
{
  /**
   * @see SubUnitFormFilter
   */
  public function configure()
  {
    parent::configure();
    unset(
                $this['inst_id'], 
            $this['creator_id'], 
            $this['last_editor_id'], 
            $this['type'], 
            $this['resident_structure_description'], 
            $this['parent_node_id'], 
            $this['status'],
            $this['location'], 
            $this['format_id'], 
            $this['storage_locations_list']
        );
  }
}
