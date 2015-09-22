<?php
namespace local\reactchat\controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class app_controller implements ControllerProviderInterface {
    public function connect(Application $app) {
        $controllers = $app['controllers_factory'];
        $controllers->get('/', array($this, 'index_action'));
        return $controllers;
    }

    public function index_action(Application $app, Request $request) {
        $app['moodle.require_login']();
        $html = $app['twig']->render('index.twig');
        return $app['moodle.wrap_html']($html);
    }
}
