@extends('layouts.app', ['page' => __('Controle de Usuários'), 'pageSlug' => 'user_control'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">Controle de Usuários</h4>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" class="btn btn-sm btn-primary">Adicionar Usuário</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table tablesorter" id="">
                        <thead class="text-primary">
                            <tr>
                                <th> Nome </th>
                                <th> Sobrenome </th>
                                <th> CPF </th>
                                <th> Email </th>
                                <th>  </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->last_name }} </td>
                                <td> {{ $user->cpf }} </td>
                                <td> {{ $user->email }} </td>
                                <td>
                                    <a title="Deletar Usuário" href="#" data-toggle="modal" data-target="#myModal">
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
