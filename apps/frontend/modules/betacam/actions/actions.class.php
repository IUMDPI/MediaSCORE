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

    public function executeIndex(sfWebRequest $request) {
        $this->betacams = Doctrine_Core::getTable('Betacam')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->betacam = Doctrine_Core::getTable('Betacam')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->betacam);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new BetacamForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new BetacamForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($betacam = Doctrine_Core::getTable('Betacam')->find(array($request->getParameter('id'))), sprintf('Object betacam does not exist (%s).', $request->getParameter('id')));
        $this->form = new BetacamForm($betacam);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($betacam = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object betacam does not exist (%s).', $request->getParameter('id')));

        $betacam->setType(40);
        $betacam->save();
        $betacam = Doctrine_Core::getTable('Betacam')->find(array($request->getParameter('id')));
        $this->form = new BetacamForm($betacam);

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

        $this->forward404Unless($betacam = Doctrine_Core::getTable('Betacam')->find(array($request->getParameter('id'))), sprintf('Object betacam does not exist (%s).', $request->getParameter('id')));
        $betacam->delete();

        $this->redirect('betacam/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $betacam = $form->save();
            $saveReturnId = array('form' => true, 'id' => $betacam->getId());
            return $saveReturnId;
//            $this->redirect('betacam/edit?id=' . $betacam->getId());
        }
        return false;
    }

}
