<?php

/**
 * openreelaudiotapeacetate actions.
 *
 * @package    mediaSCORE
 * @subpackage openreelaudiotapeacetate
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class openreelaudiotapeacetateActions extends sfActions {

    /**
     * List all OpenReelAudiotapeAcetate
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->open_reel_audiotape_acetates = Doctrine_Core::getTable('OpenReelAudiotapeAcetate')
                ->createQuery('a')
                ->execute();
    }

    /**
     * OpenReelAudiotapeAcetate Detail of specific record
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->open_reel_audiotape_acetate = Doctrine_Core::getTable('OpenReelAudiotapeAcetate')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->open_reel_audiotape_acetate);
    }

    /**
     * OpenReelAudiotapeAcetate Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new OpenReelAudiotapeAcetateForm();
    }

    /**
     * OpenReelAudiotapeAcetate Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new OpenReelAudiotapeAcetateForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * OpenReelAudiotapeAcetate Edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($open_reel_audiotape_acetate = Doctrine_Core::getTable('OpenReelAudiotapeAcetate')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_acetate does not exist (%s).', $request->getParameter('id')));
        $this->form = new OpenReelAudiotapeAcetateForm($open_reel_audiotape_acetate);
        // set the default value for speed
        $speed = explode(',', $open_reel_audiotape_acetate->getSpeed());
        $this->form->setDefault('speed', $speed);
    }

    /**
     * OpenReelAudiotapeAcetate Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($open_reel_audiotape_acetate = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_acetate does not exist (%s).', $request->getParameter('id')));

        $open_reel_audiotape_acetate->setType(10);
        $open_reel_audiotape_acetate->save();
        $open_reel_audiotape_acetate = Doctrine_Core::getTable('OpenReelAudiotapeAcetate')->find(array($request->getParameter('id')));
        $this->form = new OpenReelAudiotapeAcetateForm($open_reel_audiotape_acetate);

        $speed = explode(',', $open_reel_audiotape_acetate->getSpeed());
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
     * OpenReelAudiotapeAcetate Delete function
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($open_reel_audiotape_acetate = Doctrine_Core::getTable('OpenReelAudiotapeAcetate')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_acetate does not exist (%s).', $request->getParameter('id')));
        $open_reel_audiotape_acetate->delete();

        $this->redirect('openreelaudiotapeacetate/index');
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
            $open_reel_audiotape_acetate = $form->save();
            $saveReturnId = array('form' => true, 'id' => $open_reel_audiotape_acetate->getId());
            return $saveReturnId;
//      $this->redirect('openreelaudiotapeacetate/edit?id='.$open_reel_audiotape_acetate->getId());
        }
        return false;
    }

}
