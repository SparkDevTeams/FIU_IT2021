<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client('mongodb://127.0.0.1:27017');
echo "Connection to Database Successful";
$db = $client->sparkdev;

$checkpoints = $db->checkpoints;

//$events = $db->events;

//$document = $checkpoints->findOne(
//	['event_id' => new MongoDB\BSON\ObjectId($_GET['event_id'])]
//);
var_dump($_GET);
//print_r($document);
//print_r("\n");
//$formatteddate = date('c');
$dateformat = new DateTime(date('c'));
echo $dateformat->format('c');

$mongo_date = new MongoDB\BSON\UTCDateTime($dateformat->getTimestamp());

$pipeline = [
	['$lookup'=>[
		"from"=>"events",
		"localField"=>"event_id",
		"foreignField"=>"_id",
		"as"=>"result"
		]
	],[ '$match'=>[
		"value"=>$_GET['value'],
		'$and'=>[
				["creationDate"=>['$lte'=> $mongo_date]],
				["expirationDate"=>['$gte'=> $mongo_date]]
			]
		]
	]
] ;
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
