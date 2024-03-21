<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MohamedSabil83\LaravelHijrian\Facades\Hijrian;
use Illuminate\Support\Facades\DB;

class PopulateHijriDates extends Command
{
    protected $signature = 'hijri:populate';
    protected $description = 'Populate hijri_dates table using laravel-hijrian library and salat_times table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch all records from salat_times table
        $salatTimes = DB::table('salat_times')->get();

        foreach ($salatTimes as $salatTime) {
            $gregorianDate = $salatTime->date;
            $hijriDate = Hijrian::hijri($gregorianDate);
            $hijriDateString = $hijriDate->format('Y-m-d');


            // Insert the Hijri date into hijri_dates table
            DB::table('hijri_dates')->insert([
                'date' => $gregorianDate,
                'hijri' => $hijriDateString,
            ]);
        }

        $this->info('Hijri dates populated successfully.');
    }
}
