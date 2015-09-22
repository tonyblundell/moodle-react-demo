<?php
namespace local\reactchat;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;

use local\reactchat\controllers\api_controller;
use local\reactchat\controllers\app_controller;
use local\reactchat\providers\chat_service_provider;
use local\reactchat\providers\moodle_service_provider;

class App extends Application {
    private $moodleconfigfilepath;

    public function __construct($moodleconfigfilepath) {
        parent::__construct();
        $this->register_services($moodleconfigfilepath);
        $this->mount_controllers();
    }

    private function register_services($moodleconfigfilepath) {
        $this->register(new chat_service_provider());
        $this->register(new moodle_service_provider($moodleconfigfilepath));
        $this->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__ . '/templates',
            'twig.options' => array(
                'debug' => $this['moodle.get_debug_status'](),
            )
        ));
    }

    private function mount_controllers() {
        $this->mount('/', new app_controller());
        $this->mount('/api/v0/', new api_controller());
    }
}
