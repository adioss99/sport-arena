<section class="text-center min-h-56 lg:px-20 md:px-12 px-2 " id="arena">
    <div class="w-full">
        <div class="">
            <div
                class="relative w-full {{
                    $center
                }} max-w-xs gap-1 text-on-surface"
                type="search"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    aria-hidden="true"
                    class="absolute left-2.5 top-1/2 size-5 text-indigo-600 -translate-y-1/2 text-on-surface/50 dark:text-on-surface-dark/50"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                    />
                </svg>
                <input
                    type="search"
                    class="w-full rounded-radius bg-surface-alt py-2 pl-10 pr-2 text-sm outline-1 rounded-md outline-indigo-600 focus-visible:outline-2"
                    name="search"
                    placeholder="Search region, city or regency"
                    aria-label="search"
                    autocomplete="off"
                    wire:model.live="search"
                />
            </div>
        </div>
        <div>
            @if($search !== '')
            <div
                class="grid justify-items-center grid-cols-1 mt-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"
            >
                @foreach($locations as $location)
                <article
                    :key="{{ $location->
                    id }}"
                    class="group flex rounded-2xl flex-col overflow-hidden bg-surface-alt text-on-surface shadow-md mx-auto"
                >
                    <div class="md:h-44 overflow-hidden">
                        <img
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNSVaKvistJbXGk6wCDgyiM-Z3spOKPl-xlw&s"
                            class="object-cover m-auto transition duration-700 ease-out group-hover:scale-105"
                            alt="view of a coastal Mediterranean village on a hillside, with small boats in the water."
                        />
                    </div>
                    <div class="flex flex-col gap-4 p-3">
                        <div
                            class="flex items-center gap-1 font-medium text-xs"
                        >
                            <i class="fa-solid fa-location-dot"></i>
                            <span
                                >{{ $location->regency }},
                                {{ $location->distric }},
                                {{ $location->province }}</span
                            >
                        </div>
                        <h3
                            class="text-balance text-lg font-bold text-on-surface-strong dark:text-on-surface-dark-strong"
                            aria-describedby="tripDescription"
                        >
                            {{ $location->name }}
                        </h3>
                        <p
                            id="tripDescription"
                            class="text-pretty text-sm mb-2 hidden md:block"
                        >
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit...
                        </p>
                        <a
                            href="/arena/{{ $location->slug }}"
                            type="button"
                            class="whitespace-nowrap rounded-lg bg-blue-700 border border-blue-700 px-4 py-2 text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed"
                        >
                            Detail
                        </a>
                    </div>
                </article>
                @endforeach @if($locations->isEmpty())
                <div class="flex flex-col gap-4 p-3">
                    <h3
                        class="text-balance text-lg font-bold text-on-surface-strong dark:text-on-surface-dark-strong text-red-600"
                        aria-describedby="tripDescription"
                    >
                        No results found
                    </h3>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>
