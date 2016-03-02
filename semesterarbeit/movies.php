<!DOCTYPE html> 
  <!--
   Author: Thomas Baur
   Matrikelnr.: 5867550
  -->

<html>
  <head>
     <title>Kinofilme +++ Cinema-Movies</title>
     <meta http-equiv="Content-Type"  content="text/html; charset=utf-8">
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
            <h2>Kinofilme - &Uuml;bersicht</h2>
            <?php
              include("xml_processor.php");
              $xmlfile = "data/movies.xml";
              
              $filme = xml_process::getDataList($xmlfile);
              echo $filme;              
            ?>
            
            
         </div>
         <div class="clearer"></div>
		 <div class="footer">
           &copy;&nbsp;2014 Thomas Baur - Cologne, Germany             
         </div>                 
         
        
      </section>
    </section>
     <div class="footerContainer"></div>  
  
  </body>
</html>