<?php

/**
 * metaldisc actions.
 *
 * @package    mediaSCORE
 * @subpackage metaldisc
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class metaldiscActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->metal_discs = Doctrine_Core::getTable('MetalDisc')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->metal_disc = Doctrine_Core::getTable('MetalDisc')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->metal_disc);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new MetalDiscForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new MetalDiscForm();

        $validateForm = $this->processForm($request, $this->form);
        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('new');
        }
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($metal_disc = Doctrine_Core::getTable('MetalDisc')->find(array($request->getParameter('id'))), sprintf('Object metal_disc does not exist (%s).', $request->getParameter('id')));
        $this->form = new MetalDiscForm($metal_disc);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($metal_disc = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object metal_disc does not exist (%s).', $request->getParameter('id')));

        $metal_disc->setType(1);
        $metal_disc->save();
        $metal_disc = Doctrine_Core::getTable('MetalDisc')->find(array($request->getParameter('id')));
        $this->form = new MetalDiscForm($metal_disc);

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

        $this->forward404Unless($metal_disc = Doctrine_Core::getTable('MetalDisc')->find(array($request->getParameter('id'))), sprintf('Object metal_disc does not exist (%s).', $request->getParameter('id')));
        $metal_disc->delete();

        $this->redirect('metaldisc/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $metal_disc = $form->save();
            $saveReturnId = array('form' => true, 'id' => $metal_disc->getId());
            return $saveReturnId;
        }
    }

}
