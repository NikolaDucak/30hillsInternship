<?php
/**
* 
*/
class User
{
	private $_exists = true;
	function __construct($userID)
	{
		return $this->_setAttributes($userID);
	}

	private function _setAttributes($id)
	{
		$db = new DB();
		$user = $db->findUser($id);

		if($user){
			foreach ($user as $attribute => $value) {
				$this->$attribute = $value;
			}
			return true;
		}else{
			$this->_exists=false;
		}
	}

	public function exists(){
		return $this->_exists;
	}
}