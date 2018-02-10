<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class WebSocketTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:test';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $preserve = "";
//        $server = new swoole_websocket_server("127.0.0.1", 9501);
        $server = new \swoole_websocket_server("0.0.0.0", 9510);

        $server->on('open', function (swoole_websocket_server $server, $request) {
            echo "server: handshake success with fd{$request->fd}\n";
        });

        $server->on('message', function (swoole_websocket_server $server, $frame) use (&$preserve) {
            try {
                $data = json_decode($frame->data);

                if ($data->server_client === true) {
                    $preserve = $frame->fd;
                } else {
                    if ($preserve !== "") {
                        $server->push($preserve, "This message is from swoole websocket server.");
                        echo "我向主　发了一条信息";
                    } else {
                        $server->push($frame->fd, "This message is from swoole websocket server.");
                        echo "我向主　发了一条信息";
                    }
                };
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
//            echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        });

        $server->on('close', function ($ser, $fd) {
            echo "client {$fd} closed\n";
        });

        $server->start();
    }
}
