<?php
$url = 'https://maps.googleapis.com/maps/api/distancematrix/xml?origins='.$vendor_pin_code.'&destinations='.$zip_code.'&key=AIzaSyDDJF5Q_fLPcCpVjJM1xvZrslLNn2MExNo';

		$result_string = file_get_contents($url);

		// Convert xml string into an object 
		$new_xml = simplexml_load_string($result_string); 

		// Convert into json 
		$con_json = json_encode($new_xml); 
		
		// Convert into associative array 
		$distance = json_decode($con_json, true);	

		$distance_cal=$distance['row']['element']['distance']['text'];
		$distance_km= $distance['row']['element']['distance']['value'];
		
?>