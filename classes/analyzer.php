<?php
/**
* 
*/
class Analyzer
{
	private $_user, $_directFriends, $_outerFriends, $_friendSuggestions;
	
	function __construct(User $user)
	{
		$this->_user = $user;	
	}

	public function directFriends()
	{
		foreach ($this->_user->friends as $friend){
			$this->_directFriends[]= new User($friend);
		}

		return $this->_directFriends;
	}

	public function outerFriends()
	{
		foreach ($this->_directFriends as $friend) {
			foreach ($friend->friends as $outerFriend) {
				if
				(($outerFriend != $this->_user->id) && 
				($this->_notInList($outerFriend, $this->_directFriends)) && 
				($this->_notInList($outerFriend, $this->_outerFriends))) {
					$this->_outerFriends[] = new User($outerFriend);
				}
			}
		}
		return $this->_outerFriends;
	}

	private function _notInList($personId, $list)
	{
		if($list){
			foreach ($list as $friend) {
				if ($friend->id == $personId) {
					return false;
				}
			}
		}
		return true;
	}

	public function friendSuggestions()
	{
		$user = $this->_user;
		$posiblesugs = array();

		foreach ($this->_outerFriends as $outerFriend) {
			foreach ($outerFriend->friends as $Suggestion) {
			 	
			 	if ($Suggestion != $this->_user->id) {
				 	$mutualFriends = $this->checkMutual(new User($Suggestion), $this->_user);
				 	
				 	if (($mutualFriends>=2) 
				 	&& ($this->_notInList($Suggestion, $this->_directFriends))
				 	&& ($this->_notInList($Suggestion, $this->_friendSuggestions))){
			 			$this->_friendSuggestions[] = new User($Suggestion);
			 		}
			 	}
			} 
		}
		return $this->_friendSuggestions;
	}

	private function checkMutual($start, $end)
	{
		$count = 0;	
		foreach ($start->friends as $friend) {
			foreach ($end->friends as $endfriend) {
				if ($friend == $endfriend) {
					$count++;
				}
			}
		}
		return $count;
	}

	public static function getAllUsers()
	{
		$db = new DB();
		return $db->getAllUsers();
	}
}