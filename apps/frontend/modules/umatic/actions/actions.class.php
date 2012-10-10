<?php

/**
 * umatic actions.
 *
 * @package    mediaSCORE
 * @subpackage umatic
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class umaticActions extends sfActions {

    /**
     * List all Umatic
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->umatics = Doctrine_Core::getTable('Umatic')
                ->createQuery('a')
                ->execute();
    }

    /**
     * Umatic detail of specific record
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->umatic = Doctrine_Core::getTable('Umatic')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->umatic);
    }

    /**
     * Umatic form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new UmaticForm();
    }

    /**
     * Umatic Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new UmaticForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * Umatic edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($umatic = Doctrine_Core::getTable('Umatic')->find(array($request->getParameter('id'))), sprintf('Object umatic does not exist (%s).', $request->getParameter('id')));
        $this->form = new UmaticForm($umatic);
    }

    /**
     * Umatic Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($umatic = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object umatic does not exist (%s).', $request->getParameter('id')));

        $umatic->setType(44);
        $umatic->save();
        $umatic = Doctrine_Core::getTable('Umatic')->find(array($request->getParameter('id')));
        $this->form = new UmaticForm($umatic);


        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    /**
     * Umatic Delete form
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($umatic = Doctrine_Core::getTable('Umatic')->find(array($request->getParameter('id'))), sprintf('Object umatic does not exist (%s).', $request->getParameter('id')));
        $umatic->delete();

        $this->redirect('umatic/index');
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
            $umatic = $form->save();
            $saveReturnId = array('form' => true, 'id' => $umatic->getId());
            return $saveReturnId;
        }
        return false;
    }

}
