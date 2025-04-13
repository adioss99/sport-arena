@props(['arenas','bookedField'])
<span>
    <section
        class="overflow-hidden w-full overflow-x-auto rounded-lg border-1 border-slate-200"
    >
        <div class="overflow-hidden w-full overflow-x-auto">
            <div class="grid grid-cols-max grid-flow-col text-center">
                @foreach($arenas['fields'] as $arena)
                <div class="grid min-w-[140px]">
                    <div
                        x-data="{ isExpanded: false }"
                        class="overflow-hidden rounded-radius bg-surface-alt/40 dark:bg-surface-dark-alt/50"
                    >
                        <button
                            id="controlsAccordionItemOne"
                            type="button"
                            class="flex w-full items-center bg-indigo-50 justify-between gap-1 bg-surface-alt p-3 text-left underline-offset-2 hover:bg-surface-alt/75 focus-visible:bg-surface-alt/75 focus-visible:underline focus-visible:outline-hidden dark:bg-surface-dark-alt dark:hover:bg-surface-dark-alt/75 dark:focus-visible:bg-surface-dark-alt/75"
                            aria-controls="accordionItemOne"
                            x-on:click="isExpanded = ! isExpanded"
                            x-bind:class="isExpanded ? 'text-on-surface-strong dark:text-on-surface-dark-strong font-bold'  : 'text-on-surface dark:text-on-surface-dark font-medium'"
                            x-bind:aria-expanded="isExpanded ? 'true' : 'false'"
                        >
                            <p class="md:text-sm text-xs">
                                {{ $arena["name"] }}
                            </p>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke-width="2"
                                stroke="currentColor"
                                class="size-5 shrink-0 transition"
                                aria-hidden="true"
                                x-bind:class="isExpanded  ?  'rotate-180'  :  ''"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                />
                            </svg>
                        </button>
                        <ol
                            x-cloak
                            x-show="isExpanded"
                            id="accordionItemOne"
                            role="region"
                            aria-labelledby="controlsAccordionItemOne"
                            class="text-left p-3"
                        >
                            <li class="text-xs text-pretty">
                                Number: {{ $arena["number"] }}
                            </li>
                            <li class="text-xs text-pretty">
                                {{ $arena["detail"] }}
                            </li>
                            <li class="text-xs text-pretty font-semibold">
                                @currency($arena["price_per_hour"])/hour
                            </li>
                        </ol>
                    </div>
                    @foreach($arena['schedules'] as $schedule)
                    <div class="p-0.5">
                        <x-time_check
                            :schedule="$schedule"
                            :field="$arena"
                            :booked="$bookedField"
                        />
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </section>
</span>
