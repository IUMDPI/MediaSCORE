<?php

/**
 * halfinchopenreelvideo actions.
 *
 * @package    mediaSCORE
 * @subpackage halfinchopenreelvideo
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class halfinchopenreelvideoActions extends sfActions {

    /**
     * Generate HalfInchOpenReelVideo form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new HalfInchOpenReelVideoForm();
    }

    /**
     * HalfInchOpenReelVideo Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new HalfInchOpenReelVideoForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * HalfInchOpenReelVideo edit Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($half_inch_open_reel_video = Doctrine_Core::getTable('HalfInchOpenReelVideo')->find(array($request->getParameter('id'))), sprintf('Object half_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
        $this->form = new HalfInchOpenReelVideoForm($half_inch_open_reel_video);
        $reelSize = explode(',', $half_inch_open_reel_video->getReelSize());

        $this->form->setDefault('reelSize', $reelSize);
    }

    /**
     * HalfInchOpenReelVideo Post Edit form Process
     *  
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($half_inch_open_reel_video = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object half_inch_open_reel_video does not exist (%s).', $request->getParameter('id')));
        $half_inch_open_reel_video->setType(35);
        $half_inch_open_reel_video->save();
        $half_inch_open_reel_video = Doctrine_Core::getTable('HalfInchOpenReelVideo')->find(array($request->getParameter('id')));

        $this->form = new HalfInchOpenReelVideoForm($half_inch_open_reel_video);
        $reelSize = explode(',', $half_inch_open_reel_video->getReelSize());

        $this->form->setDefault('reelSize', $reelSize);
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
            $half_inch_open_reel_video = $form->save();
            $saveReturnId = array('form' => true, 'id' => $half_inch_open_reel_video->getId());
            return $saveReturnId;
        }
        return false;
    }

}
