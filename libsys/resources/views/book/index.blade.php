@extends('layouts.app', ['page' => __('Livros'), 'pageSlug' => 'book'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Livros</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a data-target="#add" data-toggle="modal" class="btn btn-sm btn-primary">Adicionar Livro</a>
                        <a data-target="#import" data-toggle="modal" class="btn btn-sm btn-primary">Importar Livro</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table tablesorter" id="">
                        <thead class="text-primary">
                            <tr>
                                <th> Título </th>
                                <th> Autor </th>
                                <th> Editora </th>
                                <th> Ano </th>
                                <th> Edição </th>
                                <th> ISBN </th>
                                <th> Número de Cópias </th>
                                <th> Número de Livros de Referência </th>
                                <th>  </th>
                                <th>  </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <td> {{ $book->title }} </td>
                                <td> {{ $book->author }} </td>
                                <td> {{ $book->book_publisher }} </td>
                                <td> {{ $book->year }} </td>
                                <td> {{ $book->edition }} </td>
                                <td> {{ $book->ISBN }} </td>
                                <td> {{ $book->number_of_copies }} </td>
                                <td> {{ $book->number_of_reference_book }} </td>
                                <td>
                                    <a title="Editar" href="#" data-toggle="modal" data-target="#myModal">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a title="Excluir" href="#" data-toggle="modal" data-target="#myModal">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
