@extends('layouts.page')

@section('tab-title', 'Dashboard')

@section('header-custom')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <x-carousel :content="$slider" />
    <div class="row mt-3">
        <span class="slot-name h3"><strong>Insight Dashboard</strong></span>
        @foreach ($homeData as $each)
            <x-cards.home text="{{ $each['name'] }}" value="{{ $each['data'] }}"
                icon="{{$each['icon']}}" url="{!! $each['url'] !!}" />
        @endforeach
    </div>
@endsection

@section('footer-custom')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                width: 'resolve'
            });
        });
    </script>
@endsection
