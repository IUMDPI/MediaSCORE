<?php

/**
 * Collection
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Collection extends BaseCollection
{

	public static $statusConstants = array('' => 'Select', 0 => 'Incomplete', 1 => 'In Progress', 2 => 'Completed');

	/**
	 * get slug of a unit 
	 * 
	 * @return string 
	 */
	public function getUnitSlug()
	{
		$unit = Doctrine_Query::Create()
		->from('Unit u')
		->select('u.*')
		->where('u.id  = ?', $this->getParentNodeId())
		->fetchOne();
		return $unit->getNameSlug();
	}

	/**
	 *
	 * 
	 * @return string 
	 */
	public function getCollectionSlug()
	{
		return urlSlug::slugify($this->getName());
	}

	/**
	 *
	 * 
	 * @param integer $collectionID
	 * @return string 
	 */
	public function getDuration($collectionID)
	{
		$totalDuration = 0;
		$assetGroup = Doctrine_Query::Create()
		->from('AssetGroup ag')
		->select('ag.id,ft.duration')
		->innerJoin('ag.FormatType ft')
		->where('ag.parent_node_id  = ?', $collectionID)
		->fetchArray();

		if (sizeof($assetGroup) > 0)
		{
			foreach ($assetGroup as $key => $value)
			{
				$totalDuration = $totalDuration + $value['FormatType']['duration'];
			}
		}


		return minutesToHour::ConvertMinutes2Hours($totalDuration);
	}

	static public function getCollectionNameCustom($add_values = NULL)
	{
		$Collections = Doctrine_Query::Create()
		->from('Collection c')
		->select('c.*,sl.*')
		->fetchArray();
		$CollectionArray = array();

		foreach ($Collections as $Collection)
		{
//            var_dump($Unit);
//            exit;
			$CollectionArray[$Collection['id']] = $Collection['name'];
		}

		if ($add_values)
		{
			$CollectionArray[0] = $add_values;
		}
		ksort($CollectionArray);
		return $CollectionArray;
	}

}
