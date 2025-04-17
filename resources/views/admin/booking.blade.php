@extends('admin.dashboard') @section('content')
<section class="space-y-5 mb-2 text-sm lg:pr-1">
    @php
        $status = in_array(request()->route('status'), ['pending', 'success', 'cancel', 'expired']) 
                  ? request()->route('status') 
                  : 'all';
    @endphp
    <livewire:admin-booking-table :status="$status" />
</section>
@endsection
