<?php

namespace LoadBalancer\host;

use Exception;
use Traversable;

class HostList implements HostListInterface
{
    private array $hosts;

    public function __construct(array $hosts = [])
    {
        $this->hosts = $hosts;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return isset($this->hosts[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return isset($this->hosts[$offset]) ? $this->hosts[$offset] : null;
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        if (is_int($offset) && $value instanceof Host && ($offset == 0 || isset($this->hosts[$offset - 1]))) {
            $this->hosts[$offset] = $value;
        } else {
            throw new \BadMethodCallException('Bad parameters for this operation');
        }
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        if (is_int($offset) && isset($this->hosts[$offset - 1]) && !isset($this->hosts[$offset + 1])) {
            unset($this->hosts[$offset]);
        } else {
            throw new \BadMethodCallException('Bad parameters for this operation');
        }
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->hosts);
    }
}