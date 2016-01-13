<?php

namespace App\Http\Controllers\Socket;

use Ratchet\ConnectionInterface;

class MessagingSocket extends SocketController
{

    protected $clients;
    protected $online_count;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
        $this->online_count = 0;
    }

    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $this->online_count++;
    }

    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        $this->online_count--;
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo $e->getMessage();
        $conn->close();
    }
}