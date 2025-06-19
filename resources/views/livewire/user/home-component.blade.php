{{-- livewire/user/home-component.blade.php --}}
@section('title',Name() .' | '. Description())
@section('description',Name() .' | '. Description())
@section('keywords',Keywords(Name().' '.Description()))

<div>
    {{ Name() }}
</div>
