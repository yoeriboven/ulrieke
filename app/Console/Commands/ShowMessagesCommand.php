<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Exports\MessagesExport;
use Maatwebsite\Excel\Facades\Excel;

class ShowMessagesCommand extends Command
{
    protected $signature = 'messages';

    public function handle(): void
    {
        Excel::store(new MessagesExport, 'messages.xlsx');
    }
}
