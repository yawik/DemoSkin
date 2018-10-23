<?php

require __DIR__.'/../../../vendor/autoload.php';

use Zend\Mvc\Application;

chdir(dirname(__DIR__.'/../../../'));
// Retrieve configuration
$appConfig = include __DIR__.'/../../config/config.php';

// Run the application!
Application::init($appConfig)->run();
