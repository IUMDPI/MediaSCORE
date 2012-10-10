<?php

/**
 * laserdisc actions.
 *
 * @package    mediaSCORE
 * @subpackage laserdisc
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class laserdiscActions extends sfActions {

    /**
     * Generate Laserdisc form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new LaserdiscForm();
    }

    /**
     * Laserdisc Post fom process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new LaserdiscForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * Laserdisc edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($laserdisc = Doctrine_Core::getTable('Laserdisc')->find(array($request->getParameter('id'))), sprintf('Object laserdisc does not exist (%s).', $request->getParameter('id')));
        $this->form = new LaserdiscForm($laserdisc);
    }

    /**
     * Laserdisc Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($laserdisc = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object laserdisc does not exist (%s).', $request->getParameter('id')));
        $laserdisc->setType(26);
        $laserdisc->save();
        $laserdisc = Doctrine_Core::getTable('Laserdisc')->find(array($request->getParameter('id')));

        $this->form = new LaserdiscForm($laserdisc);

        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    /**
     * Laserdisc Delete
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($laserdisc = Doctrine_Core::getTable('Laserdisc')->find(array($request->getParameter('id'))), sprintf('Object laserdisc does not exist (%s).', $request->getParameter('id')));
        $laserdisc->delete();

        $this->redirect('laserdisc/index');
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
            $laserdisc = $form->save();
            $saveReturnId = array('form' => true, 'id' => $laserdisc->getId());
            return $saveReturnId;
        }
        return false;
    }

}
