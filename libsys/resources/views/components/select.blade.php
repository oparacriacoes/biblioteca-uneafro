@php
    $defaultValue = empty($oldValue) ? old($name) : old($name, $oldValue);
@endphp

@if (!empty($label)) @include('components.label', ['label' => $label]) @endif
<div class="input-group{{ $errors->has($name) ? ' has-danger' : '' }}">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
    <select class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{ $name }}">
        <option style="background-color: #344675;" value="">{{ $message }}</option>
        @foreach ($arrayValue as $value)
        <option
            style="background-color: #344675;"
            value="{{ $value[$index] }}"
            {{ $value[$index] == $defaultValue ? 'selected' : '' }}
        >
            {{ $value[$key] }}
        </option>
        @endforeach
    </select>
    @include('components.alerts.feedback', ['field' => $name])
</div>
