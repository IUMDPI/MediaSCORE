<?php

/**
 * dvcpro actions.
 *
 * @package    mediaSCORE
 * @subpackage dvcpro
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dvcproActions extends sfActions {

    /**
     * Generate DVCPro form
     * 
     * @param sfWebRequest $request 
     */
    public function executeNew(sfWebRequest $request) {
        $this->form = new DVCProForm();
    }

    /**
     * DVCPro Post form process
     * 
     * @param sfWebRequest $request 
     */
    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DVCProForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * DVCPro edit Form
     * 
     * @param sfWebRequest $request 
     */
    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($dvc_pro = Doctrine_Core::getTable('DVCPro')->find(array($request->getParameter('id'))), sprintf('Object dvc_pro does not exist (%s).', $request->getParameter('id')));
        $this->form = new DVCProForm($dvc_pro);
        $formatVersion = explode(',', $dvc_pro->getFormatVersion());


        $this->form->setDefault('formatVersion', $formatVersion);
    }

    /**
     * DVCPro Post Edit form Process
     * 
     * @param sfWebRequest $request 
     */
    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($dvc_pro = Doctrine_Core::getTable('FormatType')->find(array($request->getParameter('id'))), sprintf('Object dvc_pro does not exist (%s).', $request->getParameter('id')));

        $dvc_pro->setType(46);
        $dvc_pro->save();
        $dvc_pro = Doctrine_Core::getTable('DVCPro')->find(array($request->getParameter('id')));
        $this->form = new DVCProForm($dvc_pro);
        $formatVersion = explode(',', $dvc_pro->getFormatVersion());


        $this->form->setDefault('formatVersion', $formatVersion);

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
            $dvc_pro = $form->save();
            $saveReturnId = array('form' => true, 'id' => $dvc_pro->getId());
            return $saveReturnId;
        }
        return false;
    }

}
