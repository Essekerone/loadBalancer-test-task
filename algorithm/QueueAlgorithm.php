<?php
namespace  LoadBalancer\algorithm;
use LoadBalancer\host\HostInterface;
use LoadBalancer\host\HostListInterface;

class QueueAlgorithm implements AlgorithmInterface
{

    private int $index;

    public function __construct()
    {
        $this->index = 0;
    }

    public function determine(HostListInterface $hostList): ?HostInterface
    {
        if(isset($hostList[$this->index])){
            $result = $hostList[$this->index];
            $this->index++;
            return $result;
        }else{
            $this->index = 0;
            if(!isset($hostList[$this->index])){
                return null;
            }
            $result = $hostList[$this->index];
            $this->index++;
            return $result;
        }
    }
}