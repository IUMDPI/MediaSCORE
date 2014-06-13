<?php

/**
 * collection actions.
 *
 * @package    mediaSCORE
 * @subpackage collection
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class collectionActions extends sfActions
{

	public function preExecute()
	{
		parent::preExecute();
		$view = $this->getUser()->getAttribute('view');
		if ( ! $view || ! $view['view'])
		{
			$view['view'] = 'score';
		}
		$this->view = $view['view'];
	}

	/**
	 * get collections for the given unit
	 * 
	 * @param sfWebRequest $request
	 * @return json 
	 */
	public function executeGetCollectionsForUnit(sfWebRequest $request)
	{
		if ($request->isXmlHttpRequest())
		{
			$unitID = $request->getParameter('id');
			$collections = Doctrine_Core::getTable('Collection')
				->createQuery('c')
				->where('parent_node_id =?', $unitID)
				->execute()
				->toArray();

			$this->getResponse()->setHttpHeader('Content-type', 'application/json');
			$this->setLayout('json');
			$this->setTemplate('index');
			return $this->renderText(json_encode($collections));
		}
	}

	/**
	 * To SET Index Page View when changes the view from Media Score to Media River and vise versa and redirect to index pgae
	 * @param sfWebRequest $request
	 */
	public function executeSetview(sfWebRequest $request)
	{



		if ($request->getParameter('view'))
		{
			$this->view = $request->getParameter('view');
			$ViewInfo = array('view' => $this->view);
			$this->getUser()->setAttribute('view', $ViewInfo);
			$view = $this->getUser()->getAttribute('view');

			$unit = Doctrine_Query::Create()
				->from('Unit u')
				->andWhere('id  = ?', $request->getParameter('u'))
				->fetchArray();
			$this->ThisUnit = $unit;

			$url = $this->generateUrl("collection", $unit[0]);
			$urls = explode('?', $url);
//            header('location: ' . $urls[0]);
			$this->redirect($urls[0]);
			exit;
		}
	}

	/**
	 * list all collections or filter collections
	 * 
	 * @param sfWebRequest $request
	 * @return json  if request is ajax
	 */
	public function executeIndex(sfWebRequest $request)
	{

		$view = $this->getUser()->getAttribute('view');
		$unitID = $request->getParameter('id');
		$searchInpout = $request->getParameter('s');
		$status = $request->getParameter('status');
		$from = $request->getParameter('from');
		$to = $request->getParameter('to');
		$dateType = $request->getParameter('datetype');
		$score = $request->getParameter('score');

		$score_end = $request->getParameter('score_end');
		$score_start = $request->getParameter('score_start');
		$scoreType = $request->getParameter('scoreType');
		$storagefilter = $request->getParameter('storagefilter');
		$view = $this->getUser()->getAttribute('view');

		if ( ! $view || ! $view['view'])
		{
			$view['view'] = 'score';
		}
		$this->view = $view['view'];

		$this->AllStorageLocations = Doctrine_Query::create()->from('StorageLocation sl')
			->select('sl.id,sl.name')
			->fetchArray('name');

		// Get collections for a specific Unit
		if ($request->isXmlHttpRequest())
		{
			$this->collections = Doctrine_Query::Create()
				->from('Collection c')
				->select('c.*,cu.*,eu.*,sl.*')
				->innerJoin('c.Creator cu')
				->innerJoin('c.Editor eu')
				->leftJoin('c.StorageLocations sl')
				->leftJoin('c.AssetGroup ag')
				->leftJoin('ag.FormatType ft')
				->where('c.parent_node_id  = ?', $unitID);

			if ($searchInpout && trim($searchInpout) != '')
			{
				$this->collections = $this->collections->andWhere('c.name like "%' . $searchInpout . '%"');
			}
			if (trim($status) != '')
			{
				$this->collections = $this->collections->andWhere('c.status =?', $status);
			}


			switch ($scoreType)
			{
				case 'river':
					if ($score_start != '' && $score_end != '')
					{
						$this->collections = $this->collections->andWhere('(CAST(c.collection_score as DECIMAL(3,2))) >= ?', "{$score_start}");
						$this->collections = $this->collections->andWhere('(CAST(c.collection_score as DECIMAL(3,2))) <= ?', "{$score_end}");
					}
					break;
				case 'score':
					if ($score_start && $score_end)
					{
						$this->collections = $this->collections->andWhere('(CAST(ft.asset_score as DECIMAL(4,2))) >= ?', "{$score_start}");
						$this->collections = $this->collections->andWhere('(CAST(ft.asset_score as DECIMAL(4,2))) <= ?', "{$score_end}");
					}
					break;
			}

			if ($dateType != '')
			{
				if ($dateType == 0)
				{
					if (trim($from) != '' && trim($to) != '')
					{
						$this->collections = $this->collections->andWhere('DATE_FORMAT(c.created_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(c.created_at,"%Y-%m-%d") <= "' . $to . '"');
					}
					else
					{
						if (trim($from) != '')
						{
							$this->collections = $this->collections->andWhere('DATE_FORMAT(c.created_at,"%Y-%m-%d") >=?', $from);
						}

						if (trim($to) != '')
						{
							$this->collections = $this->collections->andWhere('DATE_FORMAT(c.created_at,"%Y-%m-%d") <=?', $to);
						}
					}
				}
				else if ($dateType == 1)
				{
					if (trim($from) != '' && trim($to) != '')
					{
						$this->collections = $this->collections->andWhere('DATE_FORMAT(c.updated_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(c.updated_at,"%Y-%m-%d") <= "' . $to . '"');
					}
					else
					{
						if (trim($from) != '')
						{
							$this->collections = $this->collections->andWhere('DATE_FORMAT(c.updated_at,"%Y-%m-%d") >=?', $from);
						}
						if (trim($to) != '')
						{
							$this->collections = $this->collections->andWhere('DATE_FORMAT(c.updated_at,"%Y-%m-%d") <=?', $to);
						}
					}
				}
			}
			if (trim($storagefilter) != '')
			{
				$this->collections = $this->collections->andWhere('storage_location_id =?', $storagefilter);
			}

			$this->collections = $this->collections->fetchArray();

			foreach ($this->collections as $key => $value)
			{
				$duration = new Collection ();
				$duration = $duration->getDurationRealTime($value['id']);
				$this->collections[$key]['duration'] = $duration;
			}
			$this->getResponse()->setHttpHeader('Content-type', 'application/json');
			$this->setLayout('json');
			return $this->renderText(json_encode($this->collections));
		}
		else
		{
			$this->unitObject = $this->getRoute()->getObject();

			$this->forward404Unless($this->unitObject);
			$this->unitID = $request->getParameter('u');
			$this->unitID = $this->unitObject->getId();

			$this->forward404Unless($this->unitID);

			if ($this->getUser()->getGuardUser()->getRole() == 2)
			{
				$unit = Doctrine_Query::Create()
					->from('Unit u')
					->innerJoin('u.Personnel p')
					->where('person_id  = ?', $this->getUser()->getGuardUser()->getId())
					->andWhere('id  = ?', $this->unitID)
					->fetchArray();

				$this->forward404Unless(count($unit) > 0);
			}
			$this->deleteMessage = $this->getUser()->getAttribute('delCollectionMsg');
			$this->getUser()->getAttributeHolder()->remove('delCollectionMsg');
			$unit = Doctrine_Core::getTable('Unit')
				->find($this->unitID);
			$this->forward404Unless($unit);
			$this->unitName = $unit->getName();
			$this->collections = Doctrine_Query::Create()
				->from('Collection c')
				->select('c.*')
				->leftJoin('c.StorageLocations sl')
				->where('c.parent_node_id  = ?', $this->unitID)
				->execute();
		}
		$this->ThisUnit = $unit;
		$this->IsMediaScoreAccess = $this->getUser()->getGuardUser()->getMediascoreAccess();
		$this->ISMediaRiverAccess = $this->getUser()->getGuardUser()->getMediariverAccess();

		if ( ! $this->IsMediaScoreAccess && $this->getUser()->getGuardUser()->getRole() != 1)
		{
			$this->view = 'river';
			$ViewInfo = array('view' => $this->view);
			$this->getUser()->setAttribute('view', $ViewInfo);
		}

		if ( ! $this->ISMediaRiverAccess && $this->getUser()->getGuardUser()->getRole() != 1)
		{
			$this->view = 'score';
			$ViewInfo = array('view' => $this->view);
			$this->getUser()->setAttribute('view', $ViewInfo);
		}

		$AllStorageLocations = Doctrine_Query::create()->from('Unit u')
			->select('sl.id,sl.name,u.id')
			->innerJoin('u.StorageLocations sl')
			->where('u.id = ?', $this->unitID)
			->fetchArray();

		$arr = array();
		foreach ($AllStorageLocations[0] as $key => $AllStorageLocation)
		{
			if ($key == 'StorageLocations')
			{
				foreach ($AllStorageLocation as $StorageLocation)
				{
					$arr[] = array('id' => $StorageLocation['id'], 'name' => $StorageLocation['name']);
				}
			}
		}

		$this->AllStorageLocations = $arr;
	}

	public function executeShow(sfWebRequest $request)
	{

		$this->collection = Doctrine_Core::getTable('Collection')
			->createQuery('u')
			->whereIn('id', array('2579', '2578', '2577', '2576', '2568', '2566', '2565', '2563', '2554', '2448', '1406', '1310'))
			->execute();
//		echo '<pre>';
//		print_r($collection);
//		exit;
	}

	/**
	 * generate form for collection.
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeNew(sfWebRequest $request)
	{

		$view = $this->getUser()->getAttribute('view');
		if ( ! $view || ! $view['view'])
		{
			$view['view'] = 'score';
		}
		$this->view = $view['view'];
		$this->actionType = 'new';

		$this->form = new CollectionForm(null, array(
				'userID' => $this->getUser()->getGuardUser()->getId(),
				'unitID' => $request->getParameter('u'),
				'view' => $view['view']
				)
		);
		$unit = Doctrine_Query::Create()
			->from('Unit u')
			->andWhere('id  = ?', $request->getParameter('u'))
			->fetchArray();
		$this->ThisUnit = $unit;

		$url = $this->generateUrl("collection", $unit[0]);
		$arr_url = explode('?', $url);
		$this->url = $arr_url[0];
	}

	/**
	 * receive post request, process the form and insert the record.
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeCreate(sfWebRequest $request)
	{
		$view = $this->getUser()->getAttribute('view');
		if ( ! $view && ! isset($view['view']) && ! $view['view'])
			$view['view'] = 'score';

		$this->forward404Unless($request->isMethod(sfRequest::POST));
		$unitId = sfToolkit::getArrayValueForPath($request->getParameter('collection'), 'parent_node_id');
		$this->form = new CollectionForm(null, array(
				'userID' => $this->getUser()->getGuardUser()->getId(),
				'unitID' => $unitId,
				'view' => $view['view'])
		);
		$this->view = $view['view'];

		$success = $this->processForm($request, $this->form);

		if ($success && isset($success['form']) && $success['form'] == true)
		{
			$collection = $success['collection'];
			$unit = Doctrine_Core::getTable('Unit')
				->createQuery('u')
				->where('id =?', $unitId)
				->fetchOne();

			$this->redirect($this->generateUrl("assetgroup", array('unit_slug' => $unit->getNameSlug(), 'name_slug' => $success['collection']->getNameSlug())));
		}
		else
		{
			$this->setTemplate('new');
		}
//        echo url_for('assetgroup', $collection)
	}

	/**
	 * generate collection form with prefilled values.
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeEdit(sfWebRequest $request)
	{
		$view = $this->getUser()->getAttribute('view');
		if ( ! $view || ! $view['view'])
		{
			$view['view'] = 'score';
		}

		$this->formType = $request->getParameter('form');
		$this->forward404Unless($collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id'))), sprintf('Object collection does not exist (%s).', $request->getParameter('id')));
		$this->form = new CollectionForm(
				$collection, array('userID' => $this->getUser()->getGuardUser()->getId(), 'unitID' => $request->getParameter('u'),
				'action' => 'edit',
				'view' => $view['view']
				)
		);
		$this->view = $view['view'];
		$this->actionType = 'edit';
		$this->collection = $collection;
		$unit = Doctrine_Query::Create()
			->from('Unit u')
			->andWhere('id  = ?', $request->getParameter('u'))
			->fetchArray();
		$this->ThisUnit = $unit;

		$url = $this->generateUrl("collection", $unit[0]);
		$arr_url = explode('?', $url);
		$this->url = $arr_url[0];
	}

	/**
	 * receive post request, process form values and update the record
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeUpdate(sfWebRequest $request)
	{
		$view = $this->getUser()->getAttribute('view');
//        if (!$view || !$view['view']) {
//            $view['view'] = 'score';
//        }
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id'))), sprintf('Object collection does not exist (%s).', $request->getParameter('id')));
		$unitId = sfToolkit::getArrayValueForPath($request->getParameter('collection'), 'parent_node_id');


		$this->form = new CollectionForm($collection, array(
				'userID' => $this->getUser()->getGuardUser()->getId(),
				'unitID' => $unitId,
				'action' => 'edit',
				'view' => $view['view']
			));

		$success = $this->processForm($request, $this->form);
		$this->view = $view['view'];
		$this->actionType = 'edit';
		if ($success && isset($success['form']) && $success['form'] == true)
		{

			$unit = Doctrine_Core::getTable('Unit')
				->createQuery('u')
				->where('id =?', $unitId)
				->fetchOne();
			$this->redirect($this->generateUrl("assetgroup", array('unit_slug' => $unit->getNameSlug(), 'name_slug' => $success['collection']->getNameSlug())));
		}
		else
		{
			if ($success && isset($success['error']) && $success['error'] == true)
			{
				$this->locationError = 'This value is selected by a Collection or Asset Group. To de-select at the unit level, you must first de-select this value at the asset group and collection level';
			}

			$unit = Doctrine_Core::getTable('Unit')
				->createQuery('u')
				->where('id =?', $unitId)
				->execute();
			$this->ThisUnit = $unit;

			$url = $this->generateUrl("collection", $unit);
			$arr_url = explode('?', $url);
			$this->url = $arr_url[0];
			$this->setTemplate('edit');
		}
	}

	/**
	 * delete collection
	 * 
	 * @param sfWebRequest $request 
	 */
	public function executeDelete(sfWebRequest $request)
	{
		//$request->checkCSRFProtection();
		$view = $this->getUser()->getAttribute('view');
		if ( ! $view || ! $view['view'])
		{
			$view['view'] = 'score';
		}
		$this->forward404Unless($collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id'))), sprintf('Object collection does not exist (%s).', $request->getParameter('id')));
		$unit = Doctrine_Query::Create()
			->from('Unit u')
			->select('u.*')
			->where('u.id  = ?', $collection->getParentNodeId())
			->fetchOne();

		$assets = Doctrine_Query::Create()
			->from('AssetGroup ag')
			->select('ag.*')
			->where('ag.parent_node_id  = ?', $request->getParameter('id'))
			->fetchArray();
		if (sizeof($assets) > 0)
		{
			$this->getUser()->setAttribute('delCollectionMsg', 'You must reassign the asset groups to another collection before you can delete this collection.');
		}
		else
		{
			$collection->delete();
		}
		$this->view = $view['view'];
		$this->actionType = 'delete';
		$this->redirect('/' . $unit->getNameSlug());
	}

	/**
	 * process and validate form. And also manage and validate storage location
	 * 
	 * @param sfWebRequest $request
	 * @param sfForm $form
	 * @return string[] 
	 */
	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$view = $this->getUser()->getAttribute('view');
		if ( ! $view || ! $view['view'])
		{
			$view['view'] = 'score';
		}
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		$collectionsAssets = Doctrine_Query::Create()
			->from('AssetGroup ag')
			->select('ag.*')
			->where('ag.parent_node_id  = ?', $form->getValue('id'))
			->groupBy('ag.resident_structure_description')
			->fetchArray();
		$isformValid = $form->isValid();
		if ($isformValid)
		{
			$check = array();
			if ($view['view'] == 'score')
			{
				foreach ($collectionsAssets as $value)
				{
					foreach ($form->getValue('storage_locations_list') as $location)
					{
						if ($location == $value['resident_structure_description'])
						{
							$check[] = $value['resident_structure_description'];
						}
					}
				}
				if (count($collectionsAssets) != count($check))
				{
					$error = array('error' => true);
					return $error;
				}
			}

			$collection = $form->save();
			$success = array('form' => true, 'id' => $collection->getId(), 'collection' => $collection);

			return $success;
		}
		else
		{
			return $form;
		}
	}

	public function executeImport(sfWebRequest $request)
	{
		$unit = array(1 => 13,
			2 => 7879,
			3 => 11,
			5 => 12,
			7 => 10,
			8 => 271,
			9 => 211,
			10 => 157,
			11 => 14,
			12 => 208,
			15 => 537,
			24 => 433,
			30 => 1134,
			45 => 7910,
			47 => 178,
			48 => 7912,
			52 => 7918,
			63 => 241,
			72 => 1338,
			81 => 1343
		);
		$user = array(6 => 5,
			13 => 6,
			16 => 21,
			17 => 32,
			18 => 28,
			12 => 12);
		$fileContent = file_get_contents('tblCollection.xml');
		$xmlObject = @simplexml_load_string($fileContent);
		$records = $this->xmlObjToArray($xmlObject);

		foreach ($records['children']['tblcollection'] as $key => $row)
		{
			$info = $row['children'];
			echo '<pre>';print_r($info);exit;
			$primaryId = $info['primaryid'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			$title = $info['title'][0]['text'];
			if ( ! empty($title))
			{
				$collection = Doctrine_Query::Create()
					->from('Collection c')
					->where('c.name LIKE ?', trim($title))
					->fetchOne();
				if ( ! $collection)
				{
					$collection = new Collection();
					$collection->setName('Nouman');
				}
				echo $collection->getName().'<br/>';
//				if ($key == 328)
//				{
//					echo '<pre>';
//					print_r($row);
//					exit;
//				}
			}
		}

		exit;


		foreach ($records as $row)
		{
			$unknown = 0;
			if (isset($row[17]) && ($row[17] == 'TRUE' || $row[17] == 'true'))
			{
				$unknown = 1;
				$totalScore = ((int) $row[8] + (int) $row[10] + (int) $row[12] + (int) $row[14] ) / 4;
			}
			else
			{
				$totalScore = ((int) $row[8] + (int) $row[10] + (int) $row[12] + (int) $row[14] + (int) $row[16]) / 5;
			}

			$collection = Doctrine_Query::Create()
				->from('Collection c')
//				->select('c.*')
				->where('c.name = ', $row[2])
				->fetchOne();
//			if ( ! $collection)
//			{
//				$collection = new Collection();
//				$collection->setName($row[2]);
//				$collection->setInstId($row[1]);
//				$collection->setCreatorId($row[6]);
//				$collection->setLastEditorId($row[6]);
//				
//			}
			echo $row[2] . '<br/>';
			echo $collection->getName() . '<br/>';
//			$collection->setCharacteristics($row[3]);
//			$collection->setProjectTitle($row[4]);
//			$collection->setIubUnit($unit[$row[5]]);
//			$collection->setIubWork($user[$row[6]]);
//			$collection->setDateCompleted(date('Y-m-d', strtotime($row[7])));
//			$collection->setScoreSubjectInterest($row[8]);
//			$collection->setNotesSubjectInterest($row[9]);
//			$collection->setScoreContentQuality($row[10]);
//			$collection->setNotesContentQuality($row[11]);
//			$collection->setScoreRareness(isset($row[12]) ? $row[12] : '');
//			$collection->setNotesRareness(isset($row[13]) ? $row[13] : '');
//			$collection->setScoreDocumentation(isset($row[14]) ? $row[14] : '');
//			$collection->setNotesDocumentation(isset($row[15]) ? $row[15] : '');
//			$collection->setScoreTechnicalQuality(isset($row[16]) ? $row[16] : '');
//			$collection->setNotesTechnicalQuality(isset($row[18]) ? $row[18] : '');
//			$collection->setUnknownTechnicalQuality($unknown);
//			$collection->setGenerationStatement(isset($row[19]) ? $row[19] : '');
//			$collection->setGenerationStatementNotes(isset($row[20]) ? $row[20] : '');
//			$collection->setIpStatement(isset($row[21]) ? $row[21] : '');
//			$collection->setIpStatementNotes(isset($row[22]) ? $row[22] : '');
//			$collection->setGeneralNotes(isset($row[23]) ? $row[23] : '');
//			$collection->setCollectionScore($totalScore);
//			$collection->save();
//			echo 'Collection ID ' . $collection->getId() . '<br/>';
			unset($collection);
		}
		echo 'All collection successfully imported';
		exit;
	}

	function xmlObjToArray($object)
	{
		$namespace = $object->getDocNamespaces(true);
		$namespace[NULL] = NULL;
		$children = array();
		$attributes = array();
		$name = strtolower((string) $object->getName());
		$text = trim((string) $object);
		if (strlen($text) <= 0)
		{
			$text = NULL;
		}
		// get info for all namespaces
		if (is_object($object))
		{

			foreach ($namespace as $ns => $nsUrl)
			{
				// atributes
				$objAttributes = $object->attributes($ns, true);
				foreach ($objAttributes as $attributeName => $attributeValue)
				{
					$attribName = strtolower(trim((string) $attributeName));
					$attribVal = trim((string) $attributeValue);
					if ( ! empty($ns))
					{
						$attribName = $ns . ':' . $attribName;
					}
					$attributes[$attribName] = $attribVal;
				}
				// children
				$objChildren = $object->children($ns, true);
				foreach ($objChildren as $childName => $child)
				{
					$childName = strtolower((string) $childName);
					if ( ! empty($ns))
					{
						$childName = $ns . ':' . $childName;
					}
					$children[$childName][] = $this->xmlObjToArray($child);
				}
			}
		}
		return array('name' => $name, 'text' => $text, 'attributes' => $attributes, 'children' => $children);
	}

}
