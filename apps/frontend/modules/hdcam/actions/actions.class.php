<?php

/**
 * hdcam actions.
 *
 * @package    mediaSCORE
 * @subpackage hdcam
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class hdcamActions extends sfActions {

    /**
     * Generate HDCam form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new HDCamForm();
    }

    /**
     * HDCam Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new HDCamForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * HDCam edit Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($hd_cam = Doctrine_Core::getTable('HDCam')->find(array($request->getParameter('id'))), sprintf('Object hd_cam does not exist (%s).', $request->getParameter('id')));
        $this->form = new HDCamForm($hd_cam);
    }

    /**
     * HDCam Post Edit form Process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($hd_cam = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object hd_cam does not exist (%s).', $request->getParameter('id')));

        $hd_cam->setType(45);
        $hd_cam->save();
        $hd_cam = Doctrine_Core::getTable('HDCam')->find(array($request->getParameter('id')));
        $this->form = new HDCamForm($hd_cam);

        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
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
            $hd_cam = $form->save();
            $saveReturnId = array('form' => true, 'id' => $hd_cam->getId());
            return $saveReturnId;
        }
        return false;
    }

}
