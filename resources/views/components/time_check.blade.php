@props([ 'schedule' => 'array', 'field', 'booked'])
@if(!isset($booked[$schedule['pivot_id']]))
<label
    for="checkboxDefault{{ $schedule['pivot_id'] }}"
    class="inline-flex border border-slate-200 justify-between rounded-lg bg-surface-alt px-1 w-full py-2 text-sm font-medium text-on-surface has-checked:text-on-surface-strong has-checked:bg-emerald-50 has-checked:border-emerald-700 has-disabled:opacity-40 has-disabled:cursor-not-allowed"
>
    <span class="m-auto"
        >{{ $schedule["start_time"] }} - {{ $schedule["end_time"] }}</span
    >
    <span class="relative flex items-center">
        <input
            data-field="{{ $field['id'] }}"
            data-field-name="{{ $field['name'] }}"
            data-price="{{ $field['price_per_hour'] }}"
            data-time="{{ $schedule['start_time'] }} - {{
                $schedule['end_time']
            }}"
            id="checkboxDefault{{ $schedule['pivot_id'] }}"
            name="schedule[]"
            value="{{ $schedule['pivot_id'] }}"
            type="checkbox"
            class="checkBox before:content[''] peer relative size-4 appearance-none overflow-hidden rounded-sm bg-surface before:absolute before:inset-0 checked:before:bg-primary focus:outline-outline-strong checked:focus:outline-primary active:outline-offset-0 disabled:cursor-not-allowed"
            hidden
            />
    </span>
</label>
@else
<label
    for="disabled"
    class="inline-flex border border-slate-200 justify-between rounded-lg bg-surface-alt px-1 w-full py-2 text-sm font-medium text-on-surface has-disabled:opacity-30 has-disabled:cursor-not-allowed"
>
    <span class="m-auto"
        >{{ $schedule["start_time"] }} - {{ $schedule["end_time"] }}</span
    >
    <input type="checkbox" disabled id="disabled" class="hidden" />
</label>
@endif
