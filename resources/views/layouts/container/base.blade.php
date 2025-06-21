{{-- layouts/container/base.blade.php --}}
<!DOCTYPE html>
<html lang="{{ getLang() }}" dir="{{ Direction() }}">

    <head>
        @include('layouts.container.shared.meta')
        @include('layouts.container.shared.plugins')

        @if(0)
            <!-- PWA -->
            <link rel="manifest"
                  href="{{ asset('pwa/'.getLang().'/'.((Subdomain())?Subdomain():'ajyad').'/manifest.json?v='.time()) }}"
                  crossorigin="use-credentials">
            <meta name="theme-color" content="#ffc107"/>
            <script src="{{ asset('pwa/sw.js?v='.time()) }}"></script>
        @endif

        <!-- CSS -->
        {{--<link rel="stylesheet" href="{{ asset('css/global.css?v='.time()) }}">
        <link rel="stylesheet" href="{{ asset('css/light.css?v='.time()) }}">
        <link rel="stylesheet" href="{{ asset('css/dark.css?v='.time()) }}">--}}

        @yield('head')
        @livewireStyles

        @if(!Subdomain() && 0)
            @include('layouts.tags.googleHead')
        @endif
    </head>

    <body name="body" class="antialiased {{ Direction() }}">
        @if(!Subdomain() && 0)
            @include('layouts.tags.googleBody')
        @endif

        <div id="app">
            @include('layouts.container.base-grid')
        </div>

        <!-- Script -->
        {{--<script src="{{ asset('js/global.js?v='.time()) }}"></script>--}}
        @yield('script')
        @livewireScripts

        <script>
            lucide.createIcons();
        </script>
    </body>

</html>
