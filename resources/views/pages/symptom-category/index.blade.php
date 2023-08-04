@extends('layouts.page')

@section('tab-title', 'Category')

@section('header-custom')

@endSection

@section('content')
<x-breadcrumbs category="Category" href="{{ route('category.index') }}" current="index" /><x-cards.fullpage>
	<x-slot name="header">
		<x-cards.header title="Category" />
        @if (Auth::user())
		<a class="btn btn-primary" href="{{ route('category.create') }}">Tambah Data</a>
        @endif
	</x-slot>
	<x-slot name="body">
		<div class="table-responsive">
			<table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
				<thead>
					<th>No</th>
					<th>Name</th>
                    @if (Auth::guard('web')->check())
					<th>Action</th>
                    @endif
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
		ajax: "{{ route('category.index') }}",
        @else
        ajax: "{{ route('guest.category.index') }}",
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
            @if (Auth::guard('web')->check())
			{
				data: 'action',
				name: 'action',
				orderable: false,
				searchable: false
			},
            @endif
		]
	}, ...optionDatatables});
})
</script>
@endsection
