<?php

	class UserView
	{

		public function renderPage()
		{
			include_once(BASE_DIR . '\view\layout.php');
		}

		public function listOut($listName = '', $users = array())
		{
			if($listName != '' && sizeof($users) > 0){	
				$this->_startOutputBuffer($listName);
				foreach ($users as $user) {
					echo "<li class = 'user' id = '".$user->id."'>" . $user->firstName . " " . $user->surname ."</li>";
				}
				$this->_endOutputBuffer($listName);
			}
		}

		private function _endOutputBuffer($listName = ''){
			$this->$listName = ob_get_clean();
		}

		private function _startOutputBuffer($listName = ''){
			$this->_buffer = $listName;
			ob_start();
		}

		public function outputBufferContent($listName = ''){
			return (isset($this->$listName) ? $this->$listName : '');
		}

		public function userDetails(User $user){
			$this->_startOutputBuffer();
			echo "<p> UDI: " . $user->id . "</p>";
			echo "<p> Name: " . $user->firstName . "</p>";
			echo "<p> Surname: " . $user->surname . "</p>";
			echo "<p> gender: " . $user->gender . "</p>";
			$this->_endOutputBuffer('person-details');

		}
	}