@extends('layouts.page')

@section('tab-title', 'Diagnose')

@section('header-customer')

@endSection

@section('content')
    <x-breadcrumbs category="Diagnose" href="{{ route('guest.diagnose.create') }}" current="index" />
    <x-cards.single back="{{ route('guest.diagnose.create') }}">
    <x-slot name="header">
        <x-cards.header title="Diagnose Symptom" />
    </x-slot>
    <x-slot name="body">
        <form id="form" action="{{ route('guest.diagnose.post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @foreach ($symptom as $keySymp => $eachSymp)
                    <div class="mb-3 d-flex justify-content-between">
                        <label for="selectSymptom" class="flex-fill col-form-label">{{ $eachSymp }}</label>
                        <div class="flex-fill">
                            <select class="form-select" id="selectSymptom" name="symptom[{{ $keySymp }}]"
                                aria-label="Default select example">
                                <option value="" selected>Open this select menu</option>
                                @foreach ($condition as $eachCon )
                                    <option value="{{ $eachCon->value }}">{{ $eachCon->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
        <button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
    </x-slot>
    </x-cards.single>
@endsection
@section('footer-custom')
@endsection
