<?php

/**
 * pressedlpdisc actions.
 *
 * @package    mediaSCORE
 * @subpackage pressedlpdisc
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pressedlpdiscActions extends sfActions {

    /**
     * List all PressedLPDisc
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->pressed_lp_discs = Doctrine_Core::getTable('PressedLPDisc')
                ->createQuery('a')
                ->execute();
    }

    /**
     * PressedLPDisc detail of specific record
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->pressed_lp_disc = Doctrine_Core::getTable('PressedLPDisc')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->pressed_lp_disc);
    }

    /**
     * PressedLPDisc form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new PressedLPDiscForm();
    }

    /**
     * PressedLPDisc Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new PressedLPDiscForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * PressedLPDisc edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($pressed_lp_disc = Doctrine_Core::getTable('PressedLPDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_lp_disc does not exist (%s).', $request->getParameter('id')));
        $this->form = new PressedLPDiscForm($pressed_lp_disc);
    }

    /**
     * PressedLPDisc Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($pressed_lp_disc = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object pressed_lp_disc does not exist (%s).', $request->getParameter('id')));
        $pressed_lp_disc->setType(23);
        $pressed_lp_disc->save();
        $pressed_lp_disc = Doctrine_Core::getTable('PressedLPDisc')->find(array($request->getParameter('id')));

        $this->form = new PressedLPDiscForm($pressed_lp_disc);


        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    /**
     * PressedLPDisc Delete form
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($pressed_lp_disc = Doctrine_Core::getTable('PressedLPDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_lp_disc does not exist (%s).', $request->getParameter('id')));
        $pressed_lp_disc->delete();

        $this->redirect('pressedlpdisc/index');
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
            $pressed_lp_disc = $form->save();
            $saveReturnId = array('form' => true, 'id' => $pressed_lp_disc->getId());
            return $saveReturnId;
        }
        return false;
    }

}
