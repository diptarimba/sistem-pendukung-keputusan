@extends('layouts.page')

@section('tab-title', request()->routeIs('condition.create') ? 'Create Condition' : 'Update Condition')

@section('header-customer')

@endSection

@section('content')
    <x-breadcrumbs category="Condition" href="{{ route('condition.index') }}" current="index" />
    <x-cards.single back="{{ route('condition.index') }}">
        <x-slot name="header">
            <x-cards.header
                title="{{ request()->routeIs('condition.create') ? 'Create Condition' : 'Update Condition' }}" />
        </x-slot>
        <x-slot name="body">
            <form id="form"
                action="{{ request()->routeIs('condition.create') ? route('condition.store') : route('condition.update', @$condition->id) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <x-forms.put-method />
                <x-forms.input required="" label="Name" name="name" :value="@$condition->name" />
                <x-forms.input required="" label="Description" name="description" :value="@$condition->description" />
                <x-forms.input required="" label="Value" name="value" :value="@$condition->value" />
            </form>
            <button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
        </x-slot>
    </x-cards.single>
@endsection
