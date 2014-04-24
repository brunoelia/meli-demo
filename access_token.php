<?php

$CURL_OPTS = array(
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_CONNECTTIMEOUT => 10, 
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_TIMEOUT => 60
	);


$CLIENT_ID = "5354672771124560";

$CLIENT_SECRET = "zw0g017LUYEdGafNqEsoeQntIXhJp8h7";

function get_access_token(){

	$body = array(
		"grant_type" => "client_credentials", 
		"client_id" => $GLOBALS['CLIENT_ID'], 
		"client_secret" => $GLOBALS['CLIENT_SECRET'], 
		);

	$opts = array(
		CURLOPT_POST => true, 
		CURLOPT_POSTFIELDS => $body
		);

	$ch = curl_init('https://api.mercadolibre.com/oauth/token');

	curl_setopt_array($ch, $GLOBALS['CURL_OPTS']);
	curl_setopt_array($ch, $opts);

	$response = json_decode(curl_exec($ch),TRUE);

	curl_close($ch);

	return $response['access_token'];
}


?>