<?php

include 'access_token.php';
include 'meekrodb.2.2.class.php';

DB::$error_handler = false;
DB::$throw_exception_on_error = true;

$inputJSON = file_get_contents('php://input');

$input= json_decode( $inputJSON, TRUE );

if($input['topic'] == 'orders'){
    
    $order = json_decode(file_get_contents('https://api.mercadolibre.com' . $input['resource'] . "?access_token=" . get_access_token()),TRUE);

    if($order == NULL){
    	exit('error obtener la orden');
    }

    $orderId = $order['id'];

    $rows = DB::query("SELECT * FROM my_orders WHERE meli_order_id = %i ", $order['id']);

    //new order - array_merge
    if(count($rows) == 0){

		DB::insert('my_orders', array(
		  'meli_order_id' => $order['id'],
		  'product' => $order['order_items'][0]['item']['title'],
		  'status' => $order['status'],
		  'customer' => ('email:' . $order['buyer']['email'] . '/ tel :' . $order['buyer']['phone']['area_code'] . $order['buyer']['phone']['number'] )
		));
	 
		DB::insertId();

    } else{
		DB::update('my_orders', array(
			'product' => $order['order_items'][0]['item']['title'],
		  	'status' => $order['status'] . 'update',
		  	'customer' => ('email:' . $order['buyer']['email'] . '/ tel :' . $order['buyer']['phone']['area_code'] . $order['buyer']['phone']['number'] )
			), "meli_order_id=%i", $order['id']);
    }

}else{
	exit('Request MALO :(');
}


?>