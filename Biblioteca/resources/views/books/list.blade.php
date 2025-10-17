@extends('layouts.app') {{-- HERDA o layout base --}}

@section('title', 'Listagem de Livros') {{-- TÍTULO da página --}}

@section('content') {{-- INÍCIO do conteúdo --}}
<div class="d-flex justify-content-between align-items-center mb-4"> {{-- CABEÇALHO --}}
    <h2>📖 Listagem de Livros</h2> {{-- TÍTULO com emoji --}}
    <a href="{{ route('books.create') }}" class="btn btn-primary"> {{-- BOTÃO novo livro --}}
        <i class="fas fa-plus"></i> Novo Livro
    </a>
</div>

{{-- CARD de busca --}}
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('books.index') }}" class="row g-3"> {{-- FORM busca GET --}}
            <div class="col-md-3">
                <label for="search_type" class="form-label">Buscar por:</label>
                <select class="form-select" name="search_type" id="search_type"> {{-- SELECT tipo busca --}}
                    <option value="title" {{ request('search_type') == 'title' || !request('search_type') ? 'selected' : '' }}>Título</option>
                    <option value="isbn" {{ request('search_type') == 'isbn' ? 'selected' : '' }}>ISBN</option>
                    <option value="author" {{ request('search_type') == 'author' ? 'selected' : '' }}>Autor</option> {{-- BUSCA por relacionamento --}}
                    <option value="category" {{ request('search_type') == 'category' ? 'selected' : '' }}>Categoria</option> {{-- BUSCA por relacionamento --}}
                    <option value="publication_year" {{ request('search_type') == 'publication_year' ? 'selected' : '' }}>Ano de Publicação</option>
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

{{-- LISTAGEM de livros --}}
@if($books->count() > 0) {{-- SE tem livros --}}
    <div class="table-responsive"> {{-- TABELA responsiva --}}
        <table class="table table-striped table-hover border-0"> {{-- TABELA estilizada --}}
            <thead class="table-dark"> {{-- CABEÇALHO escuro --}}
                <tr>
                    <th class="border-0">ID</th>
                    <th class="border-0">Título</th>
                    <th class="border-0">ISBN</th>
                    <th class="border-0">Autor</th> {{-- COLUNA de relacionamento --}}
                    <th class="border-0">Categoria</th> {{-- COLUNA de relacionamento --}}
                    <th class="border-0">Ano</th>
                    <th class="border-0">Páginas</th>
                    <th class="border-0">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book) {{-- LOOP pelos livros --}}
                <tr>
                    <td class="border-0">{{ $book->id }}</td>
                    <td class="border-0">{{ $book->title }}</td>
                    <td class="border-0">{{ $book->isbn }}</td>
                    <td class="border-0">{{ $book->author->name }}</td> {{-- ACESSANDO relacionamento --}}
                    <td class="border-0">{{ $book->category->name }}</td> {{-- ACESSANDO relacionamento --}}
                    <td class="border-0">{{ $book->publication_year }}</td>
                    <td class="border-0">{{ $book->pages }}</td>
                    <td class="border-0">
                        <div class="btn-group" role="group"> {{-- GRUPO de botões --}}
                            {{-- BOTÃO editar --}}
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> {{-- ÍCONE editar --}}
                            </a>
                            {{-- FORM deletar --}}
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                                @csrf {{-- TOKEN segurança --}}
                                @method('DELETE') {{-- METHOD SPOOFING --}}
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Tem certeza que deseja excluir este livro?')"> {{-- CONFIRMAÇÃO JS --}}
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
    
    {{-- PAGINAÇÃO --}}
    <div class="d-flex justify-content-center"> {{-- CENTRALIZA paginação --}}
        {{ $books->links() }} {{-- LINKS de paginação do Laravel --}}
    </div>
@else {{-- SE não tem livros --}}
    <div class="text-center py-5"> {{-- ESTADO vazio --}}
        <h4>Nenhum livro encontrado</h4>
        <p class="text-muted">Comece adicionando seu primeiro livro!</p>
        <a href="{{ route('books.create') }}" class="btn btn-primary"> {{-- CALL TO ACTION --}}
            <i class="fas fa-plus"></i> Adicionar Livro
        </a>
    </div>
@endif
@endsection {{-- FIM do conteúdo --}}