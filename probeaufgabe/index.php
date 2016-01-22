<?php
/**
 * Created by PhpStorm.
 * User: thomas baur
 * Date: 20.01.2016
 * Time: 10:07
 */

 
$output = "<html>
  <head>
  <meta charset='utf-8'>
  <title>Webcloud - Startseite</title>
</head>
</html>
<body>"; 

if (isset($_GET['redirect']) && $_GET['redirect'] == 'logout') {

  $output .= "<h1>Logout erfolgreich</h1>
      <p>Vielen Dank für Ihre Nutzung der Web-Cloud
	     <br><a href='login.php'>zurück zum Login</a>
	  </p>";
} else {
 
  $output .= "
    <h1>Wilkommen!</h1>
    <p>Wenn Sie schon registriert sind, dann können Sie sich <a href='login.php'>hier einloggen.</a><br>
    Falls noch nicht, können Sie sich <a href='register.php'>hier registrieren</a>.
  </p>";
}

$output .= "</body></html>";

echo $output;