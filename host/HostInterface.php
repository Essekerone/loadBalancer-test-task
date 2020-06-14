<?php

namespace LoadBalancer\host;

use LoadBalancer\http\Request;

interface HostInterface
{
    public function getLoad(): float;

    public function handleRequest(Request $request): void;
}