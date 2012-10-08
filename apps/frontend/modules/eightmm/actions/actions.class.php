<?php

/**
 * eightmm actions.
 *
 * @package    mediaSCORE
 * @subpackage eightmm
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eightmmActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->eight_m_ms = Doctrine_Core::getTable('EightMM')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->eight_mm = Doctrine_Core::getTable('EightMM')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->eight_mm);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new EightMMForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new EightMMForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($eight_mm = Doctrine_Core::getTable('EightMM')->find(array($request->getParameter('id'))), sprintf('Object eight_mm does not exist (%s).', $request->getParameter('id')));
        $this->form = new EightMMForm($eight_mm);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($eight_mm = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object eight_mm does not exist (%s).', $request->getParameter('id')));
        // set the format type
        $eight_mm->setType(31);
        $eight_mm->save();
        $eight_mm = Doctrine_Core::getTable('EightMM')->find(array($request->getParameter('id')));
        $this->form = new EightMMForm($eight_mm);

        
        $validateForm = $this->processForm($request, $this->form);
        // form is valid then return the id;
        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($eight_mm = Doctrine_Core::getTable('EightMM')->find(array($request->getParameter('id'))), sprintf('Object eight_mm does not exist (%s).', $request->getParameter('id')));
        $eight_mm->delete();

        $this->redirect('eightmm/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $eight_mm = $form->save();
            $saveReturnId = array('form' => true, 'id' => $eight_mm->getId());
            return $saveReturnId;
//      $this->redirect('eightmm/edit?id='.$eight_mm->getId());
        }
        return false;
    }

}
