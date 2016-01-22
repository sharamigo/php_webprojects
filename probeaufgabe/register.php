<?php
/**
 * Created by PhpStorm.
 * User: thomas baur
 * Date: 20.01.2016
 * Time: 11:50
 */

session_start();

include_once('classes/config_db.php');
include_once('classes/User.php');

//create general vars
$oUser = new User();
//$pdo = config_db::getConnected();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Benutzer-Registrierung</title>
</head>
<body>

<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
	$error = false;
	$username = $_POST['username'];
	$passwort = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];


	if(strlen($passwort) == 0) {
		echo 'Bitte ein Passwort angeben<br>';
		$error = true;
	}
	if($passwort != $passwort2) {
		echo 'Die Passwörter müssen übereinstimmen<br>';
		$error = true;
	}
	//password length
	if(strlen($passwort) < config_db::MIN_PASS_LENGTH) {
		echo 'Das Passwort muss mindestens ' . config_db::MIN_PASS_LENGTH . ' Zeichen lang sein.<br>';
		$error = true;
	}
	//some other password specifications
	$valid = preg_match("/[a-z]/", $passwort)
      && preg_match("/[A-Z]/", $passwort)
      && preg_match("/[0-9]/", $passwort);
	if(!$valid) {
	
		echo "Bitte prüfen Sie das gewählte Passwort. <br>
		      Das Passwort muss folgende Kriterien erfüllen: <br>
			  - sowohl Kleinbuchstaben als auch Großbuchstaben enthalten<br>
			  - Ziffern sollten auch enthalten sein<br>";
		$error = true;
	}

	//check if user exists
	if(!$error) {
		
		$validUser = $oUser->validUser($username);
		if($validUser !== false) {
			echo 'Dieser Username ist bereits vergeben<br>';
			$error = true;
		}
	}


	if(!$error) {
		$passwort_hash = password_hash($passwort, PASSWORD_BCRYPT);

		//create a new user and check, if it did`n fail
		$newUser = $oUser->createUser($username, $passwort_hash);
		
		if($newUser) {
			echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
			$showFormular = false;
		} else {
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
		}
	}
}

if($showFormular) {
	?>

	<form action="?register=1" method="post">
		Username:<br>
		<input type="text" size="40" maxlength="250" name="username"><br><br>

		Dein Passwort:<br>
		<input type="password" size="40"  maxlength="250" name="passwort"><br>

		Passwort wiederholen:<br>
		<input type="password" size="40" maxlength="250" name="passwort2"><br><br>

		<input type="submit" value="Abschicken">
	</form>
	
	

	<?php
}
?>

</body>
</html>