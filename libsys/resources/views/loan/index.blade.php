@extends('layouts.app', ['page' => __('Controle de Empréstimos'), 'pageSlug' => 'loan_control'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Controle de Empréstimos</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table tablesorter" id="">
                        <thead class="text-primary">
                            <tr>
                                <th> Membro </th>
                                <th> Tipo </th>
                                <th> Livro </th>
                                <th> ISBN </th>
                                <th> Data de Empréstimo </th>
                                <th> Data de Retorno </th>
                                <th>  </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                            <tr>
                                <td> {{ $loan->full_name }} </td>
                                <td> {{ $loan->type }} </td>
                                <td> {{ $loan->title }} </td>
                                <td> {{ $loan->ISBN }} </td>
                                <td> {{ $loan->date }} </td>
                                <td> {{ $loan->return_date }} </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#myModal">Devolve</a>
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
