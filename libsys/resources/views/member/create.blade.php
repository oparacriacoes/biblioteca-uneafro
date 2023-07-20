@extends('layouts.app', ['page' => __('Adicionar Membro'), 'pageSlug' => 'create_member'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-5 text-left">
                        <a href="{{ route('member.index') }}" class="btn btn-sm btn-primary">Voltar</a>
                    </div>
                    <div class="col-7">
                        <h4 class="card-title">Adicionar Membro</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('member.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Nome Completo',
                                        'placeholder' => 'Nome Completo',
                                        'name' => 'full_name',
                                        'maxLength' => 50,
                                        'icon' => 'fa-regular fa-user'
                                    ]
                                )
                            </div>
                            <div class="col-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Email',
                                        'placeholder' => 'Email',
                                        'name' => 'email',
                                        'maxLength' => 50,
                                        'icon' => 'fa-regular fa-envelope'
                                    ]
                                )
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-left">
                                @include(
                                    'components.select',
                                    [
                                        'id' => 'id_member_type',
                                        'label' => 'Tipo',
                                        'name' => 'id_member_type',
                                        'arrayValue' => $slMemberType,
                                        'icon' => 'fa-solid fa-graduation-cap'
                                    ]
                                )
                            </div>
                            <div class="col-3 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Telefone',
                                        'placeholder' => 'Telefone',
                                        'name' => 'phone',
                                        'maxLength' => 11,
                                        'icon' => 'fas fa-phone'
                                    ]
                                )
                            </div>
                            <div class="col-3 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'CPF',
                                        'placeholder' => 'CPF',
                                        'name' => 'cpf',
                                        'maxLength' => 11,
                                        'icon' => 'fa-regular fa-address-card'
                                    ]
                                )
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align: center;" >
                        <button type="submit" class="btn btn-primary btn-round btn-lg">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
