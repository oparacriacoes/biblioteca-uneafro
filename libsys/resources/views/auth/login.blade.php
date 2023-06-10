@extends('layouts.app', ['class' => 'login-page', 'page' => __('Entrar'), 'contentClass' => 'login-page'])

@section('content')
    <div class="col-md-10 text-center ml-auto mr-auto">
        <h3 class="mb-5">Faça o login para acessar o sistema de gerenciamento da biblioteca.</h3>
    </div>
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <form class="form" method="post" action="{{ route('login') }}">
            @csrf

            <div class="card card-login card-white">
                <div class="card-header">
                    <img src="{{ asset('black') }}/img/card-primary.png" alt="">
                    <h1 class="card-title">Entrar</h1>
                </div>
                <div class="card-body">
                    <p class="text-dark mb-2">Digite seu email e a senha para entrar.</p>
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
                                'type' => 'password',
                                'placeholder' => 'Senha',
                                'name' => 'password',
                                'icon' => 'fa-solid fa-lock'
                            ]
                        )
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-lg btn-block mb-3">Confirmar</button>
                    <div class="pull-right">
                        <h6>
                            <a href="{{ route('password.request') }}" class="link footer-link">Esqueceu a senha?</a>
                        </h6>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
