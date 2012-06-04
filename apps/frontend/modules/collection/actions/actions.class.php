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

        // Get collections for a specific Unit
        if ($request->isXmlHttpRequest()) {
            $this->collections = Doctrine_Core::getTable('Collection')
                    ->createQuery('a')
                    ->where('parent_node_id', $unitID)
                    ->execute();

            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            return $this->renderText(json_encode($this->collections->toArray()));
        } else {
            $this->filter = new CollectionFormFilter();
            $this->unitID = $request->getParameter('u');
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

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
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

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();

        $this->forward404Unless($collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id'))), sprintf('Object collection does not exist (%s).', $request->getParameter('id')));
        $collection->delete();

        $this->redirect('collection/index?u=' . $request->getParameter('u'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

//        $unitId=sfToolkit::getArrayValueForPath($request->getParameter($form->getName()), 'parent_node_id');
//        $form->setOption('unitID', $unitId);
//        $form->setDefault('unitID',  $form->getObject()->getParentNodeId()); 
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $collection = $form->save();

            $this->redirect('collection/index?u=' . $form->getObject()->getParentNodeId());
        }
    }

}
