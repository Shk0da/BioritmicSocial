<?php

namespace App\Http\Controllers\Socket;

use DB;
use App\Models\User;
use Ratchet\ConnectionInterface;

class MessagingSocket extends SocketController
{

    protected $clients = [];
    protected $users = [];
    protected $online_count;

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

            if ($user->getAgentInfo() === $agent) {
                $this->users[$user->id] = $from->resourceId;
            }
        }

        if (property_exists($msgObj, 'key') && property_exists($msgObj, 'body')) {

            $key = $msgObj->key;
            $from = $this->getUser($key);
            $body = json_decode($msgObj->body);

            if ($from) {
                $to = $body->to;

                if ($client = $this->users[$to]) {
                    $msg = $body->msg;
                    $this->clients[$client]->send($msg);
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
        return User::where(DB::raw('md5(CONCAT(remember_token, \''.env('APP_KEY', 0).'\'))'), $key)->first();
    }
}