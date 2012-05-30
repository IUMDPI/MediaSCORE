<?php

/**
 * dat actions.
 *
 * @package    mediaSCORE
 * @subpackage dat
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class datActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->da_ts = Doctrine_Core::getTable('DAT')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->dat = Doctrine_Core::getTable('DAT')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->dat);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new DATForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DATForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($dat = Doctrine_Core::getTable('DAT')->find(array($request->getParameter('id'))), sprintf('Object dat does not exist (%s).', $request->getParameter('id')));
        $this->form = new DATForm($dat);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($dat = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object dat does not exist (%s).', $request->getParameter('id')));

        $dat->setType(6);
        $dat->save();
        $dat = Doctrine_Core::getTable('DAT')->find(array($request->getParameter('id')));
        $this->form = new DATForm($dat);

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

        $this->forward404Unless($dat = Doctrine_Core::getTable('DAT')->find(array($request->getParameter('id'))), sprintf('Object dat does not exist (%s).', $request->getParameter('id')));
        $dat->delete();

        $this->redirect('dat/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $dat = $form->save();
            $saveReturnId = array('form' => true, 'id' => $dat->getId());
            return $saveReturnId;
//            $this->redirect('dat/edit?id=' . $dat->getId());
        }
        return false;
    }

}
