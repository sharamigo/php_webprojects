<!DOCTYPE html> 
  <!--
   Author: Thomas Baur
   Matrikelnr.: 5867550
  -->

<html>
  <head>
     <title>Kinofilme +++ Cinema-Movies</title>
     <meta http-equiv="Content-Type"  content="text/html; charset=utf-8">
	 <script src="js/form_send.js" type="text/javascript"></script>
	 <script src="http://code.jquery.com/jquery-latest.js"></script>
     <link href="style/style.css"  type="text/css" rel="stylesheet">
  </head>
  
  <body>
    
    <section id="shadow_container">
      <section id="header">
      
      </section>
      <section id="content_area">
      
         <div class="menu_left">
            <ul>
              <li>
                <a class="nav" href="cinema_movies.html">Home</a>
              </li>
              <li>
                <a class="nav" href="movies.php">Cinema-Movies</a>
              </li>
              <li>
                <a class="nav" href="impressum.html">Impressum</a>
              </li>
            </ul>
         </div>
         
         <!-- content-Text-Bereich -->
         <div class="main_content">
            <h2>Kinofilme - Details</h2>
            <?php
              include("xml_processor.php");
              $xmlfile = "data/movies.xml";
              
              $filmdetails = xml_process::getDataDetails($_GET['id'], $xmlfile);
              $genres = xml_process::getMovieGenres();
              $freigabe = array("", "ab 6 Jahre", "ab 12 Jahre", "ab 16 Jahre", "ab 18 Jahre");
            
              echo "<h2>". $filmdetails[0]['titel'] ."</h2>";

              echo "<img src='images/". $filmdetails[0]['movie_poster'] ."' width='300' height='436' class='moviePicture' align='middle'><br><br>";        
            ?>
         
                  
         
         <!-- hier Formular um einzelne Daten anzuzeigen -->
        
           <?php echo '
             <form name="film_details"
                action="showDetails.php?id='.$_GET['id'].'"
                method="GET"
                accept-charset="UTF-8">';
               
               ?>
            
               <table>
                 
                 <tr>
                   <td colspan="2">
                     <?php  ?>
                   </td>
                 </tr>
                 <tr>
                   <td><label for="identyfier">ID</label></td>
                   <td> 
                     <?php 
                      echo '<input type="text" id="identyfier" name="id" value="'. $filmdetails[0]['id'] .'" size="6" disabled>';
                     ?>
                   </td>
                 </tr>
                 <tr>
                   <td><label for="title">Original-Titel:</label></td>
                   <td>
                     <?php echo '<input type="text" id="title" name="title" value="'. $filmdetails[0]['original_title'] .'" size="50">' ?>
                   </td>
                 </tr>
                 <tr>
                   <td><label for="country">Produktionsland:</label></td>
                   <td>
                     <?php echo '<input type="text" id="country" name="country" value="'. $filmdetails[0]['produktionsland'] .'" size="50" disabled>' ?>
                   </td>
                 </tr>
                 <tr>
                   <td><label for="year">Erscheinungsjahr:</label></td>
                   <td>
                     <?php echo '<input type="text" id="year" name="release_year" value="'. $filmdetails[0]['release_year'] .'" size="10" disabled>' ?>
                   </td>
                 </tr>
                 <tr>
                   <td><label for="duration">Dauer:</label></td>
                   <td>
                     <?php echo '<input type="text" id="duration" name="dauer" value="'. $filmdetails[0]['duration'] .'" size="10" disabled> Minuten' ?>
                   </td>
                 </tr>
                 <tr>
                   <td><label for="producer">Produzent:</label></td>
                   <td>
                     <?php echo '<input type="text" id="producer" name="producer" value="'. $filmdetails[0]['screenwriter'] .'" size="50">' ?>
                   </td>
                 </tr>
                 <tr>
                   <td><label for="director">Regie:</label></td>
                   <td>
                     <?php echo '<input type="text" id="director" name="director" value="'. $filmdetails[0]['director'] .'" size="50">' ?>
                   </td>
                 </tr>
                 <tr>
                   <td><label for="music">Musik:</label></td>
                   <td>
                     <?php echo '<input type="text" id="music" name="music" value="'. $filmdetails[0]['music'] .'" size="50">' ?>
                   </td>
                 </tr>
                 
                 <tr>
                   <td><label for="fsk">freigegeben ab:</label></td>
                   <td>
                     <?php
                       echo '<select name="fsk" id="fsk">';
                       for ($n=0;$n < count($freigabe); $n++) {
                         $selecta = ($filmdetails[0]['fsk'] == $freigabe[$n]) ? "selected": "";
                         echo '<option value="'.$freigabe[$n].'" '.$selecta.'>' .$freigabe[$n]. '</option>';
                       }
                       echo '</select>';
                     ?>
                   </td>
                 </tr>
                 
                 <tr>
                   <td valign="top"><label for="actors">Besetzung:</label></td>
                   <td>
                     <?php echo '<textarea id="actors" name="actors" cols="70" rows="12">'. $filmdetails[0]['actors'] .'</textarea>' ?>
                   </td>
                 </tr>
                 
                 
                  <tr>
                    <td>
                     &nbsp;
                    </td>
                    <td>
                    <fieldset>
                     <legend>Genre</legend>
                    
                     <?php
                       for ($x=0; $x < count($genres); $x++) {
                        
                         $selected = ($filmdetails[0]['genre'] == $genres[$x]) ? " checked": "";
                         echo '<input type="radio" name="genre" id="choice_'.$x.'" value="'.$genres[$x].'" '.$selected.'>'.$genres[$x].'<br>';
                       }
                     ?>
                     </fieldset>
                    </td>
                  </tr>
				  
				  <tr>
				    <td colspan="2">
					  <a href="" onclick="javascript:$('#oscarsection').toggle('slow'); return false;">show/hide this</a>
					</td>
				  </tr>
                  
                  <tr id="oscarsection">
                    <td><b>Oscars:</b></td>
                    <td>
                      <?php
                        $anzahlOscars = $filmdetails[0]['oscars'];
                        if ($anzahlOscars > 0) {
                          for($i=0; $i < $anzahlOscars; $i++) {
                            echo '<img src="images/graphics/oscar_statue_small.gif" class="fl" title="'.$filmdetails[0]['oscars'].' Oscars">&nbsp';
                          }
                        } else {
                          echo '<b>0 Oscars</b>';
                        }
                      ?>
                    </td>
                  </tr>
                  
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                 
                
               </table>
         </form>
		 
		<br><br>
		<a href="movies.php" class="backlink">&raquo;back to overview</a>
		 
		<br><br>
		<!-- Button -->
		<button onclick="send();">save</button>
        
            
			
		<!-- AJAX-Ausgabe -->
		<section id="ausgabe">
		</section>
            
         </div>
         <br><br>
         <div class="clearer"></div>
         <div class="footer">
           &copy;&nbsp;2014 Thomas Baur - Cologne, Germany             
         </div>                 
         
        
      </section>
    </section>
     <div class="footerContainer"></div>  
  
  </body>
</html>