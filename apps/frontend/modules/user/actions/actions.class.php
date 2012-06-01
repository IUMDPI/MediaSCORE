<?php

/**
 * user actions.
 *
 * @package    mediaSCORE
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $msg=$request->getParameter('n');
        if($msg)
            $this->popup=1;
        $this->users = Doctrine_Core::getTable('sfGuardUser')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->user);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new sfGuardUserForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new sfGuardUserForm();

        $this->processForm($request, $this->form, 1);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardUserForm($user);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardUserForm($user);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
//    $request->checkCSRFProtection();

        $this->forward404Unless($user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
        $user->delete();

        $this->redirect('user/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $new = null) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $user = $form->save();
            if ($new) {
                $this->redirect('user/index?n=1');
            } else {
                $this->redirect('user/index');
            }
        }
    }

}
