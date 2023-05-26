<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class FlightSearchController extends Controller
{
    private $ApiUrl;

    public function getApi()
    {
        $this->ApiUrl = 'https://test.api.amadeus.com';
        $url = $this->ApiUrl . '/v1/security/oauth2/token';
        $auth_data = [
            'client_id' => 'oVK2arWLniDTWJPrYyG9uDT08C7JVfbZ',
            'client_secret' => 'nlAFFigrRAz90btR',
            'grant_type' => 'client_credentials'
        ];

        try {
            $response = Http::asForm()->post($url, $auth_data);
            $responseBody = $response->json();
            return $responseBody['access_token'];
        } catch (Exception $e) {
            return "Error";
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function oneway($origin, $destination, $trip_type, $flight_type, $cdeparture, $adult, $children, $infant)
    {
        $access_token = $this->getApi();
        $flight = $this->ApiUrl . '/v2/shopping/flight-offers';
        $orgDate = $cdeparture; //departing date
        $travel_data = [
            'originLocationCode' => strtoupper($origin),
            'destinationLocationCode' => strtoupper($destination),
            'departureDate' => date('Y-m-d', strtotime($orgDate)),
            'adults' => $adult,
            'children' => $children,
            'infants' => $infant,
            'travelClass' => strtoupper($flight_type),
        ];
        $allFlights = Cache::remember('allFlights', 60 * 60 * 60, function () use ($travel_data, $flight, $access_token) {
            $fields = http_build_query($travel_data);
            $url = $flight . '?' . $fields;
            $headers = array('Authorization' => 'Bearer ' . $access_token);
            $response = Http::withHeaders($headers)->get($url);
            return collect($response->json())['data'];
        });

        // dd($allFlights[0]['travelerPricings']);

        $data['from'] = $origin;
        $data['to'] = $destination;
        $data['class'] = strtoupper($flight_type);
        $data['trip_type'] = $trip_type;
        $data['departure'] = $cdeparture;
        $data['adult'] = $adult;
        $data['children'] = $children;
        $data['infant'] = $infant;
        return view('flight.search.oneway', compact('allFlights', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
