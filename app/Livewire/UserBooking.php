<?php

namespace App\Livewire;

use App\Models\Booking;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class UserBooking extends PowerGridComponent
{
    public string $tableName = 'user-booking-vle6jv-table';
    public string $status = 'all';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),

            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),

            PowerGrid::detail()
                ->view('components.book-detail')
                ->showCollapseIcon(),
        ];
    }

    public function datasource(): Builder
    {
        $query =  Booking::query()
            ->where('user_id', auth()->user()->id)
            ->with([
                'bookingFields:id,field_name,field_price,booking_id',
                'bookingFields.bookingTimes:id,booking_field_id,schedule_pivot_id',
                'bookingFields.bookingTimes.schedulePivot' => fn($q) => $q->select(
                    'schedule_pivots.id as pivot_id',
                    'schedule_id',
                    'start_time',
                    'end_time'
                )
            ]);

        $query = ($this->status == 'all') ? $query->whereDate('boking_date', '>=', Carbon::now()->format('Y-m-d')) : $query->whereDate('boking_date', '<=', Carbon::now()->format('Y-m-d'))->where('status', $this->status);

        return $query;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('boking_date_formatted', fn(Booking $model) => Carbon::parse($model->boking_date)->format('d-m-Y'))
            ->add('total_hours')
            ->add('total_price', fn($book) => Blade::render("@currency($book->total_price)"))
            ->add('status_formatted', function ($book) {
                if ($book->status == 'pending') {
                    return Blade::render("<span class='text-yellow-500 bg-yellow-50'>{$book->status}</span>");
                } elseif ($book->status == 'success') {
                    return Blade::render("<span class='text-green-500 bg-green-50'>{$book->status}</span>");
                }
                return Blade::render("<span class='text-red-500 bg-red-50'>{$book->status}</span>");
            })
            ->add('location_name')
            ->add('booking_code')
            ->add('created_at_formatted', fn(Booking $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i'))
            ->add('updated_at_formatted', fn(Booking $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i'));
    }

    public function columns(): array
    {
        return [
            Column::make('Booking code', 'booking_code')
                ->sortable()
                ->searchable(),

            Column::make('Boking date', 'boking_date_formatted', 'boking_date')
                ->sortable(),

            Column::make('Total hours', 'total_hours')
                ->sortable()
                ->searchable(),

            Column::make('Total price', 'total_price')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status_formatted', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Location name', 'location_name')
                ->sortable()
                ->searchable(),

            Column::action('Action'),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Updated at', 'updated_at_formatted', 'updated_at')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Booking $row): array
    {
        return [
            Button::add('pay')
                ->slot('Pay')
                ->class('outline-1 outline-blue-500 text-blue-500 px-2 py-0.5 hover:bg-blue-500 hover:text-white rounded-md')
                ->toggleDetail($row->id),

            Button::add('detail')
                ->slot('Detail')
                ->class('outline-1 outline-yellow-500 text-yellow-500 p-1 py-0.5 hover:bg-yellow-300 hover:text-white rounded-md')
                ->toggleDetail($row->id),
        ];
    }

    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('pay')
                ->when(fn($row) => $row->status != 'pending')
                ->hide(),
        ];
    }
        
}
