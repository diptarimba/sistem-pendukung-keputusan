@extends('layouts.page')

@section('tab-title', 'Knowledge')

@section('header-custom')

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
					<th>Disease</th>
					<th>Symptom</th>
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
				data: 'disease.name',
				name: 'disease.name'
			},
			{
				data: 'symptom.name',
				name: 'symptom.name'
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
