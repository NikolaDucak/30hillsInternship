<?php
/**
* 
*/
class UserStatsFacade
{

	public function run($uid){

		$user = new User($uid);
 		
 		$view = new UserView();

 		if ($user->exists()) {

			$userData = new Analyzer($user);

			$allUsers = Analyzer::getAllUsers();
			$view->listOut("people-list", $allUsers);

			$friends = $userData->directFriends();
			$view->listOut("direct-friends-list",$friends);

			$outerFriends = $userData->outerFriends();
			$view->listOut("outer-friends-list",$outerFriends);

			$friendSuggestions = $userData->friendSuggestions();
			$view->listOut("friend-sugestion-list",$friendSuggestions);

			$view->userDetails($user);

			$view->renderPage();

		}else{

			$allUsers = Analyzer::getAllUsers();
			$view->listOut("people-list", $allUsers);

			$view->renderPage();
		}
	}
}