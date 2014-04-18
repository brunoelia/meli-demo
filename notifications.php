<?php

include 'access_token.php';
include 'meekrodb.2.2.class.php';

$inputJSON = file_get_contents('php://input');

$input= json_decode( $inputJSON, TRUE );

if($input['topic'] == 'orders'){
    
    $order = json_decode(file_get_contents('https://api.mercadolibre.com' . $input['resource'] . "?access_token=" . get_access_token()),TRUE);

    $orderId = $order['id'];

    $rows = DB::query("SELECT * FROM my_orders WHERE meli_order_id = %i ", $order['id']);

    //new order
    if(count($rows) == 0){

		DB::insert('my_orders', array(
		  'meli_order_id' => $order['id'],
		  'product' => 'hello',
		  'status' => 'new',
		  'customer' => $order['buyer']['email']
		));
	 
		DB::insertId();
    }
    //update oprder
    else{

    }

}


?>