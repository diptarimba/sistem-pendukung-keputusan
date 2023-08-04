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
                    @foreach ($symptom as $keySymptom => $eachSymptom)
                        <blockquote class="blockquote border-bottom shadow text-center">
                            <p class="h3">{{ $keySymptom }}</p>
                        </blockquote>
                        @foreach ($eachSymptom as $keySymp => $eachSymp)
                            <div class="mb-3 row">
                                <label for="selectSymptom" class="col-6 col-form-label">{{ $eachSymp }}</label>
                                <div class="col-6">
                                    <select class="form-select" id="selectSymptom_{{ $keySymp }}"
                                        name="symptom[{{ $keySymp }}][0]" aria-label="Default select example"
                                        onchange="updateHiddenInput(this)">
                                        <option value="" selected>Open this select menu</option>
                                        @foreach ($condition as $eachCon)
                                            <option value="{{ $eachCon->value }}" data-id="{{ $eachCon->id }}">
                                                {{ $eachCon->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" id="hiddenSymptom_{{ $keySymp }}"
                                        name="symptom[{{ $keySymp }}][1]" value="">
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                </div>
            </form>
            <button form="form" class="btn btn-outline-primary btn-pill">Submit</button>
        </x-slot>
    </x-cards.single>
@endsection
@section('footer-custom')
    <script>
        function updateHiddenInput(selectElement) {
            const hiddenInputId = 'hiddenSymptom_' + selectElement.name.match(/\d+/)[0];
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const selectedId = selectedOption.getAttribute('data-id');
            const hiddenInput = document.getElementById(hiddenInputId);
            hiddenInput.value = selectedId;
        }
    </script>
@endsection
