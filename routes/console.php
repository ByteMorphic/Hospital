<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\CustomTaskCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// i create a command in app\Console\Commands\CustomTaskCommand.php
// now i will register this command in console.php
//
Artisan::command('app:make-expense', function () {
    $this->info('Starting daily report generation...');
    $this->call('app:make-expense');
    $this->info('Daily report generated successfully!');
})->purpose('Generate and send the daily report');
