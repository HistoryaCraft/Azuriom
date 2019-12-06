<?php

namespace Azuriom\Console\Commands;

use Azuriom\Models\Server;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class GamePingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping the game servers to update their stats.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $servers = Server::whereIn('type', ['mc-ping', 'mc-rcon']);

        foreach ($servers as $server) {
            $data = $server->bridge()->getServerData($server);

            $server->updateData($data);
        }

        $this->info($servers->count().' servers was successfully pinged.');
    }
}