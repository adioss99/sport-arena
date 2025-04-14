@extends('admin.dashboard') @section('content')
<div class="space-y-5 mb-20">
    <section class="w-full">
        <article
            class="group grid rounded-lg w-full overflow-hidden bg-slate-100 text-slate-700"
        >
            <div
                class="grid justify-items-stretch grid-cols-1 sm:grid-cols-2 justify-center p-5 w-full col-span-5"
            >
                <div>
                    <small class="mb-4 font-medium"
                        >{{ $arenas->regency }} {{ $arenas->distric }},
                        {{ $arenas->province }}</small
                    >
                    <h3
                        class="text-balance text-xl font-bold text-black lg:text-2xl"
                        aria-describedby="articleDescription"
                    >
                        {{ $arenas->name }}
                    </h3>
                </div>
                <div class="place-self-start">
                    <p
                        id="articleDescription"
                        class="my-4 max-w-lg text-pretty text-sm"
                    >
                        {{ $arenas->detail_address }}
                    </p>
                    <a
                        href="{{ $arenas->gmaps }}"
                        class="w-fit font-regular text-sm underline-offset-2 hover:underline focus:underline focus:outline-hidden"
                        target="_blank"
                        ><i class="fa-solid fa-map-location-dot fa-xs"></i>
                        Google Maps
                    </a>
                </div>
                <span class="col-span-2 mt-2 ">
                    <x-modal>
                        <x-slot:action>
                            {{ route("admin.location.update") }}
                        </x-slot:action>
                        <x-slot:btnClass>{{
                            "whitespace-nowrap bg-transparent rounded-lg border border-sky-600 rounded-md px-2 py-1 text-xs font-medium tracking-wide text-sky-600 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed "
                        }}</x-slot:btnClass>
                        <x-slot:btnTitle
                            ><i class="fa-regular fa-pen-to-square"></i> Update
                        </x-slot:btnTitle>
                        <x-slot:modalTitle>Update Location</x-slot:modalTitle>
                        <span class="space-y-2 overflow-y-hidden">
                            @method('PUT')
                            <x-input
                                label="Name"
                                name="name"
                                type="text"
                                value="{{ $arenas->name }}"
                            />
                            <x-input
                                label="Province"
                                name="province"
                                type="text"
                                value="{{ $arenas->province }}"
                            />
                            <x-input
                                label="Regency"
                                name="regency"
                                type="text"
                                value="{{ $arenas->regency }}"
                            />
                            <x-input
                                label="Distric"
                                name="distric"
                                type="text"
                                value="{{ $arenas->distric }}"
                            />
                            <x-input
                                label="Detail Address"
                                name="detail_address"
                                type="text"
                                value="{{ $arenas->detail_address }}"
                            />
                            <x-input
                                label="Gmaps URL"
                                name="gmaps"
                                type="text"
                                value="{{ $arenas->gmaps }}"
                            />
                        </span>
                    </x-modal>
                </span>
            </div>
        </article>
    </section>
    <section>
        <span class="flex gap-2 items-center justify-between mb-1">
            <label class="m-autotext-md font-semibold text-black-600"
                >Fields</label
            >
            <x-modal>
                <x-slot:action>
                    {{ route("admin.field.create") }}
                </x-slot:action>
                <x-slot:btnClass>{{
                    "whitespace-nowrap bg-transparent rounded-md border border-sky-600 px-2 py-1 text-xs font-medium tracking-wide text-sky-600 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed "
                }}</x-slot:btnClass>
                <x-slot:btnTitle
                    ><i class="fa-regular fa-square-plus"></i> Add Field
                </x-slot:btnTitle>
                <x-slot:modalTitle>Create Field Type</x-slot:modalTitle>
                <span class="space-y-4">
                    <x-input label="Name" name="name" type="text" />
                    <x-input label="Number" name="number" type="number" />
                    <div
                        class="relative flex w-full flex-col gap-1 text-slate-700"
                    >
                        <label for="os" class="w-fit pl-0.5 text-sm"
                            >Field Type</label
                        >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            class="absolute pointer-events-none right-4 top-8 size-5"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <select
                            id="os"
                            name="field_type_id"
                            class="w-full appearance-none rounded-lg bg-slate-100 px-4 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75"
                        >
                            <option disabled selected>Select Field Type</option>
                            @foreach($fieldType as $type)
                            <option value="{{ $type->id }}">
                                <span>
                                    {{ $type->detail }}
                                </span>
                                <span>
                                    @currency($type->price_per_hour)/h
                                </span>
                            </option>
                            @endforeach
                        </select>
                    </div>
                </span>
            </x-modal>
        </span>
        <div
            class="overflow-hidden w-full overflow-x-auto border-1 border-slate-200 rounded-xl"
        >
            <table class="w-full text-left text-sm text-slate-700">
                <thead class="bg-slate-100 text-sm text-black">
                    <tr>
                        <th scope="col" class="p-4">Name</th>
                        <th scope="col" class="p-4">Number</th>
                        <th scope="col" class="p-4">Detail</th>
                        <th scope="col" class="p-4">Price (hour)</th>
                        <th scope="col" class="bg-slate-100 p-4 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-300">
                    @foreach($arenas->fields as $arena)
                    <tr>
                        <td class="p-4">{{ $arena->name }}</td>
                        <td class="p-4">{{ $arena->number }}</td>
                        <td class="p-4">{{ $arena->fieldType->detail }}</td>
                        <td class="p-4">
                            @currency($arena->fieldType->price_per_hour)
                        </td>
                        <td class="p-4 gap-2 flex justify-center">
                            <x-modal>
                                <x-slot:action>
                                    {{ route('admin.field.update', $arena->id) }}
                                </x-slot:action>
                                <x-slot:btnClass>{{
                                    "whitespace-nowrap text-sm font-medium tracking-wide text-blue-700 hover:opacity-75 "
                                }}</x-slot:btnClass>
                                <x-slot:btnTitle
                                    ><i class="fa-solid fa-pen-to-square"></i
                                ></x-slot:btnTitle>
                                <x-slot:modalTitle
                                    >Edit Field</x-slot:modalTitle
                                >

                                <span class="space-y-4">
                                    <x-input
                                        label="Name"
                                        name="name"
                                        type="text"
                                        value="{{ $arena->name }}"
                                    />
                                    <x-input
                                        label="Number"
                                        name="number"
                                        type="number"
                                        value="{{ $arena->number }}"
                                    />
                                    <div
                                        class="relative flex w-full flex-col gap-1 text-slate-700"
                                    >
                                        <label
                                            for="os"
                                            class="w-fit pl-0.5 text-sm"
                                            >Field Type</label
                                        >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            class="absolute pointer-events-none right-4 top-8 size-5"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        <select
                                            id="os"
                                            name="field_type_id"
                                            class="w-full appearance-none rounded-lg bg-slate-100 px-4 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75"
                                        >
                                            <option
                                                disabled
                                                selected
                                                class="flex gap-5"
                                            >
                                                <span>
                                                    {{$arena->fieldType->detail  }}
                                                </span>
                                                <span>
                                                    @currency($arena->fieldType->price_per_hour)/h
                                                </span>
                                            </option>
                                            @foreach($fieldType as $type)
                                            <option value="{{ $type->id }}">
                                                <span>
                                                    {{ $type->detail }}
                                                </span>
                                                <span>
                                                    @currency($type->price_per_hour)/h
                                                </span>
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </span>
                            </x-modal>
                            <x-modal>
                                @method("DELETE")
                                <x-slot:action>
                                    {{ route('admin.field.delete', $arena->id) }}
                                </x-slot:action>
                                <x-slot:btnClass>{{
                                    "whitespace-nowrap text-sm font-medium tracking-wide text-red-700 hover:opacity-75 "
                                }}</x-slot:btnClass>
                                <x-slot:btnTitle
                                    ><i class="fa-regular fa-trash-can"></i
                                ></x-slot:btnTitle>
                                <x-slot:modalTitle
                                    >Delete Field</x-slot:modalTitle
                                >
                                <span class="space-y-4">
                                    <div
                                        class="flex w-full flex-col gap-1 text-slate-700 text-center"
                                    >
                                        <label
                                            class="w-fit pl-0.5 text-base font-semibold text-center"
                                            >Are you sure want to delete
                                            {{ $arena->name }}?</label
                                        >
                                    </div>
                                </span>
                            </x-modal>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <section>
        <span class="flex gap-2 items-center justify-between mb-1">
            <label class="text-md font-semibold text-black-600"
                >Field Type</label
            >
            <x-modal>
                <x-slot:action>
                    {{ route("admin.type.create") }}
                </x-slot:action>
                <x-slot:btnClass>{{
                    "whitespace-nowrap bg-transparent rounded-md border border-sky-600 px-2 py-1 text-xs font-medium tracking-wide text-sky-600 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed "
                }}</x-slot:btnClass>
                <x-slot:btnTitle
                    ><i class="fa-regular fa-square-plus"></i> Add Field Type
                </x-slot:btnTitle>
                <x-slot:modalTitle>Create Field Type</x-slot:modalTitle>
                <span class="space-y-4">
                    <x-input label="Detail" name="detail" type="text" />
                    <x-input
                        label="Price per Hour"
                        id="currencyInput"
                        type="text"
                        oninput="handleCurrency(this)"
                    />
                    <x-input
                        name="price_per_hour"
                        type="hidden"
                        id="rawCurrency"
                    />
                    <script>
                        function handleCurrency(input) {
                            let raw = input.value.replace(/[^\d]/g, "");
                            input.value = raw.replace(
                                /\B(?=(\d{3})+(?!\d))/g,
                                "."
                            );

                            // Store raw value
                            document.getElementById("rawCurrency").value = raw;
                        }
                    </script>
                </span>
            </x-modal>
        </span>
        <div class="overflow-hidden w-full overflow-x-auto border-1 border-slate-200 rounded-xl">
            <table class="text-left w-full text-sm text-slate-700">
                <thead class="bg-slate-100 text-sm text-black">
                    <tr>
                        <th scope="col" class="p-4">Detail</th>
                        <th scope="col" class="p-4">Price (hour)</th>
                        <th scope="col" class="bg-slate-100 p-4 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-300">
                    @foreach($fieldType as $type)
                    <tr>
                        <td class="p-4">{{ $type->detail }}</td>
                        <td class="p-4">@currency($type->price_per_hour)</td>
                        <td class="p-4 gap-2 flex justify-center">
                            <x-modal>
                                <x-slot:action>
                                    {{ route('admin.type.update', $type->id) }}
                                </x-slot:action>
                                <x-slot:btnClass>{{
                                    "whitespace-nowrap text-sm font-medium tracking-wide text-blue-700 transition hover:opacity-75 text-center"
                                }}</x-slot:btnClass>
                                <x-slot:btnTitle
                                    ><i class="fa-solid fa-pen-to-square"></i
                                ></x-slot:btnTitle>
                                <x-slot:modalTitle
                                    >Edit Field Type</x-slot:modalTitle
                                >
                                <span class="space-y-4">
                                    <x-input
                                        label="Detail"
                                        name="detail"
                                        type="text"
                                        value="{{ $type->detail }}"
                                    />
                                    <x-input
                                        label="Price per Hour"
                                        name="price_per_hour"
                                        type="number"
                                        id="rawCurrency"
                                        value="{{ $type->price_per_hour }}"
                                    />
                                </span>
                            </x-modal>
                            <x-modal>
                                @method("DELETE")
                                <x-slot:action>
                                    {{ route('admin.type.delete', $type->id) }}
                                </x-slot:action>
                                <x-slot:btnClass>{{
                                    "whitespace-nowrap text-sm font-medium tracking-wide text-red-700 hover:opacity-75 "
                                }}</x-slot:btnClass>
                                <x-slot:btnTitle
                                    ><i class="fa-regular fa-trash-can"></i
                                ></x-slot:btnTitle>
                                <x-slot:modalTitle
                                    >Delete Field Type</x-slot:modalTitle
                                >
                                <span class="space-y-4">
                                    <div
                                        class="flex w-full flex-col gap-1 text-slate-700 text-center"
                                    >
                                        <label
                                            class="w-fit pl-0.5 text-base font-semibold text-center"
                                            >Are you sure want to delete
                                            {{ $type->name }}?</label
                                        >
                                    </div>
                                </span>
                            </x-modal>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
