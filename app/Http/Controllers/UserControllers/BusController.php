<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class BusController extends Controller
{
    public function ui_search()
    {
        $cities = [
            ['name' => 'Delhi', 'code' => 'DEL'],
            ['name' => 'Mumbai', 'code' => 'BOM'],
            ['name' => 'Bangalore', 'code' => 'BLR'],
            ['name' => 'Chennai', 'code' => 'MAA'],
            ['name' => 'Kolkata', 'code' => 'CCU'],
            ['name' => 'Hyderabad', 'code' => 'HYD'],
            ['name' => 'Pune', 'code' => 'PNQ'],
            ['name' => 'Goa', 'code' => 'GOI']
        ];

        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        return view('user.bus.search', [
            'cities' => $cities,
            'today' => $today,
            'tomorrow' => $tomorrow
        ]);
    }

    public function web_search(Request $request)
    {
        $validated = $request->validate([
            'from' => 'required|string|max:100',
            'to' => 'required|string|max:100|different:from',
            'date' => 'required|date|after_or_equal:today',
        ]);

        // In a real application, you would call a bus API or query your database here
        // For now, we'll simulate some sample data
        $buses = $this->getSampleBuses($validated);

        return view('user.bus.results', [
            'buses' => $buses,
            'searchParams' => $validated,
            'totalBuses' => count($buses)
        ]);
    }

    private function getSampleBuses($params)
    {
        // This is sample data - replace with actual API/database call
        $busTypes = ['AC Sleeper', 'Non-AC Sleeper', 'AC Seater', 'Non-AC Seater'];
        $operators = [
            'SRS Travels', 'KPN Travels', 'Orange Tours', 'Parveen Travels',
            'Rajadhani', 'VRL Travels', 'Sugama Tours', 'Kallada Travels'
        ];

        $buses = [];
        $departureTimes = ['20:00', '21:00', '22:00', '23:00', '00:30', '01:30', '03:00'];
        $durations = ['6h 30m', '7h 15m', '8h', '9h 30m', '10h 15m'];
        
        for ($i = 0; $i < 10; $i++) {
            $baseFare = rand(800, 2500);
            $availableSeats = rand(5, 40);
            
            $buses[] = [
                'id' => 'BUS' . (1000 + $i),
                'operator' => $operators[array_rand($operators)],
                'type' => $busTypes[array_rand($busTypes)],
                'departure_time' => $departureTimes[array_rand($departureTimes)],
                'arrival_time' => $departureTimes[array_rand($departureTimes)],
                'duration' => $durations[array_rand($durations)],
                'fare' => $baseFare,
                'available_seats' => $availableSeats,
                'rating' => number_format(rand(30, 50) / 10, 1), // 3.0 to 5.0
                'amenities' => $this->getRandomAmenities(),
                'boarding_points' => $this->getBoardingPoints(),
                'dropping_points' => $this->getDroppingPoints()
            ];
        }

        // Sort by departure time
        usort($buses, function($a, $b) {
            return strtotime($a['departure_time']) - strtotime($b['departure_time']);
        });

        return $buses;
    }

    private function getRandomAmenities()
    {
        $allAmenities = [
            'AC', 'Charging Point', 'Water Bottle', 'Blanket', 'Wifi',
            'TV', 'Reading Light', 'Pillow', 'Track My Bus', 'Live Tracking',
            'Emergency Contact Number', 'Sleeper', 'Semi-Sleeper', 'Push Back Seats'
        ];
        
        shuffle($allAmenities);
        return array_slice($allAmenities, 0, rand(3, 8));
    }

    private function getBoardingPoints()
    {
        $points = [
            ['name' => 'City Center', 'time' => '20:00'],
            ['name' => 'Airport', 'time' => '20:30'],
            ['name' => 'Railway Station', 'time' => '21:00']
        ];
        
        return array_slice($points, 0, rand(1, 3));
    }

    private function getDroppingPoints()
    {
        $points = [
            ['name' => 'City Center', 'time' => '04:30'],
            ['name' => 'Bus Stand', 'time' => '05:00'],
            ['name' => 'Railway Station', 'time' => '05:30']
        ];
        
        return array_slice($points, 0, rand(1, 3));
    }
}
