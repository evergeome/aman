{{-- layouts/container/base-grid.blade.php --}}

<div class="grid grid-rows-[auto_1fr_auto] min-h-screen bg-gray-100">
    <header class="sticky top-0 w-full z-[1010] print:hidden">
        <x-application.navigation-component />
    </header>


    <main>
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        @yield('content')
    </main>

    <footer class="print:hidden bg-white p-4">
        <div class="justify-self-center ">
            {{ Name() }}
        </div>
        {{-- @include('global.global-footer') --}}
    </footer>
</div>
