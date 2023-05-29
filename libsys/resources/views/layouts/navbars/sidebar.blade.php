<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('MP') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Menu Principal') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('dashboard') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#loan" aria-expanded="false">
                    <i class="tim-icons icon-notes"></i>
                    <span class="nav-link-text" >{{ __('Empréstimos') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse" id="loan">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'loan') class="active" @endif>
                            <a href="{{ route('loan.index') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('Controle de Empréstimos') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'loan') class="active" @endif>
                            <a href="{{ route('loan.index') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Realizar Empréstimo') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'book') class="active" @endif>
                <a href="{{ route('book.index') }}">
                    <i class="fas fa-book"></i>
                    <p>{{ __('Livros') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'member') class="active" @endif>
                <a href="{{ route('member.index') }}">
                    <i class="fas fa-users"></i>
                    <p>{{ __('Membros') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#users" aria-expanded="false">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('Usuário') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse" id="users">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'user_control') class="active" @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('Controle de Usuários') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'user_edit') class="active" @endif>
                            <a href="{{ route('user.edit')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Perfil') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                    <i class="fas fa-users"></i>
                    <p>{{ __('Sair') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
