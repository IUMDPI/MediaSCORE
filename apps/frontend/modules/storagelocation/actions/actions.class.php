<?php

/**
 * storagelocation actions.
 *
 * @package    mediaSCORE
 * @subpackage storagelocation
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class storagelocationActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {


        $unitID = $request->getParameter('u');
        $collectionID = $request->getParameter('c');
        $new = $request->getParameter('n');
        if ($request->isXmlHttpRequest()) {
            if ($unitID) {
                $storageLocations = Doctrine_Core::getTable('Unit')
                                ->find($unitID)->getStorageLocations();
                $this->getResponse()->setHttpHeader('Content-type', 'application/json');
                $this->setLayout('json');
                return $this->renderText(json_encode($storageLocations->toArray()));
            } elseif ($collectionID) {
                $storageLocations = Doctrine_Core::getTable('Collection')
                                ->find($collectionID)->getStorageLocations();
                $this->getResponse()->setHttpHeader('Content-type', 'application/json');
                $this->setLayout('json');
                if ($new) {
                    return $this->renderText(json_encode(array('s' => $storageLocations->toArray(), 'n' => $this->getUser()->getAttribute('storage_locations_list'))));
                }
                return $this->renderText(json_encode($storageLocations->toArray()));
            } else {
                $this->storage_locations = Doctrine_Core::getTable('StorageLocation')
                        ->createQuery('a')
                        ->execute();
            }
        } else {
            $this->storage_locations = Doctrine_Core::getTable('StorageLocation')
                    ->createQuery('a')
                    ->execute();
        }
    }

    public function executeShow(sfWebRequest $request) {
        $this->storage_location = Doctrine_Core::getTable('StorageLocation')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->storage_location);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new StorageLocationForm();
    }

    public function executeCreate(sfWebRequest $request) {
        
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isXmlHttpRequest());

        $this->form = new StorageLocationForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($storage_location = Doctrine_Core::getTable('StorageLocation')->find(array($request->getParameter('id'))), sprintf('Object storage_location does not exist (%s).', $request->getParameter('id')));
        $this->form = new StorageLocationForm($storage_location);
    }

    public function executeUpdate(sfWebRequest $request) {
        
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT) || $request->isXmlHttpRequest());

        $postParameters = $request->getPostParameters();
        if (!($request->getParameter('id')))
            $storageLocationID = $postParameters['storage_location']['id'];
        else
            $storageLocationID = $request->getParameter('id');
        $this->forward404Unless($storage_location = Doctrine_Core::getTable('StorageLocation')->find($storageLocationID), sprintf('Object storage_location does not exist (%s).', $storageLocationID));
        
        $this->form = new StorageLocationForm($storage_location);
        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {

        
        //$request->checkCSRFProtection();

        $postParameters = $request->getPostParameters();
        if (!($request->getParameter('id')))
            $storageLocationID = $postParameters['storage_location']['id'];
        else
            $storageLocationID = $request->getParameter('id');

        $this->forward404Unless($storage_location = Doctrine_Core::getTable('StorageLocation')->find($storageLocationID), sprintf('Object storage_location does not exist (%s).', $storageLocationID));
        $storage_location->delete();

        if ($request->isXmlHttpRequest())
            return sfView::NONE;
        else
            $this->redirect('storagelocation/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $storage_location = $form->save();
            if ($request->isXmlHttpRequest())
                return sfView::NONE;
            else
                $this->redirect('storagelocation/index');
        }
    }

}
