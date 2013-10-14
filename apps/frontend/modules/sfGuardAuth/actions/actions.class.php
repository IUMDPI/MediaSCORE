<?php

# Source: http://arpeggios.wordpress.com/2008/09/28/http-authentification-with-sfguard/

class sfGuardAuthActions extends sfActions {

    /**
     * sign in process
     * 
     * @param type $request
     * @return type 
     */
    public function executeSignin($request) {
 
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            if ($this->getUser()->getGuardUser()->getForgot_password() == 1) {
                return $this->redirect('/sfGuardAuth/changePassword');
            }
            return $this->redirect('@homepage');
        }

        //$this->form = new sfGuardFormSignin;
        $this->form = new mediaSCOREFormSignin();



        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('signin'));


            /*
              // fetch jobs already stored in the job history
              $jobs = $this->getUser()->getAttribute('job_history', array());

              // add the current job at the beginning of the array
              array_unshift($jobs, $this->job->getId());

              // store the new job history back into the session
              $this->getUser()->setAttribute('job_history', $jobs);
             */

            foreach (array('unit', 'personnel_list', 'storage_locations_list') as $workSessionField)
                $this->getUser()->setAttribute($workSessionField, $this->form[$workSessionField]->getValue());

            if ($this->form->isValid()) {

                $values = $this->form->getValues();

                $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

                //$signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));
                //return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
                if ($this->getUser()->getGuardUser()->getForgot_password() == 1) {
                    return $this->redirect('/sfGuardAuth/changePassword');
                }

                $unitID = $this->getUser()->getAttribute('unit');
                if ($unitID) {
                    $unit = Doctrine_Query::Create()
                            ->from('Unit u')
                            ->select('u.*')
                            ->where('u.id  = ?', $unitID)
                            ->fetchOne();
                    return $this->redirect('/' . $unit->getNameSlug());
                }
                else
                    return $this->redirect('@homepage');
            } else {
                if ($request->isXmlHttpRequest()) {
                    $this->getResponse()->setHeaderOnly(true);
                    $this->getResponse()->setStatusCode(401);
                    return sfView::NONE;
                }
            }
        }
    }

    /**
     * signout process
     * 
     * @param type $request 
     */
    public function executeSignout($request) {
        $this->getUser()->signOut();

        //$signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', $request->getReferer());
        //$this->redirect('' != $signoutUrl ? $signoutUrl : '@homepage');
        $this->redirect('@homepage');
    }

    /**
     * change password method
     * 
     * @param type $request 
     */
    public function executeChangePassword($request) {
        $this->user = $this->getUser()->getGuardUser();
        $this->form = new sfGuardChangeUserPasswordForm($this->user);
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $this->form->save();
                $this->user->setForgot_password(false);
                $this->user->save();
                $this->getUser()->setFlash('notice', 'Password updated successfully!');
                $this->redirect('@homepage');
            }
        }
    }

    /**
     * forgot password method
     * 
     * @param type $request 
     */
    public function executeForgotpassword($request) {
        if ($request->isMethod('post')) {
            $this->email = $request->getParameter('email');
            $validateEmail = Doctrine_Query::Create()
                    ->from('sfGuardUser u')
                    ->select("u.*")
                    ->where('u.email_address  = ?', $this->email)
                    ->fetchArray();

            if (sizeof($validateEmail) > 0) {
                $user = Doctrine_Core::getTable('sfGuardUser')->find(array($validateEmail[0]['id']));
                $password = $this->createRandomPassword();
                $user->setForgot_password(true);
                $user->setPassword($password);
                $user->save();

                $message = Swift_Message::newInstance()
                        ->setFrom('support@indiana.edu')
                        ->setTo($validateEmail[0]['email_address'])
                        ->setSubject('Forgot Password Request for ' . $validateEmail[0]['username'])
                        ->setBody('Your temporary new password is ' . $password)
                        ->setContentType('text/html');

                $this->getMailer()->send($message);
                $this->redirect('/sfGuardAuth/passwordchange');
            } else {
                $this->error = 'The given email is not correct.';
            }
        }
    }

    /**
     * activate user
     * 
     * @param type $request 
     */
    function executeActivateAccount($request) {
        $user = Doctrine_Core::getTable('sfGuardUser')->findOneBy('activation_key', $request->getParameter('key'));
        if (!$user) {
            $this->message = 'Invalid Activation Key.';
            $this->error = 1;
        } else {
            $user->setIsActive(true);
            $user->setActivation_key('');
            $user->save();
            $this->error = 0;
            $this->message = 'Account Successfully Activated.';
        }
    }

    /**
     * generate randam password
     * 
     * @return string 
     */
    function createRandomPassword() {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijkmnopqrstuvwxyz";
        srand((double) microtime() * 1000000);
        $i = 0;
        $pass = '';
        while ($i <= 10) {
            $num = rand() % 70;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }

}

