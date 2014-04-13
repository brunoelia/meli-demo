<?php

include 'index.php';


$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE );

// {"user_id":1234,"resource":"\/orders\/123123123","topic":"orders","received":"2014-04-13T07:06:58+00:00","sent":"2014-04-13T07:06:58+00:00"}

if($input['topic'] == 'orders'){
    $order = json_decode(file_get_contents('https://api.mercadolibre.com' . $input['resource'] . "?access_token=" . getToken()),TRUE);

    $con = getMySQL();

    $orderId = $order['id'];

    $orderStatus = $order['status'];

    $orderNickname = $order['buyer']['email'];

    mysqli_query($con,"INSERT INTO item_order (id,status,buyer_email) VALUES ($orderId,'$orderStatus','$orderNickname') ON DUPLICATE KEY UPDATE status = '$orderStatus'");

    echo "INSERT INTO item_order (id,status,buyer_email) VALUES ($orderId,'$orderStatus','$orderNickname') ON DUPLICATE KEY UPDATE status = '$orderStatus'";

    mysqli_close($con);

}


?>