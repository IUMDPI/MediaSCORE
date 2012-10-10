<?php

/**
 * betamax actions.
 *
 * @package    mediaSCORE
 * @subpackage betamax
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class betamaxActions extends sfActions {

    /**
     * Generate Betamax form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new BetamaxForm();
    }

    /**
     * Betamax Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new BetamaxForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * Betamax edit Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($betamax = Doctrine_Core::getTable('Betamax')->find(array($request->getParameter('id'))), sprintf('Object betamax does not exist (%s).', $request->getParameter('id')));
        $this->form = new BetamaxForm($betamax);
    }

    /**
     * Betamax Post Edit form Process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($betamax = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object betamax does not exist (%s).', $request->getParameter('id')));

        $betamax->setType(29);
        $betamax->save();
        $betamax = Doctrine_Core::getTable('Betamax')->find(array($request->getParameter('id')));
        $this->form = new BetamaxForm($betamax);


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
            $betamax = $form->save();
            $saveReturnId = array('form' => true, 'id' => $betamax->getId());
            return $saveReturnId;
        }
        return false;
    }

}
