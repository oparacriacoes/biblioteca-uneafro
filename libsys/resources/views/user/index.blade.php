@extends('layouts.app', ['page' => __('Controle de Usuários'), 'pageSlug' => 'user_control'])

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('components.alerts.success', ['key' => 'success'])
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <h4 class="card-title">Controle de Usuários</h4>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-10">
                        @include(
                            'components.input',
                            [
                                'name' => 'searchInput',
                                'placeholder' => 'Pesquisar Usuário',
                                'icon' => 'fa-solid fa-magnifying-glass'
                            ]
                        )
                    </div>
                    <div class="col-2 text-right">
                        <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Adicionar Usuário</a>
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
