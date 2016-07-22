<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\Http\Controllers\Socket\MessagingSocket;

class MessagingServer extends Command
{

    private static $port;
    private static $host;
    private static $url;
    protected $signature = 'messaging:run';
    protected $description = 'Run MessagingServer';

    public function __construct()
    {
        parent::__construct();

        static::$port = static::getPort();
        static::$url = static::getUrl();
        static::$host = static::getHost();
    }

    public function handle()
    {
        try {
            $msgSocket = new MessagingSocket();
            $wsServer = new WsServer($msgSocket);
            $httpServer = new HttpServer($wsServer);
            $server = IoServer::factory($httpServer, static::$port);

            $this->info('Start MessagingServer');
            $server->run();

        } catch (\Exception $exception) {
            $this->info($exception);
        }
    }

    public static function getUrl()
    {
        return env('MESSAGE_URL', 'localhost');
    }

    public static function getPort()
    {
        return env('MESSAGE_PORT', '8080');
    }

    public static function getHost()
    {
        return 'ws://' . static::getUrl() . ':' . static::getPort();
    }
}
