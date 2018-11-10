<?php

require __DIR__.'/../../../vendor/autoload.php';

use Core\Application;

// Retrieve configuration
$appConfig = include __DIR__.'/../config/config.php';
Application::init($appConfig)->run();
