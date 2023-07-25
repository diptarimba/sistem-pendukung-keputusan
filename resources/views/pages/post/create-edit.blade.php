@extends('layouts.page')

@section('tab-title', request()->routeIs('post.create') ? 'Create Post' : 'Update Post')

@section('header-customer')

@endSection

@section('content')
<x-breadcrumbs category="Post" href="{{ route('post.index') }}" current="index" />
<x-cards.single back="{{ route('post.index') }}">
	<x-slot name="header">
		<x-cards.header title="{{ request()->routeIs('post.create') ? 'Create Post' : 'Update Post' }}" />
	</x-slot>
	<x-slot name="body">
		<form id="form"
			action="{{ request()->routeIs('post.create') ? route('post.store') : route('post.update', @$post->id) }}"
			method="post" enctype="multipart/form-data">
			@csrf
			<x-forms.put-method />
			<x-forms.input required="" label="Name" name="name" :value="@$Post->name" />
			<x-forms.input required="" label="Image" name="image" :value="@$Post->image" />
		</form>
		<button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
	</x-slot>
</x-cards.single>
@endsection
