@extends('layouts.page')

@section('tab-title', request()->routeIs('category.create') ? 'Create Category' : 'Update Category')

@section('header-customer')

@endSection

@section('content')
<x-breadcrumbs category="Category" href="{{ route('category.index') }}" current="index" />
<x-cards.single back="{{ route('category.index') }}">
	<x-slot name="header">
		<x-cards.header title="{{ request()->routeIs('category.create') ? 'Create Category' : 'Update Category' }}" />
	</x-slot>
	<x-slot name="body">
		<form id="form"
			action="{{ request()->routeIs('category.create') ? route('category.store') : route('category.update', @$category->id) }}"
			method="post" enctype="multipart/form-data">
			@csrf
			<x-forms.put-method />
			<x-forms.input required="" label="Name" name="name" :value="@$category->name" />
		</form>
		<button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
	</x-slot>
</x-cards.single>
@endsection
