<?php

/**
 * unit actions.
 *
 * @package    mediaSCORE
 * @subpackage unit
 * @author     Nouman Tayyab
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class unitActions extends sfActions {

    public function executeSearch(sfWebRequest $request) {
        $types = array('Metal Disc' => '1',
            'Film' => '5',
            'DAT' => '6',
            'Sound Wire Reel' => '7',
            'Analog Audio Cassette' => '4',
            'Polyster Open Reel Audio Tape' => '9',
            'Acetate Open Reel Audio Tape' => '10',
            'Paper Open Reel Audio Tape' => '11',
            'PVC Open Reel Audio Tape' => '12',
            'Lacquer Disc' => '15',
            'MiniDisc' => '16',
            'Cylinder' => '17',
            'Sound Optical Disc' => '19',
            'Optical Video' => '20',
            'Pressed 78RPM Disc' => '22',
            'Pressed LP Disc' => '23',
            'Pressed 45RPM Disc' => '24',
            'LaserDisc' => '26',
            'XDCAM Optical' => '27',
            'Betamax' => '29',
            '8MM' => '31',
            '2" Open Reel Video' => '33',
            '1" Open Reel Video' => '34',
            '½" Open Reel Video' => '35',
            'DV' => '37',
            'DVCAM' => '38',
            'Betacam' => '40',
            'VHS' => '41',
            'Digital Betacam' => '42',
            'U-matic' => '44',
            'HDCAM' => '45',
            'DVCPro' => '46',
        );

        $store = array('Unit' => '1',
            'Collection' => '3',
            'Asset Group' => '4');

        $this->searchValues = $request->getParameter('search_values');
        $this->searchString = explode(',', $this->searchValues);

        $formatType = array();
        $storeType = array();
        $stringForName = '%';

        foreach ($this->searchString as $value) {
            if (isset($types[$value]))
                $formatType[] = $types[$value];
            else if (isset($store[$value]))
                $storeType[] = $store[$value];
            else
                $stringForName.=$value . '%';
        }
//        echo strlen($stringForName);

        if (count($formatType) > 0) {

            $this->formatsResult = Doctrine_Query::Create()
                    ->from('AssetGroup ag')
                    ->select('ag.*')
                    ->innerJoin('ag.FormatType f')
                    ->whereIn('f.type', $formatType);
            if (strlen($stringForName) > 1)
                $this->formatsResult = $this->formatsResult->andWhere('name like "' . $stringForName . '"');
            $this->formatsResult = $this->formatsResult->execute();
        }
        else if (count($storeType) > 0) {
            $this->storeResult = Doctrine_Query::Create()
                    ->from('Store s')
                    ->select('s.*')
                    ->whereIn('s.type', $storeType);
            if (strlen($stringForName) > 1)
                $this->storeResult = $this->storeResult->andWhere('name like "' . $stringForName . '"');
            $this->storeResult = $this->storeResult->execute();
        }
        else {
            if (strlen($stringForName) > 1) {
                $this->randomSearch = Doctrine_Query::Create()
                        ->from('Store s')
                        ->select('s.*')
                        ->where('name like "' . $stringForName . '"')
                        ->execute();
            }
        }
    }

    public function executeGetUnitForAssetGroup(sfWebRequest $request) {

        if ($request->isXmlHttpRequest()) {
            // assetgroup.parent_node_id -> collection
            // collection.parent_node_id -> unit

            $assetGroupID = $request->getParameter('id');

            // Too many exceptions thrown - taking an overly complex approach
            // (getFirst() and fetchOne() throw exceptions)
            // Needs to be optimized
            //$map = array('AssetGroup','Collection','Unit');

            $assetGroups = Doctrine_Core::getTable('AssetGroup')
                    ->createQuery('a')
                    ->where('id =?', $assetGroupID)
                    ->execute()
                    ->toArray();
            $assetGroup = array_pop($assetGroups);

            $collections = Doctrine_Core::getTable('Collection')
                    ->createQuery('c')
                    ->where('id =?', $assetGroup['parent_node_id'])
                    ->execute()
                    ->toArray();
            $collection = array_pop($collections);

            $units = Doctrine_Core::getTable('Unit')
                    ->createQuery('u')
                    ->where('id =?', $collection['parent_node_id'])
                    ->execute()
                    ->toArray();

            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            $this->setTemplate('index');
            echo json_encode(array_pop($units));
        }
    }

    public function executeUnitPersonnelLocation(sfWebRequest $request) {
        $unitId = $request->getParameter('u');
        $this->forward404Unless($request->isXmlHttpRequest());
        if ($request->isXmlHttpRequest()) {
            $unit = Doctrine_Query::Create()
                    ->from('Person p')
                    ->select('p.*')
                    ->innerJoin('p.UnitPerson up')
                    ->where('up.unit_id =?', $unitId)
                    ->fetchArray();
            $location = Doctrine_Query::Create()
                    ->from('StorageLocation sl')
                    ->select('sl.*')
                    ->innerJoin('sl.UnitStorageLocation usl')
                    ->where('usl.unit_id =?', $unitId)
                    ->fetchArray();
            return $this->renderText(json_encode(array('success' => true, 'unit' => $unit, 'location' => $location)));
        }
    }

    public function executeGetUserDetail(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        if ($request->isXmlHttpRequest()) {
            $explodeId = explode(',', $request->getParameter('id'));
            $user = Doctrine_Core::getTable('sfGuardUser')
                    ->createQuery('c')
                    ->whereIn('id ', $explodeId)
                    ->execute()
                    ->toArray();
            return $this->renderText(json_encode(array('success' => true, 'id' => $request->getParameter('id'), 'records' => $user)));
        }
    }

    public function executeIndex(sfWebRequest $request) {
        $this->deleteMessage = $this->getUser()->getAttribute('delMsg');
        $this->getUser()->getAttributeHolder()->remove('delMsg');
        $this->units = Doctrine_Core::getTable('Unit')
                ->createQuery('a')
                ->orderBy('name')
                ->execute();

        // Cannot forge a one-to-one relationship with myUser class that provides a 
        /* $this->creators = array();
          foreach($this->units as $unit) {

          //$unit->getCreator();

          $this->creators[$unit->getId()] = Doctrine_Core::getTable('User')->find( $unit->getCreatorId() );
          }

          $this->editors = array();
          foreach($this->units as $unit) {
          $this->editors[$unit->getId()] = Doctrine_Core::getTable('User')->find( $unit->getLastEditorId() );
          } */


        // To be moved into a separate Action or Controller
        $searchInpout = $request->getParameter('s');
        $status = $request->getParameter('status');
        $from = $request->getParameter('from');
        $to = $request->getParameter('to');
        $dateType = $request->getParameter('datetype');
        if ($request->isXmlHttpRequest()) {
            $this->unit = Doctrine_Query::Create()
                    ->from('Unit u')
                    ->select('u.*,cu.*,eu.*')
                    ->orderBy('u.name')
                    ->innerJoin('u.Creator cu')
                    ->innerJoin('u.Editor eu');

            if ($searchInpout && trim($searchInpout) != '') {
                $this->unit = $this->unit->andWhere('name like "%' . $searchInpout . '%"');
            }
            if ($status && trim($status) != '') {
                $this->unit = $this->unit->andWhere('status =?', $status);
            }
            if ($dateType != '') {
                if ($dateType == 0) {
                    if (trim($from) != '' && trim($to) != '') {
                        $this->unit = $this->unit->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(created_at,"%Y-%m-%d") <= "' . $to . '"');
                    } else {
                        if (trim($from) != '') {
                            $this->unit = $this->unit->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") >=?', $from);
                        }

                        if (trim($to) != '') {
                            $this->unit = $this->unit->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") <=?', $to);
                        }
                    }
                } else if ($dateType == 1) {
                    if (trim($from) != '' && trim($to) != '') {
                        $this->unit = $this->unit->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") >= "' . $from . '" AND DATE_FORMAT(updated_at,"%Y-%m-%d") <= "' . $to . '"');
                    } else {
                        if (trim($from) != '') {
                            $this->unit = $this->unit->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") >=?', $from);
                        }

                        if (trim($to) != '') {
                            $this->unit = $this->unit->andWhere('DATE_FORMAT(updated_at,"%Y-%m-%d") <=?', $to);
                        }
                    }
                }
            }


            $this->unit = $this->unit->execute();
//            $this->collections = Doctrine_Core::getTable('Collection')
//                    ->createQuery('a')
//                    ->where('parent_node_id =?', $unitID)
//                    ->andWhere('name like "%'.$searchInpout.'%"')
//                    ->execute();

            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->setLayout('json');
            return $this->renderText(json_encode($this->unit->toArray()));
        }
    }

    public function executeShow(sfWebRequest $request) {


        if ($request->isXmlHttpRequest()) {

            $unit = Doctrine_Core::getTable('Unit')->find(
                            Doctrine_Core::getTable('Collection')->find($request->getParameter('collectionID'))->getParentNodeId())->toArray();
            $this->getResponse()->setHttpHeader('Content-type', 'application/json');
            $this->getResponse()->setContent(json_encode($unit));
            return sfView::NONE;
        } else {

            $this->unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id')));
            $this->forward404Unless($this->unit);
        }
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new UnitForm(null,
                        array('userID' => $this->getUser()->getGuardUser()->getId()
                ));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new UnitForm(null, array(
                    'userID' => $this->getUser()->getGuardUser()->getId()
                ));

        $success = $this->processForm($request, $this->form);
        if ($success && isset($success['form']) && $success['form'] == true) {
            echo $success['id'];
            exit;
        } else {
            $this->setTemplate('new');
        }
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));
        $this->form = new UnitForm(
                        $unit,
                        array(
                            'userID' => $this->getUser()->getGuardUser()->getId(),
                            'action' => 'edit'
                ));
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));


        $this->form = new UnitForm($unit,
                        array(
                            'userID' => $this->getUser()->getGuardUser()->getId(),
                            'action' => 'edit'
                ));



//            $this->locationError = 'This value is selected by a Collection or Asset Group. To de-select at the unit level, you must first de-select this value at the asset group and collection level';
//            $this->setTemplate('edit');

        $success = $this->processForm($request, $this->form);
        if ($success && isset($success['form']) && $success['form'] == true) {
            echo $success['id'];
            exit;
        } else {
            if ($success && isset($success['error']) && $success['error'] == true) {
                $this->locationError = 'This value is selected by a Collection or Asset Group. To de-select at the unit level, you must first de-select this value at the asset group and collection level';
            }
            $this->setTemplate('edit');
        }
    }

    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();

        $this->forward404Unless($unit = Doctrine_Core::getTable('Unit')->find(array($request->getParameter('id'))), sprintf('Object unit does not exist (%s).', $request->getParameter('id')));

        $collections = Doctrine_Query::Create()
                ->from('Collection c')
                ->select('c.*')
                ->where('c.parent_node_id  = ?', $request->getParameter('id'))
                ->fetchArray();
        if (sizeof($collections) > 0) {
            $this->getUser()->setAttribute('delMsg', 'You must reassign the collections and asset groups to another unit before you can delete this unit.');
        } else {
            $unit->delete();
        }
        $this->redirect('unit/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $collections = Doctrine_Query::Create()
                ->from('CollectionStorageLocation csl')
                ->select('csl.*')
                ->innerJoin('csl.Collection c')
                ->where('c.parent_node_id  = ?', $form->getValue('id'))
                ->groupBy('csl.storage_location_id')
                ->fetchArray();
        if ($form->isValid()) {
            $check = array();
            foreach ($collections as $value) {
                foreach ($form->getValue('storage_locations_list') as $location) {
                    if ($location == $value['storage_location_id']) {
                        $check[] = $value['storage_location_id'];
                    }
                }
            }
            if (count($collections) != count($check)) {
                $error = array('error' => true);
                return $error;
            }
            $unit = $form->save();
            $success = array('form' => true, 'id' => $unit->getId());
            return $success;
        }
    }

}
