<?php
namespace local\reactchat\providers;

use Silex\Application;
use Silex\ServiceProviderInterface;

class chat_service_provider implements ServiceProviderInterface {
    private static $limit = 100;

    public function register(Application $app) {
        $app['chat.get_messages'] = $app->protect(function($since = 0) use ($app) {
            $sql = "SELECT m.*, u.firstname || ' ' || u.lastname AS author";
            $sql = "$sql, TIMESTAMP WITH TIME ZONE 'epoch' + m.time * INTERVAL '1 second' AS timepretty";
            $sql = "$sql FROM {local_reactchat_message} m INNER JOIN {user} u ON u.id = m.userid";
            $params = array();
            if ($since) {
                $sql = "$sql WHERE time > ?";
                $params[] = $since;
            }
            $sql = "$sql ORDER BY time DESC";
            $db = $app['moodle.get_db']();
            $records = $db->get_records_sql($sql, $params, 0, $this::$limit);
            return array_values($records);
        });

        $app['chat.add_message'] = $app->protect(function($body) use ($app) {
            $user =  $app['moodle.get_user']();
            if (!$user->id) {
                return false;
            }
            $record = new \stdClass();
            $record->userid = $user->id;
            $record->body = $body;
            $record->time = time();
            $db = $app['moodle.get_db']();
            return $db->insert_record('local_reactchat_message', $record);
        });
    }

    public function boot(Application $app) {
    }
}
