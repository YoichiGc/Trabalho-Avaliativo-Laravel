@extends('layouts.app') {{-- HERDA o layout base --}}

@section('title', 'Listagem de Categorias') {{-- TÍTULO da página --}}

@section('content') {{-- INÍCIO do conteúdo --}}
<div class="d-flex justify-content-between align-items-center mb-4"> {{-- CABEÇALHO --}}
    <h2>🏷️ Listagem de Categorias</h2> {{-- TÍTULO com emoji de etiqueta --}}
    <a href="{{ route('categories.create') }}" class="btn btn-primary"> {{-- BOTÃO nova categoria --}}
        <i class="fas fa-plus"></i> Nova Categoria
    </a>
</div>

{{-- CARD de busca --}}
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('categories.index') }}" class="row g-3"> {{-- FORM busca GET --}}
            <div class="col-md-3">
                <label for="search_type" class="form-label">Buscar por:</label>
                <select class="form-select" name="search_type" id="search_type"> {{-- SELECT tipo busca --}}
                    <option value="name" {{ request('search_type') == 'name' || !request('search_type') ? 'selected' : '' }}>Nome</option>
                    <option value="description" {{ request('search_type') == 'description' ? 'selected' : '' }}>Descrição</option> {{-- BUSCA na descrição --}}
                </select>
            </div>
            <div class="col-md-7">
                <label for="search" class="form-label">Termo de busca:</label>
                <div class="input-group">
                    <span class="input-group-text"> {{-- ÍCONE lupa --}}
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" name="search" id="search"
                           value="{{ request('search') }}" {{-- MANTÉM valor da busca --}}
                           placeholder="Digite o termo de busca...">
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label> {{-- LABEL vazia para alinhamento --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary"> {{-- BOTÃO buscar --}}
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

{{-- CONDICIONAL para busca (vazia) --}}
@if(request()->filled('search'))
    {{-- AQUI poderia mostrar "Resultados para X" --}}
@endif

{{-- LISTAGEM de categorias --}}
@if($categories->count() > 0) {{-- SE tem categorias --}}
    <div class="table-responsive"> {{-- TABELA responsiva --}}
        <table class="table table-striped table-hover border-0"> {{-- TABELA estilizada --}}
            <thead class="table-dark"> {{-- CABEÇALHO escuro --}}
                <tr>
                    <th class="border-0">ID</th>
                    <th class="border-0">Nome</th>
                    <th class="border-0">Descrição</th>
                    <th class="border-0">Livros</th> {{-- CONTAGEM de relacionamento --}}
                    <th class="border-0">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category) {{-- LOOP pelas categorias --}}
                <tr>
                    <td class="border-0">{{ $category->id }}</td>
                    <td class="border-0">{{ $category->name }}</td>
                    <td class="border-0">{{ $category->description ?? 'Sem descrição' }}</td> {{-- FALLBACK para descrição --}}
                    <td class="border-0">
                        <span class="badge bg-info">{{ $category->books_count }} livros</span> {{-- BADGE contagem livros --}}
                    </td>
                    <td class="border-0">
                        <div class="btn-group" role="group"> {{-- GRUPO de botões --}}
                            {{-- BOTÃO editar --}}
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> {{-- ÍCONE editar --}}
                            </a>
                            {{-- FORM deletar --}}
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                @csrf {{-- TOKEN segurança --}}
                                @method('DELETE') {{-- METHOD SPOOFING --}}
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Tem certeza que deseja excluir esta categoria?')"> {{-- CONFIRMAÇÃO JS --}}
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
    
@else {{-- SE não tem categorias --}}
    <div class="text-center py-5"> {{-- ESTADO vazio --}}
        <h4>Nenhuma categoria encontrada</h4>
        <p class="text-muted">Comece adicionando sua primeira categoria!</p>
        <a href="{{ route('categories.create') }}" class="btn btn-primary"> {{-- CALL TO ACTION --}}
            <i class="fas fa-plus"></i> Adicionar Categoria
        </a>
    </div]][´POIUYTREWQ @endif
=][´poiu 5y4tresaMJ,<Kbd></Kbd>endsection {{-- FIM do conteúdo --}