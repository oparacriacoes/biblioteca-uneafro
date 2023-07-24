@if (!empty($title))
    <a title="{{ $title }}" data-target="{{ $target }}" data-toggle="{{ $dataToggle }}">
@else
    <a href="{{ $route }}" @if (!empty($target)) target="{{ $target }}" @endif>
@endif
    <i class="{{ $icon }}"></i>
</a>
