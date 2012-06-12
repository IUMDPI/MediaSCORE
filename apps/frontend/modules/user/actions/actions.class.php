<?php

/**
 * user actions.
 *
 * @package    mediaSCORE
 * @subpackage user
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        if ($this->getUser()->getGuardUser()->getRole() != 1)
            $this->redirect('storagelocation/index');
        $msg = $request->getParameter('n');
        if ($msg)
            $this->popup = 1;
        $this->users = Doctrine_Core::getTable('sfGuardUser')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->user);
    }

    public function executeNew(sfWebRequest $request) {
        if ($this->getUser()->getGuardUser()->getRole() != 1)
            $this->redirect('storagelocation/index');
        $this->form = new sfGuardUserForm();
    }

    public function executeCreate(sfWebRequest $request) {
        if ($this->getUser()->getGuardUser()->getRole() != 1)
            $this->redirect('storagelocation/index');
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new sfGuardUserForm();

        $this->processForm($request, $this->form, 1);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardUserForm($user, array(
                    'action' => 'edit'
                ));
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardUserForm($user, array(
                    'action' => 'edit'
                ));

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        if ($this->getUser()->getGuardUser()->getRole() != 1)
            $this->redirect('storagelocation/index');
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
                $key = md5(rand() . microtime());
                $user->setActivation_key($key);
                $user->setIsActive(false);
                $user->save();
                $user->setUsername($user->getEmailAddress());
                $user->save();
                $message = Swift_Message::newInstance()
                        ->setFrom('support@indiana.edu')
                        ->setTo($user->getEmailAddress())
                        ->setSubject('Active your account ' . $user->getUsername())
                        ->setBody('To Active your accout click on the link.<br/> http://108.166.74.254/sfGuardAuth/activateAccount?key=' . $key)
                        ->setContentType('text/html');

                $this->getMailer()->send($message);
                $this->redirect('user/index?n=1');
            } else {
                if ($this->getUser()->getGuardUser()->getRole() == 1)
                    $this->redirect('user/index');
                else
                    $this->redirect('storagelocation/index');
            }
        }
    }

}
