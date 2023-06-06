@extends('layouts.app', ['page' => __('Controle de Usuários'), 'pageSlug' => 'user_control'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @include('alerts.success', ['key' => 'success'])
                <div class="row">
                    <div class="col-12 text-right">
                        <a href=" {{ route('user.create') }} " class="btn btn-sm btn-primary">Adicionar Usuário</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table tablesorter">
                        <thead class="text-primary">
                            <tr>
                                <th class="text-center">Usuário</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">CPF</th>
                                <th class="text-center">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="text-center"> {{ $user->name . ' ' . $user->last_name }} </td>
                                <td class="text-center"> {{ $user->email }} </td>
                                <td class="text-center"> {{ $user->cpf }} </td>
                                <td class="text-center">
                                    <a title="Excluir Usuário" data-target="#delete_user_{{ $user->id }}" data-toggle="modal">
                                        <i class="text-primary fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <div id="delete_user_{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header">
                                            <h5 class="modal-title mx-auto text-secondary" id="myModalLabel" style="font-size: 24px;">Excluir Usuário</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="form" method="post" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <div class="modal-body">
                                                <div class="alert alert-info">Você realmente deseja excluir o usuário?</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                                                <button type="submit" class="btn btn-danger" aria-hidden="true">Excluir</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
