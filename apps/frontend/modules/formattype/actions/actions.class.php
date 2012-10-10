<?php

/**
 * formattype actions.
 *
 * @package    mediaSCORE
 * @subpackage formattype
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class formattypeActions extends sfActions {

    /**
     * Get format type
     * 
     * @param sfWebRequest $request
     * @return json 
     */
    public function executeGetModelName(sfWebRequest $request) {
        $formatTypeID = $request->getParameter('id');

        $this->forward404Unless($formatTypeID);

        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        $this->setLayout('json');
        $this->setTemplate('index');

        $formatTypeIDs = Doctrine_Core::getTable('FormatType')
                ->getOptions('subclasses');

        $formatTypeModel = Doctrine_Core::getTable('FormatType')
                ->find($formatTypeID)
                ->getType();
        if ($formatTypeModel == 0) {
            return $this->renderText(json_encode('formattype'));
        } else {
            $formatTypeModel = $formatTypeModel - 1;
            return $this->renderText(json_encode($formatTypeIDs['subclasses'][$formatTypeModel]));
        }
    }

    /**
     * List FormatType
     * 
     * @param sfWebRequest $request 
     */
    public function executeIndex(sfWebRequest $request) {
        $this->format_types = Doctrine_Core::getTable('FormatType')
                ->createQuery('a')
                ->execute();
    }

    /**
     * FormatType show detail 
     * 
     * @param sfWebRequest $request 
     */
    public function executeShow(sfWebRequest $request) {
        $this->format_type = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->format_type);
    }

    /**
     * Get Format type
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        echo FormatType::getTypeModelNameForModuleName($this->getModuleName());
        //$this->form = new FormatTypeForm();
    }

    /**
     * FormatType new form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNewform(sfWebRequest $request) {

        $this->form = new FormatTypeForm();
        $this->setTemplate('new');
    }

    /** 
     * FormatType Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new FormatTypeForm();


        $validateForm = $this->processForm($request, $this->form);
        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('new');
        }
    }

    /**
     * FormatType edit form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($format_type = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object format_type does not exist (%s).', $request->getParameter('id')));
        $this->form = new FormatTypeForm($format_type);
    }

    /**
     * FormatType Post edit form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($format_type = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object format_type does not exist (%s).', $request->getParameter('id')));
        $this->form = new FormatTypeForm($format_type);

        $validateForm = $this->processForm($request, $this->form);
        if ($validateForm && isset($validateForm['form']) && $validateForm['form'] == true) {
            echo $validateForm['id'];
            exit;
        } else {
            $this->setTemplate('edit');
        }
    }

    /**
     * Delete FormatType
     * 
     * @param sfWebRequest $request 
     */
    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($format_type = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object format_type does not exist (%s).', $request->getParameter('id')));
        $format_type->delete();

        $this->redirect('formattype/index');
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
        $for = $request->getParameter('format_type');

        if ($form->isValid()) {
            $format_type = $form->save();
            $saveReturnId = array('form' => true, 'id' => $format_type->getId());
            return $saveReturnId;
        }
        return false;
    }

}
