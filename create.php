<?php
include 'meekrodb.2.2.class.php';
if(!empty($_POST)) {
	// keep track validation errors
	$productError = null;
	$statusError = null;
	$customerError = null;
	// keep track post values
	$product = $_POST['product'];
	$status = $_POST['status'];
	$customer = $_POST['customer'];

	// validate input
	$valid = true;
	if (empty($product)) {
		$productError = 'Ingresa un producto';
		$valid = false;
	}
	if (empty($status)) {
		$statusError = 'Ingresa un estado de la orden';
		$valid = false;
	}
	if (empty($customer)) {
		$customerError = 'Ingresa datos del cliente';
		$valid = false;
	}
	if ($valid) {
	DB::insert('my_orders', array(
		'product' => $product,
		'status' => $status,
		'customer' => $customer
	)); 
	DB::insertId();
	header("Location: list.php");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
     
		     <div class="span10 offset1">
                    <div class="row">
                        <h3>Cargar nueva orden</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($productError)?'error':'';?>">
                        <label class="control-label">Producto</label>
                        <div class="controls">
                            <input name="product" type="text"  value="<?php echo !empty($product)?$product:'';?>">
                            <?php if (!empty($productError)): ?>
                                <span class="help-inline"><?php echo $productError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($statusError)?'error':'';?>">
                        <label class="control-label">Estado</label>
                        <div class="controls">
                            <input name="status" type="text" value="<?php echo !empty($status)?$status:'';?>">
                            <?php if (!empty($statusError)): ?>
                                <span class="help-inline"><?php echo $statusError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($customerError)?'error':'';?>">
                        <label class="control-label">Cliente</label>
                        <div class="controls">
                            <input name="customer" type="text"  value="<?php echo !empty($customer)?$customer:'';?>">
                            <?php if (!empty($customerError)): ?>
                                <span class="help-inline"><?php echo $customerError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Cargar</button>
                          <a class="btn" href="list.php">Volver</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  </body>
</html>