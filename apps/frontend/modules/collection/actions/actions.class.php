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

    public function executeIndex(sfWebRequest $request) {
        $unitID = $request->getParameter('id');
        $searchInpout = $request->getParameter('s');
        $status = $request->getParameter('status');
        $from = $request->getParameter('from');
        $to = $request->getParameter('to');
        $dateType = $request->getParameter('datetype');

        // Get collections for a specific Unit
        if ($request->isXmlHttpRequest()) {
            $this->collections = Doctrine_Query::Create()
                    ->from('Collection c')
                    ->select('c.*,cu.*,eu.*')
                    ->innerJoin('c.Creator cu')
                    ->innerJoin('c.Editor eu')
                    ->where('c.parent_node_id  = ?', $unitID);
            if ($searchInpout && trim($searchInpout) != '') {
                $this->collections = $this->collections->andWhere('name like "%' . $searchInpout . '%"');
            }
            if ($status && trim($status) != '') {
                $this->collections = $this->collections->andWhere('status =?', $status);
            }
            if ($dateType != '') {
                if ($dateType == 0) {
                    if (trim($from) != '' && trim($to) != '') {
                        $this->collections = $this->collections->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(created_at,"%Y-%m-%d") <= "' . $to . '"');
                    } else {
                        if (trim($from) != '') {
                            $this->collections = $this->collections->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") >=?', $from);
                        }

                        if (trim($to) != '') {
                            $this->collections = $this->collections->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") <=?', $to);
                        }
                    }
                } else if ($dateType == 1) {
                    if (trim($from) != '' && trim($to) != '') {
                        $this->collections = $this->collections->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(updated_at,"%Y-%m-%d") <= "' . $to . '"');
                    } else {
                        if (trim($from) != '') {
                            $this->collections = $this->collections->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") >=?', $from);
                        }

                        if (trim($to) != '') {
                            $this->collections = $this->collections->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") <=?', $to);
                        }
                    }
                }
            }
            $this->collections = $this->collections->execute();
            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            return $this->renderText(json_encode($this->collections->toArray()));
        } else {
            $this->unitObject = $this->getRoute()->getObject();

            $this->forward404Unless($this->unitObject);
//            $this->unitID = $request->getParameter('u');
            $this->unitID = $this->unitObject->getId();
            $this->forward404Unless($this->unitID);

            $this->deleteMessage = $this->getUser()->getAttribute('delCollectionMsg');
            $this->getUser()->getAttributeHolder()->remove('delCollectionMsg');
            $unit = Doctrine_Core::getTable('Unit')
                    ->find($this->unitID);
            $this->forward404Unless($unit);
            $this->unitName = $unit->getName();
            $this->collections = Doctrine_Query::Create()
                    ->from('Collection c')
                    ->select('c.*')
                    ->where('c.parent_node_id  = ?', $this->unitID)
                    ->execute();
        }
    }

    public function executeShow(sfWebRequest $request) {
        $this->collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->collection);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new CollectionForm(null,
                        array(
                            'userID' => $this->getUser()->getGuardUser()->getId(),
                            'unitID' => $request->getParameter('u'))
        );
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $unitId = sfToolkit::getArrayValueForPath($request->getParameter('collection'), 'parent_node_id');
        $this->form = new CollectionForm(null,
                        array(
                            'userID' => $this->getUser()->getGuardUser()->getId(),
                            'unitID' => $unitId)
        );

        $success = $this->processForm($request, $this->form);
        if ($success && isset($success['form']) && $success['form'] == true) {
            echo $success['id'];
            exit;
        } else {
            $this->setTemplate('new');
        }
    }

    public function executeEdit(sfWebRequest $request) {

        $this->forward404Unless($collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id'))), sprintf('Object collection does not exist (%s).', $request->getParameter('id')));
        $this->form = new CollectionForm(
                        $collection,
                        array(
                            'userID' => $this->getUser()->getGuardUser()->getId(),
                            'unitID' => $request->getParameter('u'),
                            'action' => 'edit')
        );
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id'))), sprintf('Object collection does not exist (%s).', $request->getParameter('id')));
        $unitId = sfToolkit::getArrayValueForPath($request->getParameter('collection'), 'parent_node_id');
        $this->form = new CollectionForm($collection, array(
                    'userID' => $this->getUser()->getGuardUser()->getId(),
                    'unitID' => $unitId,
                    'action' => 'edit'
                ));

        $success = $this->processForm($request, $this->form);
        if ($success && isset($success['form']) && $success['form'] == true) {
            echo $success['id'];
            exit;
        } else {
            if ($success && isset($success['error']) && $success['error'] == true) {
                $this->locationError = 'This value is selected by a Collection or Asset Group. To de-select at the unit level, you must first de-select this value at the asset group and collection level';
            }
            $this->setTemplate('edit');
        }
    }

    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();

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
        $this->redirect('/' . $unit->getNameSlug());
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $collectionsAssets = Doctrine_Query::Create()
                ->from('AssetGroup ag')
                ->select('ag.*')
                ->where('ag.parent_node_id  = ?', $form->getValue('id'))
                ->groupBy('ag.resident_structure_description')
                ->fetchArray();

        if ($form->isValid()) {
            $check = array();
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
            $collection = $form->save();
            $success = array('form' => true, 'id' => $collection->getId());
            return $success;
        }
    }

}
