<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpSpec\Exception\Exception;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\Http\Controllers\Socket\MessagingSocket;

class MessagingServer extends Command
{
    const PORT = 8080;
    const URL = 'bioritmic.herokuapp.com';
    const HOST = 'ws://' . MessagingServer::URL . ':' . MessagingServer::PORT;
    protected $signature = 'messaging:run';
    protected $description = 'Run MessagingServer';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $msgSocket = new MessagingSocket();
            $wsServer = new WsServer($msgSocket);
            $httpServer = new HttpServer($wsServer);
            $server = IoServer::factory($httpServer, MessagingServer::PORT);

            $this->info('Start MessagingServer');
            $server->run();

        } catch (Exception $exception) {
            $this->info($exception);
        }
    }
}
