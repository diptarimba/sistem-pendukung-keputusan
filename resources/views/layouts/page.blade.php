@extends('layouts.master')

@section('header')
    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="{{ asset('vendor/notyf/notyf.min.css') }}" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css') }}">

    <!-- Chartist -->
    {{-- <link type="text/css" href="{{asset('vendor/chartist/dist/chartist.min.css')}}" rel="stylesheet"> --}}
    {{-- <link type="text/css" href="{{asset('vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet"> --}}

    <!-- Datatables Bootstrap5 CSS -->
    <link type="text/css" href="{{ asset('css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    <!-- DatePicker BS5 -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">

    <style>
        @media screen and (max-width: 767px) {
            .dt-buttons {
                margin-bottom: 0.5rem !important;
                text-align: center !important;
            }
        }
    </style>

    @yield('header-custom')
@endsection

@section('body')

    @component('components.sidebar')
        <x-slot name="head">
            {{-- <x-sidebar.ProfileInfo src="{{ Auth::user()->avatar ?? '' }}" name="{!! Auth::user()->name ?? '' !!}" nameButton="Sign Out"
                linkButton="{{ route('logout.index') }}" /> --}}
            <x-sidebar.ProfileInfo src="{{ Auth::user()->avatar ?? '/storage/placeholder/avatar/default-profile.png' }}" auth="{{Auth::guard('web')->check()}}" name="{!! '' !!}" nameButton="Sign Out"
                linkButton="{{ route('logout.index') }}" />
        </x-slot>
    @endcomponent

    <main class="content">

        @component('components.topbar')
        @endcomponent

        @yield('breadcrumb')

        {{-- Success Alert --}}
        @if (session('success'))
            <x-alert type="success" msg="{{ session('success') }}" />
        @endif

        {{-- Error Alert --}}
        @if (session('error'))
            <x-alert type="danger" msg="{{ session('error') }}" />
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible show fade mt-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')

        @component('components.setting')
        @endcomponent

        @component('components.footer')
        @endcomponent

    </main>
@endsection

@section('footer')
    <!-- JQuery -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- OwlCarousel -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>

    <!-- Core -->
    <script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ asset('vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>

    <!-- Slider -->
    <script src="{{ asset('vendor/nouislider/dist/nouislider.min.js') }}"></script>

    <!-- Smooth scroll -->
    <script src="{{ asset('vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Charts -->
    {{-- <script src="{{ asset('vendor/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('vendor/chartist-plugin-tooltips/dist/chartist-plugin-zoom.min.js') }}"></script> --}}

    <script src="{{ asset('vendor/chartjs/chart.min.js') }}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>

    <!-- Datepicker -->
    <script src="{{ asset('assets/js/daterangepicker.min.js') }}"></script>

    <!-- Notyf -->
    <script src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>

    <!-- Simplebar -->
    <script src="{{ asset('vendor/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Github buttons -->
    <script async defer src="{{ asset('assets/js/buttons.js') }}"></script>

    <!-- Volt JS -->
    <script src="{{ asset('assets/js/volt.js') }}"></script>

    <!-- FontAwesome -->
    <script src="{{ asset('assets/js/fontawesome.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/fontawesome.regular.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables/buttons.print.min.js') }}"></script>

    {{-- Chartjs Export --}}
    <script src="{{ asset('assets/js/jspdf.umd.min.js') }}"></script>
    <script src="{{ asset('assets/js/html2canvas.min.js') }}"></script>

    <!-- Tiny Mce -->
    <script src="https://cdn.tiny.cloud/1/4zhsd4hgiodlc0ea2h5oq2j5vhbdzde8mrjd39amli6t3nas/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        function delete_data(identify) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $(`#${identify}`).submit();
                }
            })
        }
    </script>
    {{-- Colour --}}
    <script>
        var color = [
            [54, 162, 235],
            [255, 99, 132],
            [75, 192, 192],
            [153, 102, 255],
            [255, 206, 86]
        ];

        var selectedData = [];

        function getRandColor() {
            if (selectedData.length === color.length) {
                return null;
            }
            var randomIndex = Math.floor(Math.random() * color.length);
            while (selectedData.includes(randomIndex)) {
                randomIndex = Math.floor(Math.random() * color.length);
            }
            selectedData.push(randomIndex);
            return color[randomIndex];
        }
    </script>
    @stack('footer-carrier')
    @yield('footer-custom')
@endsection
