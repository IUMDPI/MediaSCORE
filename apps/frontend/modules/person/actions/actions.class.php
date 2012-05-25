<?php

/**
 * person actions.
 *
 * @package    mediaSCORE
 * @subpackage person
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personActions extends sfActions
{
	public function executeGetPersonsForAssetGroup(sfWebRequest $request) {

		$assetGroupID=$request->getParameter('ag');
    		$this->forward404Unless($request->isXmlHttpRequest() && $assetGroupID);

		// Needs optimization
		$persons = Doctrine_Core::getTable('Person')
				->findBy('unit_id',Doctrine_Core::getTable('Unit')
					->find(Doctrine_Core::getTable('Collection')
						->find(	Doctrine_Core::getTable('AssetGroup')
							->find($assetGroupID)->getParentNodeId()
						)->getParentNodeId())->getId())->toArray();
		$this->getResponse()->setHttpHeader('Content-type','application/json');
		$this->setLayout('json');
		$this->setTemplate('index');
		return $this->renderText(json_encode($persons));
	}

  public function executeIndex(sfWebRequest $request)
  {
    $this->persons = Doctrine_Core::getTable('Person')
      ->createQuery('a')
      ->execute();
  }

	public function executeShow(sfWebRequest $request) {
		$this->person = Doctrine_Core::getTable('Person')->find(array($request->getParameter('id')));

		if( $request->isXmlHttpRequest() ) {
			$this->getResponse()->setHttpHeader('Content-type','application/json');
			$this->setLayout('json');
			return $this->renderText( json_encode($this->person->toArray()));
		} else
			$this->forward404Unless($this->person);
	}

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PersonForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PersonForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($person = Doctrine_Core::getTable('Person')->find(array($request->getParameter('id'))), sprintf('Object person does not exist (%s).', $request->getParameter('id')));
    $this->form = new PersonForm($person);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($person = Doctrine_Core::getTable('Person')->find(array($request->getParameter('id'))), sprintf('Object person does not exist (%s).', $request->getParameter('id')));
    $this->form = new PersonForm($person);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($person = Doctrine_Core::getTable('Person')->find(array($request->getParameter('id'))), sprintf('Object person does not exist (%s).', $request->getParameter('id')));
    $person->delete();

    $this->redirect('person/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $person = $form->save();

      $this->redirect('person/edit?id='.$person->getId());
    }
  }
}
