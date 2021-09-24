@extends('layouts.template')

@section('content')
<div>

    {{-- @livewire('gavetas', 'gavetas') --}}
    {{-- Versão 7+ do laravel fazer dessa forma: --}}
    <livewire:gavetas />
</div>
@endsection