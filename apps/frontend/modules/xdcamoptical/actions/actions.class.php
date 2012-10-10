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

    /**
     * List all XDCamOptical
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->xd_cam_opticals = Doctrine_Core::getTable('XDCamOptical')
                ->createQuery('a')
                ->execute();
    }

    /**
     * XDCamOptical detail of specific record
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->xd_cam_optical = Doctrine_Core::getTable('XDCamOptical')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->xd_cam_optical);
    }

    /**
     * XDCamOptical form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new XDCamOpticalForm();
    }

    /**
     * XDCamOptical Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new XDCamOpticalForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * XDCamOptical edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($xd_cam_optical = Doctrine_Core::getTable('XDCamOptical')->find(array($request->getParameter('id'))), sprintf('Object xd_cam_optical does not exist (%s).', $request->getParameter('id')));
        $this->form = new XDCamOpticalForm($xd_cam_optical);
        $codec = explode(',', $xd_cam_optical->getCodec());
        $dataRate = explode(',', $xd_cam_optical->getDataRate());

        $this->form->setDefault('codec', $codec);
        $this->form->setDefault('dataRate', $dataRate);
    }

    /**
     * XDCamOptical Post edit form process
     * 
     * @param sfWebRequest $request 
     */
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

        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    /**
     * XDCamOptical Delete form
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($xd_cam_optical = Doctrine_Core::getTable('XDCamOptical')->find(array($request->getParameter('id'))), sprintf('Object xd_cam_optical does not exist (%s).', $request->getParameter('id')));
        $xd_cam_optical->delete();

        $this->redirect('xdcamoptical/index');
    }

    /**
     * Process and validate form
     * 
     * @param sfWebRequest $request
     * @param sfForm $form
     * @return boolean if form is not validated
     * @return integer if form is validated then return id
     */
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $xd_cam_optical = $form->save();
            $saveReturnId = array('form' => true, 'id' => $xd_cam_optical->getId());
            return $saveReturnId;
        }
        return false;
    }

}
