<?php

/**
 * xdcamoptical actions.
 *
 * @package    mediaSCORE
 * @subpackage xdcamoptical
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class xdcamopticalActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->xd_cam_opticals = Doctrine_Core::getTable('XDCamOptical')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->xd_cam_optical = Doctrine_Core::getTable('XDCamOptical')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->xd_cam_optical);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new XDCamOpticalForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new XDCamOpticalForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($xd_cam_optical = Doctrine_Core::getTable('XDCamOptical')->find(array($request->getParameter('id'))), sprintf('Object xd_cam_optical does not exist (%s).', $request->getParameter('id')));
        $this->form = new XDCamOpticalForm($xd_cam_optical);
        $codec = explode(',', $xd_cam_optical->getCodec());
        $dataRate = explode(',', $xd_cam_optical->getDataRate());

        $this->form->setDefault('codec', $codec);
        $this->form->setDefault('dataRate', $dataRate);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($xd_cam_optical = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object xd_cam_optical does not exist (%s).', $request->getParameter('id')));
        $xd_cam_optical->setType(27);
        $xd_cam_optical->save();
        $xd_cam_optical = Doctrine_Core::getTable('XDCamOptical')->find(array($request->getParameter('id')));
        $this->form = new XDCamOpticalForm($xd_cam_optical);
        $codec = explode(',', $xd_cam_optical->getCodec());
        $dataRate = explode(',', $xd_cam_optical->getDataRate());

        $this->form->setDefault('codec', $codec);
        $this->form->setDefault('dataRate', $dataRate);
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

        $this->forward404Unless($xd_cam_optical = Doctrine_Core::getTable('XDCamOptical')->find(array($request->getParameter('id'))), sprintf('Object xd_cam_optical does not exist (%s).', $request->getParameter('id')));
        $xd_cam_optical->delete();

        $this->redirect('xdcamoptical/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $xd_cam_optical = $form->save();
            $saveReturnId = array('form' => true, 'id' => $xd_cam_optical->getId());
            return $saveReturnId;

//      $this->redirect('xdcamoptical/edit?id='.$xd_cam_optical->getId());
        }
        return false;
    }

}
