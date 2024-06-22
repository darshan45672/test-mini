@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('colleges.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.colleges.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.colleges.inputs.name')</h5>
                    <span>{{ $college->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.colleges.inputs.code')</h5>
                    <span>{{ $college->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.colleges.inputs.email')</h5>
                    <span>{{ $college->email ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.colleges.inputs.website')</h5>
                    <span>{{ $college->website ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.colleges.inputs.address')</h5>
                    <span>{{ $college->address ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('colleges.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\College::class)
                <a href="{{ route('colleges.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
