<?php

namespace LoadBalancer\host;


use LoadBalancer\http\Request;

class Host implements HostInterface
{

    private string $name;
    private float $load;

    public function __construct($name, $load = 0)
    {
        $this->name = $name;
        $this->load = $load;
    }

    public function getLoad(): float
    {
        return $this->load;
    }

    public function handleRequest(Request $request): void
    {
        $this->load += 0.1;

        echo "Request send to  " . $this->name . " Current load:" . $this->load . "\n";
    }
}