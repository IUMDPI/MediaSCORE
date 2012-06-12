<?php

/**
 * laserdisc actions.
 *
 * @package    mediaSCORE
 * @subpackage laserdisc
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class laserdiscActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->laserdiscs = Doctrine_Core::getTable('Laserdisc')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->laserdisc = Doctrine_Core::getTable('Laserdisc')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->laserdisc);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new LaserdiscForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new LaserdiscForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($laserdisc = Doctrine_Core::getTable('Laserdisc')->find(array($request->getParameter('id'))), sprintf('Object laserdisc does not exist (%s).', $request->getParameter('id')));
        $this->form = new LaserdiscForm($laserdisc);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($laserdisc = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object laserdisc does not exist (%s).', $request->getParameter('id')));
        $laserdisc->setType(26);
        $laserdisc->save();
        $laserdisc = Doctrine_Core::getTable('Laserdisc')->find(array($request->getParameter('id')));

        $this->form = new LaserdiscForm($laserdisc);

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

        $this->forward404Unless($laserdisc = Doctrine_Core::getTable('Laserdisc')->find(array($request->getParameter('id'))), sprintf('Object laserdisc does not exist (%s).', $request->getParameter('id')));
        $laserdisc->delete();

        $this->redirect('laserdisc/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $laserdisc = $form->save();
            $saveReturnId = array('form' => true, 'id' => $laserdisc->getId());
            return $saveReturnId;
//      $this->redirect('laserdisc/edit?id='.$laserdisc->getId());
        }
        return false;
    }

}
