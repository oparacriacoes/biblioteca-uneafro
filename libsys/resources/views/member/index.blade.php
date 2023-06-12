@extends('layouts.app', ['page' => __('Membros'), 'pageSlug' => 'member_control'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                @include('components.alerts.success', ['key' => 'success'])
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">Membros</h4>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('member.create') }}" class="btn btn-sm btn-primary">Adicionar Membro</a>
                        <a href="#" class="btn btn-sm btn-primary">Importar Membros</a>
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
