<?php

/**
 * vhs actions.
 *
 * @package    mediaSCORE
 * @subpackage vhs
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class vhsActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->vh_ss = Doctrine_Core::getTable('VHS')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->vhs = Doctrine_Core::getTable('VHS')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->vhs);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new VHSForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new VHSForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($vhs = Doctrine_Core::getTable('VHS')->find(array($request->getParameter('id'))), sprintf('Object vhs does not exist (%s).', $request->getParameter('id')));
        $this->form = new VHSForm($vhs);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($vhs = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object vhs does not exist (%s).', $request->getParameter('id')));

        $vhs->setType(41);
        $vhs->save();
        $vhs = Doctrine_Core::getTable('VHS')->find(array($request->getParameter('id')));
        $this->form = new VHSForm($vhs);
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

        $this->forward404Unless($vhs = Doctrine_Core::getTable('VHS')->find(array($request->getParameter('id'))), sprintf('Object vhs does not exist (%s).', $request->getParameter('id')));
        $vhs->delete();

        $this->redirect('vhs/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $vhs = $form->save();
            $saveReturnId = array('form' => true, 'id' => $vhs->getId());
            return $saveReturnId;
//      $this->redirect('vhs/edit?id='.$vhs->getId());
        }
        return false;
    }

}
