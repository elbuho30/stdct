@if (filled($brand = config('filament.brand')))
    <div @class([
        'filament-brand overflow-x-clip tracking-tight',
        'dark:text-white' => config('filament.dark_mode'),
    ])>
    <header class="fi-sidebar-header flex h-16 items-center bg-white dark:bg-gray-900 lg:shadow-sm">
        {{-- @if (filled($brandLogo = config('filament.brandLogo')))
        <div x-show="$store.sidebar.isOpen" x-transition:enter="lg:transition lg:delay-100" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <a href="http://stdct/admin">
                <div class="fi-logo flex text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white">
                   {{ $brandLogo }}
                </div>
            </a>
        </div>
        @endif --}}
        <div @class(['p-2']) x-show="$store.sidebar.isOpen" x-transition:enter="lg:transition lg:delay-100" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <img alt="COOPENTEL" src="/img/logo_coopentel.png" style="height: 4rem;" class="fi-logo flex">
        </div>

        <div x-show="$store.sidebar.isOpen" x-transition:enter="lg:transition lg:delay-100" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <div class="fi-logo flex text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white">
                {{ $brand }}
                </div>
        </div>
    </header>
    </div>

@endif
