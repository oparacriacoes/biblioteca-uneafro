@extends('layouts.app', ['page' => __('Membros'), 'pageSlug' => 'member'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">Membros</h4>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" class="btn btn-sm btn-primary">Adicionar Membro</a>
                        <a href="#" class="btn btn-sm btn-primary">Importar Membros</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table tablesorter" id="">
                        <thead class="text-primary">
                            <tr>
                                <th> Nome </th>
                                <th> Email </th>
                                <th> Telefone </th>
                                <th> Tipo </th>
                                <th>  </th>
                                <th>  </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                            <tr>
                                <td> {{ $member->full_name }} </td>
                                <td> {{ $member->email }} </td>
                                <td> {{ $member->phone }} </td>
                                <td> {{ $member->phone }} </td>
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
