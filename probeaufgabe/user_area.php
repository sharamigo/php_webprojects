<?php
/**
 * Created by PhpStorm.
 * User: Praktikant
 * Date: 20.01.2016
 * Time: 11:35
 */
include_once("classes/Files.php");


session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];


$oFiles = new Files();
$aUserFiles = $oFiles->getFiles($_SESSION['userid']);

$output = "<html>
  <head>
  <meta charset='utf-8'>
  <title>User restricted- Area</title>
  <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
  <script src='js/func.user_area.js' type='text/javascript'></script>
</head>
</html>
<body>
Eingeloogt als User: ". $userid . "<strong> " . $username . "</strong>
<a href='index.php?redirect=logout'>Logout</a>
<br/>

<div>
<h2>File upload - overview</h2><br/>
<form action='user_area.php?upload=1' method='post' name='upload' enctype='multipart/form-data'>
 Wählen Sie hier eine Datei, die Sie uploaden möchten:<br/>
 <input type='file' name='upload' size='100'>
 <input type='submit' name='fileuploader' value='Upload'>

</form>
</div>";

// here call function to insert new data
if (isset($_GET['upload'])) {
	$filename = $_FILES['upload']['name'];
	$type = $_FILES['upload']['type'];
	$size = $_FILES['upload']['size'];
	$created = date('Y-m-d H:i:s');
	$oFiles->newFile($filename, $type, $size, $created);
	header('Location: user_area.php');
}

// actions von GET abfragen
if (isset($_GET['action']) && $_GET['action'] == "delete") {
	$oFiles->deleteFile($_GET['id']);
	header('Location: user_area.php');
}
if (isset($_GET['renamed']) && isset($_POST['rename_frm_submit'])) {
	$oFiles->renameFile($_POST['fileid'], $_POST['oldfile'], $_POST['newname']);
	header('Location: user_area.php');
}
//show this only when file should be renamed
if (isset($_GET['action']) && $_GET['action'] == "rename") {
	$output .= "<div style='margin: 10px 10px; padding: 10px 10px; background-color: #CCC;' id='file_rename'>
	              <span id='close_div'><img src='icons/close.png' style='float:right;' title='close'></span>
                  <form method='post' action='user_area.php?renamed=1' name='filerename'>
                  <input type='hidden' name='fileid' value='". $_GET['id']."'>
                  <input type='hidden' name='oldfile' value='". $oFiles->getFileNameById($_GET['id']). "'>
                  new filename: <input type='text' name='newname' maxlength='100' size='100' value='". $oFiles->getFileNameById($_GET['id'])."'><br>
                  <input type='submit' value='rename' name='rename_frm_submit'>
                  </form>
                </div>";

}


//print_r($aUserFiles);
// show this, if user has files uploaded
if ($aUserFiles) {
	$output .= "<div class='filelist'>";
	$output .= "Hier sehen Sie alle Dateien, die Sie hochgeladen haben. <br>
	       Wenn Sie in die rechte Spalte auf das Icon klicken, können Sie die Datei löschen, mit dem Icon auf der mittleren Spalte <br>
		   können Sie es umbenennen. <br><br>";
	$output .= "<table>";
	$output .= "<tr>
       </tr><th>Filename</th><th>Filetype</th><th>Size</th><th>erstellt am</th><th>Download</th><th>Umbenennen</th><th>Löschen</th>
     </tr>";
	for ($i=0; $i < count($aUserFiles); $i++) {
		$filetypeIcon = str_replace("/", "_", $aUserFiles[$i]['ftype']);
		$fileSize = $oFiles->formatFilesize($aUserFiles[$i]['filesize']);

		$output .= "<tr>";
    	$output .= "<td>". $aUserFiles[$i]['filename'] ."</td>";
		$output .= "<td><img src='icons/". $filetypeIcon .".gif'>". $aUserFiles[$i]['ftype'] ."</td>";
		$output .= "<td>". $fileSize ." </td>";
		$output .= "<td>". $aUserFiles[$i]['created_at'] ."</td>";
		$output .= "<td><a href='files/". $aUserFiles[$i]['filename']. "' title='downloaden' target='_blank'><img src='icons/download.gif' style='margin:0px auto;display:block;' alt='download'> </a></td>";
		$output .= "<td><a href='user_area.php?id=". $aUserFiles[$i]['fileid'] ."&action=rename' title='umbenennen'><img src='icons/rename.gif' style='margin:0px auto;display:block;' alt='rename'> </a></td>";
		$output .= "<td><a href='user_area.php?id=". $aUserFiles[$i]['fileid'] ."&action=delete' title='Datei löschen'><img src='icons/dustbin.gif' style='margin:0px auto;display:block;' alt='delete'> </a></td>";
		$output .= "</tr>";
	}
	$output .= "</table>";
    $output .= "</div>";
}


$output .= "</body></html>";

echo $output;