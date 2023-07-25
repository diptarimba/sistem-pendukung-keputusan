@extends('layouts.page')

@section('tab-title', request()->routeIs('result.create') ? 'Create Result' : 'Update Result')

@section('header-customer')

@endSection

@section('content')
<x-breadcrumbs category="Result" href="{{ route('result.index') }}" current="index" />
<x-cards.single back="{{ route('result.index') }}">
	<x-slot name="header">
		<x-cards.header title="{{ request()->routeIs('result.create') ? 'Create Result' : 'Update Result' }}" />
	</x-slot>
	<x-slot name="body">
		<form id="form"
			action="{{ request()->routeIs('result.create') ? route('result.store') : route('result.update', @$result->id) }}"
			method="post" enctype="multipart/form-data">
			@csrf
			<x-forms.put-method />
			<x-forms.input required="" label="Date" name="date" :value="@$Result->date" />
			<x-forms.input required="" label="Disease" name="disease" :value="@$Result->disease" />
			<x-forms.input required="" label="Symptom" name="symptom" :value="@$Result->symptom" />
			<x-forms.input required="" label="Value" name="value" :value="@$Result->value" />
			<x-forms.input required="" label="Nama" name="name" :value="@$result->name" />
		</form>
		<button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
	</x-slot>
</x-cards.single>
@endsection
