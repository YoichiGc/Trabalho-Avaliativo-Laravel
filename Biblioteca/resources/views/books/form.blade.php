@extends('layouts.app') {{-- HERDA o layout principal --}}

@section('title', isset($book) ? 'Editar Livro' : 'Novo Livro') {{-- TÍTULO dinâmico --}}

@section('content') {{-- INÍCIO do conteúdo --}}
<div class="d-flex justify-content-between align-items-center mb-4"> {{-- CABEÇALHO --}}
    <h2>{{ isset($book) ? '📖 Editar Livro' : '📖 Novo Livro' }}</h2> {{-- TÍTULO com emoji --}}
    <a href="{{ route('books.index') }}" class="btn btn-secondary"> {{-- BOTÃO voltar --}}
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="card"> {{-- CARD principal --}}
    <div class="card-body"> {{-- CORPO do card --}}
        {{-- FORMULÁRIO dinâmico para criar/editar --}}
        <form action="{{ isset($book) ? route('books.update', $book) : route('books.store') }}" method="POST">
            @csrf {{-- TOKEN de segurança --}}
            @if(isset($book))
                @method('PUT') {{-- METHOD SPOOFING para edição --}}
            @endif
            
            {{-- PRIMEIRA LINHA: Título e ISBN --}}
            <div class="row">
                <div class="col-md-8"> {{-- COLUNA título (maior) --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Título *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $book->title ?? '') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4"> {{-- COLUNA ISBN (menor) --}}
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN *</label>
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                               id="isbn" name="isbn" value="{{ old('isbn', $book->isbn ?? '') }}" required>
                        @error('isbn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            {{-- SEGUNDA LINHA: Autor e Categoria --}}
            <div class="row">
                <div class="col-md-6"> {{-- SELECT autor --}}
                    <div class="mb-3">
                        <label for="author_id" class="form-label">Autor *</label>
                        <select class="form-select @error('author_id') is-invalid @enderror" 
                                id="author_id" name="author_id" required>
                            <option value="">Selecione um autor</option> {{-- PLACEHOLDER --}}
                            @foreach($authors as $author) {{-- LOOP autores --}}
                                <option value="{{ $author->id }}" 
                                        {{ old('author_id', $book->author_id ?? '') == $author->id ? 'selected' : '' }}> {{-- SELECTED dinâmico --}}
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6"> {{-- SELECT categoria --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoria *</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">Selecione uma categoria</option>
                            @foreach($categories as $category) {{-- LOOP categorias --}}
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            {{-- TERCEIRA LINHA: Ano e Páginas --}}
            <div class="row">
                <div class="col-md-4"> {{-- INPUT ano publicação --}}
                    <div class="mb-3">
                        <label for="publication_year" class="form-label">Ano de Publicação *</label>
                        <input type="number" class="form-control @error('publication_year') is-invalid @enderror" 
                               id="publication_year" name="publication_year" 
                               value="{{ old('publication_year', $book->publication_year ?? '') }}" 
                               min="1000" max="{{ date('Y') }}" required> {{-- VALIDAÇÃO min/max --}}
                        @error('publication_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-4"> {{-- INPUT número páginas --}}
                    <div class="mb-3">
                        <label for="pages" class="form-label">Número de Páginas *</label>
                        <input type="number" class="form-control @error('pages') is-invalid @enderror" 
                               id="pages" name="pages" value="{{ old('pages', $book->pages ?? '') }}" min="1" required> {{-- MÍNIMO 1 página --}}
                        @error('pages')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- COLUNA VAZIA para completar o grid --}}
            </div>
            
            {{-- TEXTAREA descrição --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4">{{ old('description', $book->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- BOTÕES de ação --}}
            <div class="d-flex justify-content-end gap-2"> {{-- ALINHADO à direita --}}
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a> {{-- CANCELAR --}}
                <button type="submit" class="btn btn-primary"> {{-- SUBMIT --}}
                    <i class="fas fa-save"></i> {{ isset($book) ? 'Atualizar' : 'Salvar' }} {{-- TEXTO dinâmico --}}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection {{-- FIM do conteúdo --}}