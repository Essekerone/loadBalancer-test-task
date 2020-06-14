<?php
namespace LoadBalancer;

require_once "vendor/autoload.php";
namespace  LoadBalancer;
use LoadBalancer\algorithm\LoadLimitAlgorithm;
use LoadBalancer\algorithm\QueueAlgorithm;
use LoadBalancer\host\Host;
use LoadBalancer\host\HostList;
use LoadBalancer\http\Request;

$request = new Request();

$hosts = new HostList();
$hosts->offsetSet(0,new Host("First", 1));
$hosts->offsetSet(1,new Host("Second", 0.18));
$hosts->offsetSet(2,new Host("Third", 0.85));

$algorithm = new LoadLimitAlgorithm();

echo "Load limit algorithm : \n";
$loadLimitBalancer = new LoadBalancer($hosts, $algorithm);
for ($i = 0; $i < 12; $i++) {
    $loadLimitBalancer->handleRequest($request);
}


$hosts = new HostList();

$hosts->offsetSet(0,new Host("First", 1));
$hosts->offsetSet(1,new Host("Second", 0.18));
$hosts->offsetSet(2,new Host("Third", 0.85));

$algorithm = new QueueAlgorithm();

echo "Queue algorithm : \n";

$queueBalancer = new LoadBalancer($hosts, $algorithm);
for ($i = 0; $i < 12; $i++) {
    $queueBalancer->handleRequest($request);
}

echo 3%2;