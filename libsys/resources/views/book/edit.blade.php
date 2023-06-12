@extends('layouts.app', ['page' => __('Editar Livro'), 'pageSlug' => 'edit_book'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-5 text-left">
                        <a href=" {{ route('book.index') }} " class="btn btn-sm btn-primary">Voltar</a>
                    </div>
                    <div class="col-7">
                        <h4 class="card-title">Editar Livro</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('book.update', serialize($book->id)) }}">
                    <div class="card-body">
                        @csrf
                        @method('put')
                        
                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Título do Livro',
                                'name' => 'title',
                                'maxLength' => 50,
                                'oldValue' => $book->title,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Autor',
                                'name' => 'author',
                                'maxLength' => 50,
                                'oldValue' => $book->author,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Editora',
                                'name' => 'book_publisher',
                                'maxLength' => 30,
                                'oldValue' => $book->book_publisher,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Edição',
                                'name' => 'edition',
                                'oldValue' => $book->edition,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Volume',
                                'name' => 'volume',
                                'oldValue' => $book->volume,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Ano',
                                'name' => 'year',
                                'oldValue' => $book->year,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Número de Cópias',
                                'name' => 'number_of_copies',
                                'oldValue' => $book->number_of_copies,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Número de Livros de Referência',
                                'name' => 'number_of_reference_book',
                                'oldValue' => $book->number_of_reference_book,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'ISBN',
                                'name' => 'ISBN',
                                'maxLength' => 13,
                                'oldValue' => $book->ISBN,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )
                    </div>
                    <div style="text-align: center;" class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
