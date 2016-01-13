<?php

namespace App\Http\Controllers\Socket;

use App\Console\Commands\PushServer;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;
use ZMQContext;

class PushController extends SocketController implements WampServerInterface
{

    protected $subscribed = [];
    protected $clients;
    protected $online_count;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
        $this->online_count = 0;
    }

    static function sentDataIoServer(array $data)
    {
        $data = json_encode($data);
        $context = new ZMQContext();
        $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'pusher');
        $socket->connect(PushServer::TCP);
        $socket->send($data);
    }

    public function broadcast($data)
    {
        $dataToSend = json_decode($data ,true);
        $subscribed = $this->getSubscribed();

        if (isset($subscribed[$dataToSend['topic_id']])) {
            $topic = $subscribed[$dataToSend['topic_id']];
            $topic->broadcast($dataToSend);
        }
    }

    public function getSubscribed()
    {
        return $this->subscribed;
    }

    public function addSubscribed($topic)
    {
        $this->subscribed[$topic->getId()] = $topic ;
    }

    function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        $conn->callError($id, $topic, 'Ups.. =)')->close();
    }

    function onSubscribe(ConnectionInterface $conn, $topic)
    {
        $this->addSubscribed($topic);
    }

    function onUnSubscribe(ConnectionInterface $conn, $topic)
    {

    }

    function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        $conn->close();
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

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo $e->getMessage();
        $conn->close();
    }

    public static function __callStatic($name, $arguments)
    {

    }

    function __call($name, $arguments)
    {

    }
}