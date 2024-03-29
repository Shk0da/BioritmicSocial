<?php

namespace App\Http\Controllers\Socket;

use App\Http\Controllers\MessageController;
use DB;
use App\Models\User;
use Ratchet\ConnectionInterface;

class MessagingSocket extends SocketController
{

    protected $clients = [];
    protected $users = [];
    protected $online_count;
    protected $statuses = ['invite', 'reinvite', 'liketo'];

    public function __construct()
    {
        $this->online_count = 0;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients[$conn->resourceId] = $conn;
        $this->online_count++;
    }

    public function onClose(ConnectionInterface $conn)
    {
        unset($this->clients[$conn->resourceId]);
        $this->online_count--;
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $msgObj = json_decode($msg);

        if (property_exists($msgObj, 'key') && property_exists($msgObj, 'agent')) {

            $key = $msgObj->key;
            $agent = $msgObj->agent;

            $user = $this->getUser($key);

            if ($user->getAgentInfo() == $agent) {
                $this->users[$user->id] = $from->resourceId;
            }
        }

        if (property_exists($msgObj, 'key') && property_exists($msgObj, 'body')) {

            $key = $msgObj->key;
            $from = $this->getUser($key);
            $body = json_decode($msgObj->body);

            if ($from) {
                $to = $body->to;
                $message = $body->message;

                if (!in_array($body->message, $this->statuses)) {
                    $message = MessageController::instance()->factoryMessage($from->id, $to, $body->message);
                }

                if (isset($this->users[$to]) && ($client = $this->users[$to]) && $message) {
                    $this->clients[$client]->send($msgObj->body);
                }

            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo $e->getMessage();
        $conn->close();
    }

    protected function getUser($key)
    {
        return User::getUserForKey($key);
    }

}
