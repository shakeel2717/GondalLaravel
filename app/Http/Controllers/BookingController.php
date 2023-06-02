<?php

namespace App\Http\Controllers;

use App\Mail\TicketNotification;
use App\Models\Booking;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validatedData = $request->validate([
            'routes' => 'required',
            'adult_count' => 'required|integer',
            'children_count' => 'required|integer',
            'infant_count' => 'required|integer',
            'payment_gateway' => 'required|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'bags' => 'nullable|string',
            'phone_code' => 'nullable|string',
            'trip_type' => 'required|string',
            'marginAmount' => 'required|numeric',
            'pureAmount' => 'required|numeric',
            'admin_buy_price' => 'required|numeric',
            'negoAmount' => 'required|numeric',
            'receivedAmount' => 'required|numeric',
            'lastTicketingDate' => 'required',
            'ticket_status' => 'required|string',
            'uri' => 'required|string',
        ]);

        // dd($request);
        $routes = json_decode($validatedData['routes']);

        $lastTicketingDate = now()->parse($routes->lastTicketingDate)->format('Y-m-d H:i:s');


        // adding new Booking
        $booking = new Booking();
        $booking->user_id = auth()->user()->id;
        $booking->routes = $validatedData['routes'];
        $booking->payment_method = $validatedData['payment_gateway'];
        $booking->trip_type = $validatedData['trip_type'];
        $booking->pnr = $this->quickRandom(6);
        $booking->status = $validatedData['ticket_status'];
        $booking->email = $validatedData['email'];
        $booking->phone = $validatedData['phone_code'] . $validatedData['phone'];
        $booking->bags = $validatedData['bags'];
        $booking->last_ticketing_date = $lastTicketingDate;
        $booking->agent_margin = $validatedData['marginAmount'];
        $booking->amount = $validatedData['pureAmount'];
        $booking->nego = $validatedData['negoAmount'];
        $booking->received = $validatedData['receivedAmount'];
        $booking->admin_buy_price = $validatedData['admin_buy_price'];
        $booking->uri = $validatedData['uri'];
        $booking->adults = $validatedData['adult_count'];
        $booking->children = $validatedData['children_count'];
        $booking->infants = $validatedData['infant_count'];
        $booking->save();
        info("Ticket Booked");

        $thispassengerDetail = [];


        for ($i = 1; $i < $validatedData['adult_count'] + 1; $i++) {
            // adding passenger
            $passenger = new Passenger();
            $passenger->booking_id =  $booking->id;
            $passenger->type = 'adult';
            $passenger->title = $request->get('title_adult_' . $i);
            $passenger->gender = $request->get('gender_adult_' . $i);
            $passenger->firstname = $request->get('firstname_adult_' . $i);
            $passenger->lastname = $request->get('lastname_adult_' . $i);
            $passenger->nationality = $request->get('nationality_adult_' . $i);
            $passenger->dob = $request->get('dob_adult_' . $i);
            $passenger->passport = $request->get('passport_adult_' . $i);
            $passenger->passport_expiry = $request->get('passport_expiry_adult_' . $i);
            $passenger->save();
            info("Adult Added");

            $passenger;

            $thispassengerDetail[] = [
                'id' => $i,
                'dateOfBirth' => $passenger->dob,
                'name' => [
                    'firstName' => $passenger->firstname,
                    'lastName' => $passenger->lastname,
                ],
                'gender' => $passenger->gender,
                'contact' => [
                    'emailAddress' => $validatedData['email'],
                    'phones' => [
                        [
                            'deviceType' => 'MOBILE',
                            'countryCallingCode' => $validatedData['phone_code'],
                            'number' => $validatedData['phone'],
                        ],
                    ],
                ],
                'documents' => [
                    [
                        'documentType' => 'PASSPORT',
                        'birthPlace' => $request->get('nationality_adult_' . $i),
                        'issuanceLocation' => $request->get('nationality_adult_' . $i),
                        'number' => $request->get('passport_adult_' . $i),
                        'expiryDate' => $passenger->passport_expiry,
                        "issuanceCountry" => $passenger->nationality,
                        "nationality" => $passenger->nationality,
                        'holder' => true,
                    ],
                ]
            ];
            info("Live API Fetched");

            $nextPassengerId = $i;
        }

        for ($i = 1; $i < $validatedData['children_count'] + 1; $i++) {
            // adding passenger
            $passenger = new Passenger();
            $passenger->booking_id =  $booking->id;
            $passenger->type = 'children';
            $passenger->title = $request->get('title_children_' . $i);
            $passenger->gender = $request->get('gender_children_' . $i);
            $passenger->firstname = $request->get('firstname_children_' . $i);
            $passenger->lastname = $request->get('lastname_children_' . $i);
            $passenger->nationality = $request->get('nationality_children_' . $i);
            $passenger->dob = $request->get('dob_children_' . $i);
            $passenger->passport = $request->get('passport_children_' . $i);
            $passenger->passport_expiry = $request->get('passport_expiry_children_' . $i);
            $passenger->save();
            info("Children Added");

            $thispassengerDetail[] = [
                'id' => $nextPassengerId + $i,
                'dateOfBirth' => $passenger->dob,
                'name' => [
                    'firstName' => $passenger->firstname,
                    'lastName' => $passenger->lastname,
                ],
                'gender' => $passenger->gender,
                'contact' => [
                    'emailAddress' => $validatedData['email'],
                    'phones' => [
                        [
                            'deviceType' => 'MOBILE',
                            'countryCallingCode' => $validatedData['phone_code'],
                            'number' => $validatedData['phone'],
                        ],
                    ],
                ],
                'documents' => [
                    [
                        'documentType' => 'PASSPORT',
                        'birthPlace' => $request->get('nationality_adult_' . $i),
                        'issuanceLocation' => $request->get('nationality_adult_' . $i),
                        'number' => $request->get('passport_adult_' . $i),
                        "issuanceCountry" => $passenger->nationality,
                        "nationality" => $passenger->nationality,
                        'expiryDate' => $passenger->passport_expiry,
                        'holder' => true,
                    ],
                ]
            ];
            info("Live API Added");

            $nextPassengerId = $i;
        }

        for ($i = 1; $i < $validatedData['infant_count'] + 1; $i++) {
            // adding passenger
            $passenger = new Passenger();
            $passenger->booking_id =  $booking->id;
            $passenger->type = 'infant';
            $passenger->title = $request->get('title_infant_' . $i);
            $passenger->gender = $request->get('gender_infant_' . $i);
            $passenger->firstname = $request->get('firstname_infant_' . $i);
            $passenger->lastname = $request->get('lastname_infant_' . $i);
            $passenger->nationality = $request->get('nationality_infant_' . $i);
            $passenger->dob = $request->get('dob_infant_' . $i);
            $passenger->passport = $request->get('passport_infant_' . $i);
            $passenger->passport_expiry = $request->get('passport_expiry_infant_' . $i);
            $passenger->save();
            info("Infant Added");


            $thispassengerDetail[] = [
                'id' => $nextPassengerId + $i,
                'dateOfBirth' => $passenger->dob,
                'name' => [
                    'firstName' => $passenger->firstname,
                    'lastName' => $passenger->lastname,
                ],
                'gender' => $passenger->gender,
                'contact' => [
                    'emailAddress' => $validatedData['email'],
                    'phones' => [
                        [
                            'deviceType' => 'MOBILE',
                            'countryCallingCode' => $validatedData['phone_code'],
                            'number' => $validatedData['phone'],
                        ],
                    ],
                ],
                'documents' => [
                    [
                        'documentType' => 'PASSPORT',
                        'birthPlace' => $request->get('nationality_adult_' . $i),
                        'issuanceLocation' => $request->get('nationality_adult_' . $i),
                        'number' => $request->get('passport_adult_' . $i),
                        'expiryDate' => $passenger->passport_expiry,
                        'holder' => true,
                    ],
                ]
            ];
            info("Live API Added");
        }


        $url = "https://api.amadeus.com/v1/booking/flight-orders";
        $accessToken = getApi(); // access token

        info(json_encode($thispassengerDetail));

        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ];

        $data = [
            'data' => [
                'type' => 'flight-order',
                'flightOffers' => [
                    json_decode($validatedData['routes'], true)
                ],
                'travelers' => $thispassengerDetail,
                'remarks' => [
                    'general' => [
                        [
                            'subType' => 'GENERAL_MISCELLANEOUS',
                            'text' => 'ONLINE BOOKING FROM GONDAL TRAVEL',
                        ],
                    ],
                ],
                'ticketingAgreement' => [
                    'option' => 'DELAY_TO_CANCEL',
                    'delay' => '1D',
                ],
                'contacts' => [
                    [
                        'addresseeName' => [
                            'firstName' => 'NAEEM',
                            'lastName' => 'GONDAL',
                        ],
                        'companyName' => 'GUR ELEC',
                        'purpose' => 'INVOICE',
                        'phones' => [
                            [
                                'deviceType' => 'LANDLINE',
                                'countryCallingCode' => '33',
                                'number' => '771626271',
                            ],
                            [
                                'deviceType' => 'MOBILE',
                                'countryCallingCode' => '33',
                                'number' => '950379906',
                            ],
                        ],
                        'emailAddress' => 'travelgondal@gmail.com',
                        'address' => [
                            'lines' => [
                                '89 AV DU GROUPE MANOUCHIAN',
                            ],
                            'postalCode' => '94400',
                            'cityName' => 'VITRY-SUR-SEINE',
                            'countryCode' => 'FR',
                        ],
                    ],
                ],
            ],
        ];

        if (option('live_booking')) {
            info("Attempt to Live booking Start");
            // checking price before order
            if (!$this->verify_price($validatedData['routes'], $validatedData['admin_buy_price'])) {
                return redirect()->route('index')->withErrors('Price has been Changed, Please Try again');
            }
            $response = Http::withHeaders($headers)->post($url, $data);
            if (isset($response['errors'])) {
                info("Error " . $response['errors'][0]['detail']);
                $error = $response['errors'][0]['detail'];
                return back()->withErrors($error);
            }
            $liveData = $response->json();
            info(json_encode($liveData));
            $booking = Booking::find($booking->id);
            $booking->pnr = $liveData['data']['associatedRecords'][0]['reference'];
            $booking->pnr_status = 'live';
            $booking->ticket_status = 'Booked';
            $booking->pnr_track_id = $liveData['data']['id'];
            $booking->live_data = json_encode($liveData);
            $booking->save();
            info("Live API Ticket Booked");
        }

        if ($booking->email != "") {
            // send notification to this user
            Mail::to($booking->email)->send(new TicketNotification($booking, $passenger));
            info("Email Sent");
        }
        return redirect()->route('flight.booking.show', ['booking' => $booking->id]);
    }


    private function verify_price($routes, $price)
    {
        info("Attempt to Verify Price");
        // Build the request URL and headers
        $flightPricingUrl = 'https://api.amadeus.com/v1/shopping/flight-offers/pricing';
        $accessToken = getApi();
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ];

        // Prepare the request payload
        $data = [
            'data' => [
                'type' => 'flight-offers-pricing',
                'flightOffers' => [json_decode($routes)], // Replace with your flight offer data
            ],
        ];

        // Send the price verification request
        $response = Http::withHeaders($headers)->post($flightPricingUrl, $data);
        // Handle the response
        if ($response->successful()) {
            $pricingData = $response->json();
            // Process the pricing data as needed
            if ($price == $pricingData['data']['flightOffers'][0]['price']['grandTotal']) {
                info("Price is Matched" . $pricingData['data']['flightOffers'][0]['price']['grandTotal']);
                return true;
            } else {
                info("Price is Mis-Matched");
                return false;
            }
        } else {
            $error = $response->json('errors.0.detail');
            info("Error on Attempt to Verify Price");
            return false;
        }
    }


    private static function quickRandom($length = 16)
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $flightData = json_decode($booking->routes);
        return view('booking.show', compact('booking', 'flightData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }


    public function ticket($id, $hash)
    {
        $booking = Booking::findOrFail($id);
        $originalHash = md5($booking->uri);
        if ($originalHash == $hash) {
            $flightData = json_decode($booking->routes);
            return view('booking.show', compact('booking', 'flightData'));
        } else {
            abort(404);
        }
    }
}
