<?php

/**
 * minidisc actions.
 *
 * @package    mediaSCORE
 * @subpackage minidisc
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class minidiscActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->mini_discs = Doctrine_Core::getTable('MiniDisc')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->mini_disc = Doctrine_Core::getTable('MiniDisc')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->mini_disc);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new MiniDiscForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new MiniDiscForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($mini_disc = Doctrine_Core::getTable('MiniDisc')->find(array($request->getParameter('id'))), sprintf('Object mini_disc does not exist (%s).', $request->getParameter('id')));
        $this->form = new MiniDiscForm($mini_disc);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($mini_disc = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object mini_disc does not exist (%s).', $request->getParameter('id')));

        $mini_disc->setType(16);
        $mini_disc->save();
        $mini_disc = Doctrine_Core::getTable('MiniDisc')->find(array($request->getParameter('id')));
        $this->form = new MiniDiscForm($mini_disc);

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

        $this->forward404Unless($mini_disc = Doctrine_Core::getTable('MiniDisc')->find(array($request->getParameter('id'))), sprintf('Object mini_disc does not exist (%s).', $request->getParameter('id')));
        $mini_disc->delete();

        $this->redirect('minidisc/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $mini_disc = $form->save();
            $saveReturnId = array('form' => true, 'id' => $mini_disc->getId());
            return $saveReturnId;

//      $this->redirect('minidisc/edit?id='.$mini_disc->getId());
        }
    }

}
