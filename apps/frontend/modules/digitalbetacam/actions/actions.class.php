<?php

/**
 * digitalbetacam actions.
 *
 * @package    mediaSCORE
 * @subpackage digitalbetacam
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class digitalbetacamActions extends sfActions {

    /**
     * Generate DigitalBetacam form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new DigitalBetacamForm();
    }

    /**
     * DigitalBetacam Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DigitalBetacamForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * DigitalBetacam edit Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($digital_betacam = Doctrine_Core::getTable('DigitalBetacam')->find(array($request->getParameter('id'))), sprintf('Object digital_betacam does not exist (%s).', $request->getParameter('id')));
        $this->form = new DigitalBetacamForm($digital_betacam);
        $bitRate = explode(',', $digital_betacam->getBitrate());
        $this->form->setDefault('bitrate', $bitRate);
    }

    /**
     * DigitalBetacam Post Edit form Process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($digital_betacam = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object digital_betacam does not exist (%s).', $request->getParameter('id')));

        $digital_betacam->setType(42);
        $digital_betacam->save();
        $digital_betacam = Doctrine_Core::getTable('DigitalBetacam')->find(array($request->getParameter('id')));
        $this->form = new DigitalBetacamForm($digital_betacam);
        // get and set the default value for bitrate
        $bitRate = explode(',', $digital_betacam->getBitrate());
        $this->form->setDefault('bitrate', $bitRate);

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
     * @return boolean 
     */
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $digital_betacam = $form->save();
            $saveReturnId = array('form' => true, 'id' => $digital_betacam->getId());
            return $saveReturnId;
        }
        return false;
    }

}
