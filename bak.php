<?php

/**
 * assetgroup actions.
 *
 * @package    mediaSCORE
 * @subpackage assetgroup
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class assetgroupActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    /*$this->asset_groups = Doctrine_Core::getTable('AssetGroup')
      ->createQuery('a')
      ->execute();*/
	  $collectionID=$request->getParameter('c');
	  $this->forward404Unless($collectionID);

	  $this->collectionName = Doctrine_Core::getTable('Collection')
		  						->find($collectionID)
								->getName();
	  echo $this->collectionName;

	  $this->asset_groups = Doctrine_Core::getTable('AssetGroup')
		  						->findBy('parent_node_id',$collectionID);
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->asset_group = Doctrine_Core::getTable('AssetGroup')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->asset_group);
  }

  public function executeNew(sfWebRequest $request)
  {
	$this->trace = 'trace';

	$this->units = Doctrine_Core::getTable('Unit')
	->createQuery('a')
	->execute();

	$this->collections=Doctrine_Core::getTable('Collection')
	->createQuery('a')
	->execute();

	$this->form = new AssetGroupForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AssetGroupForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
	  $this->forward404Unless($asset_group = Doctrine_Core::getTable('AssetGroup')->find(array($request->getParameter('id'))), sprintf('Object asset_group does not exist (%s).', $request->getParameter('id')));

    $this->collections=Doctrine_Core::getTable('Collection')->findAll();
    $this->form = new AssetGroupForm($asset_group);

    // Pass the related EvaluatorHistory objects to the View
    //$this->evaluatorHistoryInstances = $asset_group->getEvaluatorHistory();

/*Doctrine_Query::create()
				->from('AssetGroup ag')
				->leftJoin('ag.evaluatorActions eh')
				->where('ag.id = ?',7)
				->fetchOne();*/
    
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($asset_group = Doctrine_Core::getTable('AssetGroup')->find(array($request->getParameter('id'))), sprintf('Object asset_group does not exist (%s).', $request->getParameter('id')));
    $this->form = new AssetGroupForm($asset_group);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($asset_group = Doctrine_Core::getTable('AssetGroup')->find(array($request->getParameter('id'))), sprintf('Object asset_group does not exist (%s).', $request->getParameter('id')));
    $asset_group->delete();

    $this->redirect('assetgroup/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $asset_group = $form->save();

      $this->redirect('assetgroup/edit?id='.$asset_group->getId());
    }
  }
}
