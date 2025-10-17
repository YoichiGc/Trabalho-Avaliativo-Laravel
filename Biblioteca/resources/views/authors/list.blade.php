@extends('layouts.app') {{-- HERDA o layout base --}}

@section('title', 'Listagem de Autores') {{-- TÍTULO fixo da página --}}

@section('content') {{-- INÍCIO do conteúdo --}}
<div class="d-flex justify-content-between align-items-center mb-4"> {{-- CABEÇALHO com título e botão --}}
    <h2>👤 Listagem de Autores</h2>
    <a href="{{ route('authors.create') }}" class="btn btn-primary"> {{-- BOTÃO criar novo --}}
        <i class="fas fa-plus"></i> Novo Autor {{-- ÍCONE adicionar --}}
    </a>
</div>

{{-- CARD de busca/filtro --}}
<div class="card mb-4">
    <div class="card-body">

        {{-- FORM de busca --}}

        <form method="GET" action="{{ route('authors.index') }}" class="row g-3">
            
        {{-- SELECT tipo de busca --}}

            <div class="col-md-3">
                <label for="search_type" class="form-label">Buscar por:</label>
                <select class="form-select" name="search_type" id="search_type">
                    <option value="name" {{ request('search_type') == 'name' || !request('search_type') ? 'selected' : '' }}>Nome</option>
                    <option value="nationality" {{ request('search_type') == 'nationality' ? 'selected' : '' }}>Nacionalidade</option>
                </select>
            </div>
            {{-- INPUT termo de busca --}}
            
            <div class="col-md-7">
                <label for="search" class="form-label">Termo de busca:</label>
                <div class="input-group">
                    <span class="input-group-text"> {{-- ÍCONE lupa --}}
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" name="search" id="search"
                           value="{{ request('search') }}" {{-- MANTÉM valor após submit --}}
                           placeholder="Digite o termo de busca...">
                </div>
            </div>
            {{-- BOTÃO submit --}}
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label> {{-- LABEL vazia para alinhamento --}}
                <div class="d-grid"> {{-- BOTÃO em grid --}}
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ALERTA de sucesso --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }} {{-- MENSAGEM da sessão --}}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button> {{-- BOTÃO fechar --}}
    </div>
@endif

{{-- CONDICIONAL para busca (vazia no código) --}}
@if(request()->filled('search'))
    {{-- AQUI poderia mostrar "Resultados para: X" --}}
@endif

{{-- CARD principal da listagem --}}
<div class="card">
    <div class="card-body">
        @if($authors->count() > 0) {{-- SE tem autores --}}
            <div class="table-responsive"> {{-- TABELA responsiva --}}
                <table class="table table-striped table-hover border-0"> {{-- TABELA estilizada --}}
                    <thead class="table-dark"> {{-- CABEÇALHO escuro --}}
                        <tr>
                            <th class="border-0">ID</th>
                            <th class="border-0">Nome</th>
                            <th class="border-0">Nacionalidade</th>
                            <th class="border-0">Data de Nascimento</th>
                            <th class="border-0">Livros</th>
                            <th class="border-0">Ações</th> {{-- COLUNA ações --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $author) {{-- LOOP autores --}}
                        <tr>
                            <td class="border-0">{{ $author->id }}</td> {{-- ID --}}
                            <td class="border-0">{{ $author->name }}</td> {{-- NOME --}}
                            <td class="border-0">{{ $author->nationality ?? 'Não informado' }}</td> {{-- NACIONALIDADE com fallback --}}
                            <td class="border-0">{{ $author->birth_date ? $author->birth_date->format('d/m/Y') : 'Não informado' }}</td> {{-- DATA formatada --}}
                            <td class="border-0">
                                <span class="badge bg-info">{{ $author->books_count }} livros</span> {{-- BADGE contagem livros --}}
                            </td>
                            <td class="border-0">
                                <div class="btn-group" role="group"> {{-- GRUPO de botões --}}
                                    {{-- BOTÃO editar --}}
                                    <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> {{-- ÍCONE editar --}}
                                    </a>
                                    {{-- FORM deletar --}}
                                    <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline">
                                        @csrf {{-- TOKEN segurança --}}
                                        @method('DELETE') {{-- METHOD SPOOFING --}}
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Tem certeza que deseja excluir este autor?')"> {{-- CONFIRMAÇÃO JS --}}
                                            <i class="fas fa-trash"></i> {{-- ÍCONE lixeira --}}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- AQUI FALTA a paginação --}}
       
        @else {{-- SE não tem autores --}}
            <div class="text-center py-5"> {{-- ESTADO vazio --}}
                <h4>Nenhum autor encontrado</h4>
                <p class="text-muted">Comece adicionando seu primeiro autor!</p>
                <a href="{{ route('authors.create') }}" class="btn btn-primary"> {{-- CALL TO ACTION --}}
                    <i class="fas fa-plus"></i> Adicionar Autor
                </a>
            </div>
        @endif
    </div>
</div>
@endsection {{-- FIM do conteúdo --}}