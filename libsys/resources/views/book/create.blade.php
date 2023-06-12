@extends('layouts.app', ['page' => __('Adicionar Livro'), 'pageSlug' => 'create_book'])

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
                        <h4 class="card-title">Adicionar Livro</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('book.store') }}">
                    @csrf
                    <div class="card-body">
                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Título do Livro',
                                'name' => 'title',
                                'maxLength' => 50,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Autor',
                                'name' => 'author',
                                'maxLength' => 50,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Editora',
                                'name' => 'book_publisher',
                                'maxLength' => 30,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Edição',
                                'name' => 'edition',
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Volume',
                                'name' => 'volume',
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Ano',
                                'name' => 'year',
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Número de Cópias',
                                'name' => 'number_of_copies',
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Número de Livros de Referência',
                                'name' => 'number_of_reference_book',
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'ISBN',
                                'name' => 'ISBN',
                                'maxLength' => 13,
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
