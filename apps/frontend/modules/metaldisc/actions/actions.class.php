<?php

/**
 * metaldisc actions.
 *
 * @package    mediaSCORE
 * @subpackage metaldisc
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class metaldiscActions extends sfActions {

    /**
     * List All MetalDisc
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->metal_discs = Doctrine_Core::getTable('MetalDisc')
                ->createQuery('a')
                ->execute();
    }

    /**
     * MetalDisc Detail 
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->metal_disc = Doctrine_Core::getTable('MetalDisc')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->metal_disc);
    }

    /**
     * MetalDisc new Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new MetalDiscForm();
    }

    /**
     * MetalDisc Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new MetalDiscForm();

        $validateForm = $this->processForm($request, $this->form);
        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('new');
        }
    }

    /**
     * MetalDisc Edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($metal_disc = Doctrine_Core::getTable('MetalDisc')->find(array($request->getParameter('id'))), sprintf('Object metal_disc does not exist (%s).', $request->getParameter('id')));
        $this->form = new MetalDiscForm($metal_disc);
    }

    /**
     * MetalDisc Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($metal_disc = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object metal_disc does not exist (%s).', $request->getParameter('id')));

        $metal_disc->setType(1);
        $metal_disc->save();
        $metal_disc = Doctrine_Core::getTable('MetalDisc')->find(array($request->getParameter('id')));
        $this->form = new MetalDiscForm($metal_disc);

        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    /**
     * Delete MetalDisc
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($metal_disc = Doctrine_Core::getTable('MetalDisc')->find(array($request->getParameter('id'))), sprintf('Object metal_disc does not exist (%s).', $request->getParameter('id')));
        $metal_disc->delete();

        $this->redirect('metaldisc/index');
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
            $metal_disc = $form->save();
            $saveReturnId = array('form' => true, 'id' => $metal_disc->getId());
            return $saveReturnId;
        }
    }

}
