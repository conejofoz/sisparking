@extends('layouts.template')

@section('content')
<div>

    {{-- @livewire('caixas', 'caixas') --}}
    {{-- Versão 7+ do laravel fazer dessa forma: --}}
    <livewire:caixas />
</div>
@endsection