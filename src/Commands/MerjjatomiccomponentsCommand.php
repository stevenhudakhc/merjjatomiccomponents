<?php

namespace Stevenhudakhc\Merjjatomiccomponents\Commands;

use Illuminate\Console\Command;

class MerjjatomiccomponentsCommand extends Command
{
    public $signature = 'merjjatomiccomponents';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
