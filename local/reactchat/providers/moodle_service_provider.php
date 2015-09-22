<?php
namespace local\reactchat\providers;

use Silex\Application;
use Silex\ServiceProviderInterface;

class moodle_service_provider implements ServiceProviderInterface {
    public function __construct($configfilepath) {
        $this->configfilepath = $configfilepath;
    }

    public function register(Application $app) {
        require_once($this->configfilepath);

        $app['moodle.get_debug_status'] = $app->protect(function() use ($app) {
            return debugging('', DEBUG_MINIMAL);
        });

        $app['moodle.get_db'] = $app->protect(function() use ($app) {
            global $DB;
            return $DB;
        });

        $app['moodle.get_user'] = $app->protect(function() use ($app) {
            global $USER;
            return get_complete_user_data('id', $USER->id);
        });

        $app['moodle.wrap_html'] = $app->protect(function($html) use ($app) {
            global $PAGE, $OUTPUT;
            $PAGE->set_context(\context_system::instance());
            $PAGE->set_pagelayout('standard');
            $PAGE->set_url(me());
            $wrapped = $OUTPUT->header();
            $wrapped .= $html;
            $wrapped .= $OUTPUT->footer();
            return $wrapped;
        });

        $app['moodle.require_login'] = $app->protect(function() use ($app) {
            require_login();
        });
    }

    public function boot(Application $app) {
    }
}
