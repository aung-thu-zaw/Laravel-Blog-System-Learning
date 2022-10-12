@props(["name","value"=>""])
<x-form.input-wrapper>
    <x-form.label :name="$name" />
    <textarea class="form-control editor" name="{{ $name }}" id="{{ $name }}" cols="30" rows="10"
        value="{{ old($name,$value) }}">{!! $value !!}</textarea>
    <x-error name="{{ $name }}" />
</x-form.input-wrapper>
