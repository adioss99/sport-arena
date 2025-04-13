@props([ 'arenas', ])
<div
    x-data="{ sidebarIsOpen: false }"
    x-on:keydown.esc.window="sidebarIsOpen = false"
>
    <!-- toggle button -->
    <button
        class="fixed bottom-4 right-4 z-10 rounded-full bg-indigo-600 p-4 text-slate-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 active:outline-offset-0"
        x-on:click="sidebarIsOpen = ! sidebarIsOpen"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            stroke="currentColor"
            fill="none"
            stroke-width="1.5"
            class="size-6"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
            />
        </svg>
        <span class="sr-only">sidenav toggle</span>
    </button>
    <form
        action="{{ route('booking.store') }}"
        method="POST"
        x-cloak
        x-show="sidebarIsOpen"
        class="fixed right-0.5 bottom-20 z-20 flex min-h-90 max-h-9/12 w-80 shrink-0 flex-col bg-white p-4 transition-transform duration-300 rounded-xl border border-indigo-600"
        aria-label="shopping cart"
        x-transition:enter="transition duration-200 ease-out"
        x-transition:enter-end="translate-x-0"
        x-transition:enter-start=" translate-x-80"
        x-transition:leave="transition ease-in duration-200 "
        x-transition:leave-end="translate-x-80"
        x-transition:leave-start="translate-x-0"
    >
        @csrf
        <!-- sidebar header -->
        <div class="flex items-center justify-center">
            <h3 class="text-md font-bold text-indigo-600">Booking details</h3>
        </div>
        <!-- menu items -->
        <div class="flex flex-col gap-2 overflow-y-auto py-4">
            <!-- products -->
            <ul class="flex flex-col gap-2 divide-y-2 divide-slate-300">
                <!-- product card -->
                <li class="text-sm">
                    Location:
                    <span class="font-semibold">{{ $arenas["name"] }}</span>
                    <input
                        type="text"
                        value="{{ $arenas['id'] }}"
                        name="location_id"
                        hidden
                    />
                </li>
                <li class="text-sm">
                    Date:
                    <input
                        type="date"
                        name="date"
                        id="dateBook"
                        value=""
                        class="font-semibold"
                        readonly
                    />
                    <div id="fieldData" hidden></div>
                </li>
                <li class="text-sm divide-y divide-slate-200" id="bookList">
                    <p class="text-sm font-semibold text-red-600">
                        No schedule selected
                    </p>
                </li>
            </ul>
        </div>

        <!-- sidebar footer -->
        <div class="mt-auto">
            <div>
                <div
                    class="flex items-center justify-between py-2 text-sm font-bold text-slate-700"
                >
                    <span>Total</span>
                    <span id="totalPrice" class="text-black"></span>
                </div>
            </div>
            <div>
                @auth
                <button
                    type="submit"
                    id="bookButton"
                    class="mt-2 flex w-full rounded-lg border border-indigo-600 items-center justify-center gap-2 whitespace-nowrap bg-indigo-600 px-4 py-2 text-center text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-50"
                    disabled
                >
                    <span>Book</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        fill="none"
                        stroke-width="2"
                        class="size-4"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                        />
                    </svg>
                </button>
                @endauth @guest
                <a
                    href="{{ route('login') }}"
                    class="mt-2 flex w-full rounded-lg border border-indigo-600 items-center justify-center gap-2 whitespace-nowrap px-4 py-2 text-center text-sm font-medium tracking-wide text-indigo-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75"
                >
                    <span>Login to book</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        fill="none"
                        stroke-width="2"
                        class="size-4"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                        />
                    </svg>
                </a>
                @endguest
            </div>
        </div>
    </form>
</div>
@vite('resources/js/transaction.js')
