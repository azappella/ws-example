<?php 

require "../vendor/autoload.php";

/*//////////////////////////////////////////////////////////////////////////////
 * Slim App Configuration
 *//////////////////////////////////////////////////////////////////////////////

$app = new \Slim\Slim(array(
    'debug' => true,
    'templates.path' => '../app/views',
));

$slim = \Slim\Slim::getInstance();
define('BASE_URL', $slim->request()->getUrl() . $slim->request()->getRootUri() . '/');


// You need to set the base url manually FIRST before you can get it
$app->hook('slim.before', function () use ($app) {
    $app->view()->appendData(array(
        'baseUrl' => $app->request()->getUrl() . $app->request()->getRootUri() . '/')
    );
});


/*//////////////////////////////////////////////////////////////////////////////
 * Routes
 *//////////////////////////////////////////////////////////////////////////////

$app->get('/', function() use ($app) {
    $app->render('index.php');
});

$app->post('/', function() use ($app) {
    $post = $app->request()->post();
    $context = new ZMQContext();
    $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'pusher');
    $socket->connect("tcp://127.0.0.1:5555");
    $socket->send(json_encode($post));
});

$app->run();
