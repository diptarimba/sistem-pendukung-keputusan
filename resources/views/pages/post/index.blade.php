@extends('layouts.page')

@section('tab-title', 'Post')

@section('header-custom')

@endSection

@section('content')
<x-breadcrumbs category="Post" href="{{ route('post.index') }}" current="index" /><x-cards.fullpage>
	<x-slot name="header">
		<x-cards.header title="Post" />
		<a class="btn btn-primary" href="{{ route('post.create') }}">Tambah Data</a>
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
		ajax: "{{ route('post.index') }}",
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
                render: function(data){
                    return data.substr(0,40) + '...'
                }
			},
			{
				data: 'suggestion',
				name: 'suggestion',
                render: function(data){
                    return data.substr(0,40) + '...'
                }
			},
			{
				data: 'image',
				name: 'image',
                render: function(data, type, row){
                    return `<img src="${data}" class="img-fluid"/>`
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
