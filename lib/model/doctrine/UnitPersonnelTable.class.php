<?php

class UnitPersonnelTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('UnitPersonnel');
    }

}
