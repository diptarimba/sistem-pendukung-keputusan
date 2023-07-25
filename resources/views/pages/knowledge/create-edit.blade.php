@extends('layouts.page')

@section('tab-title', request()->routeIs('knowledge.create') ? 'Create Knowledge' : 'Update Knowledge')

@section('header-customer')

@endSection

@section('content')
<x-breadcrumbs category="Knowledge" href="{{ route('knowledge.index') }}" current="index" />
<x-cards.single back="{{ route('knowledge.index') }}">
	<x-slot name="header">
		<x-cards.header title="{{ request()->routeIs('knowledge.create') ? 'Create Knowledge' : 'Update Knowledge' }}" />
	</x-slot>
	<x-slot name="body">
		<form id="form"
			action="{{ request()->routeIs('knowledge.create') ? route('knowledge.store') : route('knowledge.update', @$knowledge->id) }}"
			method="post" enctype="multipart/form-data">
			@csrf
			<x-forms.put-method />
			<x-forms.input required="" label="Measure of Belief" name="measure_of_belief" :value="@$Knowledge->measure_of_belief" />
			<x-forms.input required="" label="Measure of Disbelief" name="measure_of_disbelief" :value="@$Knowledge->measure_of_disbelief" />
			<x-forms.input required="" label="disease_id" name="disease_id" :value="@$Knowledge->disease_id" />
			<x-forms.input required="" label="symtom_id" name="symtom_id" :value="@$Knowledge->symtom_id" />
		</form>
		<button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
	</x-slot>
</x-cards.single>
@endsection
