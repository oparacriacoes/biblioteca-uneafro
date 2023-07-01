@extends('layouts.app', ['page' => __('Editar Membro'), 'pageSlug' => 'edit_member'])

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
                        <h4 class="card-title">Editar Membro</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('member.update', serialize($member->id)) }}">
                    <div class="card-body">
                        @csrf
                        @method('put')
                        
                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Nome Completo',
                                'name' => 'full_name',
                                'maxLength' => 50,
                                'oldValue' => $member->full_name,
                                'icon' => 'fa-regular fa-user'
                            ]
                        )

                        @include(
                            'components.select',
                            [
                                'name' => 'id_member_type',
                                'slMemberType' => $slMemberType,
                                'oldValue' => $member->id_member_type,
                                'icon' => 'fa-solid fa-graduation-cap'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Email',
                                'name' => 'email',
                                'maxLength' => 50,
                                'oldValue' => $member->email,
                                'icon' => 'fa-regular fa-envelope'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'Telefone',
                                'name' => 'phone',
                                'maxLength' => 11,
                                'oldValue' => $member->phone,
                                'icon' => 'fas fa-phone'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'placeholder' => 'CPF',
                                'name' => 'cpf',
                                'maxLength' => 11,
                                'oldValue' => $member->cpf,
                                'icon' => 'fa-regular fa-address-card'
                            ]
                        )
                    </div>
                    <div style="text-align: center;" class="card-footer">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
