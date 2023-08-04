@extends('layouts.page')

@section('tab-title', request()->routeIs('symptom.create') ? 'Create Symptom' : 'Update Symptom')

@section('header-customer')

@endSection

@section('content')
    <x-breadcrumbs category="Symptom" href="{{ route('symptom.index') }}" current="index" />
    <x-cards.single back="{{ route('symptom.index') }}">
        <x-slot name="header">
            <x-cards.header title="{{ request()->routeIs('symptom.create') ? 'Create Symptom' : 'Update Symptom' }}" />
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('symptom.create') ? route('symptom.store') : route('symptom.update', @$symptom->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <x-forms.put-method />
                <x-forms.input required="" label="Name" name="name" :value="@$symptom->name" />
                <x-forms.select label="Symtpom Category" name="category_id" :items="$category" :value="@$symptom->category_id" />
            </form>
            <button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
        </x-slot>
    </x-cards.single>
@endsection
