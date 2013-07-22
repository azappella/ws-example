<?php

require "vendor/autoload.php";

/*//////////////////////////////////////////////////////////////////////////////
 * Ratchet App Configuration
 *//////////////////////////////////////////////////////////////////////////////

$loop = React\EventLoop\Factory::create();
$pusher = new Ws\Pusher;

$context = new React\ZMQ\Context($loop);
$pull = $context->getSocket(ZMQ::SOCKET_PULL);
$pull->bind('tcp://127.0.0.1:5555'); // Binding to 127.0.0.1 means the only client that can connect is itself
$pull->on('message', array($pusher, 'onPost'));

// Set up our WebSocket server for clients wanting real-time updates
$webSock = new React\Socket\Server($loop);
$webSock->listen(8080, '0.0.0.0'); // Binding to 0.0.0.0 means remotes can connect
$webServer = new Ratchet\Server\IoServer(
    new Ratchet\WebSocket\WsServer(
        new Ratchet\Wamp\WampServer(
            $pusher
        )
    ),
    $webSock
);

$loop->run();