<?php

namespace App\Http\Livewire\agent;

use App\Mail\TicketNotification;
use App\Models\Booking;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class AllBooking extends PowerGridComponent
{
    use ActionButton;

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
        return Booking::query()->where('user_id', auth()->user()->id)->latest();
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
                ->makeInputText(),

            Column::make('PHONE', 'phone')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('COMPANY', 'company')
                ->sortable()
                ->searchable(),


            Column::make('PNR', 'pnr')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('DESTINATION', 'destination')
                ->sortable()
                ->searchable(),

            Column::make('BAGS', 'bags')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('STATUS', 'status')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('TICKET STATUS', 'ticket_status')
                ->sortable()
                ->searchable()
                ->makeInputText(),


            Column::make('PNR STATUS', 'pnr_status')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('PAYMENT METHOD', 'payment_method')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('LIVE FARE', 'admin_buy_price')
                ->sortable()
                ->searchable()
                ->withSum('Sum', true, false)
                ->makeInputRange(),

            Column::make('NEGO', 'nego')
                ->sortable()
                ->searchable()
                ->withSum('Sum', true, false)
                ->makeInputRange(),


            Column::make('SELL PRICE', 'agent_margin')
                ->sortable()
                ->searchable()
                ->withSum('Sum', true, false)
                ->makeInputRange(),


            Column::make('RECEIVED', 'received')
                ->sortable()
                ->searchable()
                ->withSum('Sum', true, false)
                ->makeInputRange(),

            Column::make('REMAINING', 'remaing_amount')
                ->sortable()
                ->searchable()
                ->withSum('Sum', true, false)
                ->makeInputRange(),

            Column::make('COLLECTOR PAYMENT', 'collector')
                ->sortable()
                ->withSum('Sum', true, false)
                ->searchable()
                ->makeInputRange(),

            Column::make('COLLECTOR BALANCE', 'remaining_collector')
                ->sortable()
                ->withSum('Sum', true, false)
                ->searchable()
                ->makeInputRange(),


            Column::make('REMARKS', 'remarks')
                ->sortable()
                ->searchable()
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


            Button::make('printInvoice', 'Print Invoice')
                ->class('btn btn-primary btn-sm')
                ->route('flight.invoice.show', ['invoice' => 'id']),

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
