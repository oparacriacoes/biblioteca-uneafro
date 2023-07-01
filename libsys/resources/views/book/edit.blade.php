@extends('layouts.app', ['page' => __('Editar Livro'), 'pageSlug' => 'edit_book'])

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('components.alerts.success', ['key' => 'success'])
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-5 text-left">
                        <a href=" {{ route('book.index') }} " class="btn btn-sm btn-primary">Voltar</a>
                    </div>
                    <div class="col-7">
                        <h4 class="card-title">Descrição do Livro</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 text-left">
                        @include('components.label', ['field' => 'Título', 'value' => $book['title']])
                    </div>
                    <div class="col-6 text-left">
                        @include('components.label', ['field' => 'ISBN', 'value' => $book['ISBN']])
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-left">
                        @include('components.label', ['field' => 'Autor', 'value' => $book['author']])
                    </div>
                    <div class="col-6 text-left">
                        @include('components.label', ['field' => 'Editora', 'value' => $book['book_publisher']])
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-left">
                        @include('components.label', ['field' => 'Edição', 'value' => $book['edition']])
                    </div>
                    <div class="col-3 text-left">
                        @include('components.label', ['field' => 'Volume', 'value' => $book['volume']])
                    </div>
                    <div class="col-3 text-left">
                        @include('components.label', ['field' => 'Ano', 'value' => $book['year']])
                    </div>
                </div>
                @include('components.label', ['field' => 'Número de Cópias', 'value' => $book['number_of_copies']])
                @include('components.label', ['field' => 'Acervos', 'value' => $book['bookCopies']])
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="text-align: center;">Editar Livro</h4>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('book.update', serialize($book['id'])) }}">
                    <div class="card-body">
                        @csrf
                        @method('put')
                        
                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Título do Livro',
                                'name' => 'title',
                                'maxLength' => 50,
                                'oldValue' => $book['title'],
                                'icon' => 'fa-regular fa-id-card'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Autor',
                                'name' => 'author',
                                'maxLength' => 50,
                                'oldValue' => $book['author'],
                                'icon' => 'fa-regular fa-id-card'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Editora',
                                'name' => 'book_publisher',
                                'maxLength' => 30,
                                'oldValue' => $book['book_publisher'],
                                'icon' => 'fa-regular fa-id-card'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Edição',
                                'name' => 'edition',
                                'oldValue' => $book['edition'],
                                'icon' => 'fa-regular fa-id-card'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Volume',
                                'name' => 'volume',
                                'oldValue' => $book['volume'],
                                'icon' => 'fa-regular fa-id-card'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Ano',
                                'name' => 'year',
                                'oldValue' => $book['year'],
                                'icon' => 'fa-regular fa-id-card'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'ISBN',
                                'name' => 'ISBN',
                                'maxLength' => 13,
                                'oldValue' => $book['ISBN'],
                                'icon' => 'fa-regular fa-id-card'
                            ]
                        )
                        <input type="hidden" id="idBookCopie" name="idBookCopie" value="{{ serialize($book['idBookCopie']) }}">
                    </div>
                    <div style="text-align: center;" class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">Salvar</button>
                    </div>
                </form>
            </div>
        </div>

        @include('book_copies.index', ['idBook' => $book['id']])

    </div>
</div>

@endsection
