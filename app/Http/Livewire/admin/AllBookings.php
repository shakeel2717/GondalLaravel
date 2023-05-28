<?php

namespace App\Http\Livewire\admin;

use App\Models\Booking;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class AllBookings extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

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
        return [
            "User" => [
                'name'
            ]
        ];
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
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('user', function (Booking $model) {
                return $model->user->name;
            })
            ->addColumn('pnr')

            /** Example of custom column using a closure **/
            ->addColumn('pnr_lower', fn (Booking $model) => strtolower(e($model->pnr)))

            ->addColumn('trip_type')
            ->addColumn('status')
            ->addColumn('payment_method')
            ->addColumn('last_ticketing_date')
            ->addColumn('amount')
            ->addColumn('agent_margin')
            ->addColumn('remarks')
            ->addColumn('routes')
            ->addColumn('created_at_formatted', fn (Booking $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('PNR', 'pnr')
                ->sortable()
                ->searchable(),

            Column::make('Trip type', 'trip_type')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Payment method', 'payment_method')
                ->sortable()
                ->searchable(),

            Column::make('Last ticketing date', 'last_ticketing_date')
                ->sortable()
                ->searchable(),

            Column::make('Amount', 'amount')
                ->sortable()
                ->searchable(),

            Column::make('Agent margin', 'agent_margin')
                ->sortable()
                ->searchable(),

            Column::make('Remarks', 'remarks')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('pnr')->operators(['contains']),
            Filter::inputText('trip_type')->operators(['contains']),
            Filter::inputText('status')->operators(['contains']),
            Filter::inputText('payment_method')->operators(['contains']),
            Filter::inputText('last_ticketing_date')->operators(['contains']),
            Filter::inputText('agent_margin')->operators(['contains']),
            Filter::inputText('remarks')->operators(['contains']),
            Filter::datetimepicker('created_at'),
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
            Button::make('edit', 'Edit')
                ->class('btn btn-primary')
                ->target("")
                ->route('admin.booking.edit', ['booking' => 'id']),

            //    Button::make('destroy', 'Delete')
            //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //        ->route('booking.destroy', function(\App\Models\Booking $model) {
            //             return $model->id;
            //        })
            //        ->method('delete')
        ];
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
