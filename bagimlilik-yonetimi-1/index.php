<?php

use Katzgrau\KLogger\Logger;

require_once 'vendor/autoload.php';

$logger = new Logger(__DIR__."/logs");
$logger->info("Info example");

$errorInfo = array(
    'code' => 404,
    'message' => "Not Found"
);
$logger->error("Error example", $errorInfo);