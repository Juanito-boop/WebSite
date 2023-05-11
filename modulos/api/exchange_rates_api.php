<?php
require '../../vendor/autoload.php';

$client = new http\Client;
$request = new http\Client\Request;

$request->setRequestUrl('http://api.exchangeratesapi.io/v1/latest');
$request->setRequestMethod('GET');
$request->setQuery(new http\QueryString([
  'access_key' => '8c1R5Q0DQZC7HGztsMXmVks0lqzqIgEv',
  'base' => 'COP',
  'symbols' => 'USD'
]));

$request->setHeaders([
  'Accept' => '*/*',
  'User-Agent' => 'Thunder Client (https://www.thunderclient.com)'
]);

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();

?>