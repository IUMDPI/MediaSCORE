<?php

/**
 * dv actions.
 *
 * @package    mediaSCORE
 * @subpackage dv
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dvActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->d_vs = Doctrine_Core::getTable('DV')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->dv = Doctrine_Core::getTable('DV')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->dv);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new DVForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DVForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($dv = Doctrine_Core::getTable('DV')->find(array($request->getParameter('id'))), sprintf('Object dv does not exist (%s).', $request->getParameter('id')));
        $this->form = new DVForm($dv);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($dv = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object dv does not exist (%s).', $request->getParameter('id')));

        $dv->setType(37);
        $dv->save();
        $dv = Doctrine_Core::getTable('DV')->find(array($request->getParameter('id')));
        $this->form = new DVForm($dv);

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

        $this->forward404Unless($dv = Doctrine_Core::getTable('DV')->find(array($request->getParameter('id'))), sprintf('Object dv does not exist (%s).', $request->getParameter('id')));
        $dv->delete();

        $this->redirect('dv/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $dv = $form->save();
            $saveReturnId = array('form' => true, 'id' => $dv->getId());
            return $saveReturnId;
//      $this->redirect('dv/edit?id='.$dv->getId());
        }
        return false;
    }

}
