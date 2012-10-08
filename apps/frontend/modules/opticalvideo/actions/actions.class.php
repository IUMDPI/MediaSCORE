<?php

/**
 * opticalvideo actions.
 *
 * @package    mediaSCORE
 * @subpackage opticalvideo
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class opticalvideoActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->optical_videos = Doctrine_Core::getTable('OpticalVideo')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->optical_video = Doctrine_Core::getTable('OpticalVideo')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->optical_video);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new OpticalVideoForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new OpticalVideoForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($optical_video = Doctrine_Core::getTable('OpticalVideo')->find(array($request->getParameter('id'))), sprintf('Object optical_video does not exist (%s).', $request->getParameter('id')));
        $this->form = new OpticalVideoForm($optical_video);
        $dataLayer = explode(',', $optical_video->getDataLayer());
        $reflectiveLayer = explode(',', $optical_video->getReflectiveLayer());

        $this->form->setDefault('dataLayer', $dataLayer);
        $this->form->setDefault('reflectiveLayer', $reflectiveLayer);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($optical_video = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object optical_video does not exist (%s).', $request->getParameter('id')));
        $optical_video->setType(20);
        $optical_video->save();
        $optical_video = Doctrine_Core::getTable('OpticalVideo')->find(array($request->getParameter('id')));

        $this->form = new OpticalVideoForm($optical_video);
        $dataLayer = explode(',', $optical_video->getDataLayer());
        $reflectiveLayer = explode(',', $optical_video->getReflectiveLayer());

        $this->form->setDefault('dataLayer', $dataLayer);
        $this->form->setDefault('reflectiveLayer', $reflectiveLayer);
        
        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($optical_video = Doctrine_Core::getTable('OpticalVideo')->find(array($request->getParameter('id'))), sprintf('Object optical_video does not exist (%s).', $request->getParameter('id')));
        $optical_video->delete();

        $this->redirect('opticalvideo/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $optical_video = $form->save();
            $saveReturnId = array('form' => true, 'id' => $optical_video->getId());
            return $saveReturnId;
//      $this->redirect('opticalvideo/edit?id='.$optical_video->getId());
        }
        return false;
    }

}
