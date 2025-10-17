@extends('layouts.app') {{-- HERDA o layout principal --}}

@section('title', isset($category) ? 'Editar Categoria' : 'Nova Categoria') {{-- TÍTULO dinâmico --}}

@section('content') {{-- INÍCIO do conteúdo --}}
<div class="d-flex justify-content-between align-items-center mb-4"> {{-- CABEÇALHO --}}
    <h2>{{ isset($category) ? '🏷️ Editar Categoria' : '🏷️ Nova Categoria' }}</h2> {{-- TÍTULO com emoji --}}
    <a href="{{ route('categories.index') }}" class="btn btn-secondary"> {{-- BOTÃO voltar --}}
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="card"> {{-- CARD principal --}}
    <div class="card-body"> {{-- CORPO do card --}}
        {{-- FORMULÁRIO dinâmico para criar/editar --}}
        <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST">
            @csrf {{-- TOKEN de segurança --}}
            @if(isset($category))
                @method('PUT') {{-- METHOD SPOOFING para edição --}}
            @endif
            
            {{-- CAMPO nome (único campo obrigatório) --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required> {{-- REQUIRED --}}
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div> {{-- FEEDBACK erro --}}
                @enderror
            </div>
            
            {{-- CAMPO descrição (opcional) --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4">{{ old('description', $category->description ?? '') }}</textarea> {{-- TEXTAREA --}}
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- BOTÕES de ação --}}
            <div class="d-flex justify-content-end gap-2"> {{-- ALINHADO à direita --}}
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a> {{-- CANCELAR --}}
                <button type="submit" class="btn btn-primary"> {{-- SUBMIT --}}
                    <i class="fas fa-save"></i> {{ isset($category) ? 'Atualizar' : 'Salvar' }} {{-- TEXTO dinâmico --}}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection {{-- FIM do conteúdo --}}