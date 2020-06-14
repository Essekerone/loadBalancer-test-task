<?php

namespace LoadBalancer\tests\algorithm;

use LoadBalancer\algorithm\QueueAlgorithm;
use LoadBalancer\host\Host;
use LoadBalancer\host\HostList;
use PHPUnit\Framework\TestCase;

class QueueAlgorithmTest extends TestCase
{
    public function testDetermine()
    {
        $hostFirst = new Host('True', 1);
        $hostSecond = new Host('False', 2);
        $algorithm = new QueueAlgorithm();

        $hostList = new HostList([$hostSecond, $hostFirst]);

        for ($i= 0;$i<3;$i++){
                $this->assertEquals($hostList[$i%2],$algorithm->determine($hostList));
        }
    }
}