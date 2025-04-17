@props([ 'selected', 'option','optionId', 'style'])
<select
    id="os"
    name="field_type_id"
    class="w-full appearance-none rounded-lg bg-slate-100 px-4 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75"
>
    <option disabled selected class="flex gap-5">
        <span>
            {{ $selected }}
        </span>
    </option>
    @foreach($fieldType as $type)
    <option value="{{ $optionId }}">
        <span>
            {{ $option }}
        </span>
    </option>
    @endforeach
</select>
