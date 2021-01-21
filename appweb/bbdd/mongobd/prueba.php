<?php
require 'vendor/autoload.php';

//phpinfo();
echo extension_loaded("mongodb") ? "loaded\n" : "not loaded\n";

//$connection = new MongoDB\Client;
//$client = new \MongoDB\Client("mongodb://127.0.0.1:27017");
// Connecting specifying host and port
$connection = new MongoDB\Client('mongodb://localhost:27017');



?>