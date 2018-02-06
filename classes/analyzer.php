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
		$this->_directFriends();
		$this->_outerFriends();
		$this->_friendSuggestions();
	}

	private function _directFriends()
	{
		foreach ($this->_user->friends as $friend){
			$this->_directFriends[]= new User($friend);
		}
	}

	private function _outerFriends()
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

	private function _friendSuggestions()
	{
		$user = $this->_user;
		$posiblesugs = array();

		foreach ($this->_outerFriends as $outerFriend) {
			foreach ($outerFriend->friends as $Suggestion) {
			 	
			 	if ($Suggestion != $this->_user->id) {
				 	$mutualFriends = $this->_checkMutual(new User($Suggestion), $this->_user);
				 	
				 	if (($mutualFriends>=2) 
				 	&& ($this->_notInList($Suggestion, $this->_directFriends))
				 	&& ($this->_notInList($Suggestion, $this->_friendSuggestions))){
			 			$this->_friendSuggestions[] = new User($Suggestion);
			 		}
			 	}
			} 
		}
	}

	private function _checkMutual($start, $end)
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

	public function getFriends(){ return $this->_directFriends; }
	public function getOuterFriends(){ return $this->_outerFriends; }
	public function getFriendSuggestions(){ return $this->_friendSuggestions; }
}