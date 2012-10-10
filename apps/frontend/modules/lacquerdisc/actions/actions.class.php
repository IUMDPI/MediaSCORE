<?php

/**
 * lacquerdisc actions.
 *
 * @package    mediaSCORE
 * @subpackage lacquerdisc
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class lacquerdiscActions extends sfActions {

    /**
     * Generate LacquerDisc form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new LacquerDiscForm();
    }

    /**
     * LacquerDisc Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new LacquerDiscForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * LacquerDisc edit Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($lacquer_disc = Doctrine_Core::getTable('LacquerDisc')->find(array($request->getParameter('id'))), sprintf('Object lacquer_disc does not exist (%s).', $request->getParameter('id')));
        $this->form = new LacquerDiscForm($lacquer_disc);
    }

    /**
     * LacquerDisc Post Edit form Process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($lacquer_disc = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object lacquer_disc does not exist (%s).', $request->getParameter('id')));

        $lacquer_disc->setType(15);
        $lacquer_disc->save();
        $lacquer_disc = Doctrine_Core::getTable('LacquerDisc')->find(array($request->getParameter('id')));
        $this->form = new LacquerDiscForm($lacquer_disc);


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
            $lacquer_disc = $form->save();
            $saveReturnId = array('form' => true, 'id' => $lacquer_disc->getId());
            return $saveReturnId;
        }
        return false;
    }

}
