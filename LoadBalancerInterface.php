<?php
namespace LoadBalancer;


use LoadBalancer\http\Request;

interface LoadBalancerInterface
{
    public function handleRequest(Request $request);
}