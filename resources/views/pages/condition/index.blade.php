@extends('layouts.page')

@section('tab-title', 'Condition')

@section('header')

@endSection

@section('content')
<x-breadcrumbs category="Condition" href="{{ route('condition.index') }}" current="index" /><x-cards.fullpage>
	<x-slot name="header">
		<x-cards.header title="Condition" />
		<a class="btn btn-primary" href="{{ route('condition.create') }}">Tambah Data</a>
	</x-slot>
	<x-slot name="body">
		<div class="table-responsive">
			<table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
				<thead>
					<th>No</th>
					<th>Name</th>
					<th>Description</th>
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
@section('content')
<script>
$(document).ready(() => {
	var table = $('.datatables-target-exec').DataTable({
		...{
		ajax: "{{ route('condition.index') }}",
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
				data: 'description',
				name: 'description'
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
@endsecttion
