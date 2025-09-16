@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Sistema de Biblioteca</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Livros</h5>
                        <p class="card-text">Gerencie o acervo</p>
                        <a href="{{ route('books.index') }}" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Autores</h5>
                        <p class="card-text">Gerencie autores</p>
                        <a href="{{ route('authors.index') }}" class="btn btn-success">Acessar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Categorias</h5>
                        <p class="card-text">Gerencie categorias</p>
                        <a href="{{ route('categories.index') }}" class="btn btn-info">Acessar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h4>Funcionalidades do Sistema:</h4>
            <ul>
                <li>Cadastro de Livros, Autores e Categorias</li>
                <li>Controle completo do acervo</li>
                <li>Relatórios e consultas</li>
            </ul>
        </div>
    </div>
</div>
@endsection