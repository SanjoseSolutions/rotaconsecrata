<?php

class MyWebUser extends RWebUser {
	private $_profile = null;

	public function init() {
		parent::init();
		if (!$this->getIsGuest()) {
			$this->_profile = Users::model()->findByPk($this->getId());
		}
	}
	
	public function getProfile() {
		return $this->_profile;
	}
}

