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

        $result = DB::select('SELECT MIN(date) AS min_date, MAX(date) AS max_date FROM salat_times');

        $minDate = $result[0]->min_date;
        $maxDate = $result[0]->max_date;

        $response = [
            'min_date' => $minDate,
            'max_date' => $maxDate,
        ];

        return response()->json($response);
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
}
