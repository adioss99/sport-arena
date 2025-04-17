<section class="w-full flex flex-row justify-center text-slate-800 bg-slate-100">
    <ul class="divide-y-1 divide-slate-200">
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
</section>
