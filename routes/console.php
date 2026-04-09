<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('jurnal:reminder')
    ->dailyAt('12:00')
    ->timezone('Asia/Jakarta');

Schedule::command('jurnal:reminder')
    ->dailyAt('17:00')
    ->timezone('Asia/Jakarta');

Schedule::command('jurnal:reminder')
    ->dailyAt('20:00')
    ->timezone('Asia/Jakarta');