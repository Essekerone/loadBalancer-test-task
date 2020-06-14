<?php

namespace LoadBalancer;

use LoadBalancer\algorithm\AlgorithmInterface;
use LoadBalancer\host\HostListInterface;
use LoadBalancer\http\Request;
use LoadBalancer\logger\LoggerInterface;

class LoadBalancer implements LoadBalancerInterface
{
    private HostListInterface $hosts;
    private AlgorithmInterface $algorithm;

    public function __construct(HostListInterface $hostsList, AlgorithmInterface $algorithm)
    {
        $this->hosts = $hostsList;
        $this->algorithm = $algorithm;
    }

    public function handleRequest(Request $request)
    {
        $host = $this->algorithm->determine($this->hosts);

        if(!is_null($host)){
            try {
                $host->handleRequest($request);
            }catch (\Exception $e){
                LoggerInterface::saveHandleRequestLog($e);
            }
        }else{
            LoggerInterface::saveNotExistsHostLog(new \Exception('Not found target host'));
        }
    }
}