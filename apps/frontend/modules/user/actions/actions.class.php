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

    /**
     * List users
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        // if user dont have admin rights then redirect storagelocation
        if ($this->getUser()->getGuardUser()->getRole() != 1)
            $this->redirect('storagelocation/index');
        $msg = $request->getParameter('n'); // if new user is created
        if ($msg)
            $this->popup = 1;   // show popup for the new users










            
// List all the users
        $this->users = Doctrine_Core::getTable('sfGuardUser')
                ->createQuery('a')
                ->execute();
    }

    /**
     * show detail of a user
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->user);
    }

    /**
     * New form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        // if user dont have admin rights then redirect storagelocation
        if ($this->getUser()->getGuardUser()->getRole() != 1)
            $this->redirect('storagelocation/index');
        $this->form = new sfGuardUserForm();
    }

    /**
     * Post new form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        // if user dont have admin rights then redirect storagelocation
        if ($this->getUser()->getGuardUser()->getRole() != 1)
            $this->redirect('storagelocation/index');

        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new sfGuardUserForm();

        $this->processForm($request, $this->form, 1);

        $this->setTemplate('new');
    }

    /**
     * Edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardUserForm($user, array(
                    'action' => 'edit',
                    'userType' => $this->getUser()->getGuardUser()->getType(),
                ));
    }

    /**
     * Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
        $this->form = new sfGuardUserForm($user, array(
                    'action' => 'edit'
                ));

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * Delete user
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        if ($this->getUser()->getGuardUser()->getRole() != 1)
            $this->redirect('storagelocation/index');
//    $request->checkCSRFProtection();

        $this->forward404Unless($user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
        $user->delete();

        $this->redirect('user/index');
    }

    /**
     * Process and validate form
     * 
     * @param sfWebRequest $request
     * @param sfForm $form
     * @param boolean $new 
     */
    protected function processForm(sfWebRequest $request, sfForm $form, $new = null) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $user = $form->save();
            if ($new) {
                $key = md5(rand() . microtime()); // generate a key for activation
                $user->setActivation_key($key); // set the key in database
                $user->setIsActive(false);   // set inacitve status 
                $user->save();
                // send email to the user for activating the account
                $user->setUsername($user->getEmailAddress());
                $user->save();
                $message = Swift_Message::newInstance()
                        ->setFrom('support@indiana.edu')
                        ->setTo($user->getEmailAddress())
                        ->setSubject('Activate your account ' . $user->getUsername())
                        ->setBody('To Activate your account click on the following link.<br/><br/> ' . sfConfig::get('app_base') . '/sfGuardAuth/activateAccount?key=' . $key)
                        ->setContentType('text/html');

                $this->getMailer()->send($message);
                $this->redirect('user/index?n=1');
            } else {
                if (!$user->getIsActive()) {
                    $message = Swift_Message::newInstance()
                            ->setFrom('support@indiana.edu')
                            ->setTo($user->getEmailAddress())
                            ->setSubject('Activate your account ' . $user->getUsername())
                            ->setBody('To Activate your account click on the following link.<br/><br/> ' . sfConfig::get('app_base') . '/sfGuardAuth/activateAccount?key=' . $key)
                            ->setContentType('text/html');

                    $this->getMailer()->send($message);
                }
                if ($this->getUser()->getGuardUser()->getRole() == 1)
                    $this->redirect('user/index');
                else
                    $this->redirect('storagelocation/index');
            }
        }
    }

}
