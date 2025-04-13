@extends('admin.dashboard') @section('content')
<section class="mb-5 w-full">
    <article
        class="group grid rounded-lg w-full overflow-hidden bg-slate-100 text-slate-700"
    >
        <div
            class="grid justify-items-stretch grid-cols-1 sm:grid-cols-2 justify-center p-6 w-full col-span-5"
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
        </div>
    </article>
</section>
<section
    class="overflow-hidden w-full overflow-x-auto rounded-lg border-1 border-slate-200"
>
    <table class="w-full text-left text-sm text-slate-700">
        <thead class="bg-slate-100 text-sm text-black">
            <tr>
                <th scope="col" class="p-4">Name</th>
                <th scope="col" class="p-4">Number</th>
                <th scope="col" class="p-4">Detail</th>
                <th scope="col" class="p-4">Price (hour)</th>
                <th scope="col" class="bg-slate-100 p-4">Action</th>
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
                <td class="p-4">
                    <button
                        type="button"
                        class="whitespace-nowrap rounded-lg bg-transparent p-0.5 font-semibold text-blue-700 outline-blue-700 hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 dark:text-blue-600 dark:outline-blue-600"
                    >
                        Edit
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
