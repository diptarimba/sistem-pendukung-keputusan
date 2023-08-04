@extends('layouts.page')

@section('tab-title', 'Result')

@section('header-custom')

@endSection

@section('content')
    <x-breadcrumbs category="Result" href="{{ route('result.index') }}" current="index" />
    <button id="print-button" class="btn btn-secondary mb-2">Cetak Data</button>
    <div id="content-to-print">
        <div class="col-12 mb-3">
            <div class="card">
              <div class="card-body d-flex flex-wrap">
                <!-- Image on the left -->
                <div class="col-4 col-md-1 flex-fill">
                    <img src="{{ $image }}" class="rounded" alt="Image">
                </div>
                <div class="col-auto col-md-9 ms-2 flex-fill">
                  <!-- Title and description on the right -->
                  <h5 class="card-title">{{__('Disease diagnosis result')}}</h5>
                  <p class="card-text">{{$name}} / {{ $value }} ({{ $percentage }}%)</p>
                  <p class="card-text">{{ $determine }}</p>
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
        document.getElementById("print-button").addEventListener("click", function() {
            var contentToPrint = document.getElementById("content-to-print").innerHTML;
            var originalBody = document.body.innerHTML;
            document.body.innerHTML = contentToPrint;
            window.print();
            document.body.innerHTML = originalBody;
        });
    </script>
@endsection
