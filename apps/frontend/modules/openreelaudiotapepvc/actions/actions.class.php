<?php

/**
 * openreelaudiotapepvc actions.
 *
 * @package    mediaSCORE
 * @subpackage openreelaudiotapepvc
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class openreelaudiotapepvcActions extends sfActions {

    /**
     * OpenReelAudiotapePVC List all
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->open_reel_audiotape_pv_cs = Doctrine_Core::getTable('OpenReelAudiotapePVC')
                ->createQuery('a')
                ->execute();
    }

    /**
     * OpenReelAudiotapePVC detail of specific record
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->open_reel_audiotape_pvc = Doctrine_Core::getTable('OpenReelAudiotapePVC')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->open_reel_audiotape_pvc);
    }

    /**
     * OpenReelAudiotapePVC form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new OpenReelAudiotapePVCForm();
    }

    /**
     * OpenReelAudiotapePVC Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new OpenReelAudiotapePVCForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * OpenReelAudiotapePVC Edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($open_reel_audiotape_pvc = Doctrine_Core::getTable('OpenReelAudiotapePVC')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_pvc does not exist (%s).', $request->getParameter('id')));
        $this->form = new OpenReelAudiotapePVCForm($open_reel_audiotape_pvc);

        $speed = explode(',', $open_reel_audiotape_pvc->getSpeed());

        $this->form->setDefault('speed', $speed);
    }

    /**
     * OpenReelAudiotapePVC Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($open_reel_audiotape_pvc = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_pvc does not exist (%s).', $request->getParameter('id')));
        $open_reel_audiotape_pvc->setType(12);
        $open_reel_audiotape_pvc->save();

        $open_reel_audiotape_pvc = Doctrine_Core::getTable('OpenReelAudiotapePVC')->find(array($request->getParameter('id')));
        $this->form = new OpenReelAudiotapePVCForm($open_reel_audiotape_pvc);

        // set the default value for speed
        $speed = explode(',', $open_reel_audiotape_pvc->getSpeed());
        $this->form->setDefault('speed', $speed);

        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    /**
     * OpenReelAudiotapePVC Delete function
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($open_reel_audiotape_pvc = Doctrine_Core::getTable('OpenReelAudiotapePVC')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_pvc does not exist (%s).', $request->getParameter('id')));
        $open_reel_audiotape_pvc->delete();

        $this->redirect('openreelaudiotapepvc/index');
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
            $open_reel_audiotape_pvc = $form->save();
            $saveReturnId = array('form' => true, 'id' => $open_reel_audiotape_pvc->getId());
            return $saveReturnId;
        }
    }

}
