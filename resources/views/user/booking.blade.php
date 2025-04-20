@extends('user.dashboard') @section('content')
<section class="space-y-5 mb-2 text-sm lg:pr-1">
    <select
        class="m-2 rounded-sm bg-slate-100 outline-1 outline-blue-400 text-blue-800 px-3 py-1 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75"
    >
        <option value="expired">
            <span>
                Expired
            </span>
        </option>
        <option value="all">
            <span>
                All
            </span>
        </option>
    </select>
    <livewire:user-booking />
</section>
@endsection
