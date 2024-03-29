<?php

/**
 * AssetGroup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Nouman Tayyab
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class AssetGroup extends BaseAssetGroup {

    /**
     * calcuate the format duration
     * 
     * @param integer $formatID
     * @return integer 
     */
    public function getDuration($formatID) {
        $totalDuration = 0;

        $formatType = Doctrine_Query::Create()
                ->from('FormatType ft')
                ->select('ft.*')
                ->where('ft.id  = ?', $formatID)
                ->fetchArray();
        if (sizeof($formatType) > 0)
            $totalDuration = $totalDuration + $formatType[0]['duration'];




        return minutesToHour::ConvertMinutes2Hours($totalDuration);
    }

    /**
     * calcuate the format duration
     * 
     * @param integer $formatID
     * @return integer 
     */
    public function getDurationRealTime($formatID) {
        $totalDuration = 0;

        $formatType = Doctrine_Query::Create()
                ->from('FormatType ft')
                ->select('ft.*')
                ->where('ft.id  = ?', $formatID)
                ->fetchArray();
        if (sizeof($formatType) > 0)
            $totalDuration = $totalDuration + $formatType[0]['duration'];
        return minutesToHour::ConvertMinutes2HoursRealTime($totalDuration);
    }

    /**
     *   
     * get the Mediscore Score
     * @param int $collectionID
     * @param float $start_score
     * @param float $end_score
     * @return array of Assets
     * */
    public function getMediaScoreScoreRealTime($formatID, $start_score, $end_score) {
        $formatType = Doctrine_Query::Create()
                ->from('FormatType ft')
                ->select('ft.*')
                ->where('ft.id  = ?', $formatID)
                ->andWhere('(CAST(ft.asset_score as DECIMAL(3,2))) >= ?', $start_score)
                ->andWhere('(CAST(ft.asset_score as DECIMAL(3,2)))  <= ?', $end_score)
                ->fetchArray();

        return $formatType;
    }

    /**
     * getStorageLocationsRealTime
     * Retrun Asset's Collection's Storage Location
     * 
     * @param int $StorageLocationId
     * @return array Units_Storage_Location
     */
    public function getStorageLocationsRealTime($StorageLocationId, $AssetId) {
        $assetGroup = Doctrine_Query::Create()
                ->from('AssetGroup ag')
                ->innerJoin('ag.Collection c')
                ->innerJoin('c.StorageLocations sl')
                ->whereIn('ag.id', $AssetId)
                ->andWhereIn('sl.id', $StorageLocationId)
                ->fetchArray();
        return $assetGroup;
    }

}
