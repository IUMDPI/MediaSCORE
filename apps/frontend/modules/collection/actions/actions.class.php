<?php

/**
 * collection actions.
 *
 * @package    mediaSCORE
 * @subpackage collection
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class collectionActions extends sfActions {

    public function executeGetCollectionsForUnit(sfWebRequest $request) {

        if ($request->isXmlHttpRequest()) {

            $unitID = $request->getParameter('id');

            // Too many exceptions thrown - taking an overly complex approach
            // (getFirst() and fetchOne() throw exceptions)
            // Needs to be optimized

            $collections = Doctrine_Core::getTable('Collection')
                    ->createQuery('c')
                    ->where('parent_node_id =?', $unitID)
                    ->execute()
                    ->toArray();

            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            $this->setTemplate('index');
            echo json_encode($collections);
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
//            $this->collections = Doctrine_Core::getTable('Collection')
//                    ->createQuery('a')
//                    ->where('parent_node_id =?', $unitID)
//                    ->andWhere('name like "%'.$searchInpout.'%"')
//                    ->execute();

            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            return $this->renderText(json_encode($this->collections->toArray()));
        } else {
//            $this->unitObject = $this->getRoute()->getObject();
            
            
            
//            $this->forward404Unless($this->unitObject);
            $this->deleteMessage = $this->getUser()->getAttribute('delCollectionMsg');
            $this->getUser()->getAttributeHolder()->remove('delCollectionMsg');

            $this->unitID = $request->getParameter('u');
//            $this->unitID = $this->unitObject->getId();
            $this->forward404Unless($this->unitID);

            $unit = Doctrine_Core::getTable('Unit')
                    ->find($this->unitID);
            $this->forward404Unless($unit);
            $this->unitName = $unit->getName();
            $this->collections = Doctrine_Query::Create()
                    ->from('Collection c')
                    ->select('c.*')
                    ->where('c.parent_node_id  = ?', $this->unitID)
                    ->execute();

//            $this->collections = Doctrine_Core::getTable('Collection')
//                    ->findBy('parent_node_id', $this->unitID);
//                                $this->filter=new CollectionFormFilter;
            //->findAll();
//		print_r($this->collections->toArray());exit;
        }
    }

    public function executeShow(sfWebRequest $request) {
        $this->collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->collection);
    }

    public function executeNew(sfWebRequest $request) {
        //$this->unitID=$request->getParameter('u');

        $this->form = new CollectionForm(null,
                        array(
                            'userID' => $this->getUser()->getGuardUser()->getId(),
                            'unitID' => $request->getParameter('u'))
        );

        //$this->form = new CollectionForm();
        //$this->form->setOption('unitID',$request->getParameter('u'));
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
            $this->setTemplate('edit');
        }
    }

    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();

        $this->forward404Unless($collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id'))), sprintf('Object collection does not exist (%s).', $request->getParameter('id')));
        $assets = Doctrine_Query::Create()
                ->from('AssetGroup ag')
                ->select('ag.*')
                ->where('ag.parent_node_id  = ?', $request->getParameter('id'))
                ->fetchArray();
        if (sizeof($assets) > 0) {
            $this->getUser()->setAttribute('delCollectionMsg', 'You have to delete assets group first to remove this collection.');
        } else {
            $collection->delete();
        }
        $this->redirect('collection/index?u=' . $request->getParameter('u'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

//        $unitId=sfToolkit::getArrayValueForPath($request->getParameter($form->getName()), 'parent_node_id');
//        $form->setOption('unitID', $unitId);
//        $form->setDefault('unitID',  $form->getObject()->getParentNodeId()); 
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $collection = $form->save();
            $success = array('form' => true, 'id' => $collection->getId());
            return $success;
//            $this->redirect('collection/index?u=' . $form->getObject()->getParentNodeId());
        }
    }

}
