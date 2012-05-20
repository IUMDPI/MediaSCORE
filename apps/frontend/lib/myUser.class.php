<?php

//class myUser extends sfBasicSecurityUser
class myUser extends sfGuardSecurityUser
{
	public function setUp() {
		parent::setUp();

		$this->hasMany('Store as createdStores', array(
			'local' => 'id',
			'foreign' => 'creator_id'
		));

		$this->hasMany('Store as editedStores', array(
			'local' => 'id',
			'foreign' => 'last_editor_id'
		));
	}
}
