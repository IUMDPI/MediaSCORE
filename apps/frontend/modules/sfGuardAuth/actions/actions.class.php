<?php

/*
  #class BasesfGuardAuthActions extends sfActions
  class sfGuardAuthActions extends sfActions
  {
  public function executeSignin($request)
  {
  $user = $this->getUser();
  if ($user->isAuthenticated())
  {
  return $this->redirect('@homepage');
  }

  //$class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
  //$this->form = new $class();
  $this->form = new sfGuardFormSignin();

  if ($request->isMethod('post'))
  {
  $this->form->bind($request->getParameter('signin'));
  if ($this->form->isValid())
  {
  $values = $this->form->getValues();
  $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

  // always redirect to a URL set in app.yml
  // or to the referer
  // or to the homepage

  //$signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));

  //return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');

  return $this->getModuleName().'/signin';
  }
  }
  else
  {
  if ($request->isXmlHttpRequest())
  {
  $this->getResponse()->setHeaderOnly(true);
  $this->getResponse()->setStatusCode(401);

  return sfView::NONE;
  }

  // if we have been forwarded, then the referer is the current URL
  // if not, this is the referer of the current request
  $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

  $module = sfConfig::get('sf_login_module');
  if ($this->getModuleName() != $module)
  {
  return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
  }

  $this->getResponse()->setStatusCode(401);
  }
  }

  public function executeSignout($request)
  {
  $this->getUser()->signOut();

  $signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', $request->getReferer());

  $this->redirect('' != $signoutUrl ? $signoutUrl : '@homepage');
  }

  public function executeSecure($request)
  {
  $this->getResponse()->setStatusCode(403);
  }

  public function executePassword($request)
  {
  throw new sfException('This method is not yet implemented.');
  }
  }
 */

# Source: http://arpeggios.wordpress.com/2008/09/28/http-authentification-with-sfguard/

class sfGuardAuthActions extends sfActions {

    public function executeSignin($request) {

        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            return $this->redirect('@homepage');
        }

        //$this->form = new sfGuardFormSignin;
        $this->form = new mediaSCOREFormSignin();

        // Temporary
        $this->form->disableLocalCSRFProtection();

        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('signin'));

            # Work Session Data
            #
			/*
             *     // fetch jobs already stored in the job history
             *         $jobs = $this->getUser()->getAttribute('job_history', array());
             *          
             *              // add the current job at the beginning of the array
             *                  array_unshift($jobs, $this->job->getId());
             *                   
             *                       // store the new job history back into the session
             *                           $this->getUser()->setAttribute('job_history', $jobs);
             */

            foreach (array('unit', 'personnel_list', 'storage_locations_list') as $workSessionField)
                $this->getUser()->setAttribute($workSessionField, $this->form[$workSessionField]->getValue());
//            echo '<pre>';print_r($this->getUser()->getAttribute('personnel_list'));exit;
            //print_r( $this->getUser()->getAttribute('unit', $this->form['unit'])->getValue() );
            //$this->getResponse()->setContent( $this->getUser()->getAttribute('personnel_list') );
            //print_r( $this->getUser()->getAttribute('storage_locations_list') );
            //return sfView::NONE;

            if ($this->form->isValid()) {

                $values = $this->form->getValues();
                $this->getUser()->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

                //$signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));
                //return $this->redirect('' != $signinUrl ? $signinUrl : '@homepage');
                //
				$unitID = $this->getUser()->getAttribute('unit');
                if ($unitID)
                    return $this->redirect('collection/index?u=' . $unitID);
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

    public function executeSignout($request) {
        $this->getUser()->signOut();

        //$signoutUrl = sfConfig::get('app_sf_guard_plugin_success_signout_url', $request->getReferer());
        //$this->redirect('' != $signoutUrl ? $signoutUrl : '@homepage');
        $this->redirect('@homepage');
    }

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
                $user->setPassword($password);
                $user->save();
                $message = Swift_Message::newInstance()
                        ->setFrom('noumantayyab@gmail.com')
                        ->setTo($validateEmail[0]['email_address'])
                        ->setSubject('Forgot Password Request for ' . $validateEmail[0]['username'])
                        ->setBody('Your temporary new password is '.$password)
                        ->setContentType('text/html');

                $this->getMailer()->send($message);
                $this->redirect('/guard/passwordchange');
            } else {
                $this->error = 'The given email is not correct.';
            }
//            echo '<pre>';print_r($validateEmail);exit;
        }
    }
    function executePasswordchange($request){
        
    }
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

    /*  public function executeSignin1($request)
      {
      $user = $this->getUser();

      if ($user->isAuthenticated())
      {
      return $this->redirect('@homepage');
      }

      $message = 'Authentification required';

      $this->form = new sfGuardFormSignin;

      if (isset($_SERVER['PHP_AUTH_USER']))
      {
      $request->setParameter('signin', array(
      'username' =>$_SERVER['PHP_AUTH_USER'],
      'password' =>$_SERVER['PHP_AUTH_PW'],
      ));

      $this->form->bind($request->getParameter('signin'));
      if ($this->form->isValid())
      {
      $values = $this->form->getValues();
      $this->getUser()->signin($values['user']);

      return $this->redirect($request->getUri());
      }
      else
      {
      $message = $this->form->getErrorSchema();
      }
      }

      $header_message = "Basic realm=\"$message\"";

      $this->getResponse()->setStatusCode(401);
      $this->getResponse()->setHttpHeader('WWW_Authenticate', $header_message);

      return sfView::NONE;
      } */
}

