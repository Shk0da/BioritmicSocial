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
        //TODO добавлять при заходе хеш-ключ в массив regid => hash, для идентификации пользователся
        // делать обратное преобразование пользака в хеш и смотреть есть ли он сейчас в массиве, если есть отправлять сабж
        // гениально сцуко!
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