<?php

namespace Awcodes\RicherEditor\Commands;

use Illuminate\Console\Command;

class RicherEditorCommand extends Command
{
    public $signature = 'richer-editor';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
