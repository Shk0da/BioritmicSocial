<?php

namespace App\Http\Controllers\Socket;

use App\Http\Controllers\Controller;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class SocketController extends Controller implements MessageComponentInterface
{

    function onOpen(ConnectionInterface $conn) {}

    function onClose(ConnectionInterface $conn) {}

    function onMessage(ConnectionInterface $from, $msg) {}

    function onError(ConnectionInterface $conn, \Exception $e) {}

}