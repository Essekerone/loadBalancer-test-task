<?php

namespace LoadBalancer\tests\host;

use LoadBalancer\host\Host;
use LoadBalancer\host\HostList;
use PHPUnit\Framework\TestCase;

class HostListTest extends TestCase
{
    /**
     * @var Host
     */
    private Host $host;

    public function setUp(): void
    {
        $this->host = new Host("HostExample", 0.1);
    }

    public function testOffsetSet()
    {
        $hostList = new HostList();
        $hostList->offsetSet(0, $this->host);
        $this->assertEquals($hostList[0], $this->host);
    }

    public function testOffsetGet()
    {
        $hostList = new HostList([$this->host]);
        $testHost = $hostList->offsetGet(0);
        $this->assertEquals($testHost, $this->host);
    }
}