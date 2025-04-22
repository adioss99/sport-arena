@extends('admin.dashboard')

@section('content')
<section class="overflow-hidden w-full overflow-x-auto rounded-sm ">
    <div class="overflow-hidden grid gap-2 md:gap-4 grid-cols-2 md:grid-cols-4 w-full overflow-x-auto mb-10">
        <a href="{{ route('admin.booking') }}" class="grid gap-2 bg-slate-100 p-4 rounded-lg">
            <p
                class="text-xs text-slate-500"
            >
                Total Orders Today
            </p> 
            <span>
                <h6 class="text-xl font-bold text-slate-700 text-end">0</h6>
            </span>
        </a> 
        <a href="{{ route('admin.booking', 'pending') }}" class="grid gap-2 bg-slate-100 p-4 rounded-lg">
            <p
                class="text-xs text-slate-500"
            >
                Orders Pending
            </p> 
            <span>
                <h6 class="text-xl font-bold text-slate-700 text-end">0</h6>
            </span>
        </a> 
        <a href="{{ route('admin.booking', 'success') }}" class="grid gap-2 bg-slate-100 p-4 rounded-lg">
            <p
                class="text-xs text-slate-500"
            >
                Orders Sucess
            </p> 
            <span>
                <h6 class="text-xl font-bold text-slate-700 text-end">0</h6>
            </span>
        </a> 
        <a href="{{ route('admin.booking', 'cancel') }}" class="grid gap-2 bg-slate-100 p-4 rounded-lg">
            <p
                class="text-xs text-slate-500"
            >
                Orders Cancelled
            </p> 
            <span>
                <h6 class="text-xl font-bold text-slate-700 text-end">0</h6>
            </span>
        </a> 
    </div>
</section>
@endsection