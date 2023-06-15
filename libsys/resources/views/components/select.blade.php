@php
    $type = empty($oldValue) ? old($name) : old($name, $oldValue);
@endphp

<div class="input-group{{ $errors->has($name) ? ' has-danger' : '' }}">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
    <select name="{{ $name }}" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}">
        <option style="background-color: #344675;" value="">Selecione o tipo do membro</option>
        @foreach ($slMemberType as $memberType)
            <option style="background-color: #344675;"value="{{ $memberType['id'] }}" {{ $memberType['id'] == $type ? 'selected' : '' }}>
                {{ $memberType['type'] }}
            </option>
        @endforeach
    </select>
    @include('components.alerts.feedback', ['field' => $name])
</div>
