<?php

  $client = new SoapClient("http://www.webservicex.net/globalweather.asmx?wsdl");
  $params = new stdClass;
  $params->CityName= 'Munich';
  $params->CountryName= 'Germany';
  $result = $client->GetWeather($params);
  // Check for errors...
  $weatherXML = $result->GetWeatherResult;
  // some dirty workaround to change the label to utf-8
  $weatherXML = preg_replace('/(<\?xml[^?]+?)utf-16/i', '$1utf-8', $weatherXML); 
  
  // var_dump($weatherXML);
  
  // write Result in xml file (filename as weather_Locationname.xml)
  $filename = "xmls/weather_" . $params->CityName . ".xml";
  $xmlfile = fopen($filename, "w");
  fwrite($xmlfile, $weatherXML, 1000);
  fclose($xmlfile);
  
  // now get content of file by simplexml
  $data = simplexml_load_file($filename);
  $wLocation = $data->Location;
  $wTime = $data->Time;
  $wTimeFormats = explode("/", $wTime);
  $wWind = $data->Wind;
  $wVisibility = $data->Visibility;
  $wSkyCond = $data->SkyConditions;
  $wTemp = $data->Temperature;
  $wDewpoint = $data->DewPoint; 
  $wHumidity = $data->RelativeHumidity; 
  $wPressure = $data->Pressure;
  
  $formattedResult = "
  <div>
    <strong>" . $wLocation . "</strong>
    <br/>" . $wTimeFormats[0] . "<br/>
    <br/><span class='temp'>Temp.: " . $wTemp . "</span>
    <br/>" . $wSkyCond . "
    <br/>Humidity: " . $wHumidity . "
    <br/>Pressure: " . $wPressure . "
    <br/>Wind: " . substr($wWind, 0, -2) . "
    <br/>Visibility: " . substr($wVisibility, 0, -2) . "
    <br/>
    <span><img src='images/weatherImages/".trim($wSkyCond).".png' alt=''></span>
  </div>";
  
  // now display result
  echo $formattedResult;