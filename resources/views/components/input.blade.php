@props(['label'=> '', 'name'=> 'name', 'value'=> '', 'type' => 'text',
'placeholder' => '', 'id', 'attributes' => ''])

<div class="flex w-full flex-col gap-1 text-slate-700">
    <label class="w-fit pl-0.5 text-sm">{{ $label }}</label>
    <input
        class="w-full rounded-sm bg-slate-100 px-4 py-2 text-sm focus-visible:outline-1 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        id="{{ $id ?? $name }}"
        {{
        $attributes
        }}
    />
</div>
