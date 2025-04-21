@extends('user.dashboard') @section('content')
<section class="space-y-5 mb-2 text-sm lg:pr-1">
    <div x-data="{ selectedTab: 'All' }" class="w-full">
        <div
            x-on:keydown.right.prevent="$focus.wrap().next()"
            x-on:keydown.left.prevent="$focus.wrap().previous()"
            class="flex gap-2 overflow-x-auto border-b border-slate-300"
            role="tablist"
            aria-label="tab options"
        >
            <button
                x-on:click="selectedTab = 'All'"
                x-bind:aria-selected="selectedTab === 'All'"
                x-bind:tabindex="selectedTab === 'All' ? '0' : '-1'"
                x-bind:class="selectedTab === 'All' ? 'font-bold text-blue-700 border-b-2 border-blue-700 ' : 'text-slate-700 font-medium hover:border-b-2 hover:border-b-slate-800 hover:text-black'"
                class="h-min px-4 py-2 text-sm"
                type="button"
                role="tab"
                aria-controls="tabpanelAll"
            >
                All
            </button>
            <button
                x-on:click="selectedTab = 'Expired'"
                x-bind:aria-selected="selectedTab === 'Expired'"
                x-bind:tabindex="selectedTab === 'Expired' ? '0' : '-1'"
                x-bind:class="selectedTab === 'Expired' ? 'font-bold text-blue-700 border-b-2 border-blue-700 ' : 'text-slate-700 font-medium hover:border-b-2 hover:border-b-slate-800 hover:text-black'"
                class="h-min px-4 py-2 text-sm"
                type="button"
                role="tab"
                aria-controls="tabpanelExpired"
            >
                Expired
            </button>
        </div>
        <div class="md:px-2 py-4 text-slate-700">
            <div
                x-cloak
                x-show="selectedTab === 'All'"
                id="tabpanelAll"
                role="tabpanel"
                aria-label="All"
            >
                <livewire:user-booking :status="'all'" />
            </div>
            <div
                x-cloak
                x-show="selectedTab === 'Expired'"
                id="tabpanelExpired"
                role="tabpanel"
                aria-label="Expired"
            >
            <button id="pay-button" class="px-3 py-2 bg-amber-200">this is expired</button>
                <livewire:user-booking :status="'expired'" />
            </div>
        </div>
    </div>
</section>
@endsection
