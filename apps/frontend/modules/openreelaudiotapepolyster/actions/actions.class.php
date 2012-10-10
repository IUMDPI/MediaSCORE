<?php

/**
 * openreelaudiotapepolyster actions.
 *
 * @package    mediaSCORE
 * @subpackage openreelaudiotapepolyster
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class openreelaudiotapepolysterActions extends sfActions {

    /**
     * OpenReelAudiotapePolyster List all
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->open_reel_audiotape_polysters = Doctrine_Core::getTable('OpenReelAudiotapePolyster')
                ->createQuery('a')
                ->execute();
    }

    /**
     * OpenReelAudiotapePolyster detail of specific record
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->open_reel_audiotape_polyster = Doctrine_Core::getTable('OpenReelAudiotapePolyster')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->open_reel_audiotape_polyster);
    }

    /**
     * OpenReelAudiotapePolyster form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new OpenReelAudiotapePolysterForm();
    }

    /**
     * OpenReelAudiotapePolyster Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new OpenReelAudiotapePolysterForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * OpenReelAudiotapePolyster edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($open_reel_audiotape_polyster = Doctrine_Core::getTable('OpenReelAudiotapePolyster')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_polyster does not exist (%s).', $request->getParameter('id')));
        $this->form = new OpenReelAudiotapePolysterForm($open_reel_audiotape_polyster);

        $speed = explode(',', $open_reel_audiotape_polyster->getSpeed());
        $this->form->setDefault('speed', $speed);
    }

    /**
     * OpenReelAudiotapePolyster Post edit process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($open_reel_audiotape_polyster = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_polyster does not exist (%s).', $request->getParameter('id')));

        $open_reel_audiotape_polyster->setType(9);
        $open_reel_audiotape_polyster->save();

        $open_reel_audiotape_polyster = Doctrine_Core::getTable('OpenReelAudiotapePolyster')->find(array($request->getParameter('id')));

        $this->form = new OpenReelAudiotapePolysterForm($open_reel_audiotape_polyster);

        $speed = explode(',', $open_reel_audiotape_polyster->getSpeed());

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
     * OpenReelAudiotapePolyster Delete function
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($open_reel_audiotape_polyster = Doctrine_Core::getTable('OpenReelAudiotapePolyster')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_polyster does not exist (%s).', $request->getParameter('id')));
        $open_reel_audiotape_polyster->delete();

        $this->redirect('openreelaudiotapepolyster/index');
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
            $open_reel_audiotape_polyster = $form->save();
            $saveReturnId = array('form' => true, 'id' => $open_reel_audiotape_polyster->getId());
            return $saveReturnId;
//            $this->redirect('openreelaudiotapepolyster/edit?id=' . $open_reel_audiotape_polyster->getId());
        }
        return false;
    }

}
