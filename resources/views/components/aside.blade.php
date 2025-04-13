<span class="flex flex-col gap-2">
    @foreach($menus as $menu)
    <a
        href="{{ route($menu['url']) }}"
        class="flex items-center rounded-lg gap-2 px-2 py-1.5 text-sm font-medium {{ request()->routeIs($menu['url']) ? 'bg-blue-700/10 text-black underline-offset-2 focus-visible:underline focus:outline-hidden' : ' ' }} "
    >
        <i class="fa-solid {{ $menu['icon'] }} fa-lg"></i>
        <span>{{ $menu["name"] }}</span>
    </a>
    @endforeach
</span>
