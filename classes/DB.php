<?php

class DB
{
	private $_db;
	
	public function __construct()
	{
		$jsonString = file_get_contents(BASE_DIR . '/data/data.json');
		$this->_db = json_decode($jsonString);
	}

	public function findUser($userId)
	{
 		foreach ($this->_db as $user) {
 			if ($user->id == $userId) {
 				return $user;
 			}
 		}
 		return false;
	}

	public function getAllUsers()
	{
		return $this->_db;
	}
}