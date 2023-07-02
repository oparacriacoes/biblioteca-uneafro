@extends('layouts.app', ['page' => __('Controle de Empréstimos'), 'pageSlug' => 'loan_control'])

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('components.alerts.success', ['key' => 'success'])
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Controle de Empréstimos</h4>
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
