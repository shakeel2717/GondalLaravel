<?php

namespace App\Http\Livewire\admin;

use App\Models\Booking;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
    public $nego;
    public $received;
    public $admin_buy_price;
    public $issued_from;


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
            Header::make()->showSearchInput(),
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
        return Booking::query();
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
                return $model->passengers[0]->firstname . " " . $model->passengers[0]->lastname;
            })
            ->addColumn('company', function (Booking $model) {
                $routes = json_decode($model->routes);
                return $routes->travelerPricings[0]->fareDetailsBySegment[0]->cabin . " (" . $routes->travelerPricings[0]->fareDetailsBySegment[0]->class . ")";
            })
            ->addColumn('pnr')

            /** Example of custom column using a closure **/
            ->addColumn('pnr_lower', function (Booking $model) {
                return strtolower(e($model->pnr));
            })

            ->addColumn('trip_type')
            ->addColumn('status')
            ->addColumn('payment_method')
            ->addColumn('last_ticketing_date')
            ->addColumn('remaining_time', function (Booking $model) {
                return now()->parse($model->last_ticketing_date)->diffForHumans();
            })
            ->addColumn('amount')
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

            Column::make('COMPANY', 'company')
                ->sortable()
                ->searchable(),


            Column::make('PNR', 'pnr')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputText(),

            Column::make('TRIP TYPE', 'trip_type')
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

            Column::make('AMOUNT', 'amount')
                ->sortable()
                ->editOnClick()
                ->searchable()
                ->makeInputRange(),

            Column::make('NEGO', 'nego')
                ->sortable()
                ->editOnClick()
                ->searchable()
                ->makeInputRange(),


            Column::make('RECEIVED', 'received')
                ->sortable()
                ->editOnClick()
                ->searchable()
                ->makeInputRange(),

            Column::make('AGENT MARGIN', 'agent_margin')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputRange(),

            Column::make('ISSUED FROM', 'issued_from')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->makeInputRange(),

            Column::make('ADMIN BUY PRICE', 'admin_buy_price')
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

            //    Button::make('destroy', 'Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('booking.destroy', ['booking' => 'id'])
            //        ->method('delete')
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
            ]
        );
    }


    public function reissue($id)
    {
        $method = Booking::find($id['id']);
        session(['bookingData' => $method]);
        return redirect($method->uri);
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

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($booking) => $booking->id === 1)
                ->hide(),
        ];
    }
    */
}
