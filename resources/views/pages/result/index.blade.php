@extends('layouts.page')

@section('tab-title', 'Result')

@section('header-custom')

@endSection

@section('content')
<x-breadcrumbs category="Result" href="{{ route('result.index') }}" current="index" /><x-cards.fullpage>
	<x-slot name="header">
		<x-cards.header title="Result" />
		{{-- <a class="btn btn-primary" href="{{ route('result.create') }}">Tambah Data</a> --}}
	</x-slot>
	<x-slot name="body">
		<div class="table-responsive">
			<table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
				<thead>
					<th>No</th>
					<th>Date</th>
					<th>Disease</th>
					<th>Symptom</th>
					<th>Value</th>
					<th>Action</th>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</x-slot>
</x-cards.fullpage>
<x-addon />
@endsection
@section('footer-custom')
<script>
$(document).ready(() => {
	var table = $('.datatables-target-exec').DataTable({
		...{
        @if (Auth::user())
		ajax: "{{ route('result.index') }}",
        @else
        ajax: "{{ route('guest.result.index') }}",
        @endif
		columns: [
			{
				data: 'DT_RowIndex',
				name: 'DT_RowIndex',
				sortable: false,
				orderable: false,
				searchable: false
			},
			{
				data: 'date',
				name: 'date'
			},
			{
				data: 'disease',
				name: 'disease'
			},
			{
				data: 'symptom',
				name: 'symptom'
			},
			{
				data: 'value',
				name: 'value'
			},
			{
				data: 'action',
				name: 'action',
				orderable: false,
				searchable: false
			},
		]
	}, ...optionDatatables});
})
</script>
@endsection
