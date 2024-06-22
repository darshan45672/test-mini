@php $editing = isset($department) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', '')"
            maxlength="255"
            placeholder="Name"
        ></x-inputs.text>
    </x-inputs.group>
</div>
