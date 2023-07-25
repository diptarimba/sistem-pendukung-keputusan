@extends('layouts.page')

@section('tab-title', request()->routeIs('post.create') ? 'Create Post' : 'Update Post')

@section('header-custom')

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
                @if (isset($post->image))
                    <div class="col-6 mx-auto">
                        <x-forms.view-image label="Thumbnail" src="{{ asset($post->image) }}" />
                    </div>
                @endif
                <x-forms.put-method />
                <x-forms.file label="Change Thumbnail" name="image" id="gallery-photo-add" />
                <div class="gallery row row-cols-2 justify-content-center" id="isi-gallery"></div>
                <x-forms.input required="" label="Name" name="name" :value="@$post->name" />
                <x-forms.wysiwyg label="Determine" name="determine" :value="@$post->determine" />
                <x-forms.wysiwyg label="Suggestion" name="suggestion" :value="@$post->suggestion" />
            </form>
            <button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
        </x-slot>
    </x-cards.single>
@endsection
@section('footer-custom')
    <script src="{{ asset('assets/js/imageReview.js') }}"></script>
    <script>
        $('#gallery-photo-add').on('change', function() {
            imagesPreview(this, 'div.gallery');
        })

        $('#gallery-photo-add').on('click', function() {
            let parent = document.getElementById("isi-gallery")
            while (parent.firstChild) {
                parent.firstChild.remove()
            }
        })
    </script>
@endsection
