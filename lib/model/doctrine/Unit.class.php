<?php

/**
 * Unit
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    mediaSCORE
 * @subpackage model
 * @author     Nouman Tayyab
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Unit extends BaseUnit
{

	/**
	 * get the duration
	 * 
	 * @param integer $unitID
	 * @return string 
	 */
	public function getDuration($unitID)
	{
		$totalDuration = 0;
		$collection = Doctrine_Query::Create()
		->from('AssetGroup ag')
		->select('c.id,ag.id,ft.duration')
		->innerJoin('ag.Collection c')
		->innerJoin('ag.FormatType ft')
		->where('c.parent_node_id  = ?', $unitID)
		->fetchArray();
		if (sizeof($collection) > 0)
		{
			foreach ($collection as $key => $value)
			{
				$totalDuration = $totalDuration + $value['FormatType']['duration'];
			}
		}

		return minutesToHour::ConvertMinutes2Hours($totalDuration);
	}

	static public function getSearchResults($params, $user)
	{

		$join = '';
//		if ($user->getType() == 3)
//		{
//			$join .='INNER JOIN unit_person up ON up.unit_id=s.id AND s.type=1';
//		}
		$where = '';
		if (count($params['formats']) > 0)
			$where .= ' AND ft.type IN (' . implode(',', $params['formats']) . ')';
		if (count($params['store']) > 0)
			$where .= ' AND s.type IN (' . implode(',', $params['store']) . ')';
		if (count($params['location']) > 0)
		{
			$where .= ' AND (usl.storage_location_id IN (' . implode(',', $params['location']) . ')';
			$where .= ' OR  csl.storage_location_id IN (' . implode(',', $params['location']) . '))';
		}
		if (count($params['string']) > 0)
		{

			$where .= ' AND ( 1=1 ';
			foreach ($params['string'] as $index => $string)
			{
				if ( ! empty($string))
					$where .=" OR (s.name LIKE %{$string}%)";
			}
			$where .=')';
		}
//		if ($user->getType() == 3)
//		{
//			$where .=' AND up.person_id = ' . $user->getId();
//		}


		$query = "SELECT s.id FROM store s
	     	{$join}
			LEFT JOIN format_type ft ON ft.id=s.format_id AND s.type=4
			LEFT JOIN unit_storage_location usl on usl.unit_id=s.id AND s.type=1
			LEFT JOIN collection_storage_location csl on csl.collection_id=s.id AND s.type=3
			WHERE 1=1 {$where}";
			echo $query;exit;
		$q = Doctrine_Manager::getInstance()->getCurrentConnection();
		$result = $q->execute($query);
		$result = $result->fetchAll();
		$filter_ID = array();
		foreach ($result as $value)
		{
			$filter_ID[] = $value['id'];
		}


		return $filter_ID;
	}

	/**
	 * get the Units Custome
	 * 
	 * @param  Array of adding custome values
	 * @return Array of Units
	 */
	static public function getUnitNameCustome($add_values = NULL)
	{
		$Units = Doctrine_Query::Create()
		->from('Unit c')
		->select('c.*')
		->fetchArray();
		$UnitsArray = array();

		foreach ($Units as $Unit)
		{
//            var_dump($Unit);
//            exit;
			$UnitsArray[$Unit['id']] = $Unit['name'];
		}

		if ($add_values)
		{
			$UnitsArray[0] = $add_values;
		}
		ksort($UnitsArray);
		return $UnitsArray;
	}

}
