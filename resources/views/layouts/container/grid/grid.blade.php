{{-- layouts/container/grid/grid.blade.php --}}
<style>
    .grid-container {
        display: grid;
        grid-template-areas:
        "header"
        "main"
        "footer";
        grid-template-columns: 1fr;
        height: 100%;
    }
    header {
        grid-area: header;
        font-size: 15px;
        position: sticky;
        top: 0;
        width: 100%;
        z-index: 1010;
    }
    footer {
        grid-area: footer;
        font-size: 15px;
        box-shadow: var(--shadow);
    }
</style>
<div class=" grid-container">
    <header class="header d-print-none">
        {{--@include('global.global-header')--}}
    </header>
    <main class="main">
        @yield('content')
    </main>

    <footer class="footer d-print-none border-0">
        {{--@include('global.global-footer')--}}
    </footer>
</div>
