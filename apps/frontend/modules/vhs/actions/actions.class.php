<?php

/**
 * vhs actions.
 *
 * @package    mediaSCORE
 * @subpackage vhs
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vhsActions extends sfActions {

    /**
     * List all VHS
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->vh_ss = Doctrine_Core::getTable('VHS')
                ->createQuery('a')
                ->execute();
    }

    /**
     * VHS detail of specific record
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->vhs = Doctrine_Core::getTable('VHS')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->vhs);
    }

    /**
     * VHS form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new VHSForm();
    }

    /**
     * VHS Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new VHSForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * VHS edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($vhs = Doctrine_Core::getTable('VHS')->find(array($request->getParameter('id'))), sprintf('Object vhs does not exist (%s).', $request->getParameter('id')));
        $this->form = new VHSForm($vhs);
    }

    /**
     * VHS Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($vhs = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object vhs does not exist (%s).', $request->getParameter('id')));

        $vhs->setType(41);
        $vhs->save();
        $vhs = Doctrine_Core::getTable('VHS')->find(array($request->getParameter('id')));
        $this->form = new VHSForm($vhs);

        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    /**
     * VHS Delete form
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($vhs = Doctrine_Core::getTable('VHS')->find(array($request->getParameter('id'))), sprintf('Object vhs does not exist (%s).', $request->getParameter('id')));
        $vhs->delete();

        $this->redirect('vhs/index');
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
            $vhs = $form->save();
            $saveReturnId = array('form' => true, 'id' => $vhs->getId());
            return $saveReturnId;
        }
        return false;
    }

}
