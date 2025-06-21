{{-- livewire/main/home-component.blade.php --}}
@section('title',Name() .' | '. Description())
@section('description',Name() .' | '. Description())
@section('keywords',Keywords(Name().' '.Description()))

<div>
    {{ Name() .' | '. Description() }}

    <x-shared.icon icon="x"/>
</div>
