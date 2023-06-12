@extends('layouts.app', ['page' => __('Livros'), 'pageSlug' => 'book_control'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                @include('components.alerts.success', ['key' => 'success'])
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">Livros</h4>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('book.create') }}" class="btn btn-sm btn-primary">Adicionar Livro</a>
                        <a href="#" class="btn btn-sm btn-primary">Importar Livros</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.table', ['arrayHeader' => $arrayHeader, 'arrayData' => $arrayData])
            </div>
        </div>
    </div>
</div>
@endsection
