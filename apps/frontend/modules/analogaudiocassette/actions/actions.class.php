<?php

/**
 * analogaudiocassette actions.
 *
 * @package    mediaSCORE
 * @subpackage analogaudiocassette
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class analogaudiocassetteActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->analog_audio_cassettes = Doctrine_Core::getTable('AnalogAudioCassette')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->analog_audio_cassette = Doctrine_Core::getTable('AnalogAudioCassette')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->analog_audio_cassette);
        
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new AnalogAudioCassetteForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new AnalogAudioCassetteForm();
        
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($analog_audio_cassette = Doctrine_Core::getTable('AnalogAudioCassette')->find(array($request->getParameter('id'))), sprintf('Object analog_audio_cassette does not exist (%s).', $request->getParameter('id')));
        $this->form = new AnalogAudioCassetteForm($analog_audio_cassette);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($analog_audio_cassette = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object analog_audio_cassette does not exist (%s).', $request->getParameter('id')));
        $analog_audio_cassette->setType(4);
        $analog_audio_cassette->save();
        $analog_audio_cassette = Doctrine_Core::getTable('AnalogAudioCassette')->find(array($request->getParameter('id')));

        $this->form = new AnalogAudioCassetteForm($analog_audio_cassette);

//        $this->form->disableLocalCSRFProtection();
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

        $this->forward404Unless($analog_audio_cassette = Doctrine_Core::getTable('AnalogAudioCassette')->find(array($request->getParameter('id'))), sprintf('Object analog_audio_cassette does not exist (%s).', $request->getParameter('id')));
        $analog_audio_cassette->delete();

        $this->redirect('analogaudiocassette/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $analog_audio_cassette = $form->save();
            $saveReturnId = array('form' => true, 'id' => $analog_audio_cassette->getId());
            return $saveReturnId;
//      $this->redirect('analogaudiocassette/edit?id='.$analog_audio_cassette->getId());
        }
        return false;
    }

}
