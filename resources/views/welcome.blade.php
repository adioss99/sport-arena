<x-layout>
    <x-navbar></x-navbar>

    <section class="relative isolate px-6 pt-14 h-screen mb-10 lg:px-8">
        <div
            class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl"
            aria-hidden="true"
        >
            <div
                class="relative left-[calc(50%-11rem)] aspect-1155/678 w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="
                    clip-path: polygon(
                        74.1% 44.1%,
                        100% 61.6%,
                        97.5% 26.9%,
                        85.5% 0.1%,
                        80.7% 2%,
                        72.5% 32.5%,
                        60.2% 62.4%,
                        52.4% 68.1%,
                        47.5% 58.3%,
                        45.2% 34.5%,
                        27.5% 76.7%,
                        0.1% 64.9%,
                        17.9% 100%,
                        27.6% 76.8%,
                        76.1% 97.7%,
                        74.1% 44.1%
                    );
                "
            ></div>
        </div>
        <div class="mx-auto max-w-2xl py-32">
            <div class="text-center">
                <h1
                    class="text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl"
                >
                    Rent Sport Field Nearby
                </h1>
                <p
                    class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8"
                >
                    Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure
                    qui lorem cupidatat commodo. Elit sunt amet fugiat veniam
                    occaecat.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a
                        href="#arena"
                        class="rounded-md outline-1 outline-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-indigo-600 shadow-xs hover:bg-indigo-500 hover:text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >Find arena <span aria-hidden="true">→</span></a
                    >
                </div>
            </div>
        </div>
    </section>
    <livewire:search-location center="mx-auto" />
</x-layout>
