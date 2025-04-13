<x-layout>
    <x-navbar />
    <!-- booking cart -->
    <x-booking-popup :arenas="$arenas" />
    <div class="pt-24 lg:px-10 md:px-7 px-2">
        <x-breadcrumbs />
        <section class="w-full">
            <article
                class="group grid rounded-lg w-full overflow-hidden bg-slate-100 text-slate-700"
            >
                <div
                    class="grid justify-items-stretch grid-cols-1 sm:grid-cols-2 justify-center p-6 w-full col-span-5"
                >
                    <div>
                        <small class="mb-4 font-medium"
                            >{{ $arenas["regency"] }} {{ $arenas["distric"] }},
                            {{ $arenas["province"] }}</small
                        >
                        <h3
                            class="text-balance text-xl font-bold text-black lg:text-2xl"
                            aria-describedby="articleDescription"
                        >
                            {{ $arenas["name"] }}
                        </h3>
                    </div>
                    <div class="place-self-start">
                        <p
                            id="articleDescription"
                            class="my-4 max-w-lg text-pretty text-sm"
                        >
                            {{ $arenas["detail_address"] }}
                        </p>
                        <a
                            href="{{ $arenas['gmaps'] }}"
                            class="w-fit font-regular text-sm underline-offset-2 hover:underline focus:underline focus:outline-hidden"
                            target="_blank"
                            ><i class="fa-solid fa-map-location-dot fa-xs"></i>
                            Google Maps
                        </a>
                    </div>
                </div>
            </article>
        </section>
        <livewire:booking-date-search :location_id="$arenas['id']" :arenas="$schedules"/>
    </div>
    <div class="h-56"></div>
    @vite(['resources/js/app.js'])
</x-layout>
