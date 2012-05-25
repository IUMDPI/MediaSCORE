<?php

/**
 * unit actions.
 *
 * @package    mediaSCORE
 * @subpackage unit
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class unitActions extends sfActions {

    public function executeGetUnitForAssetGroup(sfWebRequest $request) {

        if ($request->isXmlHttpRequest()) {
            // assetgroup.parent_node_id -> collection
            // collection.parent_node_id -> unit

            $assetGroupID = $request->getParameter('id');

            // Too many exceptions thrown - taking an overly complex approach
            // (getFirst() and fetchOne() throw exceptions)
            // Needs to be optimized
            //$map = array('AssetGroup','Collection','Unit');

            $assetGroups = Doctrine_Core::getTable('AssetGroup')
                    ->createQuery('a')
                    ->where('id =?', $assetGroupID)
                    ->execute()
                    ->toArray();
            $assetGroup = array_pop($assetGroups);

            $collections = Doctrine_Core::getTable('Collection')
                    ->createQuery('c')
                    ->where('id =?', $assetGroup['parent_node_id'])
                    ->execute()
                    ->toArray();
            $collection = array_pop($collections);

            $units = Doctrine_Core::getTable('Unit')
                    ->createQuery('u')
                    ->where('id =?', $collection['parent_node_id'])
                    ->execute()
                    ->toArray();

            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            $this->setTemplate('index');
            echo json_encode(array_pop($units));
        }
    }

    public function executeUnitPersonnelLocation(sfWebRequest $request) {
        $unitId = $request->getParameter('u');
        $this->forward404Unless($request->isXmlHttpRequest());
        if ($request->isXmlHttpRequest()) {
            $unit = Doctrine_Query::Create()
                    ->from('Person p')
                    ->select('p.*')
                    ->innerJoin('p.UnitPerson up')
                    ->where('up.unit_id =?', $unitId)
                    ->fetchArray();
            $location = Doctrine_Query::Create()
                    ->from('StorageLocation sl')
                    ->select('sl.*')
                    ->innerJoin('sl.UnitStorageLocation usl')
                    ->where('usl.unit_id =?', $unitId)
                    ->fetchArray();
            return $this->renderText(json_encode(array('success' => true, 'unit' => $unit, 'location' => $location)));
        }
    }

    public function executeGetUserDetail(sfWebRequest $request) {

        $this->forward404Unless($request->isXmlHttpRequest());
        if ($request->isXmlHttpRequest()) {
            $explodeId = explode(',', $request->getParameter('id'));
            $user = Doctrine_Core::getTable('sfGuardUser')
                    ->createQuery('c')
                    ->whereIn('id ', $explodeId)
                    ->execute()
                    ->toArray();
            return $this->renderText(json_encode(array('success' => true, 'id' => $request->getParameter('id'), 'records' => $user)));
        }
    }

    public function executeIndex(sfWebRequest $request) {

        $this->units = Doctrine_Core::getTable('Unit')
                ->createQuery('a')
                ->execute();

        // Cannot forge a one-to-one relationship with myUser class that provides a 
        /* $this->creators = array();
          foreach($this->units as $unit) {

          //$unit->getCreator();

          $this->creators[$unit->getId()] = Doctrine_Core::getTable('User')->find( $unit->getCreatorId() );
          }

          $this->editors = array();
          foreach($this->units as $unit) {
          $this->editors[$unit->getId()] = Doctrine_Core::getTable('User')->find( $unit->getLastEditorId() );
          } */


        // To be moved into a separate Action or Controller
        if ($request->isXmlHttpRequest()) {
            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            echo json_encode($this->units->toArray());
        }
    }

    public function executeShow(sfWebRequest $request) {

        if ($request->isXmlHttpRequest()) {

            $unit = Doctrine_Core::getTable('Unit')->find(
                            Doctrine_Core::getTable('Collection')->find($request->getParameter('collectionID'))->getParentNodeId())->toArray();
            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->getResponse()->setContent(json_encode($unit));
            return sfView::NONE;
        } else {

            $this->unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id')));
            $this->forward404Unless($this->unit);
        }
    }

    public function executeNew(sfWebRequest $request) {
        //$this->form = new UnitForm();
        //$this->setLayout('fancyLayout');
        $this->form = new UnitForm(
                        null,
                        array(
                            'userID' => $this->getUser()->getGuardUser()->getId()
                ));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new UnitForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));
        $this->form = new UnitForm(
                        $unit,
                        array(
                            'userID' => $this->getUser()->getGuardUser()->getId()
                ));
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));
        $this->form = new UnitForm($unit);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();

        $this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));
        
        $unit->delete();
        

        $this->redirect('unit/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $unit = $form->save();

            $this->redirect('unit/index');
        }
    }

}
