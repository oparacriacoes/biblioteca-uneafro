@if (!empty($label)) <label>{{ $label }}</label> @endif
@php
    $type = empty($type) ? 'text' : $type;
@endphp
<div class="input-group{{ $errors->has($name) ? ' has-danger' : '' }}">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}"
        placeholder="{{ empty($placeholder) ? $label : $placeholder }}"
        @if (!empty($type) && $type != 'password')
            value="{{ empty($oldValue) ? old($name) : old($name, $oldValue) }}"
        @endif
        @if (!empty($maxLength)) maxlength="{{ $maxLength }}" @endif
    >
    @include('components.alerts.feedback', ['field' => $name])
</div>
