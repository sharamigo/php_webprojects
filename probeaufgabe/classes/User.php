<?php
/**
 * Created by PhpStorm.
 * User: Praktikant
 * Date: 20.01.2016
 * Time: 10:16
 */

include_once('config_db.php');

class User {

	protected $user;

    
	
	/**
	 * creates a new user
	 * @param $username
	 * @param $password
	 * @return boolean
	 */
	public function createUser($username, $password) {
	
		$pdo = config_db::getConnected();
		$stmt = $pdo->prepare("INSERT INTO `users` (username, password) VALUES (:username, :passwort)");
		$result = $stmt->execute(array('username' => $username, 'passwort' => $password));
		
		// add new user into authfile
		$content = "\n" . $username .":". $password;
		$authFile = config_db::FILEFOLDER .'/'. '.htpasswd';
		$filehandle = fopen($authFile, 'a');
		fputs($filehandle, $content);
        
		if ($result) {
			return true;
		} else {
			return false;
		}
	
	}
	
	/**
	 * checks if a username is already existing
	 * @param $username
	 * @return boolean
	 */
	public function getUser($username) {
	
		$this->user = array();
		$pdo = config_db::getConnected();
		$statement = $pdo->prepare("SELECT * FROM `users` WHERE username = :username");
		$result = $statement->execute(array('username' => $username));
		$this->user = $statement->fetch();  
		
		return $this->user;
	
	}
	
	/**
	 * checks if a username is already existing
	 * @param $username
	 * @return boolean
	 */
	public function validUser($username) {
	
		$this->user = false;
		$pdo = config_db::getConnected();
		$statement = $pdo->prepare("SELECT * FROM `users` WHERE username = :username");
		$result = $statement->execute(array('username' => $username)); echo $username;
		$this->user = $statement->fetch();  
		
		if ($this->user) {
			return true;
		} else {
			return false;
		}
	
	}
}

