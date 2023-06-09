@extends('layouts.app', ['page' => __('Perfil do Usuário'), 'pageSlug' => 'edit_user'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Editar Usuário</h5>
                </div>
                <form method="post" action="{{ route('user.update', ['user' => auth()->user()]) }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('components.alerts.success', ['key' => 'success'])
                        
                        @include(
                            'components.input',
                            [
                                'label' => 'Nome',
                                'name' => 'name',
                                'oldValue' => auth()->user()->name,
                                'maxLength' => 20,
                                'icon' => 'tim-icons icon-single-02'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'label' => 'Sobrenome',
                                'name' => 'last_name',
                                'oldValue' => auth()->user()->last_name,
                                'maxLength' => 20,
                                'icon' => 'tim-icons icon-single-02'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'label' => 'CPF',
                                'name' => 'cpf',
                                'oldValue' => auth()->user()->cpf,
                                'maxLength' => 11,
                                'icon' => 'tim-icons icon-badge'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'label' => 'Email',
                                'name' => 'email',
                                'oldValue' => auth()->user()->email,
                                'maxLength' => 50,
                                'icon' => 'tim-icons icon-email-85'
                            ]
                        )
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">Salvar</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">Alterar Senha</h5>
                </div>
                <form method="post" action="{{ route('user.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('components.alerts.success', ['key' => 'password_status'])
                        
                        @include(
                            'components.input',
                            [
                                'type' => 'password',
                                'label' => 'Senha Atual',
                                'name' => 'old_password',
                                'icon' => 'tim-icons icon-lock-circle'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'type' => 'password',
                                'label' => 'Nova Senha',
                                'name' => 'password',
                                'icon' => 'tim-icons icon-lock-circle'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'type' => 'password',
                                'label' => 'Confirmar Nova Senha',
                                'name' => 'password_confirmation',
                                'icon' => 'tim-icons icon-lock-circle'
                            ]
                        )
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">Alterar Senha</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="{{ asset('black') }}/img/emilyz.jpg" alt="">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>
                            <p class="description">
                                {{ __('Ceo/Co-Founder') }}
                            </p>
                        </div>
                    </p>
                    <div class="card-description">
                        {{ __('Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...') }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
