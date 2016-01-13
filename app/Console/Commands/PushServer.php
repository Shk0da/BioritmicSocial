<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

use App\Http\Controllers\Socket\PushController as Pusher;
use React\EventLoop\Factory as ReactLoop;
use React\ZMQ\Context as ReactContext;
use React\Socket\Server as ReactServer;
use Ratchet\Wamp\WampServer;

class PushServer extends Command
{
    const PORT = 8080;
    const HOST = 'ws://localhost:' . PushServer::PORT;
    const TCP = 'tcp://127.0.0.1:8081';

    private $reRun = 5;
    protected $signature = 'push:run';
    protected $description = 'Run Push Server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $loop = ReactLoop::create();
        $pusher = new Pusher();
        $context = new ReactContext($loop);

        $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
        $pull->bind(PushServer::TCP);
        $pull->on('message', [$pusher, 'broadcast']);

        $webSock = new ReactServer($loop);
        $webSock->listen(PushServer::PORT, '0.0.0.0');
        $this->startServer($loop, $pusher, $webSock);
    }

    public function startServer($loop, $pusher, $webSock)
    {
        try {
            $this->reRun--;
            new IoServer(new HttpServer(new WsServer(new WampServer($pusher))), $webSock);
            $this->info('Run PushServer');
            $loop->run();
        } catch (\Exception $e) {
            $this->info($e->getMessage());
            if ($this->reRun > 0)
                $this->startServer($loop, $pusher, $webSock);
        }
    }
}
