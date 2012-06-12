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

    public function executeIndex(sfWebRequest $request) {
        $this->open_reel_audiotape_papers = Doctrine_Core::getTable('OpenReelAudiotapePaper')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->open_reel_audiotape_paper = Doctrine_Core::getTable('OpenReelAudiotapePaper')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->open_reel_audiotape_paper);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new OpenReelAudiotapePaperForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new OpenReelAudiotapePaperForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($open_reel_audiotape_paper = Doctrine_Core::getTable('OpenReelAudiotapePaper')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_paper does not exist (%s).', $request->getParameter('id')));
        $this->form = new OpenReelAudiotapePaperForm($open_reel_audiotape_paper);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($open_reel_audiotape_paper = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_paper does not exist (%s).', $request->getParameter('id')));

        $open_reel_audiotape_paper->setType(11);
        $open_reel_audiotape_paper->save();

        $open_reel_audiotape_paper = Doctrine_Core::getTable('OpenReelAudiotapePaper')->find(array($request->getParameter('id')));
        $this->form = new OpenReelAudiotapePaperForm($open_reel_audiotape_paper);

        $this->form->disableLocalCSRFProtection();
        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($open_reel_audiotape_paper = Doctrine_Core::getTable('OpenReelAudiotapePaper')->find(array($request->getParameter('id'))), sprintf('Object open_reel_audiotape_paper does not exist (%s).', $request->getParameter('id')));
        $open_reel_audiotape_paper->delete();

        $this->redirect('openreelaudiotapepaper/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $open_reel_audiotape_paper = $form->save();
            $saveReturnId = array('form' => true, 'id' => $open_reel_audiotape_paper->getId());
            return $saveReturnId;

//      $this->redirect('openreelaudiotapepaper/edit?id='.$open_reel_audiotape_paper->getId());
        }
        return false;
    }

}
