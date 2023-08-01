@extends('layouts.page')

@section('tab-title', 'Result')

@section('header-custom')

@endSection

@section('content')
    <x-breadcrumbs category="Result" href="{{ route('result.index') }}" current="index" />
    <div class="row">
        <div class="col-12 col-lg-6 my-2">
            <div class="card border-0 shadow">
                <div class="card-header border-gray-100 d-flex justify-content-between align-items-center">
                    Disease diagnosis result
                </div>
                <div class="card-body">
                    $name / {{ $value }} ({{ $percentage }}%)
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 my-2">
            <div class="card border-0 shadow">
                <div class="row">
                    <div class="col-lg-4 col-12 d-flex align-items-center justify-content-end">
                        <!-- Add 'd-flex align-items-center' here -->
                        <img src="{{ $image }}" class="img-fluid pt-2 rounded">
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <h5 class="card-title">{{ $name }}</h5>
                            <p class="card-text">{{ $determine }}</p>
                            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6 col-12"> <x-cards.fullpage>
                <x-slot name="header">
                    <x-cards.header title="Disease" />
                </x-slot>
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded datatables-target-disease"
                            style="width: 100%">
                            <caption>Disease</caption>
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Value</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </x-slot>
            </x-cards.fullpage></div>
        <div class="col-md-6 col-12"><x-cards.fullpage>
                <x-slot name="header">
                    <x-cards.header title="Symptom" />
                </x-slot>
                <x-slot name="body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded datatables-target-symptom"
                            style="width: 100%">
                            <caption>Symptom</caption>
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Condition</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </x-slot>
            </x-cards.fullpage></div>
    </div>


    <x-addon />
@endsection
@section('footer-custom')
    <script>
        $(document).ready(() => {
            var table = $('.datatables-target-symptom').DataTable({
                ...{
                    ajax: "{{ route('guest.result.edit', ['symptom_list' => true, 'result' => $result->id]) }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            sortable: false,
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'symptom.name',
                            name: 'symptom.name'
                        },
                        {
                            data: 'condition.name',
                            name: 'condition.name'
                        }
                    ]
                },
                ...optionDatatables
            });
        })

        $(document).ready(() => {
            var table = $('.datatables-target-disease').DataTable({
                ...{
                    ajax: "{{ route('guest.result.edit', ['disease_list' => true, 'result' => $result->id]) }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            sortable: false,
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'disease.name',
                            name: 'disease.name'
                        },
                        {
                            data: 'value',
                            name: 'value'
                        }
                    ]
                },
                ...optionDatatables
            });
        })
    </script>
@endsection
