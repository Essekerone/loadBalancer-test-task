<?php

namespace LoadBalancer\algorithm;

use LoadBalancer\host\HostInterface;
use LoadBalancer\host\HostListInterface;

interface AlgorithmInterface
{
    public function determine(HostListInterface $hostCollection): ?HostInterface;
}