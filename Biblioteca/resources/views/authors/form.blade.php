@extends('layouts.app') {{-- HERDA o layout principal --}}

@section('title', isset($author) ? 'Editar Autor' : 'Novo Autor') {{-- TÍTULO DINÂMICO da página --}}

@section('content') {{-- INÍCIO da seção de conteúdo --}}
<div class="d-flex justify-content-between align-items-center mb-4"> {{-- CABEÇALHO com flexbox --}}
    <h2>{{ isset($author) ? '👤 Editar Autor' : '👤 Novo Autor' }}</h2> {{-- TÍTULO contextual --}}
    <a href="{{ route('authors.index') }}" class="btn btn-secondary"> {{-- BOTÃO voltar --}}
        <i class="fas fa-arrow-left"></i> Voltar {{-- ÍCONE font awesome --}}
    </a>
</div>

<div class="card"> {{-- CARD principal --}}
    <div class="card-body"> {{-- CORPO do card --}}
        {{-- FORMULÁRIO dinâmico: UPDATE se existir author, CREATE se não --}}
        <form action="{{ isset($author) ? route('authors.update', $author) : route('authors.store') }}" method="POST">
            @csrf {{-- TOKEN de segurança CSRF --}}
            @if(isset($author))
                @method('PUT') {{-- METHOD SPOOFING para simular PUT --}}
            @endif
            
            {{-- CAMPO NOME (obrigatório) --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $author->name ?? '') }}" required>
                {{-- VALIDAÇÃO: mostra erro se houver --}}
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- GRID  com 2 colunas --}}
            <div class="row">
                <div class="col-md-6"> {{-- COLUNA nacionalidade --}}
                    <div class="mb-3">
                        <label for="nationality" class="form-label">Nacionalidade</label>
                        <input type="text" class="form-control @error('nationality') is-invalid @enderror" 
                               id="nationality" name="nationality" value="{{ old('nationality', $author->nationality ?? '') }}">
                        @error('nationality')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6"> {{-- COLUNA data nascimento --}}
                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Data de Nascimento</label>
                        {{-- INPUT date com formatação Y-m-d --}}
                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                               id="birth_date" name="birth_date" 
                               value="{{ old('birth_date', $author->birth_date ? $author->birth_date->format('Y-m-d') : '') }}">
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            {{-- CAMPO biografia (textarea) --}}
            <div class="mb-3">
                <label for="biography" class="form-label">Biografia</label>
                <textarea class="form-control @error('biography') is-invalid @enderror" 
                          id="biography" name="biography" rows="4">{{ old('biography', $author->biography ?? '') }}</textarea>
                @error('biography')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- BOTÕES de ação alinhados à direita --}}
            <div class="d-flex justify-content-end gap-2"> {{-- FLEX com espaçamento --}}
                <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a> {{-- CANCELAR --}}
                <button type="submit" class="btn btn-primary"> {{-- SUBMIT dinâmico --}}
                    <i class="fas fa-save"></i> {{ isset($author) ? 'Atualizar' : 'Salvar' }} {{-- TEXTO contextual --}}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection {{-- FIM da seção de conteúdo --}}