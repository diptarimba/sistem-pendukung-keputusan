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
                @if (isset($disease->image))
                    <div class="col-6 mx-auto">
                        <x-forms.view-image label="Thumbnail" src="{{ asset($disease->image) }}" />
                    </div>
                @endif
                <x-forms.put-method />
                <x-forms.file label="Change Thumbnail" name="image" id="gallery-photo-add" />
                <div class="gallery row row-cols-2 justify-content-center" id="isi-gallery"></div>
                <x-forms.put-method />
                <x-forms.input required="" label="Name" name="name" :value="@$disease->name" />
                <x-forms.input required="" label="Determine" name="determine" :value="@$disease->determine" />
                <x-forms.input required="" label="Suggestion" name="suggestion" :value="@$disease->suggestion" />
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
