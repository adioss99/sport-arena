<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use RealRashid\SweetAlert\Facades\Alert;

final class AdminBookingTable extends PowerGridComponent
{
    public string $tableName = 'admin-booking-table-t2wiq1-table';

    public string $status;

    public function boot(): void
    {
        config(['livewire-powergrid.filter' => 'outside']);
    }
    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput()
                ->showToggleColumns(),

            PowerGrid::footer()
                ->showPerPage(10)
                ->showRecordCount(),

            PowerGrid::detail()
                ->view('components.book-detail')
                ->showCollapseIcon(),
        ];
    }

    public function query(): Builder
    {
        $owner =  Auth::user()->location->id;
        $query = Booking::query()
            ->join('users', fn($join) => $join->on('bookings.user_id', '=', 'users.id'))
            ->with([
                'bookingFields:id,field_name,field_price,booking_id',
                'bookingFields.bookingTimes:id,booking_field_id,schedule_pivot_id',
                'bookingFields.bookingTimes.schedulePivot' => fn($q) => $q->select(
                    'schedule_pivots.id as pivot_id',
                    'schedule_id',
                    'start_time',
                    'end_time'
                )
            ])
            ->select('bookings.*', 'users.name as user_name')
            ->where('location_id', $owner);

        $today = Carbon::now()->format('Y-m-d');
        if ($this->status === 'expired') {
            $query->whereDate('boking_date', '<', $today);
        } elseif ($this->status !== 'all' && $this->status !== 'expired') {
            $query->whereDate('boking_date', '>=', $today);
            $query->where('status', $this->status);
        } else {
            $query->whereDate('boking_date', '>=', $today);
        }

        return $query;
    }

    public function datasource()
    {
        $query = $this->query();

        return $query;
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('boking_date_formatted', fn(Booking $model) => Carbon::parse($model->boking_date)->format('d/m/Y'))
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
            ->add('user_name')
            ->add('booking_code')
            ->add('created_at_formatted', fn(Booking $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i'))
            ->add('updated_at_formatted', fn(Booking $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Booking code', 'booking_code')
                ->sortable()
                ->searchable(),

            Column::make('Boking date', 'boking_date_formatted', 'boking_date')
                ->sortable()
                ->searchable(),

            Column::make('hours', 'total_hours')
                ->sortable()
                ->searchable(),

            Column::make('Total price', 'total_price')
                ->sortable()
                ->searchable(),

            Column::make('User id', 'user_name', 'users.name')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status_formatted', 'status')
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
    public function actions(Booking $row): array
    {
        $btn = [

            Button::add('success')
                ->slot('Success')
                ->class('bg-green-400 text-white p-1 py-0.5 hover:bg-green-300 rounded-md')
                ->dispatch('clickToEdit', ['status' => 'success', 'id' => $row->id]),

            Button::add('cancel')
                ->slot('Cancel')
                ->class('bg-red-400 text-white p-1 py-0.5 hover:bg-red-300 rounded-md ')
                ->dispatch('clickToEdit', ['status' => 'cancel', 'id' => $row->id]),

            Button::add('pending')
                ->slot('Pending')
                ->class('bg-blue-400 text-white p-1 py-0.5 hover:bg-blue-300 rounded-md')
                ->dispatch('clickToEdit', ['status' => 'pending', 'id' => $row->id]),

            Button::add('detail')
                ->slot('Detail')
                ->class('outline-1 outline-yellow-500 text-yellow-500 p-1 py-0.5 hover:bg-yellow-300 rounded-md')
                ->toggleDetail($row->id),

        ];
        return $btn;
    }
    #[On('clickToEdit')]
    public function clickToEdit(string $status, int $id): void
    {
        $val = Validator::make(['status' => $status], [
            'status' => 'required|in:success,cancel,pending',
        ]);
        $data = Booking::where('id', $id)->first();
        if ($data && $data->status !== $status && $val->passes() && $this->status !== 'expired' && $data->status !== 'cancel') {
            $data->update(['status' => $status]);
        }
    }

    public function actionRules($row): array
    {

        return [
            Rule::button('pending')
                ->when(fn($row) => $row->status === 'cancel' || $row->status == 'pending' || $this->status == 'expired')
                ->hide(),

            Rule::button('cancel')
                ->when(fn($row) => $row->status == 'cancel'  || $this->status == 'expired')
                ->hide(),

            Rule::button('success')
                ->when(fn($row) => $row->status === 'cancel' || $row->status == 'success' || $this->status == 'expired')
                ->hide(),
        ];
    }
}
