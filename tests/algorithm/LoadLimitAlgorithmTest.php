<?php

namespace LoadBalancer\tests\algorithm;

use LoadBalancer\algorithm\LoadLimitAlgorithm;
use LoadBalancer\host\Host;
use LoadBalancer\host\HostList;
use PHPUnit\Framework\TestCase;

class LoadLimitAlgorithmTest extends TestCase
{
    public function testDetermine(){
        include_once 'config/config.php';
        $hostFirst = new Host('True', $config['load_limit'] - 0.5);
        $hostSecond = new Host('False', $config['load_limit'] + 0.5);
        $algorithm = new LoadLimitAlgorithm();

        $hostList = new HostList([$hostSecond,$hostFirst]);
        $result = $algorithm->determine($hostList);

        $this->assertEquals($hostFirst,$result);

        $hostList = new HostList([$hostFirst,$hostSecond]);
        $result = $algorithm->determine($hostList);

        $this->assertEquals($hostFirst,$result);
    }
}