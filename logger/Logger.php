<?php
namespace  LoadBalancer\logger;
use LoadBalancer\logger\Exception\HandleRequestLogException;
use LoadBalancer\logger\Exception\NotExistsHostException;

class Logger implements  LoggerInterface{

    public static function saveNotExistsHostLog(\Exception $e)
    {
        // TODO: Implement saveNotExistsHostLog() method. Save log to own system and send to next systems (12 factors)
        throw new NotExistsHostException($e->getMessage(),$e->getCode());
    }

    public static function saveHandleRequestLog(\Exception $e)
    {
        // TODO: Implement saveHandleRequestLog() method. Save log to own system and send to next systems (12 factors)
        throw new HandleRequestLogException($e->getMessage(),$e->getCode());
    }
}