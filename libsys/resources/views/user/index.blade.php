@extends('layouts.app', ['page' => __('Controle de Usuários'), 'pageSlug' => 'user_control'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @include('components.alerts.success', ['key' => 'success'])
                <div class="row">
                    <div class="col-4">
                        <h4 class="card-title">Controle de Usuários</h4>
                    </div>
                    <div class="col-8 text-right">
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
