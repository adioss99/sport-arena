<!-- aside -->
<span class="flex flex-col gap-2">
    @foreach($menus as $menu) @if(!isset($menu['submenu']))
    <a
        href="{{ route($menu['url']) }}"
        class="flex items-center rounded-lg gap-2 px-2 py-1.5 text-sm text-slate-700 font-medium {{ request()->routeIs($menu['url']) ? 'bg-blue-700/10 text-slate-800 underline-offset-2 focus-visible:underline focus:outline-hidden' : ' ' }} "
    >
        <i class="fa-solid {{ $menu['icon'] }} fa-lg"></i>
        <span>{{ $menu["name"] }}</span>
    </a>
    @else
    <a
        href="{{ route($menu['url']) }}"
        class="flex items-center rounded-lg gap-2 px-2 py-1.5 text-sm text-slate-700 font-medium {{ request()->routeIs($menu['url']) ? 'bg-blue-700/10 text-slate-800 underline-offset-2 focus-visible:underline focus:outline-hidden' : ' ' }} "
    >
        <i class="fa-solid {{ $menu['icon'] }} fa-lg"></i>
        <span>{{ $menu["name"] }}</span>
    </a>
    <ul class="pl-4">
        @foreach($menu['submenu'] as $submenu)
        <li class="border-l px-2 py-0.5 border-slate-300">
            <a
                href="{{ route($menu['url'], $submenu['url']) }}"
                class="flex items-center gap-2 px-2 py-1.5 text-sm rounded-lg text-slate-700 hover:bg-blue-700/5 hover:text-black focus-visible:underline focus:outline-hidden {{ request()->route('status') == $submenu['url'] ? 'bg-blue-500/10 text-slate-800 underline-offset-2 focus-visible:underline focus:outline-hidden' : ' ' }} "
            >
                <span
                    class="w-fit inline-flex overflow-hidden text-xs font-medium p-0.5 px-1 rounded-lg bg-{{
                        $submenu['color']
                    }}/10 text-{{ $submenu['color'] }} "
                    >{{ $submenu["name"] }}</span
                >
            </a>
        </li>
        @endforeach
    </ul>
    @endif @endforeach
</span>
