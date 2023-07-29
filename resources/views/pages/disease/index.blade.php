@extends('layouts.page')

@section('tab-title', 'Disease')

@section('header-custom')

@endSection

@section('content')
<x-breadcrumbs category="Disease" href="{{ route('disease.index') }}" current="index" /><x-cards.fullpage>
	<x-slot name="header">
		<x-cards.header title="Disease" />
        @if (Auth::user())
		<a class="btn btn-primary" href="{{ route('disease.create') }}">Tambah Data</a>
        @endif
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
        @if (Auth::user())
		ajax: "{{ route('disease.index') }}",
        @else
        ajax: "{{ route('guest.disease.index') }}",
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
				data: 'name',
				name: 'name'
			},
			{
				data: 'determine',
				name: 'determine',
                render: function(data) {
                    return data.length > 40 ? data.substr(0, 40) + '...' : data
                }
			},
			{
				data: 'suggestion',
				name: 'suggestion',
                render: function(data) {
                    return data.length > 40 ? data.substr(0, 40) + '...' : data
                }
			},
			{
				data: 'image',
				name: 'image',
                render: function(data){
                    return `<img src="${data}" style="max-height: 35px;"class="img-fluid"/>`
                }
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
