<?php

/**
 * collection actions.
 *
 * @package    mediaSCORE
 * @subpackage collection
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class collectionActions extends sfActions
{

	public function executeGetCollectionsForUnit(sfWebRequest $request) {

		if($request->isXmlHttpRequest()) {

			$unitID = $request->getParameter('id');

			// Too many exceptions thrown - taking an overly complex approach
			// (getFirst() and fetchOne() throw exceptions)
			// Needs to be optimized

			$collections = Doctrine_Core::getTable('Collection')
				->createQuery('c')
				->where('parent_node_id =?',$unitID)
				->execute()
				->toArray();

			$this->getResponse()->setHttpHeader('Content-type','application/json');
			$this->setLayout('json');
			$this->setTemplate('index');
			echo json_encode($collections);
		}
	}

  public function executeIndex(sfWebRequest $request)
  {
	  $unitID=$request->getParameter('id');

	  // Get collections for a specific Unit
	  if($unitID and $request->isXmlHttpRequest()) {
		$this->collections = Doctrine_Core::getTable('Collection')
			->createQuery('a')
			->where('parent_node_id',$unitID)
			->execute();

		$this->getResponse()->setHttpHeader('Content-type','application/json');
		$this->setLayout('json');
		echo json_encode($this->collections->toArray());
		
	  } else {
		$this->collections = Doctrine_Core::getTable('Collection')
			->createQuery('a')
			->execute();
	  }
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->collection);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CollectionForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CollectionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id'))), sprintf('Object collection does not exist (%s).', $request->getParameter('id')));
    $this->form = new CollectionForm($collection);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id'))), sprintf('Object collection does not exist (%s).', $request->getParameter('id')));
    $this->form = new CollectionForm($collection);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($collection = Doctrine_Core::getTable('Collection')->find(array($request->getParameter('id'))), sprintf('Object collection does not exist (%s).', $request->getParameter('id')));
    $collection->delete();

    $this->redirect('collection/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $collection = $form->save();

      $this->redirect('collection/edit?id='.$collection->getId());
    }
  }
}
