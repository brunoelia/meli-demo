<?php

include 'meekrodb.2.2.class.php';

echo "HOfLA";

echo "dss";

$row = DB::query("SELECT %s FROM dual WHERE %s=%s ", 'pepe', 'pepe', 'pepe');

var_dump($row);

?>