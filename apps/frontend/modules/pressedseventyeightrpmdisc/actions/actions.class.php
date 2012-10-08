<?php

/**
 * pressedseventyeightrpmdisc actions.
 *
 * @package    mediaSCORE
 * @subpackage pressedseventyeightrpmdisc
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pressedseventyeightrpmdiscActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->pressed_seventy_eight_rpm_discs = Doctrine_Core::getTable('PressedSeventyEightRPMDisc')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->pressed_seventy_eight_rpm_disc = Doctrine_Core::getTable('PressedSeventyEightRPMDisc')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->pressed_seventy_eight_rpm_disc);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new PressedSeventyEightRPMDiscForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new PressedSeventyEightRPMDiscForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($pressed_seventy_eight_rpm_disc = Doctrine_Core::getTable('PressedSeventyEightRPMDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_seventy_eight_rpm_disc does not exist (%s).', $request->getParameter('id')));
        $this->form = new PressedSeventyEightRPMDiscForm($pressed_seventy_eight_rpm_disc);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($pressed_seventy_eight_rpm_disc = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object pressed_seventy_eight_rpm_disc does not exist (%s).', $request->getParameter('id')));

        $pressed_seventy_eight_rpm_disc->setType(22);
        $pressed_seventy_eight_rpm_disc->save();
        $pressed_seventy_eight_rpm_disc = Doctrine_Core::getTable('PressedSeventyEightRPMDisc')->find(array($request->getParameter('id')));
        $this->form = new PressedSeventyEightRPMDiscForm($pressed_seventy_eight_rpm_disc);

        
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

        $this->forward404Unless($pressed_seventy_eight_rpm_disc = Doctrine_Core::getTable('PressedSeventyEightRPMDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_seventy_eight_rpm_disc does not exist (%s).', $request->getParameter('id')));
        $pressed_seventy_eight_rpm_disc->delete();

        $this->redirect('pressedseventyeightrpmdisc/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $pressed_seventy_eight_rpm_disc = $form->save();
            $saveReturnId = array('form' => true, 'id' => $pressed_seventy_eight_rpm_disc->getId());
            return $saveReturnId;
//      $this->redirect('pressedseventyeightrpmdisc/edit?id='.$pressed_seventy_eight_rpm_disc->getId());
        }
        return false;
    }

}
