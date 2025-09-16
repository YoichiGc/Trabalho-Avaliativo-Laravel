@extends('layouts.app')

@section('title', 'Livros')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Listagem de Livros</h3>
    </div>
    <div class="card-body">
        <p>Página em desenvolvimento - CRUD de Livros</p>
        <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>
@endsection