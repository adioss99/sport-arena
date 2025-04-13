<header class="absolute inset-x-0 top-0 z-100" x-data="{ isOpen: false }">
    <nav
        class="flex items-center justify-between p-6 lg:px-8"
        aria-label="Global"
    >
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Company</span>
                <img
                    class="h-8 w-auto"
                    src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                    alt=""
                />
            </a>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="/" class="text-sm/6 font-semibold text-gray-900">Home</a>
            <a href="/arena" class="text-sm/6 font-semibold text-gray-900"
                >Arena</a
            >
            <a href="#" class="text-sm/6 font-semibold text-gray-900">About</a>
            <a href="#" class="text-sm/6 font-semibold text-gray-900"
                >Company</a
            >
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            @auth
            <div>
                <a
                    href="/dashboard"
                    class="flex w-full items-center rounded-lg gap-2 p-2 text-left text-slate-700 hover:bg-blue-700/5 hover:text-black focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700"
                >
                    <img
                        src="https://penguinui.s3.amazonaws.com/component-assets/avatar-7.webp"
                        class="size-8 object-cover rounded-lg"
                        alt="avatar"
                        aria-hidden="true"
                    />
                </a>
            </div>
            @endauth @guest
            <a href="/login" class="text-sm/6 font-semibold text-gray-900"
                >Log in
            </a>
            <span aria-hidden="true" class="mx-1">/</span>
            <a href="/register" class="text-sm/6 font-semibold text-gray-900">
                Register
            </a>
            <span aria-hidden="true">&rarr;</span>
            @endguest
        </div>
        <div class="flex lg:hidden">
            <button
                @click="isOpen = !isOpen"
                type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
            >
                <span class="sr-only">Open main menu</span>
                <svg
                    class="size-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true"
                    data-slot="icon"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                    />
                </svg>
            </button>
        </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true" x-show="isOpen">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-100" @click="isOpen = !isOpen"></div>
        <div
            class="fixed inset-y-0 right-0 z-100 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
        >
            <div class="flex items-center justify-between">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img
                        class="h-8 w-auto"
                        src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                        alt=""
                    />
                </a>
                <button
                    @click="isOpen = !isOpen"
                    type="button"
                    class="-m-2.5 rounded-md p-2.5 text-gray-700"
                >
                    <span class="sr-only">Close menu</span>
                    <svg
                        class="size-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                        data-slot="icon"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a
                            href="/"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                            >Home</a
                        >
                        <a
                            href="/arena"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                            >Arena</a
                        >
                        <a
                            href="#"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                            >About</a
                        >
                        <a
                            href="#"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50"
                            >Company</a
                        >
                    </div>
                    <div class="py-6 flex">
                        @auth
                        <div class="w-full">
                            <a
                                href="/dashboard"
                                class="flex w-full items-center rounded-lg gap-2 p-2 text-left text-slate-700 hover:bg-blue-700/5 hover:text-black focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700"
                            >
                                <img
                                    src="https://penguinui.s3.amazonaws.com/component-assets/avatar-7.webp"
                                    class="size-8 object-cover rounded-lg"
                                    alt="avatar"
                                    aria-hidden="true"
                                />
                                <span
                                    class="text-sm/6 font-semibold text-gray-900"
                                    >Dashboard</span
                                >
                            </a>

                        </div>
                        @endauth
                        @guest
                        <a
                            href="/login"
                            class="text-sm/6 font-semibold text-gray-900"
                            >Log in
                        </a>
                        <span class="mx-3">/</span>
                        <a
                            href="/register"
                            class="text-sm/6 font-semibold text-gray-900"
                        >
                            Register
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
