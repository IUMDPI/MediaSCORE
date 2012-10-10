<?php

/**
 * openreelaudiotapepaper actions.
 *
 * @package    mediaSCORE
 * @subpackage openreelaudiotapepaper
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class openreelaudiotapepaperActions extends sfActions {

    /**
     * List all OpenReelAudiotapePaper
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->open_reel_audiotape_papers = Doctrine_Core::getTable('OpenReelAudiotapePaper')
                ->createQuery('a')
                ->execute();
    }

    /**
     * OpenReelAudiotapePaper Detail of specific records
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->open_reel_audiotape_paper = Doctrine_Core::getTable('OpenReelAudiotapePaper')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->open_reel_audiotape_paper);
    }

    /**
     * OpenReelAudiotapePaper form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new OpenReelAudiotapePaperForm();
    }

    /**
     * OpenReelAudiotapePaper Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new OpenReelAudiotapePaperForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * OpenReelAudiotapePaper edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($open_reel_audiotape_paper = Doctrine_Core::getTable('OpenReelAudiotapePaper')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_paper does not exist (%s).', $request->getParameter('id')));
        $this->form = new OpenReelAudiotapePaperForm($open_reel_audiotape_paper);
        $speed = explode(',', $open_reel_audiotape_paper->getSpeed());

        $this->form->setDefault('speed', $speed);
    }

    /**
     * OpenReelAudiotapePaper Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($open_reel_audiotape_paper = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_paper does not exist (%s).', $request->getParameter('id')));

        $open_reel_audiotape_paper->setType(11);
        $open_reel_audiotape_paper->save();

        $open_reel_audiotape_paper = Doctrine_Core::getTable('OpenReelAudiotapePaper')->find(array($request->getParameter('id')));
        $this->form = new OpenReelAudiotapePaperForm($open_reel_audiotape_paper);
        $speed = explode(',', $open_reel_audiotape_paper->getSpeed());

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
     * OpenReelAudiotapePaper Delete function
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($open_reel_audiotape_paper = Doctrine_Core::getTable('OpenReelAudiotapePaper')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_paper does not exist (%s).', $request->getParameter('id')));
        $open_reel_audiotape_paper->delete();

        $this->redirect('openreelaudiotapepaper/index');
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
            $open_reel_audiotape_paper = $form->save();
            $saveReturnId = array('form' => true, 'id' => $open_reel_audiotape_paper->getId());
            return $saveReturnId;
        }
        return false;
    }

}
