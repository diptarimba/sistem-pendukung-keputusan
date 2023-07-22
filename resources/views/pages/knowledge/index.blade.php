@extends('layouts.page')

@section('tab-title', 'Knowledge')

@section('header')

@endSection

@section('content')
<x-breadcrumbs category="Knowledge" href="{{ route('knowledge.index') }}" current="index" /><x-cards.fullpage>
	<x-slot name="header">
		<x-cards.header title="Knowledge" />
		<a class="btn btn-primary" href="{{ route('knowledge.create') }}">Tambah Data</a>
	</x-slot>
	<x-slot name="body">
		<div class="table-responsive">
			<table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
				<thead>
					<th>No</th>
					<th>Measure of Belief</th>
					<th>Measure of Disbelief</th>
					<th>disease_id</th>
					<th>symtom_id</th>
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
		ajax: "{{ route('knowledge.index') }}",
		columns: [
			{
				data: 'DT_RowIndex',
				name: 'DT_RowIndex',
				sortable: false,
				orderable: false,
				searchable: false
			},
			{
				data: 'measure_of_belief',
				name: 'measure_of_belief'
			},
			{
				data: 'measure_of_disbelief',
				name: 'measure_of_disbelief'
			},
			{
				data: 'disease_id',
				name: 'disease_id'
			},
			{
				data: 'symtom_id',
				name: 'symtom_id'
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
