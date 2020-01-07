<?php

use Houston\Parsers\JsonParser;
use Houston\Transaction;

require_once 'vendor/autoload.php';

$jsonSample  = file_get_contents('./data_samples/transaction.json');
$xmlSample   = file_get_contents('./data_samples/transaction.xml');
$arraySample = include './data_samples/transaction.php';


//load from JSON
$jsonParser      = new JsonParser();
$jsonTransaction = new Transaction($jsonParser, $jsonSample);

//OR load from JSON
$jsonTrans = Transaction::createFromJson($jsonSample);
//load from XML
$xmlTrans = Transaction::createFromXml($xmlSample);
//load from Array
$arrTrans = Transaction::createFromArray($arraySample);


print_r($jsonTransaction->getTransaction());
print_r($jsonTrans->getTransaction());
print_r($xmlTrans->getTransaction());
print_r($arrTrans->getTransaction());