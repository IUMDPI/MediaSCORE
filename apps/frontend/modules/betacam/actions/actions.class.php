<?php

/**
 * betacam actions.
 *
 * @package    mediaSCORE
 * @subpackage betacam
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class betacamActions extends sfActions {

    /**
     * Generate Betacam form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new BetacamForm();
    }

    /**
     * Betacam Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new BetacamForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * Betacam edit Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($betacam = Doctrine_Core::getTable('Betacam')->find(array($request->getParameter('id'))), sprintf('Object betacam does not exist (%s).', $request->getParameter('id')));
        $this->form = new BetacamForm($betacam);
    }
    /**
     * Betacam Post Edit form Process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($betacam = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object betacam does not exist (%s).', $request->getParameter('id')));
        // change the format type
        $betacam->setType(40);
        $betacam->save();
        $betacam = Doctrine_Core::getTable('Betacam')->find(array($request->getParameter('id')));
        $this->form = new BetacamForm($betacam);


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
            $betacam = $form->save();
            $saveReturnId = array('form' => true, 'id' => $betacam->getId());
            return $saveReturnId;
        }
        return false;
    }

}
