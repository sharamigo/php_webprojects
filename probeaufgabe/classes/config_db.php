<?php
/**
 * Created by PhpStorm.
 * User: thomas baur
 * Date: 20.01.2016
 * Time: 10:25
 */

class config_db {

	//deprecated: only used when connected via mysqli
    //const DB_HOST = "cremerssa.szlocal.de";
	const DB_HOST = "localhost";
    const DB_USER = "probeaufgabe";
	const DB_PASS = "probeaufgabe";
    const DATABASE = "probeaufgabe";

	//const FILEFOLDER = "C:/Users/Praktikant/PhpstormProjects/probeaufgabe/files";
	const FILEFOLDER = "C:/xampp5.6/htdocs/probeaufgabe/files";
	
	const MIN_PASS_LENGTH = 6;
	

	/**
	 * gets database-connection
	 * @return pdo
	 */
    static function getConnected() {

		//$pdo = new PDO('mysql:host=localhost;dbname=probeaufgabe', 'probeaufgabe', 'probeaufgabe');
		$pdo = new PDO('mysql:host=localhost;dbname=probeaufgabe', 'root', '');

  	    return $pdo;
    }

}