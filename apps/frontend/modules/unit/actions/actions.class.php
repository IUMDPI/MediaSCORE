<?php

/**
 * unit actions.
 *
 * @package    mediaSCORE
 * @subpackage unit
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class unitActions extends sfActions
{

	/**
	 * global search method
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeSearch(sfWebRequest $request)
	{
		// make array of all the format types that are available
//        $unitScore = $request->getParameter('searchScore');
		$this->AllStorageLocations = Doctrine_Query::create()->from('StorageLocation sl')->select('sl.id,sl.name')->fetchArray('name');
		if ($request->isXmlHttpRequest())
		{
			$searchInpout = $request->getParameter('s');
			$status = $request->getParameter('status');
			$from = $request->getParameter('from');
			$to = $request->getParameter('to');
			$dateType = $request->getParameter('datetype');


			$this->unit = Doctrine_Query::Create()
			->from('Unit u')
			->select('u.*,cu.*,eu.*,sl.resident_structure_description')
			->orderBy('u.name')
			->innerJoin('u.Creator cu')
			->innerJoin('u.Editor eu')
			->leftJoin('u.StorageLocations sl');

			// apply filters for searching the unit
			if ($searchInpout && trim($searchInpout) != '')
			{
				$this->unit = $this->unit->andWhere('name like "%' . $searchInpout . '%"');
			}
			if (trim($status) != '')
			{
				$this->unit = $this->unit->andWhere('status =?', $status);
			}



			if ($dateType != '')
			{
				if ($dateType == 0)
				{
					if (trim($from) != '' && trim($to) != '')
					{
						$this->unit = $this->unit->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(created_at,"%Y-%m-%d") <= "' . $to . '"');
					}
					else
					{
						if (trim($from) != '')
						{
							$this->unit = $this->unit->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") >=?', $from);
						}

						if (trim($to) != '')
						{
							$this->unit = $this->unit->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") <=?', $to);
						}
					}
				}
				else if ($dateType == 1)
				{
					if (trim($from) != '' && trim($to) != '')
					{
						$this->unit = $this->unit->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(updated_at,"%Y-%m-%d") <= "' . $to . '"');
					}
					else
					{
						if (trim($from) != '')
						{
							$this->unit = $this->unit->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") >=?', $from);
						}

						if (trim($to) != '')
						{
							$this->unit = $this->unit->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") <=?', $to);
						}
					}
				}
			}
			$this->unit = $this->unit->fetchArray();
//            echo '<pre>';
//            print_r($this->unit);
//            exit;
			// after applying the parametes get units.
			// get duration for each unit
			foreach ($this->unit as $key => $value)
			{
				$duration = new Unit();
				$this->unit[$key]['duration'] = $duration->getDuration($value['id']);
			}


			$this->getResponse()->setHttpHeader('Content-type', 'application/json');
			$this->setLayout('json');

			return $this->renderText(json_encode($this->unit));
		}
		else
		{ // Format Type Array
			$types = array('Metal Disc' => '1',
				'Film' => '5',
				'DAT' => '6',
				'Sound Wire Reel' => '7',
				'Analog Audio Cassette' => '4',
				'Polyster Open Reel Audio Tape' => '9',
				'Acetate Open Reel Audio Tape' => '10',
				'Paper Open Reel Audio Tape' => '11',
				'PVC Open Reel Audio Tape' => '12',
				'Lacquer Disc' => '15',
				'MiniDisc' => '16',
				'Cylinder' => '17',
				'Sound Optical Disc' => '19',
				'Optical Video' => '20',
				'Pressed 78RPM Disc' => '22',
				'Pressed LP Disc' => '23',
				'Pressed 45RPM Disc' => '24',
				'LaserDisc' => '26',
				'XDCAM Optical' => '27',
				'Betamax' => '29',
				'8MM' => '31',
				'2" Open Reel Video' => '33',
				'1" Open Reel Video' => '34',
				'½" Open Reel Video' => '35',
				'DV' => '37',
				'DVCAM' => '38',
				'Betacam' => '40',
				'VHS' => '41',
				'Digital Betacam' => '42',
				'U-matic' => '44',
				'HDCAM' => '45',
				'DVCPro' => '46',
			);
			// make array of search parameters
			$store = array('Unit' => '1',
				'Collection' => '3',
				'Asset Group' => '4');
			// get the parameter of search
			$this->searchValues = $request->getParameter('search_values');
			// make array of search values
			$this->searchString=array();
			if ( ! empty($this->searchValues))
				$this->searchString = explode(',', $this->searchValues);
			// compare search values with the arrays ($store and $type)

			$formatType = array();
			$storeType = array();
			$stringForName = array();
			$locationString = array();
			$this->storeType = $storeType;
			$locations = array();

			foreach ($this->AllStorageLocations as $location)
			{
				$locations[$location['name']] = $location['id'];
			}

			foreach ($this->searchString as $value)
			{
				if (isset($types[$value]))
					$formatType[] = $types[$value];
				else if (isset($store[$value]))
					$storeType[] = $store[$value];
				else if (isset($locations[$value]))
					$locationString[] = $locations[$value];
				else
					$stringForName[] = trim($value);
			}
			$searchParams = array(
				'formats' => $formatType,
				'store' => $storeType,
				'string' => $stringForName,
				'location' => $locationString);
			
			$db = new Unit();
			$filterID = $db->getSearchResults($searchParams,$this->getUser()->getGuardUser());
			echo '<pre>';print_r($filterID);exit;
			$this->searchResult = Doctrine_Query::Create()
			->from('Store s')
			->select('s.*')
			->whereIn('s.id', $filterID)
			->execute();
		}
	}

	/**
	 * get list of unit for asset group
	 * 
	 * @param sfWebRequest $request 
	 * @return json
	 */
	public function executeGetUnitForAssetGroup(sfWebRequest $request)
	{

		if ($request->isXmlHttpRequest())
		{
			$assetGroupID = $request->getParameter('id');
			// search the assets with the request ID
			$assetGroups = Doctrine_Core::getTable('AssetGroup')
			->createQuery('a')
			->where('id =?', $assetGroupID)
			->execute()
			->toArray();
			$assetGroup = array_pop($assetGroups);

			// get collection for the search asset group
			$collections = Doctrine_Core::getTable('Collection')
			->createQuery('c')
			->where('id =?', $assetGroup['parent_node_id'])
			->execute()
			->toArray();
			$collection = array_pop($collections);
			// get unit for the collection for the asset group
			$units = Doctrine_Core::getTable('Unit')
			->createQuery('u')
			->where('id =?', $collection['parent_node_id'])
			->execute()
			->toArray();
			// return the response with the units detail
			$this->getResponse()->setHttpHeader('Content-type', 'application/json');
			$this->setLayout('json');
			$this->setTemplate('index');
			echo json_encode(array_pop($units));
		}
	}

	/**
	 * get unit personnel
	 * 
	 * @param sfWebRequest $request
	 * @return json 
	 */
	public function executeUnitPersonnelLocation(sfWebRequest $request)
	{
		$unitId = $request->getParameter('u');
		$this->forward404Unless($request->isXmlHttpRequest());
		if ($request->isXmlHttpRequest())
		{
			// get details of unit persons for the given unit id.
			$unit = Doctrine_Query::Create()
			->from('Person p')
			->select('p.*')
			->innerJoin('p.UnitPerson up')
			->where('up.unit_id =?', $unitId)
			->fetchArray();
			// get the detail of storage location for the given unit id
			$location = Doctrine_Query::Create()
			->from('StorageLocation sl')
			->select('sl.*')
			->innerJoin('sl.UnitStorageLocation usl')
			->where('usl.unit_id =?', $unitId)
			->fetchArray();
			return $this->renderText(json_encode(array('success' => true, 'unit' => $unit, 'location' => $location)));
		}
	}

	/**
	 * get user detail of unit
	 * 
	 * @param sfWebRequest $request
	 * @return json 
	 */
	public function executeGetUserDetail(sfWebRequest $request)
	{
		$this->forward404Unless($request->isXmlHttpRequest());
		if ($request->isXmlHttpRequest())
		{
			$explodedId = explode(',', $request->getParameter('id'));
			// search and get the detail of users
			$user = Doctrine_Core::getTable('sfGuardUser')
			->createQuery('c')
			->whereIn('id ', $explodedId)
			->execute()
			->toArray();
			return $this->renderText(json_encode(array('success' => true, 'id' => $request->getParameter('id'), 'records' => $user)));
		}
	}

	/**
	 * list and filter unit
	 * 
	 * @param sfWebRequest $request
	 * @return json if request is ajax 
	 */
	public function executeIndex(sfWebRequest $request)
	{
		// if any unit is deleted then so the message and remove it.
		$this->deleteMessage = $this->getUser()->getAttribute('delMsg');
		$this->getUser()->getAttributeHolder()->remove('delMsg');



		// get all the request parameters
		$searchInpout = $request->getParameter('s');
		$status = $request->getParameter('status');
		$from = $request->getParameter('from');
		$to = $request->getParameter('to');
		$dateType = $request->getParameter('datetype');
		$score = $request->getParameter('score');




//        $unitScore = $request->getParameter('searchScore');
		if ($request->isXmlHttpRequest())
		{
			$this->unit = Doctrine_Query::Create()
			->from('Unit u')
			->select('u.*,cu.*,eu.*,sl.resident_structure_description')
			->orderBy('u.name')
			->innerJoin('u.Creator cu')
			->innerJoin('u.Editor eu')
			->leftJoin('u.Collection c')
			->leftJoin('c.AssetGroup ag')
			->leftJoin('ag.FormatType ft')
			->leftJoin('u.StorageLocations sl');
			if($this->getUser()->getGuardUser()->getType()==3){
				$this->unit=$this->unit->innerJoin('u.Personnel p')->where('person_id = ?',$this->getUser()->getGuardUser()->getId());
			}
			// apply filters for searching the unit
			if ($searchInpout && trim($searchInpout) != '')
			{
				$this->unit = $this->unit->andWhere('u.name like "%' . $searchInpout . '%"');
			}
			if (trim($status) != '')
			{
				$this->unit = $this->unit->andWhere('u.status =?', $status);
			}
			if (trim($score) != '')
			{
				$this->unit = $this->unit->andWhere('ft.asset_score LIKE ?', "{$score}%");
			}



			if ($dateType != '')
			{
				if ($dateType == 0)
				{
					if (trim($from) != '' && trim($to) != '')
					{
						$this->unit = $this->unit->andWhere('DATE_FORMAT(u.created_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(u.created_at,"%Y-%m-%d") <= "' . $to . '"');
					}
					else
					{
						if (trim($from) != '')
						{
							$this->unit = $this->unit->andWhere('DATE_FORMAT(u.created_at,"%Y-%m-%d") >=?', $from);
						}

						if (trim($to) != '')
						{
							$this->unit = $this->unit->andWhere('DATE_FORMAT(u.created_at,"%Y-%m-%d") <=?', $to);
						}
					}
				}
				else if ($dateType == 1)
				{
					if (trim($from) != '' && trim($to) != '')
					{
						$this->unit = $this->unit->andWhere('DATE_FORMAT(u.updated_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(u.updated_at,"%Y-%m-%d") <= "' . $to . '"');
					}
					else
					{
						if (trim($from) != '')
						{
							$this->unit = $this->unit->andWhere('DATE_FORMAT(u.updated_at,"%Y-%m-%d") >=?', $from);
						}

						if (trim($to) != '')
						{
							$this->unit = $this->unit->andWhere('DATE_FORMAT(u.updated_at,"%Y-%m-%d") <=?', $to);
						}
					}
				}
			}
			$this->unit = $this->unit->fetchArray();

//            echo '<pre>';
//            print_r($this->unit);
//            exit;
			// after applying the parametes get units.
			// get duration for each unit
			foreach ($this->unit as $key => $value)
			{
				$duration = new Unit();
				$this->unit[$key]['duration'] = $duration->getDuration($value['id']);
			}


			$this->getResponse()->setHttpHeader('Content-type', 'application/json');
			$this->setLayout('json');

			return $this->renderText(json_encode($this->unit));
		}
		else
		{
			$this->AllStorageLocations = Doctrine_Query::create()->from('StorageLocation sl')->select('sl.id,sl.name')->fetchArray('name');
			// get the list of all the units 
			$this->units = Doctrine_Core::getTable('Unit')
			->createQuery('u')
			->orderBy('name')
			->leftJoin('u.StorageLocations sl');
			if($this->getUser()->getGuardUser()->getType()==3){
				$this->units=$this->units->innerJoin('u.Personnel p')->where('person_id = ?',$this->getUser()->getGuardUser()->getId());
			}
			$this->units=$this->units->execute();
		}
	}

	/**
	 * detail of specific unit
	 * 
	 * @param sfWebRequest $request
	 * @return type 
	 */
	public function executeShow(sfWebRequest $request)
	{


		if ($request->isXmlHttpRequest())
		{

			$unit = Doctrine_Core::getTable('Unit')->find(
			Doctrine_Core::getTable('Collection')->find($request->getParameter('collectionID'))->getParentNodeId())->toArray();
			$this->getResponse()->setHttpHeader('Content-type', 'application/json');
			$this->getResponse()->setContent(json_encode($unit));
			return sfView::NONE;
		}
		else
		{

			$this->unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id')));
			$this->forward404Unless($this->unit);
		}
	}

	/**
	 * Unit new form
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeNew(sfWebRequest $request)
	{

		$this->form = new UnitForm(null, array('userID' => $this->getUser()->getGuardUser()->getId()
		));
	}

	/**
	 * Unit Post form process
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new UnitForm(null, array(
			'userID' => $this->getUser()->getGuardUser()->getId()
		));

		$success = $this->processForm($request, $this->form);
		if ($success && isset($success['form']) && $success['form'] == true)
		{
			echo $success['id'];
			exit;
		}
		else
		{
			$this->setTemplate('new');
		}
	}

	/**
	 * Unit edit form
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));
		$this->form = new UnitForm(
		$unit, array(
			'userID' => $this->getUser()->getGuardUser()->getId(),
			'action' => 'edit'
		));
	}

	/**
	 * Unit Post edit form process
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));


		$this->form = new UnitForm($unit, array(
			'userID' => $this->getUser()->getGuardUser()->getId(),
			'action' => 'edit'
		));

		$success = $this->processForm($request, $this->form);
		if ($success && isset($success['form']) && $success['form'] == true)
		{
			echo $success['id'];
			exit;
		}
		else
		{
			if ($success && isset($success['error']) && $success['error'] == true)
			{
				$this->locationError = 'This value is selected by a Collection or Asset Group. To de-select at the unit level, you must first de-select this value at the asset group and collection level';
			}
			$this->setTemplate('edit');
		}
	}

	/**
	 * delete method
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeDelete(sfWebRequest $request)
	{
		//$request->checkCSRFProtection();

		$this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));
		// remove all the collection first before deleting any unit.
		$collections = Doctrine_Query::Create()
		->from('Collection c')
		->select('c.*')
		->where('c.parent_node_id  = ?', $request->getParameter('id'))
		->fetchArray();
		if (sizeof($collections) > 0)
		{
			$this->getUser()->setAttribute('delMsg', 'You must reassign the collections and asset groups to another unit before you can delete this unit.');
		}
		else
		{
			$unit->delete();
		}
		$this->redirect('unit/index');
	}

	/**
	 * process and validate form
	 * 
	 * @param sfWebRequest $request
	 * @param sfForm $form
	 * @return boolean 
	 * @return string[]
	 */
	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		// get the storage location for the given unit.
		$collections = Doctrine_Query::Create()
		->from('CollectionStorageLocation csl')
		->select('csl.*')
		->innerJoin('csl.Collection c')
		->where('c.parent_node_id  = ?', $form->getValue('id'))
		->groupBy('csl.storage_location_id')
		->fetchArray();
		if ($form->isValid())
		{
			$check = array();
			// match the selected and already assign the storage location. 
			foreach ($collections as $value)
			{
				foreach ($form->getValue('storage_locations_list') as $location)
				{
					if ($location == $value['storage_location_id'])
					{
						$check[] = $value['storage_location_id'];
					}
				}
			}
			// if store location is already assign to collection that user want to remove then show error message.
			if (count($collections) != count($check))
			{
				$error = array('error' => true);
				return $error;
			}
			$unit = $form->save();


			$success = array('form' => true, 'id' => $unit->getId());
			return $success;
		}
	}

}
