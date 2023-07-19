@extends('layouts.app', ['page' => __('Realizar Empréstimo'), 'pageSlug' => 'make_loan'])

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('components.alerts.success', ['key' => 'success', 'alert' => 'alert'])
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12" style="text-align: center;">
                        <h4 class="card-title">Realizar Empréstimo</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('loan.store') }}">
                    @csrf
                    <div class="card-body">
                        @include(
                            'components.select',
                            [
                                'label' => 'Selecione o membro',
                                'name' => 'slMember',
                                'arrayValue' => $slMember,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.select',
                            [
                                'label' => 'Selecione o livro',
                                'name' => 'slBook',
                                'arrayValue' => $slBook,
                                'icon' => 'fa-solid fa-book'
                            ]
                        )
                    </div>
                    <div class="card-footer" style="text-align: center;">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
