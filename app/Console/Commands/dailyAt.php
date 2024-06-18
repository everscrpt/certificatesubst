<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class dailyAt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:sendMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Campign to every subscriber';

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
     * @return int
     */
    public function handle()
    {
        echo app(\App\Http\Controllers\Mailwizz\MailwizzController::class)->sendMail();
    }
}
