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
	 * To SET Index Page View when changes the view from Media Score to Media River and vise versa and redirect to index page
	 * 
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
			if ($this->view == 'score')
				$this->redirect($this->generateUrl("assetgroup", array('unit_slug' => $unit->getNameSlug(), 'name_slug' => $success['collection']->getNameSlug())));
			else
			{
				echo 'here';
				exit;
				$this->redirect("collection/edit/id/{$success['id']}/u/{$unit->getId()}/form/river");
			}
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
			$this->redirect($this->generateUrl("collection", $unit));
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

	public function executeUpdateCollectionScores(sfWebRequest $request)
	{
		$collections = Doctrine_Query::Create()
		->from('Collection c')
		->execute();
		$total = 0;
		foreach ($collections as $collection):
			$removeTotalScore = FALSE;
			if ($collection->getScoreSubjectInterest() == '')
				$removeTotalScore = TRUE;
			if ($collection->getScoreContentQuality() == '')
				$removeTotalScore = TRUE;
			if ($collection->getScoreRareness() == '')
				$removeTotalScore = TRUE;
			if ($collection->getScoreDocumentation() == '')
				$removeTotalScore = TRUE;
			if ($collection->getUnknownTechnicalQuality() != 1)
			{
				if ($collection->getScoreTechnicalQuality() == '')
					$removeTotalScore = TRUE;
			}
			if ($removeTotalScore)
			{
				$collection->setCollectionScore(NULL);
				$collection->save();
				$total ++;
			}
		endforeach;
		echo 'Total updated records: ' . $total;
		exit;
	}

	public function executeImport(sfWebRequest $request)
	{
		$unit = array(1 => 13, 2 => 7879, 3 => 11, 5 => 12, 7 => 10, 8 => 271,
			9 => 211, 10 => 157, 11 => 14, 12 => 208, 15 => 537, 24 => 433, 30 => 1134,
			45 => 7910, 47 => 178, 48 => 7912, 52 => 7918, 63 => 241, 72 => 1338, 81 => 1343
		);
		$user = array(6 => 5, 13 => 6, 16 => 21, 17 => 32, 18 => 28, 12 => 12);
		$fileContent = file_get_contents('tblCollection.xml');
		$xmlObject = @simplexml_load_string($fileContent);
		$records = $this->xmlObjToArray($xmlObject);

		foreach ($records['children']['tblcollection'] as $key => $row)
		{
			$info = $row['children'];
			$primaryId = isset($info['primaryid'][0]['text']) ? $info['primaryid'][0]['text'] : '';
			$title = isset($info['title'][0]['text']) ? $info['title'][0]['text'] : '';
			$characteristics = isset($info['characteristics'][0]['text']) ? $info['characteristics'][0]['text'] : '';
			$projecttitle = isset($info['projecttitle'][0]['text']) ? $info['projecttitle'][0]['text'] : '';
			$iubunit = $unit[$info['iubunit'][0]['text']];
			$iubworker = isset($info['iubworker'][0]['text']) ? $user[$info['iubworker'][0]['text']] : 1;
			$datecompleted = isset($info['datecompleted'][0]['text']) ? date('Y-m-d', strtotime($info['datecompleted'][0]['text'])) : '';
			$intscore = isset($info['intscore'][0]['text']) ? (float) $info['intscore'][0]['text'] : NULL;
			$intnotes = isset($info['intnotes'][0]['text']) ? $info['intnotes'][0]['text'] : '';
			$contscore = isset($info['contscore'][0]['text']) ? (float) $info['contscore'][0]['text'] : NULL;
			$contnotes = isset($info['contnotes'][0]['text']) ? $info['contnotes'][0]['text'] : '';
			$rarescore = isset($info['rarescore'][0]['text']) ? (float) $info['rarescore'][0]['text'] : NULL;
			$rarenotes = isset($info['rarenotes'][0]['text']) ? $info['rarenotes'][0]['text'] : '';
			$docscore = isset($info['docscore'][0]['text']) ? (float) $info['docscore'][0]['text'] : NULL;
			$docnotes = isset($info['docnotes'][0]['text']) ? $info['docnotes'][0]['text'] : '';
			$techscore = isset($info['techscore'][0]['text']) ? (float) $info['techscore'][0]['text'] : NULL;
			$techunknown = $info['techunknown'][0]['text'];
			$technotes = isset($info['technotes'][0]['text']) ? $info['technotes'][0]['text'] : '';
			$generationstatement = isset($info['generationstatement'][0]['text']) ? $info['generationstatement'][0]['text'] : '';
			$generationnotes = isset($info['generationnotes'][0]['text']) ? $info['generationnotes'][0]['text'] : '';
			$intellectualpropertynotes = isset($info['intellectualpropertynotes'][0]['text']) ? $info['intellectualpropertynotes'][0]['text'] : '';
			$intellectualpropertystatement = isset($info['intellectualpropertystatement'][0]['text']) ? $info['intellectualpropertystatement'][0]['text'] : '';
			$generalnotes = isset($info['generalnotes'][0]['text']) ? $info['generalnotes'][0]['text'] : '';

			if ( ! empty($title))
			{
				$unknown = 0;
				if (isset($techunknown) && ($techunknown == 'TRUE' || $techunknown == 'true'))
				{
					$unknown = 1;
					$totalScore = ((float) $intscore + (float) $contscore + (float) $rarescore + (float) $docscore ) / 4;
				}
				else
				{
					$totalScore = ((float) $intscore + (float) $contscore + (float) $rarescore + (float) $docscore + (float) $techscore) / 5;
				}
				$collection = Doctrine_Query::Create()
				->from('Collection c')
				->where('c.name LIKE ?', trim($title))
				->fetchOne();
				if ( ! $collection)
				{
					$collection = new Collection();
					$collection->setName($title);
					$collection->setInstId($primaryId);
					$collection->setCreatorId($iubworker);
					$collection->setLastEditorId($iubworker);

					echo 'New <br/>';
				}
				$collection->setCharacteristics($characteristics);
				$collection->setProjectTitle($projecttitle);
				$collection->setParentNodeId($iubunit);
				$collection->setIubUnit($iubunit);
				$collection->setIubWork($iubworker);
				$collection->setDateCompleted($datecompleted);
				$collection->setScoreSubjectInterest($intscore);
				$collection->setNotesSubjectInterest($intnotes);
				$collection->setScoreContentQuality($contscore);
				$collection->setNotesContentQuality($contnotes);
				$collection->setScoreRareness($rarescore);
				$collection->setNotesRareness($rarenotes);
				$collection->setScoreDocumentation($docscore);
				$collection->setNotesDocumentation($docnotes);
				$collection->setScoreTechnicalQuality($techscore);
				$collection->setNotesTechnicalQuality($technotes);
				$collection->setUnknownTechnicalQuality($unknown);
				$collection->setGenerationStatement($generationstatement);
				$collection->setGenerationStatementNotes($generationnotes);
				$collection->setIpStatement($intellectualpropertystatement);
				$collection->setIpStatementNotes($intellectualpropertynotes);
				$collection->setGeneralNotes($generalnotes);
				$collection->setCollectionScore($totalScore);
				$collection->save();
				echo 'Record ID =>' . $collection->getId() . '<br/>';
				echo 'Total Score =>' . $collection->getCollectionScore() . '<br/>';
//				if ($key == 328)
//				{
//					echo '<pre>';
//					print_r($row);
//					exit;
//				}
			}
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
