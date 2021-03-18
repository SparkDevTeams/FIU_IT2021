<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client('mongodb://127.0.0.1:27017');
echo "Connection to Database Successful";
$qrdb = $client->qr;

$attendance = $qrdb->attendance;

$events = $qrdb->event;

$checkpoints = $qrdb->checkpoints;


$document = $checkpoints->findOne(
	['event_id' => new MongoDB\BSON\ObjectId($_GET['event_id'])]
);
var_dump($_GET);
print_r($document);
print_r("\n");


$pipeline = array(
	array(
		'$lookup' => [
			'from' => 'event',
			'localField' => 'event_id',
			'foreignField' => '_id',
			'as' =>  'haha'
		]
	)
);
$result = $checkpoints->aggregate($pipeline);
print_r($result);

//foreach($document as $doc){
//var_dump($doc);
//}

//$testcol->insertOne([
//	'username' => 'admin',
//	'timestamp' => time(),
//	'ip' => $_SERVER['REMOTE_ADDR'],
//	'checkpoint' => $_GET['checkpoint'],
//]);
//print_r($_GET);

?>
