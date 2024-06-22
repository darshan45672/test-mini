@php $editing = isset($activityType) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', '')"
            maxlength="255"
            placeholder="Title"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="description"
            label="Description"
            :value="old('description', '')"
            maxlength="255"
            placeholder="Description"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="credits"
            label="Credits"
            :value="old('credits', '')"
            max="255"
            step="1"
            placeholder="Credits"
        ></x-inputs.number>
    </x-inputs.group>
</div>
