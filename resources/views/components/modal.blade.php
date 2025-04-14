@props([
    'modalId' => '1', 'action' => '#', 'btnClass' => '', 'btnTitle' => '',
    'modalTitle' => '', 'confirmYes' => 'Confirm',
])
<div x-data="{modal{{ $modalId }}: false}">
    <button
        x-on:click="modal{{ $modalId }} = true"
        type="button"
        class="{{ $btnClass }}"
    >
        {{ $btnTitle }}
    </button>
    <div
        x-cloak
        x-show="modal{{ $modalId }}"
        x-transition.opacity.duration.200ms 
        x-on:keydown.esc.window="modal{{ $modalId }} = false"
        x-on:click.self="modal{{ $modalId }} = false"
        class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
        role="dialog"
        aria-modal="true"
        aria-labelledby="defaultModalTitle"
    >
        <!-- Modal Dialog -->
        <div
            x-show="modal{{ $modalId }}"
            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
            x-transition:enter-start="opacity-0 scale-50"
            x-transition:enter-end="opacity-100 scale-100"
            class="flex w-lg flex-col gap-2 max-h-11/12 overflow-y-scroll rounded-radius bg-surface bg-white rounded-lg text-on-surface"
        >
            <!-- Dialog Header -->
            <div
                class="flex items-center justify-between bg-surface-alt/60 p-4 20"
            >
                <h3
                    id="defaultModalTitle"
                    class="font-semibold tracking-wide text-on-surface-strong dark-strong"
                >
                    {{ $modalTitle }}
                </h3>
                <button
                    x-on:click="modal{{ $modalId }} = false"
                    aria-label="close modal"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                        stroke="currentColor"
                        fill="none"
                        stroke-width="1.4"
                        class="w-5 h-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <form action="{{ $action }}" method="POST" autocomplete="off">
                @csrf
                <div class="px-4 py-8">
                    {{ $slot }}
                </div>
                <!-- Dialog Footer -->
                <div
                    class="flex flex-col justify-between gap-2 bg-surface-alt/60 p-4 20 sm:flex-row sm:items-center md:justify-end"
                >
                    <button
                        x-on:click="modal{{ $modalId }} = false"
                        type="button"
                        class="rounded-lg outline-1 outline-red-500 text-md font-semibold text-red-500 w-full py-2 hover:bg-red-400 hover:text-white"
                    >
                        Cancel
                    </button>
                    <button
                        x-on:click="modal{{ $modalId }} = false"
                        type="submit"
                        class="rounded-lg outline-1 outline-green-500 text-md font-semibold text-green-500 w-full py-2 hover:bg-green-400 hover:text-white"
                    >
                        {{ $confirmYes ?? 'Confirm' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
