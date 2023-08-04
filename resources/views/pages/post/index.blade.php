@extends('layouts.page')

@section('tab-title', 'Post')

@section('header-custom')

@endSection

@section('content')
    <x-breadcrumbs category="Post" href="{{ route('post.index') }}" current="index" /><x-cards.fullpage>
        <x-slot name="header">
            <x-cards.header title="{{__('page.Post')}}" />
            @if (Auth::user())
                <a class="btn btn-primary" href="{{ route('post.create') }}">Tambah Data</a>
            @endif
        </x-slot>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        {{-- <th>Determine</th>
                        <th>Suggestion</th> --}}
                        <th>Image</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-cards.fullpage>
    <x-addon />


    <!-- Modal Content -->
    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Terms of Service</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="content-image">

                    </div>
                    <p class="h3 fw-bold">Determine</p>
                    <div class="content-determine">

                    </div>
                    <p class="h3 fw-bold">Suggestion</p>
                    <div class="content-suggestion">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

@endsection
@section('footer-custom')
    <script>
        function fetchDataAndPopulateModal(apiUrl) {
            // Assuming the API endpoint on contoh.com is /api/terms-of-service
            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the modal title
                    $('#modal-default .modal-title').text(data.data.name);

                    // Update the modal body
                    $('#modal-default .content-image').html(`<img class="image-fluid" src="${data.data.image}">`);
                    $('#modal-default .content-determine').html('<p>' + data.data.determine + '</p>');
                    $('#modal-default .content-suggestion').html('<p>' + data.data.suggestion + '</p>');

                    $('#modal-default').modal('show');
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        $(document).ready(() => {

            // Function to fetch data from the API and populate the modal


            // Call the function when the button is clicked to trigger the modal
            $('.read-post').on('click', function() {
                var href = $(this).attr('href');
                console.log(href)
                // fetchDataAndPopulateModal(href);
            });

            var table = $('.datatables-target-exec').DataTable({
                ...{
                    @if (Auth::user())
                        ajax: "{{ route('post.index') }}",
                    @else
                        ajax: "{{ route('guest.post.index') }}",
                    @endif
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            sortable: false,
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        // {
                        //     data: 'determine',
                        //     name: 'determine',
                        //     render: function(data) {
                        //         return data.substr(0, 40) + '...'
                        //     }
                        // },
                        // {
                        //     data: 'suggestion',
                        //     name: 'suggestion',
                        //     render: function(data) {
                        //         return data.substr(0, 40) + '...'
                        //     }
                        // },
                        {
                            data: 'image',
                            name: 'image',
                            render: function(data, type, row) {
                                return `<img src="${data}" class="img-fluid" style="max-height: 60px;"/>`
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                },
                ...optionDatatables
            });
        })
    </script>
@endsection
