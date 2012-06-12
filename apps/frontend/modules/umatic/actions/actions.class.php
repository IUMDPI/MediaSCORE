<?php

/**
 * umatic actions.
 *
 * @package    mediaSCORE
 * @subpackage umatic
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class umaticActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->umatics = Doctrine_Core::getTable('Umatic')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->umatic = Doctrine_Core::getTable('Umatic')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->umatic);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new UmaticForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new UmaticForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($umatic = Doctrine_Core::getTable('Umatic')->find(array($request->getParameter('id'))), sprintf('Object umatic does not exist (%s).', $request->getParameter('id')));
        $this->form = new UmaticForm($umatic);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($umatic = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object umatic does not exist (%s).', $request->getParameter('id')));

        $umatic->setType(44);
        $umatic->save();
        $umatic = Doctrine_Core::getTable('Umatic')->find(array($request->getParameter('id')));
        $this->form = new UmaticForm($umatic);

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

        $this->forward404Unless($umatic = Doctrine_Core::getTable('Umatic')->find(array($request->getParameter('id'))), sprintf('Object umatic does not exist (%s).', $request->getParameter('id')));
        $umatic->delete();

        $this->redirect('umatic/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $umatic = $form->save();
            $saveReturnId = array('form' => true, 'id' => $umatic->getId());
            return $saveReturnId;
//      $this->redirect('umatic/edit?id='.$umatic->getId());
        }
        return false;
    }

}
