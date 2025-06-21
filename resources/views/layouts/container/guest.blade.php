{{-- layouts/container/guest.blade.php --}}
<!DOCTYPE html>
<html lang="{{ getLang() }}" dir="{{ Direction() }}">

    <head>
        @include('layouts.container.shared.meta')
        @include('layouts.container.shared.plugins')
    </head>

    <body class="text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
            <div>
                <a href="{{ route('home') }}">
                    <x-application.logo-component width="70" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <script>
            lucide.createIcons();
        </script>
    </body>

</html>
