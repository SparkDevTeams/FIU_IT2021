<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client('mongodb://127.0.0.1:27017');
echo "Connection to Database Successful";
$testdb = $client->mytestdb;

$testcol = $testdb->sparkdev;

$testcol->insertOne([
	'username' => 'admin',
	'timestamp' => time(),
	'ip' => $_SERVER['REMOTE_ADDR'],
	'checkpoint' => $_GET['checkpoint'],
	'value'=> 'ajbdviaublwajhkafhsdlf',
	'creationDate'=> time(),
]);
print_r($_GET);

?>
