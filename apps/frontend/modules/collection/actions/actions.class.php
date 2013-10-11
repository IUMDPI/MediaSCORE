<?php

/**
 * collection actions.
 *
 * @package    mediaSCORE
 * @subpackage collection
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class collectionActions extends sfActions {

    public function preExecute() {
        parent::preExecute();
        $view = $this->getUser()->getAttribute('view');
        if (!$view || !$view['view']) {
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
    public function executeGetCollectionsForUnit(sfWebRequest $request) {
        if ($request->isXmlHttpRequest()) {
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
     * list all collections or filter collections
     * 
     * @param sfWebRequest $request
     * @return json  if request is ajax
     */
    public function executeIndex(sfWebRequest $request) {
        $view = array();
        if ($request->isXmlHttpRequest()) {
            $this->view = $request->getParameter('view');
            $ViewInfo = array('view' => $this->view);
            $this->getUser()->setAttribute('view', $ViewInfo);
            $view = $this->getUser()->getAttribute('view');
            echo $view['view'];
            exit;
        }
        $unitID = $request->getParameter('id');
        $searchInpout = $request->getParameter('s');
        $status = $request->getParameter('status');
        $from = $request->getParameter('from');
        $to = $request->getParameter('to');
        $dateType = $request->getParameter('datetype');
        $score = $request->getParameter('score');

        $view = $this->getUser()->getAttribute('view');
        if (!$view || !$view['view']) {
            $view['view'] = 'score';
        }
        $this->view = $view['view'];

        $this->AllStorageLocations = Doctrine_Query::create()->from('StorageLocation sl')->select('sl.id,sl.name')->fetchArray('name');
        // Get collections for a specific Unit
        if ($request->isXmlHttpRequest()) {
            $this->collections = Doctrine_Query::Create()
                    ->from('Collection c')
                    ->select('c.*,cu.*,eu.*,sl.*')
                    ->innerJoin('c.Creator cu')
                    ->innerJoin('c.Editor eu')
                    ->leftJoin('c.StorageLocations sl')
                    ->leftJoin('c.AssetGroup ag')
                    ->leftJoin('ag.FormatType ft')
                    ->where('c.parent_node_id  = ?', $unitID);
            if ($searchInpout && trim($searchInpout) != '') {
                $this->collections = $this->collections->andWhere('c.name like "%' . $searchInpout . '%"');
            }
            if (trim($status) != '') {
                $this->collections = $this->collections->andWhere('c.status =?', $status);
            }
            if (trim($score) != '') {
                $this->collections = $this->collections->andWhere('ft.asset_score LIKE ?', "{$score}%");
            }

            if ($dateType != '') {
                if ($dateType == 0) {
                    if (trim($from) != '' && trim($to) != '') {
                        $this->collections = $this->collections->andWhere('DATE_FORMAT(c.created_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(c.created_at,"%Y-%m-%d") <= "' . $to . '"');
                    } else {
                        if (trim($from) != '') {
                            $this->collections = $this->collections->andWhere('DATE_FORMAT(c.created_at,"%Y-%m-%d") >=?', $from);
                        }

                        if (trim($to) != '') {
                            $this->collections = $this->collections->andWhere('DATE_FORMAT(c.created_at,"%Y-%m-%d") <=?', $to);
                        }
                    }
                } else if ($dateType == 1) {
                    if (trim($from) != '' && trim($to) != '') {
                        $this->collections = $this->collections->andWhere('DATE_FORMAT(c.updated_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(c.updated_at,"%Y-%m-%d") <= "' . $to . '"');
                    } else {
                        if (trim($from) != '') {
                            $this->collections = $this->collections->andWhere('DATE_FORMAT(c.updated_at,"%Y-%m-%d") >=?', $from);
                        }

                        if (trim($to) != '') {
                            $this->collections = $this->collections->andWhere('DATE_FORMAT(c.updated_at,"%Y-%m-%d") <=?', $to);
                        }
                    }
                }
            }
            $this->collections = $this->collections->fetchArray();

            foreach ($this->collections as $key => $value) {
                $duration = new Collection();
                $duration = $duration->getDuration($value['id']);
                $this->collections[$key]['duration'] = $duration;
            }
            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            return $this->renderText(json_encode($this->collections));
        } else {
            $this->unitObject = $this->getRoute()->getObject();

            $this->forward404Unless($this->unitObject);
            $this->unitID = $request->getParameter('u');
            $this->unitID = $this->unitObject->getId();

            $this->forward404Unless($this->unitID);
            if ($this->getUser()->getGuardUser()->getType() == 3) {
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
            $this->ThisUnit = $unit;
         
            
        }
    }

    /**
     * generate form for collection.
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {

        $view = $this->getUser()->getAttribute('view');
        if (!$view || !$view['view']) {
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
    }

    /**
     * receive post request, process the form and insert the record.
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $view = $this->getUser()->getAttribute('view');
        if (!$view && !isset($view['view']) && !$view['view'])
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

        if ($success && isset($success['form']) && $success['form'] == true) {
//            $collection = $success['collection'];
//            header('location: /index.php');
            echo '<script> window.location= "/index.php"</script>';
            exit;
        } else {
            $this->setTemplate('new');
        }
//        echo url_for('assetgroup', $collection)
    }

    /**
     * generate collection form with prefilled values.
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $view = $this->getUser()->getAttribute('view');
        if (!$view || !$view['view']) {
            $view['view'] = 'score';
        }
        $this->forward404Unless($collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id'))), sprintf('Object collection does not exist (%s).', $request->getParameter('id')));
        $this->form = new CollectionForm(
                        $collection, array('userID' => $this->getUser()->getGuardUser()->getId(), 'unitID' => $request->getParameter('u'),
                    'action' => 'edit',
                    'view' => $view['view']
                        )
        );
        $this->view = $view['view'];
        $this->actionType = 'edit';
    }

    /**
     * receive post request, process form values and update the record
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
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
        if ($success && isset($success['form']) && $success['form'] == true) {
//            echo $success['id'];
            echo '<script> window.location= "/index.php"</script>';
            exit;
        } else {
            if ($success && isset($success['error']) && $success['error'] == true) {
                $this->locationError = 'This value is selected by a Collection or Asset Group. To de-select at the unit level, you must first de-select this value at the asset group and collection level';
            }
            $this->setTemplate('edit');
        }
    }

    /**
     * delete collection
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();
        $view = $this->getUser()->getAttribute('view');
        if (!$view || !$view['view']) {
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
        if (sizeof($assets) > 0) {
            $this->getUser()->setAttribute('delCollectionMsg', 'You must reassign the asset groups to another collection before you can delete this collection.');
        } else {
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
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $view = $this->getUser()->getAttribute('view');
        if (!$view || !$view['view']) {
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
        if ($isformValid) {
            $check = array();
            if ($view['view'] == 'score') {
                foreach ($collectionsAssets as $value) {
                    foreach ($form->getValue('storage_locations_list') as $location) {
                        if ($location == $value['resident_structure_description']) {
                            $check[] = $value['resident_structure_description'];
                        }
                    }
                }


                if (count($collectionsAssets) != count($check)) {
                    $error = array('error' => true);
                    return $error;
                }
            }

            $collection = $form->save();
            $success = array('form' => true, 'id' => $collection->getId(), 'collection' => $collection);

            return $success;
        } else {
            return $form;
        }
    }

}
