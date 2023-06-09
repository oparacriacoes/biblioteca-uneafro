@if (!empty($label)) <label>{{ $label }}</label> @endif
<div class="input-group{{ $errors->has($name) ? ' has-danger' : '' }}">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
    <input
        type="{{ empty($type) ? 'text' : $type }}"
        name="{{ $name }}"
        class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}"
        placeholder="{{ empty($placeholder) ? $label : $placeholder }}"
        value="{{ empty($oldValue) ? old($name) : old($name, $oldValue) }}"
        @if (!empty($maxLength)) maxlength="{{ $maxLength }}" @endif
    >
    @include('components.alerts.feedback', ['field' => $name])
</div>
