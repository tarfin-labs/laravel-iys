<?php

namespace TarfinLabs\Iys\Commands;

use Illuminate\Console\Command;

class IysCommand extends Command
{
    public $signature = 'laravel-iys';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
