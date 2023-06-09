@extends('layouts.app', ['page' => __('Adicionar Usuário'), 'pageSlug' => 'create_user'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-5 text-left">
                        <a href=" {{ route('user.index') }} " class="btn btn-sm btn-primary">Voltar</a>
                    </div>
                    <div class="col-7">
                        <h4 class="card-title">Adicionar Usuário</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('user.store') }}">
                    @csrf
                    <div class="card-body">
                    @include(
                            'components.input',
                            [
                                'placeholder' => 'Nome',
                                'name' => 'name',
                                'maxLength' => 20,
                                'icon' => 'tim-icons icon-single-02'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Sobrenome',
                                'name' => 'last_name',
                                'maxLength' => 20,
                                'icon' => 'tim-icons icon-single-02'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'CPF',
                                'name' => 'cpf',
                                'maxLength' => 11,
                                'icon' => 'tim-icons icon-badge'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Email',
                                'name' => 'email',
                                'maxLength' => 50,
                                'icon' => 'tim-icons icon-email-85'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'type' => 'password',
                                'placeholder' => 'Senha',
                                'name' => 'password',
                                'icon' => 'tim-icons icon-lock-circle'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'type' => 'password',
                                'placeholder' => 'Confirmar Senha',
                                'name' => 'password_confirmation',
                                'icon' => 'tim-icons icon-lock-circle'
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
