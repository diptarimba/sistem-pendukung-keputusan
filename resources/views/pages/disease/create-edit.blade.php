@extends('layouts.page')

@section('tab-title', request()->routeIs('disease.create') ? 'Create Disease' : 'Update Disease')

@section('header-customer')

@endSection

@section('content')
    <x-breadcrumbs category="Disease" href="{{ route('disease.index') }}" current="index" />
    <x-cards.single back="{{ route('disease.index') }}">
        <x-slot name="header">
            <x-cards.header title="{{ request()->routeIs('disease.create') ? 'Create Disease' : 'Update Disease' }}" />
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('disease.create') ? route('disease.store') : route('disease.update', @$disease->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <x-forms.put-method />
                <x-forms.input required="" label="Name" name="name" :value="@$Disease->name" />
                <x-forms.input required="" label="Determine" name="determine" :value="@$Disease->determine" />
                <x-forms.input required="" label="Suggestion" name="suggestion" :value="@$Disease->suggestion" />
                <x-forms.input required="" label="Image" name="image" :value="@$Disease->image" />
            </form>
            <button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
        </x-slot>
    </x-cards.single>
@endsection
