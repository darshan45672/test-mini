@php $editing = isset($activity) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="student_id" label="Student" required>
            @php $selected = old('student_id', ($editing ? $activity->student_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Student</option>
            @foreach($students as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="activity_type_id" label="Activity Type" required>
            @php $selected = old('activity_type_id', ($editing ? $activity->activity_type_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Activity Type</option>
            @foreach($activityTypes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.partials.label
            name="activityreport"
            label="Activityreport"
        ></x-inputs.partials.label
        ><br />

        <input
            type="file"
            name="activityreport"
            id="activityreport"
            class="form-control-file"
        />

        @if($editing && $activity->activityreport)
        <div class="mt-2">
            <a
                href="{{ \Storage::url($activity->activityreport) }}"
                target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('activityreport')
        @include('components.inputs.partials.error') @enderror
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.partials.label
            name="certificate"
            label="Certificate"
        ></x-inputs.partials.label
        ><br />

        <input
            type="file"
            name="certificate"
            id="certificate"
            class="form-control-file"
        />

        @if($editing && $activity->certificate)
        <div class="mt-2">
            <a
                href="{{ \Storage::url($activity->certificate) }}"
                target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('certificate')
        @include('components.inputs.partials.error') @enderror
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="duration"
            label="Duration"
            :value="old('duration', '')"
            maxlength="255"
            placeholder="Duration"
        ></x-inputs.text>
    </x-inputs.group>

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
</div>
