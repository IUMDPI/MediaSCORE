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

    public function executeIndex(sfWebRequest $request) {
        $this->sound_wire_reels = Doctrine_Core::getTable('SoundWireReel')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->sound_wire_reel = Doctrine_Core::getTable('SoundWireReel')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->sound_wire_reel);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new SoundWireReelForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new SoundWireReelForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($sound_wire_reel = Doctrine_Core::getTable('SoundWireReel')->find(array($request->getParameter('id'))), sprintf('Object sound_wire_reel does not exist (%s).', $request->getParameter('id')));
        $this->form = new SoundWireReelForm($sound_wire_reel);
    }

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

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($sound_wire_reel = Doctrine_Core::getTable('SoundWireReel')->find(array($request->getParameter('id'))), sprintf('Object sound_wire_reel does not exist (%s).', $request->getParameter('id')));
        $sound_wire_reel->delete();

        $this->redirect('soundwirereel/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $sound_wire_reel = $form->save();
            $saveReturnId = array('form' => true, 'id' => $sound_wire_reel->getId());
            return $saveReturnId;

//      $this->redirect('soundwirereel/edit?id='.$sound_wire_reel->getId());
        }
        return false;
    }

}
