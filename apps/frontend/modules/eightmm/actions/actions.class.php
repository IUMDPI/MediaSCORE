<?php

/**
 * eightmm actions.
 *
 * @package    mediaSCORE
 * @subpackage eightmm
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eightmmActions extends sfActions {

    /**
     * Generate EightMM form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new EightMMForm();
    }

    /**
     * EightMM Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new EightMMForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * EightMM edit Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($eight_mm = Doctrine_Core::getTable('EightMM')->find(array($request->getParameter('id'))), sprintf('Object eight_mm does not exist (%s).', $request->getParameter('id')));
        $this->form = new EightMMForm($eight_mm);
    }

    /**
     * EightMM Post Edit form Process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($eight_mm = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object eight_mm does not exist (%s).', $request->getParameter('id')));
        // set the format type
        $eight_mm->setType(31);
        $eight_mm->save();
        $eight_mm = Doctrine_Core::getTable('EightMM')->find(array($request->getParameter('id')));
        $this->form = new EightMMForm($eight_mm);


        $validateForm = $this->processForm($request, $this->form);
        // form is valid then return the id;
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
            $eight_mm = $form->save();
            $saveReturnId = array('form' => true, 'id' => $eight_mm->getId());
            return $saveReturnId;
        }
        return false;
    }

}
