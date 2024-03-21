<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalatTimeController extends Controller
{
    // Get all locations
    public function getLocations()
    {
        $locations = DB::table('locations')->get();
        return response()->json($locations);
    }

    // Get minimum and maximum date from salat_times table
    public function getMinMaxDate()
    {
        $result = DB::table('salat_times')
            ->selectRaw('MIN(date) AS min_date, MAX(date) AS max_date')
            ->first();

        return response()->json($result);
    }

    // Get salat times for a specific date and location
    public function getSalatTime(Request $request)
    {
        $date = $request->input('date');
        $locationName = $request->input('location');

        $salatTimes = DB::table('salat_times')
            ->join('locations', 'salat_times.location_id', '=', 'locations.id')
            ->where('salat_times.date', $date)
            ->where('locations.name', $locationName)
            ->select('salat_times.*')
            ->first();

        if ($salatTimes) {
            return response()->json($salatTimes);
        } else {
            return response()->json(['error' => 'Salat times not found for the given date and location'], 404);
        }
    }

    public function getMonthlySalatTime(Request $request)
    {
        $date = $request->input('date');
        $locationName = $request->input('location');


        // Calculate the first day and last day of the month
        $firstDayOfMonth = date('Y-m-01', strtotime($date));
        $lastDayOfMonth = date('Y-m-t', strtotime($date));

        $salatTimes = DB::table('salat_times')
            ->join('locations', 'salat_times.location_id', '=', 'locations.id')
            ->where('salat_times.date', '>=', $firstDayOfMonth)
            ->where('salat_times.date', '<=', $lastDayOfMonth)
            ->where('locations.name', $locationName)
            ->select('salat_times.*')
            ->get();

        if ($salatTimes->isNotEmpty()) {
            return response()->json($salatTimes);
        } else {
            return response()->json(['error' => 'Salat times not found for the given month, year, and location'], 404);
        }
    }


    public function getRamadanDatesForYear($year)
    {
        $ramadanDates = $this->getRamadanDates($year);

        return response()->json($ramadanDates);
    }

    public function getRamadanDates($year)
    {
        $ramadanDates = DB::table('hijri_dates')
            ->whereYear('hijri_dates.date', $year)
            ->whereRaw("SUBSTRING(hijri_dates.hijri, 6, 2) = '09'") // 9th month for Ramadan
            ->select('hijri_dates.date', 'hijri_dates.hijri')
            ->get();

        $result = [];
        foreach ($ramadanDates as $date) {
            $result[] = [
                'date' => $date->date,
                'hijri_date' => $date->hijri
            ];
        }

        return $result;
    }

    public function getRamadanSalatTimesForLocation(Request $request)
    {
        $date = $request->input('date');
        $locationName = $request->input('location');

        // Extract the year from the provided date
        $year = date('Y', strtotime($date));

        $ramadanDates = $this->getRamadanDates($year);

        if (empty($ramadanDates)) {
            return response()->json(['error' => 'No Ramadan dates found for the given year'], 404);
        }

        // Retrieve Salat times for the Hijri dates and specified location
        $salatTimes = DB::table('salat_times')
            ->join('locations', 'salat_times.location_id', '=', 'locations.id')
            ->whereIn('salat_times.date', array_column($ramadanDates, 'date')) // Filter Salat times for Ramadan dates
            ->where('locations.name', $locationName)
            ->select('salat_times.*')
            ->get();

        if ($salatTimes->isEmpty()) {
            return response()->json(['error' => 'Salat times not found for the given location and Ramadan dates'], 404);
        }


        return response()->json($salatTimes);
    }
}
