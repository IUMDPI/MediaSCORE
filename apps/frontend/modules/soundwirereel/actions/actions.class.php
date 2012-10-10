<?php

/**
 * soundwirereel actions.
 *
 * @package    mediaSCORE
 * @subpackage soundwirereel
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class soundwirereelActions extends sfActions {

    /**
     * List all SoundWireReel
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->sound_wire_reels = Doctrine_Core::getTable('SoundWireReel')
                ->createQuery('a')
                ->execute();
    }

    /**
     * SoundWireReel detail of specific record
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->sound_wire_reel = Doctrine_Core::getTable('SoundWireReel')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->sound_wire_reel);
    }

    /**
     * SoundWireReel form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new SoundWireReelForm();
    }

    /**
     * SoundWireReel Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new SoundWireReelForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * SoundWireReel edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($sound_wire_reel = Doctrine_Core::getTable('SoundWireReel')->find(array($request->getParameter('id'))), sprintf('Object sound_wire_reel does not exist (%s).', $request->getParameter('id')));
        $this->form = new SoundWireReelForm($sound_wire_reel);
    }

    /**
     * SoundWireReel Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($sound_wire_reel = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object sound_wire_reel does not exist (%s).', $request->getParameter('id')));
        $sound_wire_reel->setType(7);
        $sound_wire_reel->save();
        $sound_wire_reel = Doctrine_Core::getTable('SoundWireReel')->find(array($request->getParameter('id')));
        $this->form = new SoundWireReelForm($sound_wire_reel);

        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    /**
     * SoundWireReel Delete form
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($sound_wire_reel = Doctrine_Core::getTable('SoundWireReel')->find(array($request->getParameter('id'))), sprintf('Object sound_wire_reel does not exist (%s).', $request->getParameter('id')));
        $sound_wire_reel->delete();

        $this->redirect('soundwirereel/index');
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
            $sound_wire_reel = $form->save();
            $saveReturnId = array('form' => true, 'id' => $sound_wire_reel->getId());
            return $saveReturnId;
        }
        return false;
    }

}
