<?php

namespace LoadBalancer\tests;

use LoadBalancer\algorithm\AlgorithmInterface;
use LoadBalancer\host\HostInterface;
use LoadBalancer\host\HostList;
use LoadBalancer\http\Request;
use LoadBalancer\LoadBalancer;
use LoadBalancer\logger\Exception\HandleRequestLogException;
use LoadBalancer\logger\Exception\NotExistsHostException;
use LoadBalancer\logger\LoggerInterface;
use PHPUnit\Framework\TestCase;

class LoadBalancerTest extends TestCase
{
    /**
     * @var HostInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private $hostMock;
    /**
     * @var AlgorithmInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private $algorithmMock;
    /**
     * @var Request
     */
    private Request $request;

    public function setUp(): void
    {
        $this->request = new Request();
        $this->hostMock = $this->createMock(HostInterface::class);
        $this->algorithmMock = $this->createMock(AlgorithmInterface::class);
    }

    public function testHandleRequest()
    {
        $this->hostMock->expects($this->once())
            ->method('handleRequest')
            ->with($this->request);

        $hostList = new HostList([$this->hostMock]);

        $this->algorithmMock->expects($this->once())
            ->method('determine')
            ->with($hostList)
            ->willReturn($this->hostMock);

        $loadBalancer = new LoadBalancer(new HostList([$this->hostMock]), $this->algorithmMock);
        $loadBalancer->handleRequest($this->request);
    }

    public function testNotExistsHostException()
    {
        $this->expectException(NotExistsHostException::class);

        $loadBalancer = new LoadBalancer(new HostList([]),$this->algorithmMock);

        $loadBalancer->handleRequest($this->request);
    }

    public function testHandleRequestException()
    {
        $this->expectException(HandleRequestLogException::class);

        $loadBalancer = new LoadBalancer(new HostList([0=>new class {}]),$this->algorithmMock);

        $loadBalancer->handleRequest($this->request);
    }

}