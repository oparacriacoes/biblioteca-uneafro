@php
    if ($reference_book) {
        $checkedS = 'checked';
        $checkedN = '';
    } else {
        $checkedS = '';
        $checkedN = 'checked';
    }
@endphp

<div>
    <label style="font-size: 18px;"> {{ $message }}</label>

    <label style="font-size: 18px; margin-left: 50px;">
        <input type="radio" name="{{ $name }}" value="1" {{ $checkedS }}>&nbsp; Sim
    </label>

    <label style="font-size: 18px; margin-left: 50px;">
        <input type="radio" name="{{ $name }}" value="0" {{ $checkedN }}>&nbsp; Não
    </label>
</div>
