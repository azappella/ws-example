Websocket Example in PHP using Ratchet
======================================

This is a small example (<http://socketo.me/docs/push>) of how to use Ratchet
to do push/pull in a web app with Slim.  

Dependencies
------------
		* Ratchet
		* ZeroMQ (see below)
		* Slim

Usage
----- 

	1. Install dependencies
	
			$ composer install

	2. Run the ws server

			$ php bin/push-server.php

	3. Point a browser tab at the app (e.g. http://localhost/ws-example)
	4. Point a second tab at the same address and open your js console
	5. Post something in the first tab and check the result in the second tab. 

Installing ZeroMQ
-----------------

    1. Install ZeroMQ <http://www.zeromq.org/area:download>
    2. Install the PHP bindings <http://www.zeromq.org/bindings:php>
    3. On Windows: 
       - Copy libzmq.dll into your php directory (e.g. C:\wamp\bin\php\php5.3.8\)
       - Copy the appropriate version of php_zmq.dll to your php extension directory 
       (e.g. C:\wamp\bin\php\php5.3.8\ext)

Some useful links 
-----------------

Ratchet

    * http://socketo.me/
    * http://socketo.me/docs/push (push/pull example)

ZeroMQ

    * http://www.zeromq.org/area:download
    * http://www.zeromq.org/bindings:php
    * http://zguide.zeromq.org/page:all
    * http://stackoverflow.com/questions/6742773/zeromq-php-extension-for-windows
 
JS libraries

    * https://github.com/cujojs/when
    * http://autobahn.ws/

WAMP  (Web Socket Messaging Protocal Specification)

     * http://wamp.ws/

Get ZeroMQ Version in PHP
--------------------------

From http://zguide.zeromq.org/php:zversion

	<?php
	/* Report 0MQ version
	*
	* @author Ian Barber <ian(dot)barber(at)gmail(dot)com>
	*/

	if (class_exists("ZMQ") && defined("ZMQ::LIBZMQ_VER")) {
	echo ZMQ::LIBZMQ_VER, PHP_EOL;
	}
