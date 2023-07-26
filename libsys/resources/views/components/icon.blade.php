@if (!empty($dataTarget))
    <a title="{{ $title }}" data-target="{{ $dataTarget }}" data-toggle="{{ $dataToggle }}">
@else
    <a title="{{ $title }}" href="{{ $route }}" @if (!empty($target)) target="{{ $target }}" @endif>
@endif
    <i class="{{ $icon }}"></i>
</a>
