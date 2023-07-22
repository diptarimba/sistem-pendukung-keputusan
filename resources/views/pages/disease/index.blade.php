@extends('layouts.page')

@section('tab-title', 'Disease')

@section('header-custom')

@endSection

@section('content')
<x-breadcrumbs category="Disease" href="{{ route('disease.index') }}" current="index" /><x-cards.fullpage>
	<x-slot name="header">
		<x-cards.header title="Disease" />
		<a class="btn btn-primary" href="{{ route('disease.create') }}">Tambah Data</a>
	</x-slot>
	<x-slot name="body">
		<div class="table-responsive">
			<table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
				<thead>
					<th>No</th>
					<th>Name</th>
					<th>Determine</th>
					<th>Suggestion</th>
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
@endsection
@section('footer-custom')
<script>
$(document).ready(() => {
	var table = $('.datatables-target-exec').DataTable({
		...{
		ajax: "{{ route('disease.index') }}",
		columns: [
			{
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
			{
				data: 'determine',
				name: 'determine'
			},
			{
				data: 'suggestion',
				name: 'suggestion'
			},
			{
				data: 'image',
				name: 'image'
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
