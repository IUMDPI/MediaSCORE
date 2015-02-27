<?php

/**
 * BaseCharacteristicsFormat
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $format_id
 * @property string $format_c_name
 * @property FormatType $FormatType
 * @property Doctrine_Collection $CharacteristicsValues
 * 
 * @method integer               getFormatId()              Returns the current record's "format_id" value
 * @method string                getFormatCName()           Returns the current record's "format_c_name" value
 * @method FormatType            getFormatType()            Returns the current record's "FormatType" value
 * @method Doctrine_Collection   getCharacteristicsValues() Returns the current record's "CharacteristicsValues" collection
 * @method CharacteristicsFormat setFormatId()              Sets the current record's "format_id" value
 * @method CharacteristicsFormat setFormatCName()           Sets the current record's "format_c_name" value
 * @method CharacteristicsFormat setFormatType()            Sets the current record's "FormatType" value
 * @method CharacteristicsFormat setCharacteristicsValues() Sets the current record's "CharacteristicsValues" collection
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Nouman Tayyab
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCharacteristicsFormat extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('characteristics_format');
        $this->hasColumn('format_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('format_c_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => 'ture',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('FormatType', array(
             'local' => 'format_id',
             'foreign' => 'id'));

        $this->hasMany('CharacteristicsValues', array(
             'local' => 'id',
             'foreign' => 'parent_characteristic_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}