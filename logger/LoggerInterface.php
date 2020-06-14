<?php

namespace LoadBalancer\logger;

interface LoggerInterface{
    public static function saveNotExistsHostLog(\Exception $e);
    public static function saveHandleRequestLog(\Exception $e);
}