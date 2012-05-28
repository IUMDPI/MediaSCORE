<?php

/**
 * assetgroup actions.
 *
 * @package    mediaSCORE
 * @subpackage assetgroup
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class assetgroupActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        /* $this->asset_groups = Doctrine_Core::getTable('AssetGroup')
          ->createQuery('a')
          ->execute(); */

        $this->collectionID = $request->getParameter('c');
        $this->forward404Unless($this->collectionID);

        $collection = Doctrine_Core::getTable('Collection')
                ->find($this->collectionID);
        $this->forward404Unless($collection);

        $this->unitID = $collection->getParentNodeId();

        $this->unitName = Doctrine_Core::getTable('Unit')
                ->find($this->unitID)
                ->getName();

        $this->persons = Doctrine_Core::getTable('Evaluator')
                ->findAll();
        //print_r($this->persons->toArray());
        //print_r($this->persons->count());
        //exit();

        $this->collectionName = $collection->getName();
        $this->asset_groups = Doctrine_Core::getTable('AssetGroup')
                ->findBy('parent_node_id', $this->collectionID);
        //print_r($this->asset_groups->getPerson()->toArray());
    }

    public function executeShow(sfWebRequest $request) {
        $this->asset_group = Doctrine_Core::getTable('AssetGroup')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->asset_group);
    }

    public function executeNew(sfWebRequest $request) {
        $this->units = Doctrine_Core::getTable('Unit')
                ->createQuery('a')
                ->execute();

        $this->collections = Doctrine_Core::getTable('Collection')
                ->createQuery('a')
                ->execute();

        $this->form = new AssetGroupForm(
                        null,
                        array(
                            'creatorID' => $this->getUser()->getGuardUser()->getId(),
                            'collectionID' => $request->getParameter('c'))
        );
        //$this->form->setOption('collectionID',$request->getParameter('c'));
    }

    public function executeCreate(sfWebRequest $request) {

        // 05/08/12
        //$this->getResponse()->setContent( print_r($request->getPostParameters()) );
        //return sfView::NONE;

        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $collectionId = sfToolkit::getArrayValueForPath($request->getParameter('asset_group'), 'parent_node_id');

        $this->form = new AssetGroupForm(null,
                        array(
                            'creatorID' => $this->getUser()->getGuardUser()->getId(),
                            'collectionID' => $collectionId));

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {

        $this->forward404Unless($asset_group = Doctrine_Core::getTable('AssetGroup')->find(array($request->getParameter('id'))), sprintf('Object asset_group does not exist (%s).', $request->getParameter('id')));
        $this->collections = Doctrine_Core::getTable('Collection')->findAll();
        $this->form = new AssetGroupForm($asset_group,
                        array(
                            'creatorID' => $this->getUser()->getGuardUser()->getId(),
                            'collectionID' => $request->getParameter('c'),
                            'action'=>'edit')
        );
        $this->form->setOption('collectionID', $request->getParameter('c'));

        // Pass the related EvaluatorHistory objects to the View
        //$this->evaluatorHistoryInstances = $asset_group->getEvaluatorHistory();

        /* Doctrine_Query::create()
          ->from('AssetGroup ag')
          ->leftJoin('ag.evaluatorActions eh')
          ->where('ag.id = ?',7)
          ->fetchOne(); */
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($asset_group = Doctrine_Core::getTable('AssetGroup')->find(array($request->getParameter('id'))), sprintf('Object asset_group does not exist (%s).', $request->getParameter('id')));

        $collectionId = sfToolkit::getArrayValueForPath($request->getParameter('asset_group'), 'parent_node_id');
        $this->form = new AssetGroupForm($asset_group,
                        array(
                            'creatorID' => $this->getUser()->getGuardUser()->getId(),
                            'collectionID' => $collectionId,
                            'action'=>'edit'));
        $this->processEditForm($request, $this->form);

        //$this->setTemplate('edit');
        $this->redirect('assetgroup/index?c=' . $collectionId);
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($asset_group = Doctrine_Core::getTable('AssetGroup')->find(array($request->getParameter('id'))), sprintf('Object asset_group does not exist (%s).', $request->getParameter('id')));
        $asset_group->delete();

        $this->redirect('assetgroup/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $collectionId = sfToolkit::getArrayValueForPath($form->getName(), 'parent_node_id');
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $asset_group = $form->save();

            $this->redirect('assetgroup/edit?id=' . $asset_group->getId() . '&c=' . $form->getOption('collectionID'));
        }
    }

    protected function processEditForm(sfWebRequest $request, sfForm $form) {
        $collectionId = sfToolkit::getArrayValueForPath($form->getName(), 'parent_node_id');
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $asset_group = $form->save();

//            $this->redirect('assetgroup/edit?id=' . $asset_group->getId() . '&c=' . $form->getOption('collectionID'));
        }
    }

}
