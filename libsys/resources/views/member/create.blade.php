@extends('layouts.app', ['page' => __('Adicionar Membro'), 'pageSlug' => 'create_member'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-5 text-left">
                        <a href=" {{ route('member.index') }} " class="btn btn-sm btn-primary">Voltar</a>
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
                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Nome Completo',
                                'name' => 'full_name',
                                'maxLength' => 50,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.select',
                            [
                                'name' => 'id_member_type',
                                'slMemberType' => $slMemberType,
                                'icon' => 'fa-solid fa-graduation-cap'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Email',
                                'name' => 'email',
                                'maxLength' => 50,
                                'icon' => 'fa-regular fa-envelope'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Telefone',
                                'name' => 'phone',
                                'maxLength' => 11,
                                'icon' => 'fas fa-phone'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'CPF',
                                'name' => 'cpf',
                                'maxLength' => 11,
                                'icon' => 'fa-regular fa-address-card'
                            ]
                        )
                    </div>
                    <div style="text-align: center;" class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
