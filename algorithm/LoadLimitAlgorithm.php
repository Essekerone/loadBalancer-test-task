<?php

namespace LoadBalancer\algorithm;

use LoadBalancer\host\HostInterface;
use LoadBalancer\host\HostListInterface;

class LoadLimitAlgorithm implements AlgorithmInterface
{

    private ?HostInterface $resultHost;
    private float $loadLimit;

    public function __construct()
    {
        include_once 'config/config.php';
        $this->loadLimit = $config['load_limit'];
        $this->resultHost = null;
    }

    public function determine(HostListInterface $hostList): ?HostInterface
    {
        foreach ($hostList as $host) {
            if ($host->getLoad() < $this->loadLimit) {
                return $host;
            }

            if (is_null($this->resultHost) || $host->getLoad() < $this->resultHost->getLoad()) {
                $this->resultHost = $host;
            }
        }
        return $this->resultHost;
    }
}