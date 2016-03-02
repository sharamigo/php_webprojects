<?php 
  
  include('xml_processor.php');
  
  if (isset($_GET)) {
    //var_dump($_GET);
    echo "Titel: " . htmlspecialchars($_GET['title']);
    
    echo "<br>Regie: " . htmlspecialchars($_GET['director']);
    
    echo "<br>Produzent: " . htmlspecialchars($_GET['producer']);
    
    echo "<br>Erschienen: (Jahr und Land) " . htmlspecialchars($_GET['release_year']) . " " . $_GET['country'];

    echo "<br><b>Filmlaenge: " . htmlspecialchars($_GET['dauer']) . "min</b>";

    echo "<br>Your changes has been saved!";    
  }
  
  // Daten aendern
  $data= simplexml_load_file(xml_process::$filename);
  $data->movie[0]->original_title = htmlspecialchars($_GET['title']);
  $data->movie[0]->director = htmlspecialchars($_GET['director']);
  $data->movie[0]->screenwriter = htmlspecialchars($_GET['producer']);
  $data->movie[0]->genre = htmlspecialchars($_GET['g']);
  $data->movie[0]->music = htmlspecialchars($_GET['music']);
  
  $data->asXML(xml_process::$filename);
  
  
  /*
  $query = $data->xpath("/cinemamovies/movie/id[.='".$_GET['id']."']/parent::*");
  $data->asXML(xml_process::$filename);
  */
  
  /*
  $data= simplexml_load_file(xml_process::$filename);
  $handle = fopen(xml_process::$filename, "wb"); 
  fwrite($handle, $data->asXML());
  fclose($handle);
  */
  
