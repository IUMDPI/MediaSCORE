<?php

/**
 * dvcam actions.
 *
 * @package    mediaSCORE
 * @subpackage dvcam
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dvcamActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->dv_cams = Doctrine_Core::getTable('DVCam')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->dv_cam = Doctrine_Core::getTable('DVCam')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->dv_cam);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new DVCamForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DVCamForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($dv_cam = Doctrine_Core::getTable('DVCam')->find(array($request->getParameter('id'))), sprintf('Object dv_cam does not exist (%s).', $request->getParameter('id')));
        $this->form = new DVCamForm($dv_cam);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($dv_cam = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object dv_cam does not exist (%s).', $request->getParameter('id')));

        $dv_cam->setType(38);
        $dv_cam->save();
        $dv_cam = Doctrine_Core::getTable('DVCam')->find(array($request->getParameter('id')));
        $this->form = new DVCamForm($dv_cam);

        $this->form->disableLocalCSRFProtection();
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

        $this->forward404Unless($dv_cam = Doctrine_Core::getTable('DVCam')->find(array($request->getParameter('id'))), sprintf('Object dv_cam does not exist (%s).', $request->getParameter('id')));
        $dv_cam->delete();

        $this->redirect('dvcam/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $dv_cam = $form->save();
            $saveReturnId = array('form' => true, 'id' => $dv_cam->getId());
            return $saveReturnId;
//      $this->redirect('dvcam/edit?id='.$dv_cam->getId());
        }
        return false;
    }

}
