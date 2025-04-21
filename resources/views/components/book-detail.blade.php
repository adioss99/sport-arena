<section
    class="w-full flex flex-row justify-center text-slate-800 bg-slate-100"
>
    <div class="flex justify-center text-center gap-4 p-4 w-full">
        <ul class="divide-y-1 divide-slate-200 w-1/2">
            @foreach($row->bookingFields as $field)
            <li class="text-center">
                <p class="font-semibold">{{ $field->field_name }}</p>
                @foreach($field->bookingTimes as $time)
                <span class="m-auto divide-y-0"
                    >( @time($time->schedulePivot[0]->start_time) -
                    @time($time->schedulePivot[0]->end_time))</span
                >
                @endforeach
            </li>
            @endforeach
        </ul>
        @if( auth()->user()->role->name == 'user')
        <section
            class="flex sm:flex-col justify-items-center gap-2 min-w-[200px]"
        >
            <button
                class="border-1 bg-slate-50 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white rounded-md p-2 py-1"
            >
                Having a problem: call admin
            </button>
            @if(in_array($row->status, ['pending']))
            <button
                class="border-1 bg-slate-50 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white rounded-md p-2 py-1"
            >
                Cash DP: call admin
            </button>
            <a
                class="border-1 bg-slate-50 border-green-500 text-green-600 hover:bg-green-500 hover:text-white rounded-md p-2 py-1"
                id="pay-button"
                href="/payment/{{ $row->booking_code }}"
                target="_blank"
                rel="noopener noreferrer"
            >
                Self payment
            </a>
            @endif
        </section>
        @endif
    </div>
</section>
