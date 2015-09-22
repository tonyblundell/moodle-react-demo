<?php
namespace local\reactchat\controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class api_controller implements ControllerProviderInterface {
    public function connect(Application $app) {
        $controllers = $app['controllers_factory'];
        $controllers->get('/messages', array($this, 'get_messages_action'));
        $controllers->post('/messages', array($this, 'add_message_action'));
        return $controllers;
    }

    public function get_messages_action(Application $app, Request $request) {
        $messages = $app['chat.get_messages']();
        return new JsonResponse($messages);
    }

    public function add_message_action(Application $app, Request $request) {
        $body = $request->get('body');
        $messageid = $app['chat.add_message']($body);
        $success = $messageid > 0;
        return new JsonResponse($success);
    }
}
