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
    /**
     * Generate DVCam form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new DVCamForm();
    }
    /**
     * DVCam Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DVCamForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }
    /**
     * DVCam edit Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($dv_cam = Doctrine_Core::getTable('DVCam')->find(array($request->getParameter('id'))), sprintf('Object dv_cam does not exist (%s).', $request->getParameter('id')));
        $this->form = new DVCamForm($dv_cam);
    }
    /**
     * DVCam Post Edit form Process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($dv_cam = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object dv_cam does not exist (%s).', $request->getParameter('id')));

        $dv_cam->setType(38);
        $dv_cam->save();
        $dv_cam = Doctrine_Core::getTable('DVCam')->find(array($request->getParameter('id')));
        $this->form = new DVCamForm($dv_cam);

        
        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    
    /**
     * Process and Validate Form
     * 
     * @param sfWebRequest $request
     * @param sfForm $form
     * @return boolean if form is not validated
     * @return integer if form is validated then return id
     */
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $dv_cam = $form->save();
            $saveReturnId = array('form' => true, 'id' => $dv_cam->getId());
            return $saveReturnId;

        }
        return false;
    }

}
