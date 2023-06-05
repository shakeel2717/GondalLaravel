<?php

namespace App\Http\Livewire\admin;

use App\Mail\TicketNotification;
use App\Models\Booking;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class AllBookings extends PowerGridComponent
{
    use ActionButton;

    public $pnr;
    public $trip_type;
    public $status;
    public $ticket_status;
    public $email;
    public $phone;
    public $payment_method;
    public $last_ticketing_date;
    public $amount;
    public $agent_margin;
    public $remarks;
    public $routes;
    public $bags;
    public $nego;
    public $received;
    public $admin_buy_price;
    public $issued_from;
    public $track_price;
    public $iata;
    public $collector;


    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Booking>
     */
    public function datasource(): Builder
    {
        return Booking::query()->latest();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('user', function (Booking $model) {
                return $model->user->name;
            })

            ->addColumn('fullname', function (Booking $model) {
                $firstname = $model->passengers[0]->firstname ?? "No";
                $lastname = $model->passengers[0]->lastname ?? "No";
                return  $firstname . " " . $lastname;
            })
            ->addColumn('company', function (Booking $model) {
                $routes = json_decode($model->routes);
                return findAirlineName($routes->itineraries[0]->segments[0]->carrierCode);
            })
            ->addColumn('destination', function (Booking $model) {
                $routes = json_decode($model->routes);
                $destination = "";
                foreach ($routes->itineraries as $itinerary) {
                    foreach ($itinerary->segments as $segment) {
                        $destination .= $segment->departure->iataCode;
                        $destination .= '-';
                        $destination .= $segment->arrival->iataCode;
                        $destination .= ' ';
                    }
                }

                return $destination ?? "No";
            })
            ->addColumn('pnr')

            /** Example of custom column using a closure **/
            ->addColumn('remaing_amount', function (Booking $model) {
                return $model->agent_margin - $model->received;
            })

            ->addColumn('trip_type')
            ->addColumn('status')
            ->addColumn('payment_method')
            ->addColumn('last_ticketing_date')
            ->addColumn('remaining_time', function (Booking $model) {
                return now()->parse($model->last_ticketing_date)->diffForHumans();
            })
            ->addColumn('remaining_iata', function (Booking $model) {
                return $model->amount - $model->iata;
            })
            ->addColumn('remaining_collector', function (Booking $model) {
                return $model->nego - $model->collector;
            })
            ->addColumn('amount')
            ->addColumn('bags')
            ->addColumn('agent_margin')
            ->addColumn('remarks')
            ->addColumn('created_at_formatted', fn (Booking $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Booking $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Agent', 'user'),

            Column::make('P NAME', 'fullname')
                ->sortable()
                ->searchable(),

            Column::make('EMAIL', 'email')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputText(),

            Column::make('PHONE', 'phone')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputText(),

            Column::make('COMPANY', 'company')
                ->sortable()
                ->searchable(),


            Column::make('PNR', 'pnr')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputText(),

            Column::make('DESTINATION', 'destination')
                ->sortable()
                ->searchable(),

            Column::make('BAGS', 'bags')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputText(),

            Column::make('STATUS', 'status')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputText(),

            Column::make('TICKET STATUS', 'ticket_status')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputText(),


            Column::make('PNR STATUS', 'pnr_status')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('PAYMENT METHOD', 'payment_method')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputText(),

            Column::make('LAST TICKETING DATE', 'last_ticketing_date')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputText(),


            Column::make('REMAINING', 'remaining_time')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputText(),

            Column::make('LIVE FARE', 'admin_buy_price')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->withSum('Sum', true, false)
                ->makeInputRange(),

            Column::make('AMOUNT', 'amount')
                ->sortable()
                ->editOnClick()
                ->searchable()
                ->withSum('Sum', true, false)
                ->makeInputRange(),

            Column::make('NEGO', 'nego')
                ->sortable()
                ->editOnClick()
                ->searchable()
                ->withSum('Sum', true, false)
                ->makeInputRange(),


            Column::make('SELL PRICE', 'agent_margin')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->withSum('Sum', true, false)
                ->makeInputRange(),


            Column::make('RECEIVED', 'received')
                ->sortable()
                ->editOnClick()
                ->searchable()
                ->withSum('Sum', true, false)
                ->makeInputRange(),

            Column::make('REMAINING', 'remaing_amount')
                ->sortable()
                ->editOnClick()
                ->searchable()
                ->withSum('Sum', true, false)
                ->makeInputRange(),

            Column::make('IATA PAYMENT', 'iata')
                ->sortable()
                ->editOnClick()
                ->searchable()
                ->withSum('Sum', true, false)
                ->makeInputRange(),

            Column::make('IATA BALANCE', 'remaining_iata')
                ->sortable()
                ->editOnClick()
                ->searchable()
                ->withSum('Sum', true, false)
                ->makeInputRange(),

            Column::make('COLLECTOR PAYMENT', 'collector')
                ->sortable()
                ->editOnClick()
                ->withSum('Sum', true, false)
                ->searchable()
                ->makeInputRange(),

            Column::make('COLLECTOR BALANCE', 'remaining_collector')
                ->sortable()
                ->editOnClick()
                ->withSum('Sum', true, false)
                ->searchable()
                ->makeInputRange(),


            Column::make('ISSUED FROM', 'issued_from')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputRange(),


            Column::make('REMARKS', 'remarks')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputText(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Booking Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::make('edit', 'View Passengers')
                ->class('btn btn-primary btn-sm')
                ->route('admin.passenger.show', ['passenger' => 'id']),

            Button::make('print', 'Print Ticket')
                ->class('btn btn-primary btn-sm')
                ->route('flight.booking.show', ['booking' => 'id']),

            Button::make('reissue', 'REISSUE')
                ->class('btn btn-primary btn-sm')
                ->emit('reissue', ['id' => 'id']),

            Button::make('update', 'UPDATE TICKET')
                ->class('btn btn-primary btn-sm')
                ->emit('update', ['id' => 'id']),

            Button::make('cancel', 'CANCEL')
                ->class('btn btn-danger btn-sm')
                ->emit('cancel', ['id' => 'id']),


            Button::make('delete', 'DELETE')
                ->class('btn btn-danger btn-sm')
                ->emit('delete', ['id' => 'id']),

            Button::make('track_price', 'TRACK PRICE')
                ->class('btn btn-primary btn-sm')
                ->emit('track_price', ['id' => 'id']),


            Button::make('stop_track', 'STOP TRACK')
                ->class('btn btn-danger btn-sm')
                ->emit('stop_track', ['id' => 'id']),


            Button::make('send_ticket', 'SEND TICKET')
                ->class('btn btn-primary btn-sm')
                ->emit('send_ticket', ['id' => 'id']),

        ];
    }


    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        Booking::query()->find($id)->update([
            $field => $value,
        ]);
    }


    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'reissue',
                'track_price',
                'stop_track',
                'cancel',
                'cancelTicket',
                'update',
                'delete',
                'send_ticket',
            ]
        );
    }


    public function send_ticket($id)
    {
        $booking = Booking::find($id['id']);
        $passenger = $booking->passengers[0];

        Mail::to($booking->email)->send(new TicketNotification($booking, $passenger));
    }


    public function delete($id)
    {
        $booking = Booking::find($id['id']);
        $booking->delete();
    }


    public function reissue($id)
    {
        $method = Booking::find($id['id']);
        session(['bookingData' => $method]);
        return redirect($method->uri);
    }

    public function cancelTicket($id)
    {
        $method = Booking::find($id['id']);
        $method->ticket_status = "Cancel";
        $method->save();

        if (option('live_booking') && $method->pnr_track_id != "") {
            $orderId = $method->pnr_track_id;
            $url = "https://api.amadeus.com/v1/booking/flight-orders/{$orderId}";

            $accessToken = getApi();

            $headers = [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json'
            ];
            $response = Http::withHeaders($headers)->delete($url);
            if ($response->successful()) {
                info('successfull connection');
                $method->pnr_status = "test";
                $method->save();
                return true;
            } else {
                info("Error " . $response['errors'][0]['detail']);
                return redirect(url()->current())->withErrors('Error While Cancelling the Ticket ' . $response['errors'][0]['detail']);
            }
        }
    }

    public function cancel($id)
    {
        $method = Booking::find($id['id']);
        $this->dispatchBrowserEvent('confirm-cancel', [
            'bookingId' => $method->id,
        ]);
    }




    public function update($id)
    {
        $booking = Booking::find($id['id']);

        if (option('live_booking') && $booking->pnr_track_id != "") {
            $orderId = $booking->pnr_track_id;
            $url = "https://api.amadeus.com/v1/booking/flight-orders/{$orderId}";

            $accessToken = getApi();

            $headers = [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json'
            ];
            $response = Http::withHeaders($headers)->get($url);
            $booking->last_ticketing_date = $response['data']['flightOffers'][0]['lastTicketingDate'];
            $booking->routes = json_encode($response['data']['flightOffers'][0]);
            $booking->save();
        }
    }




    public function track_price($id)
    {
        $method = Booking::find($id['id']);
        $method->track_price = true;
        $method->save();
    }

    public function stop_track($id)
    {
        $method = Booking::find($id['id']);
        $method->track_price = false;
        $method->save();
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Booking Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
        return [

            //Hide button edit for ID 1
            Rule::button('stop_track')
                ->when(fn ($booking) => $booking->track_price == false)
                ->hide(),

            Rule::button('track_price')
                ->when(fn ($booking) => $booking->track_price == true)
                ->hide(),

            Rule::button('cancel')
                ->when(fn ($booking) => $booking->ticket_status == "Cancel")
                ->hide(),

            Rule::button('send_ticket')
                ->when(fn ($booking) => $booking->email == "")
                ->hide(),

            Rule::rows('send_ticket')
                ->when(fn ($booking) => $booking->pnr_status == "live")
                ->setAttribute('class', 'bg-2'),

            Rule::rows('send_ticket')
                ->when(fn ($booking) => $booking->ticket_status == "Cancel")
                ->setAttribute('class', 'bg-7'),
        ];
    }
}
