@if (!empty($title))
    <a title="{{ $title }}" data-target="{{ $target }}" data-toggle="{{ $dataToggle }}">
@else
    <a href="{{ $route }}">
@endif
    <i class="{{ $icon }}"></i>
</a>
