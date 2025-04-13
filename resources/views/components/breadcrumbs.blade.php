<nav
    class="hidden sm:inline-block text-sm font-regular text-slate-700"
    aria-label="breadcrumb"
>
    <ol class="flex flex-wrap items-center gap-1">
        <li class="flex items-center gap-1">
            <a href="/" class="hover:text-black">
                <i class="fa-solid fa-house fa-sm"></i>
            </a>
        </li>
        @foreach($segments as $url => $name)
        <li class="flex items-center gap-1">
            <span>/</span>
            <a href="{{ $url }}" class="hover:text-black ">{{
                $name
            }}</a>
        </li>
        @endforeach
    </ol>
</nav>
