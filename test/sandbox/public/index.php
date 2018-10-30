<?php

require __DIR__.'/../../../vendor/autoload.php';

// Retrieve configuration
$appConfig = include __DIR__.'/../../config/config.php';

\Core\Yawik::runApplication($appConfig);
