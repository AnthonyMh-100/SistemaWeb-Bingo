<?php

namespace App\Console\Commands;

use App\Models\Game;
use Date;
use DateTime;
use Illuminate\Console\Command;

class DeleteOldGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-games';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date =date('Y') . '-01-01 00:00:00';
        $date_end = new DateTime($date); 
        $deleted = Game::where('date_start', '<', $date_end)->delete();

        $this->info("$deleted registros de juegos eliminados.");
    }
}
