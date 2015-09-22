<?php
// Autoload and use the Silex app namespace.
$loader = require(__DIR__ . '/../../vendor/autoload.php');
$loader->addPsr4('local\\reactchat\\', __DIR__);
use local\reactchat\app;

// Create and run an instance of the app.
// We pass it the config.php URL so it can bootstrap Moodle.
$moodleconfigfilepath = dirname(dirname(__DIR__)) . '/config.php';
$app = new app($moodleconfigfilepath);
$app->run();
