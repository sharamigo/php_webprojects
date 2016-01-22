<?php

include_once('classes/config_db.php');
include_once('classes/User.php');
$oUser = new User();
//$pdo = config_db::getConnected();

//$pdo = new PDO('mysql:host=localhost;dbname=probeaufgabe', 'probeaufgabe', 'probeaufgabe');

if(isset($_GET['login']) && $_GET['login'] == 1) {
	
	$username = $_POST['username'];
	$passwort = $_POST['passwort'];

	//$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
	//$result = $statement->execute(array('username' => $username));
	//$user = $statement->fetch();
	
	$user = $oUser->getUser($username);
	$validUser = $oUser->validUser($username);
	

	//Überprüfung des Passworts
	if ($validUser !== false && password_verify($passwort, $user['password'])) {
		
		$_SESSION['userid'] = $user['id'];
		$_SESSION['username'] = $user['username'];
		header('Location: user_area.php');
		//die('Login erfolgreich. Weiter zu <a href="user_area.php">internen Bereich</a>');
	} else {
		$errorMessage = "Benutzername oder Passwort war ungültig<br>";
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Webcloud - Login</title>
</head>
<body>

<?php
if(isset($errorMessage)) {
	echo $errorMessage;
}
?>

<form action="?login=1" method="post">
	Benutzername:<br>
	<input type="text" size="40" maxlength="250" name="username"><br><br>

	Passwort:<br>
	<input type="password" size="40"  maxlength="250" name="passwort"><br>

	<input type="submit" value="Login">
</form>
</body>
</html>
