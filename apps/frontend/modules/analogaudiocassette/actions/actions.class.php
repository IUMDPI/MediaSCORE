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

    /**
     * Generate AnalogAudioCassette form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
		$this->forward404Unless($this->getUser()->getGuardUser()->getType() != 3);
        $this->form = new AnalogAudioCassetteForm();
    }

    /**
     * AnalogAudioCassette Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new AnalogAudioCassetteForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * AnalogAudioCassette edit Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        
		$this->forward404Unless($this->getUser()->getGuardUser()->getType() != 3);
        $this->forward404Unless($analog_audio_cassette = Doctrine_Core::getTable('AnalogAudioCassette')->find(array($request->getParameter('id'))), sprintf('Object analog_audio_cassette does not exist (%s).', $request->getParameter('id')));
        $this->form = new AnalogAudioCassetteForm($analog_audio_cassette);
    }

    /**
     * AnalogAudioCassette Post Edit form Process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($analog_audio_cassette = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object analog_audio_cassette does not exist (%s).', $request->getParameter('id')));
        $analog_audio_cassette->setType(4);
        $analog_audio_cassette->save();
        $analog_audio_cassette = Doctrine_Core::getTable('AnalogAudioCassette')->find(array($request->getParameter('id')));

        $this->form = new AnalogAudioCassetteForm($analog_audio_cassette);


        $validateForm = $this->processForm($request, $this->form);

        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    /**
     * Process and Validate Form
     * 
     * @param sfWebRequest $request
     * @param sfForm $form
     * @return boolean if form is not validated
     * @return integer if form is validated then return id
     */
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $analog_audio_cassette = $form->save();
            $saveReturnId = array('form' => true, 'id' => $analog_audio_cassette->getId());
            return $saveReturnId;
        }
        return false;
    }

}
