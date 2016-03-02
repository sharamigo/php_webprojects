function send() { 

  /* HTTP-Object erzeugen 
     siehe dazu auch:
	 http://www.hki.uni-koeln.de/wisem-2013/basissysteme-der-informationsverarbeitung-bsi-hist-kultwiss-informationsverarbeitung-teil-1-texte-als-information/a-5
	 (sheet Seite 2)
  */
  var HTTP = null;
  if (window.XMLHttpRequest) {
	HTTP = new XMLHttpRequest();
  }  // ein Workaround für den Drecks-Internetexplorer
   else if (window.ActiveXObject) {
   	try {
   		HTTP = new ActiveXObject("Msxml2.HTTP");
   	}
   	catch (ex) {
   		try {
   			HTTP = new ActiveXObject("Microsoft.HTTP");
   		}
   		catch (ex) {
   		}
   	}
  }
  
  //variable für das Genre setzen 
  // such as "Abenteuer", "Action", "Dokumentation", "Drama", "Erotik", "Fantasy", "Horror", "Krimi", "Komödie", "Romantik", "Science-Fiction", "Thriller", "Western", "Zeichentrick"
  var filmgenre = '';
  var genres_available = new Array(
    "Abenteuer", "Action", "Dokumentation", "Drama", "Erotik", "Fantasy", "Horror", "Krimi", "Komödie", "Romantik", "Science-Fiction", "Thriller", "Western", "Zeichentrick"
  );
  for (var x=0; x < genres_available.length; x++) {
    if (document.getElementById('choice_'+ x).checked) {
      filmgenre = genres_available[x];
    }
  }  
  
 
  
  
  var titel = "title=" + document.getElementById('title').value;
  var director = "&director=" + document.getElementById('director').value;
  var producer = "&producer=" + document.getElementById('producer').value;
  var release = "&release_year=" + document.getElementById('year').value;
  var country = "&country=" + document.getElementById('country').value;
  var duration = "&dauer=" + document.getElementById('duration').value;
  var music = "&music=" + document.getElementById('music').value;
  var genre = "&g=" + filmgenre;
  
  // hier Funktion einbauen
  HTTP.open("GET", "formRequest.php?" + titel + director + producer + release + country + duration + music + genre);
  //HTTP.open("POST", "formRequest.php", true);
  HTTP.onreadystatechange=function() {
    Ausgabe("ausgabe", HTTP);
  }
   
   HTTP.send();
   //document.film_details.submit();
}

/*
 * Funktion die die Ausgabe der Formulareingaben im HTML an ein bestimmtes Element anzeigt
 */
function Ausgabe(elem, HTTP) {

  if (HTTP.readyState == 4) {
     
     document.getElementById(elem).innerHTML = HTTP.responseText;
  } else {
    // alert("hier ist nix");
  }

}