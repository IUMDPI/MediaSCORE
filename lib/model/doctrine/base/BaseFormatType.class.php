<?php

/**
 * BaseFormatType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $quantity
 * @property integer $generation
 * @property string $year_recorded
 * @property boolean $copies
 * @property string $stock_brand
 * @property boolean $off_brand
 * @property boolean $fungus
 * @property boolean $other_contaminants
 * @property string $duration
 * @property string $duration_type
 * @property string $duration_type_methodology
 * @property text $format_notes
 * @property string $type
 * @property integer $material
 * @property boolean $oxidationCorrosion
 * @property integer $pack_deformation
 * @property boolean $noise_reduction
 * @property integer $tape_type
 * @property boolean $thin_tape
 * @property boolean $slow_speed
 * @property integer $sound_field
 * @property integer $soft_binder_syndrome
 * @property integer $gauge
 * @property integer $color
 * @property boolean $colorFade
 * @property integer $soundtrackFormat
 * @property integer $substrate
 * @property boolean $strongOdor
 * @property boolean $vinegarOdor
 * @property integer $ADStripLevel
 * @property boolean $shrinkage
 * @property integer $levelOfShrinkage
 * @property boolean $rust
 * @property boolean $discoloration
 * @property boolean $surfaceBlisteringBubbling
 * @property boolean $thinTape
 * @property boolean $1993OrEarlier
 * @property boolean $dataGradeTape
 * @property boolean $longPlay32K96K
 * @property boolean $corrosionRustOxidation
 * @property integer $composition
 * @property boolean $nonStandardBrand
 * @property integer $trackConfiguration
 * @property integer $tapeThickness
 * @property string $speed
 * @property boolean $softBinderSyndrome
 * @property boolean $materialsBreakdown
 * @property integer $physicalDamage
 * @property boolean $delamination
 * @property boolean $plasticizerExudation
 * @property integer $recordingLayer
 * @property integer $recordingSpeed
 * @property integer $cylinderType
 * @property string $reflectiveLayer
 * @property string $dataLayer
 * @property integer $opticalDiscType
 * @property integer $format
 * @property integer $recordingStandard
 * @property date $publicationYear
 * @property integer $capacityLayers
 * @property string $codec
 * @property string $dataRate
 * @property boolean $sheddingSoftBinder
 * @property integer $formatVersion
 * @property integer $oxide
 * @property integer $binderSystem
 * @property string $reelSize
 * @property boolean $whiteResidue
 * @property integer $size
 * @property integer $formatTypedVideoRecordingFormat
 * @property string $bitrate
 * @property integer $scanning
 * @property Doctrine_Collection $heldByAssetGroups
 * 
 * @method integer             getQuantity()                        Returns the current record's "quantity" value
 * @method integer             getGeneration()                      Returns the current record's "generation" value
 * @method string              getYearRecorded()                    Returns the current record's "year_recorded" value
 * @method boolean             getCopies()                          Returns the current record's "copies" value
 * @method string              getStockBrand()                      Returns the current record's "stock_brand" value
 * @method boolean             getOffBrand()                        Returns the current record's "off_brand" value
 * @method boolean             getFungus()                          Returns the current record's "fungus" value
 * @method boolean             getOtherContaminants()               Returns the current record's "other_contaminants" value
 * @method string              getDuration()                        Returns the current record's "duration" value
 * @method string              getDurationType()                    Returns the current record's "duration_type" value
 * @method string              getDurationTypeMethodology()         Returns the current record's "duration_type_methodology" value
 * @method text                getFormatNotes()                     Returns the current record's "format_notes" value
 * @method string              getType()                            Returns the current record's "type" value
 * @method integer             getMaterial()                        Returns the current record's "material" value
 * @method boolean             getOxidationCorrosion()              Returns the current record's "oxidationCorrosion" value
 * @method integer             getPackDeformation()                 Returns the current record's "pack_deformation" value
 * @method boolean             getNoiseReduction()                  Returns the current record's "noise_reduction" value
 * @method integer             getTapeType()                        Returns the current record's "tape_type" value
 * @method boolean             getThinTape()                        Returns the current record's "thin_tape" value
 * @method boolean             getSlowSpeed()                       Returns the current record's "slow_speed" value
 * @method integer             getSoundField()                      Returns the current record's "sound_field" value
 * @method integer             getSoftBinderSyndrome()              Returns the current record's "soft_binder_syndrome" value
 * @method integer             getGauge()                           Returns the current record's "gauge" value
 * @method integer             getColor()                           Returns the current record's "color" value
 * @method boolean             getColorFade()                       Returns the current record's "colorFade" value
 * @method integer             getSoundtrackFormat()                Returns the current record's "soundtrackFormat" value
 * @method integer             getSubstrate()                       Returns the current record's "substrate" value
 * @method boolean             getStrongOdor()                      Returns the current record's "strongOdor" value
 * @method boolean             getVinegarOdor()                     Returns the current record's "vinegarOdor" value
 * @method integer             getADStripLevel()                    Returns the current record's "ADStripLevel" value
 * @method boolean             getShrinkage()                       Returns the current record's "shrinkage" value
 * @method integer             getLevelOfShrinkage()                Returns the current record's "levelOfShrinkage" value
 * @method boolean             getRust()                            Returns the current record's "rust" value
 * @method boolean             getDiscoloration()                   Returns the current record's "discoloration" value
 * @method boolean             getSurfaceBlisteringBubbling()       Returns the current record's "surfaceBlisteringBubbling" value
 * @method boolean             getThinTape()                        Returns the current record's "thinTape" value
 * @method boolean             get1993OrEarlier()                   Returns the current record's "1993OrEarlier" value
 * @method boolean             getDataGradeTape()                   Returns the current record's "dataGradeTape" value
 * @method boolean             getLongPlay32K96K()                  Returns the current record's "longPlay32K96K" value
 * @method boolean             getCorrosionRustOxidation()          Returns the current record's "corrosionRustOxidation" value
 * @method integer             getComposition()                     Returns the current record's "composition" value
 * @method boolean             getNonStandardBrand()                Returns the current record's "nonStandardBrand" value
 * @method integer             getTrackConfiguration()              Returns the current record's "trackConfiguration" value
 * @method integer             getTapeThickness()                   Returns the current record's "tapeThickness" value
 * @method string              getSpeed()                           Returns the current record's "speed" value
 * @method boolean             getSoftBinderSyndrome()              Returns the current record's "softBinderSyndrome" value
 * @method boolean             getMaterialsBreakdown()              Returns the current record's "materialsBreakdown" value
 * @method integer             getPhysicalDamage()                  Returns the current record's "physicalDamage" value
 * @method boolean             getDelamination()                    Returns the current record's "delamination" value
 * @method boolean             getPlasticizerExudation()            Returns the current record's "plasticizerExudation" value
 * @method integer             getRecordingLayer()                  Returns the current record's "recordingLayer" value
 * @method integer             getRecordingSpeed()                  Returns the current record's "recordingSpeed" value
 * @method integer             getCylinderType()                    Returns the current record's "cylinderType" value
 * @method string              getReflectiveLayer()                 Returns the current record's "reflectiveLayer" value
 * @method string              getDataLayer()                       Returns the current record's "dataLayer" value
 * @method integer             getOpticalDiscType()                 Returns the current record's "opticalDiscType" value
 * @method integer             getFormat()                          Returns the current record's "format" value
 * @method integer             getRecordingStandard()               Returns the current record's "recordingStandard" value
 * @method date                getPublicationYear()                 Returns the current record's "publicationYear" value
 * @method integer             getCapacityLayers()                  Returns the current record's "capacityLayers" value
 * @method string              getCodec()                           Returns the current record's "codec" value
 * @method string              getDataRate()                        Returns the current record's "dataRate" value
 * @method boolean             getSheddingSoftBinder()              Returns the current record's "sheddingSoftBinder" value
 * @method integer             getFormatVersion()                   Returns the current record's "formatVersion" value
 * @method integer             getOxide()                           Returns the current record's "oxide" value
 * @method integer             getBinderSystem()                    Returns the current record's "binderSystem" value
 * @method string              getReelSize()                        Returns the current record's "reelSize" value
 * @method boolean             getWhiteResidue()                    Returns the current record's "whiteResidue" value
 * @method integer             getSize()                            Returns the current record's "size" value
 * @method integer             getFormatTypedVideoRecordingFormat() Returns the current record's "formatTypedVideoRecordingFormat" value
 * @method string              getBitrate()                         Returns the current record's "bitrate" value
 * @method integer             getScanning()                        Returns the current record's "scanning" value
 * @method Doctrine_Collection getHeldByAssetGroups()               Returns the current record's "heldByAssetGroups" collection
 * @method FormatType          setQuantity()                        Sets the current record's "quantity" value
 * @method FormatType          setGeneration()                      Sets the current record's "generation" value
 * @method FormatType          setYearRecorded()                    Sets the current record's "year_recorded" value
 * @method FormatType          setCopies()                          Sets the current record's "copies" value
 * @method FormatType          setStockBrand()                      Sets the current record's "stock_brand" value
 * @method FormatType          setOffBrand()                        Sets the current record's "off_brand" value
 * @method FormatType          setFungus()                          Sets the current record's "fungus" value
 * @method FormatType          setOtherContaminants()               Sets the current record's "other_contaminants" value
 * @method FormatType          setDuration()                        Sets the current record's "duration" value
 * @method FormatType          setDurationType()                    Sets the current record's "duration_type" value
 * @method FormatType          setDurationTypeMethodology()         Sets the current record's "duration_type_methodology" value
 * @method FormatType          setFormatNotes()                     Sets the current record's "format_notes" value
 * @method FormatType          setType()                            Sets the current record's "type" value
 * @method FormatType          setMaterial()                        Sets the current record's "material" value
 * @method FormatType          setOxidationCorrosion()              Sets the current record's "oxidationCorrosion" value
 * @method FormatType          setPackDeformation()                 Sets the current record's "pack_deformation" value
 * @method FormatType          setNoiseReduction()                  Sets the current record's "noise_reduction" value
 * @method FormatType          setTapeType()                        Sets the current record's "tape_type" value
 * @method FormatType          setThinTape()                        Sets the current record's "thin_tape" value
 * @method FormatType          setSlowSpeed()                       Sets the current record's "slow_speed" value
 * @method FormatType          setSoundField()                      Sets the current record's "sound_field" value
 * @method FormatType          setSoftBinderSyndrome()              Sets the current record's "soft_binder_syndrome" value
 * @method FormatType          setGauge()                           Sets the current record's "gauge" value
 * @method FormatType          setColor()                           Sets the current record's "color" value
 * @method FormatType          setColorFade()                       Sets the current record's "colorFade" value
 * @method FormatType          setSoundtrackFormat()                Sets the current record's "soundtrackFormat" value
 * @method FormatType          setSubstrate()                       Sets the current record's "substrate" value
 * @method FormatType          setStrongOdor()                      Sets the current record's "strongOdor" value
 * @method FormatType          setVinegarOdor()                     Sets the current record's "vinegarOdor" value
 * @method FormatType          setADStripLevel()                    Sets the current record's "ADStripLevel" value
 * @method FormatType          setShrinkage()                       Sets the current record's "shrinkage" value
 * @method FormatType          setLevelOfShrinkage()                Sets the current record's "levelOfShrinkage" value
 * @method FormatType          setRust()                            Sets the current record's "rust" value
 * @method FormatType          setDiscoloration()                   Sets the current record's "discoloration" value
 * @method FormatType          setSurfaceBlisteringBubbling()       Sets the current record's "surfaceBlisteringBubbling" value
 * @method FormatType          setThinTape()                        Sets the current record's "thinTape" value
 * @method FormatType          set1993OrEarlier()                   Sets the current record's "1993OrEarlier" value
 * @method FormatType          setDataGradeTape()                   Sets the current record's "dataGradeTape" value
 * @method FormatType          setLongPlay32K96K()                  Sets the current record's "longPlay32K96K" value
 * @method FormatType          setCorrosionRustOxidation()          Sets the current record's "corrosionRustOxidation" value
 * @method FormatType          setComposition()                     Sets the current record's "composition" value
 * @method FormatType          setNonStandardBrand()                Sets the current record's "nonStandardBrand" value
 * @method FormatType          setTrackConfiguration()              Sets the current record's "trackConfiguration" value
 * @method FormatType          setTapeThickness()                   Sets the current record's "tapeThickness" value
 * @method FormatType          setSpeed()                           Sets the current record's "speed" value
 * @method FormatType          setSoftBinderSyndrome()              Sets the current record's "softBinderSyndrome" value
 * @method FormatType          setMaterialsBreakdown()              Sets the current record's "materialsBreakdown" value
 * @method FormatType          setPhysicalDamage()                  Sets the current record's "physicalDamage" value
 * @method FormatType          setDelamination()                    Sets the current record's "delamination" value
 * @method FormatType          setPlasticizerExudation()            Sets the current record's "plasticizerExudation" value
 * @method FormatType          setRecordingLayer()                  Sets the current record's "recordingLayer" value
 * @method FormatType          setRecordingSpeed()                  Sets the current record's "recordingSpeed" value
 * @method FormatType          setCylinderType()                    Sets the current record's "cylinderType" value
 * @method FormatType          setReflectiveLayer()                 Sets the current record's "reflectiveLayer" value
 * @method FormatType          setDataLayer()                       Sets the current record's "dataLayer" value
 * @method FormatType          setOpticalDiscType()                 Sets the current record's "opticalDiscType" value
 * @method FormatType          setFormat()                          Sets the current record's "format" value
 * @method FormatType          setRecordingStandard()               Sets the current record's "recordingStandard" value
 * @method FormatType          setPublicationYear()                 Sets the current record's "publicationYear" value
 * @method FormatType          setCapacityLayers()                  Sets the current record's "capacityLayers" value
 * @method FormatType          setCodec()                           Sets the current record's "codec" value
 * @method FormatType          setDataRate()                        Sets the current record's "dataRate" value
 * @method FormatType          setSheddingSoftBinder()              Sets the current record's "sheddingSoftBinder" value
 * @method FormatType          setFormatVersion()                   Sets the current record's "formatVersion" value
 * @method FormatType          setOxide()                           Sets the current record's "oxide" value
 * @method FormatType          setBinderSystem()                    Sets the current record's "binderSystem" value
 * @method FormatType          setReelSize()                        Sets the current record's "reelSize" value
 * @method FormatType          setWhiteResidue()                    Sets the current record's "whiteResidue" value
 * @method FormatType          setSize()                            Sets the current record's "size" value
 * @method FormatType          setFormatTypedVideoRecordingFormat() Sets the current record's "formatTypedVideoRecordingFormat" value
 * @method FormatType          setBitrate()                         Sets the current record's "bitrate" value
 * @method FormatType          setScanning()                        Sets the current record's "scanning" value
 * @method FormatType          setHeldByAssetGroups()               Sets the current record's "heldByAssetGroups" collection
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Nouman Tayyab
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFormatType extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('format_type');
        $this->hasColumn('quantity', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('generation', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('year_recorded', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('copies', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('stock_brand', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('off_brand', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('fungus', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('other_contaminants', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('duration', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('duration_type', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('duration_type_methodology', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('format_notes', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('type', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('material', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('oxidationCorrosion', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             ));
        $this->hasColumn('pack_deformation', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('noise_reduction', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             ));
        $this->hasColumn('tape_type', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('thin_tape', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('slow_speed', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('sound_field', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('soft_binder_syndrome', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('gauge', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('color', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('colorFade', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('soundtrackFormat', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('substrate', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('strongOdor', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('vinegarOdor', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ADStripLevel', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('shrinkage', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('levelOfShrinkage', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('rust', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('discoloration', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('surfaceBlisteringBubbling', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('thinTape', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('1993OrEarlier', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('dataGradeTape', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('longPlay32K96K', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('corrosionRustOxidation', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('composition', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('nonStandardBrand', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('trackConfiguration', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('tapeThickness', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('speed', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('softBinderSyndrome', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('materialsBreakdown', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('physicalDamage', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('delamination', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('plasticizerExudation', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('recordingLayer', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('recordingSpeed', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('cylinderType', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('reflectiveLayer', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('dataLayer', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('opticalDiscType', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('format', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('recordingStandard', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('publicationYear', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('capacityLayers', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('codec', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('dataRate', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('sheddingSoftBinder', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('formatVersion', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('oxide', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('binderSystem', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('reelSize', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('whiteResidue', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('size', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('formatTypedVideoRecordingFormat', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('bitrate', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('scanning', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));

        $this->setSubClasses(array(
             'MetalDisc' => 
             array(
              'type' => 1,
             ),
             'ReelCassetteFormatType' => 
             array(
              'type' => 2,
             ),
             'AudiotapeFormatType' => 
             array(
              'type' => 3,
             ),
             'AnalogAudiocassette' => 
             array(
              'type' => 4,
             ),
             'Film' => 
             array(
              'type' => 5,
             ),
             'DAT' => 
             array(
              'type' => 6,
             ),
             'SoundWireReel' => 
             array(
              'type' => 7,
             ),
             'OpenReelAudioTapeFormatType' => 
             array(
              'type' => 8,
             ),
             'OpenReelAudiotapePolyster' => 
             array(
              'type' => 9,
             ),
             'OpenReelAudiotapeAcetate' => 
             array(
              'type' => 10,
             ),
             'OpenReelAudiotapePaper' => 
             array(
              'type' => 11,
             ),
             'OpenReelAudiotapePVC' => 
             array(
              'type' => 12,
             ),
             'DiskFormatType' => 
             array(
              'type' => 13,
             ),
             'SoftDiskFormatType' => 
             array(
              'type' => 14,
             ),
             'LacquerDisc' => 
             array(
              'type' => 15,
             ),
             'MiniDisc' => 
             array(
              'type' => 16,
             ),
             'Cylinder' => 
             array(
              'type' => 17,
             ),
             'OpticalDiscFormatType' => 
             array(
              'type' => 18,
             ),
             'SoundOpticalDisc' => 
             array(
              'type' => 19,
             ),
             'OpticalVideo' => 
             array(
              'type' => 20,
             ),
             'PressedAudioDiscFormatType' => 
             array(
              'type' => 21,
             ),
             'PressedSeventyEightRPMDisc' => 
             array(
              'type' => 22,
             ),
             'PressedLPDisc' => 
             array(
              'type' => 23,
             ),
             'PressedFortyFiveRPMDisc' => 
             array(
              'type' => 24,
             ),
             'StandardizedRecordingFormatType' => 
             array(
              'type' => 25,
             ),
             'Laserdisc' => 
             array(
              'type' => 26,
             ),
             'XDCamOptical' => 
             array(
              'type' => 27,
             ),
             'VideoRecordingFormatType' => 
             array(
              'type' => 28,
             ),
             'Betamax' => 
             array(
              'type' => 29,
             ),
             'ReelVideoRecordingFormatType' => 
             array(
              'type' => 30,
             ),
             'EightMM' => 
             array(
              'type' => 31,
             ),
             'OpenReelVideoFormatType' => 
             array(
              'type' => 32,
             ),
             'TwoInchOpenReelVideo' => 
             array(
              'type' => 33,
             ),
             'OneInchOpenReelVideo' => 
             array(
              'type' => 34,
             ),
             'HalfInchOpenReelVideo' => 
             array(
              'type' => 35,
             ),
             'SizedVideoRecordingFormatType' => 
             array(
              'type' => 36,
             ),
             'DV' => 
             array(
              'type' => 37,
             ),
             'DVCam' => 
             array(
              'type' => 38,
             ),
             'FormatTypedVideoRecording' => 
             array(
              'type' => 39,
             ),
             'Betacam' => 
             array(
              'type' => 40,
             ),
             'VHS' => 
             array(
              'type' => 41,
             ),
             'DigitalBetacam' => 
             array(
              'type' => 42,
             ),
             'FormatVersionedVideoRecordingType' => 
             array(
              'type' => 43,
             ),
             'Umatic' => 
             array(
              'type' => 44,
             ),
             'HDCam' => 
             array(
              'type' => 45,
             ),
             'DVCPro' => 
             array(
              'type' => 46,
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('AssetGroup as heldByAssetGroups', array(
             'local' => 'id',
             'foreign' => 'format_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}