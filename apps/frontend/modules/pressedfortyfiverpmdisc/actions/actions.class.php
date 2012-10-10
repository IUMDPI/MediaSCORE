<?php

/**
 * pressedfortyfiverpmdisc actions.
 *
 * @package    mediaSCORE
 * @subpackage pressedfortyfiverpmdisc
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pressedfortyfiverpmdiscActions extends sfActions {

    /**
     * List all
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->pressed_forty_five_rpm_discs = Doctrine_Core::getTable('PressedFortyFiveRPMDisc')
                ->createQuery('a')
                ->execute();
    }

    /**
     * detail of specific record
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->pressed_forty_five_rpm_disc = Doctrine_Core::getTable('PressedFortyFiveRPMDisc')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->pressed_forty_five_rpm_disc);
    }

    /**
     * PressedFortyFiveRPMDisc form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new PressedFortyFiveRPMDiscForm();
    }

    /**
     * PressedFortyFiveRPMDisc Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new PressedFortyFiveRPMDiscForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * PressedFortyFiveRPMDisc edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($pressed_forty_five_rpm_disc = Doctrine_Core::getTable('PressedFortyFiveRPMDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_forty_five_rpm_disc does not exist (%s).', $request->getParameter('id')));
        $this->form = new PressedFortyFiveRPMDiscForm($pressed_forty_five_rpm_disc);
    }

    /**
     * PressedFortyFiveRPMDisc Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($pressed_forty_five_rpm_disc = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object pressed_forty_five_rpm_disc does not exist (%s).', $request->getParameter('id')));
        $pressed_forty_five_rpm_disc->setType(24);
        $pressed_forty_five_rpm_disc->save();
        $pressed_forty_five_rpm_disc = Doctrine_Core::getTable('PressedFortyFiveRPMDisc')->find(array($request->getParameter('id')));

        $this->form = new PressedFortyFiveRPMDiscForm($pressed_forty_five_rpm_disc);


        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    /**
     * PressedFortyFiveRPMDisc Delete function
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($pressed_forty_five_rpm_disc = Doctrine_Core::getTable('PressedFortyFiveRPMDisc')->find(array($request->getParameter('id'))), sprintf('Object pressed_forty_five_rpm_disc does not exist (%s).', $request->getParameter('id')));
        $pressed_forty_five_rpm_disc->delete();

        $this->redirect('pressedfortyfiverpmdisc/index');
    }

    /**
     * Process and validate form
     * 
     * @param sfWebRequest $request
     * @param sfForm $form
     * @return boolean if form is not validated
     * @return integer if form is validated then return id 
     */
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $pressed_forty_five_rpm_disc = $form->save();
            $saveReturnId = array('form' => true, 'id' => $pressed_forty_five_rpm_disc->getId());
            return $saveReturnId;
        }
        return false;
    }

}
