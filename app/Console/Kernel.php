<?php

namespace App\Console;

use App\Model\Setting;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $settings = Setting::select('value')->where(['key' => 'mailwizz_setting'])->first();
        $data = json_decode($settings->value);

        $logPath = storage_path('app').DIRECTORY_SEPARATOR.'mailwizz.log';

        if ($data->status == 1) {
            $schedule->command('daily:sendMail')
                ->weekdays()
                ->dailyAt($data->time)
                ->appendOutputTo($logPath)
                ->timezone('America/Toronto')
                ->emailOutputTo('rajibdeb.slg@gmail.com');
        }

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
