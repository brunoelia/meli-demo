<?php

function getMySQL(){
	return mysqli_connect("us-cdbr-east-05.cleardb.net","bf1bc084cfd2a5","0b8e9262","heroku_92be9b375008aca");
}

$CURL_OPTS = array(
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_CONNECTTIMEOUT => 10, 
	CURLOPT_RETURNTRANSFER => 1, 
	CURLOPT_TIMEOUT => 60
	);

$CLIENT_ID = "151021044208185";

$CLIENT_SECRET = "kOu0A6Nujm623PbdUaPevs3CEfFHnKTx";


function getToken(){

	$con= getMySQL();

	$result = mysqli_query($con,"SELECT * FROM auth WHERE user_id = 7958450");

	$row = mysqli_fetch_array($result);

	$return_access_token = null;


	if (strtotime($row['expires']) < (strtotime("now") - 60 ) ){

		$body = array(
	                "grant_type" => "refresh_token", 
	                "client_id" => $GLOBALS['CLIENT_ID'], 
	                "client_secret" => $GLOBALS['CLIENT_SECRET'], 
	                "refresh_token" => $row['refresh_token']
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

		$return_access_token = $response["access_token"];

		$refresh_token = $response["refresh_token"];

		$update = "UPDATE auth SET access_token = '$return_access_token', expires = ADDTIME(NOW(), '06:00:00'), refresh_token =  '$refresh_token' WHERE user_id = 7958450";

		var_dump($update);

		$result = mysqli_query($con, $update);

		mysqli_close($con);

	}else{

		$return_access_token = $row['access_token'];
	}
	
	
	return $return_access_token;

}




?>

