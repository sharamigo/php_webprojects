<?php
/**
 * Processor-class for XML-file to provide data
 * @author: Thomas Baur (5867550)
 *
 */
 
 class xml_process {
 
    
    static $filename = 'data/movies.xml';    
    
    function __construct() {
       
    }
    
    /**
     * show some data of xml-file in overview
     * @param  string $xmlfile   name of the processed xml-file
     * @return string $datalist  table with data from xml-file
     */
    static function getDataList($xmlfile) {    
      
      // init vars in first time
      if (file_exists($xmlfile)) {
        $xml = simplexml_load_file($xmlfile);
      
        $gesamt = $xml->movie->count();
        
        
        $datalist = "<span>Es sind $gesamt Datens&auml;tze vorhanden</span>";
        $datalist .= "<table class='dataTable' width='100%'>";
        
        $datalist .= "<tr>
                        <th>Name</th>
                        <th>Erscheinungsjahr</th>
                        <th>Genre</th>
                        <th>Regie</th>
                        <th></th>
                         </tr>";
        
        // get all the results from the file
        for($i=0; $i <$gesamt; $i++) {
          $class_switch = ($i % 2 == 0) ? "evenrow" : "oddrow";
        
          $datalist .= "<tr class='".$class_switch."'>";
          $datalist .= "<td title='$xml->cinemamovies->$i->original_title'>". $xml->movie->$i->titel ."</td>";
          $datalist .= "<td>". $xml->movie->$i->release_year ."</td>";
          $datalist .= "<td>". $xml->movie->$i->genre ."</td>";
          $datalist .= "<td>". $xml->movie->$i->director ."</td>";
          $datalist .= "<td><a href='showDetails.php?id=". $xml->movie->$i->id ."' class='editlink'>Edit</a></td>";
          $datalist .= "</tr>";
        }      
        
        $datalist .= "</table>";
      
      }
      return $datalist;
    }
    
    /**
     * @param  int    $dataset  id of the dataset
     * @param  string $xmlfile  xml-file to be processed
     * @return array  $retval   details of a specified dataset (identified by id- get-param)
     *
     */
    static function getDataDetails($dataset, $xmlfile) {
    
      $retval = array();
      $xmlString = file_get_contents($xmlfile);
      $xml = new SimpleXMLElement($xmlString); 
      
      $query = $xml->xpath("/cinemamovies/movie/id[.='$dataset']/parent::*");      
      
      /* 
       * convert SimpleXMLObject to array
       * @url: http://www.binarytides.com/convert-simplexml-object-to-array-in-php/ 
       */
      $retval = json_decode(json_encode($query), 1);
      
      
      return $retval;
    }
    
    
    /**
     * returns movie genres
     * @return  array  $genres
     */
    static function getMovieGenres() {
    
      $genres = array(
        "Abenteuer", "Action", "Dokumentation", "Drama", "Erotik", "Fantasy", 
        "Horror", "Krimi", "Komödie", "Romantik", "Science-Fiction", "Thriller",
        "Western", "Zeichentrick"
      );     
    
      return $genres;
    }
    
     
 }