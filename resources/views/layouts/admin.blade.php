{{-- layouts/admin.blade.php --}}
<x-layout.base-layout>
    @section('head')
    @endsection

    @section('content')
        {{ $slot ?? '' }}
    @endsection


    @section('script')
    @endsection
</x-layout.base-layout>


