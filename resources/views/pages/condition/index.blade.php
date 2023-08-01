@extends('layouts.page')

@section('tab-title', 'Condition')

@section('header-custom')

@endSection

@section('content')
<x-breadcrumbs category="Condition" href="{{ route('condition.index') }}" current="index" /><x-cards.fullpage>
	<x-slot name="header">
		<x-cards.header title="Condition" />
        @if (Auth::user())
		<a class="btn btn-primary" href="{{ route('condition.create') }}">Tambah Data</a>
        @endif
	</x-slot>
	<x-slot name="body">
		<div class="table-responsive">
			<table class="table table-centered table-nowrap mb-0 rounded datatables-target-exec" style="width: 100%">
				<thead>
					<th>No</th>
					<th>Name</th>
					<th>Description</th>
					<th>Value</th>
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
		ajax: "{{ route('condition.index') }}",
        @else
        ajax: "{{ route('guest.condition.index') }}",
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
				data: 'description',
				name: 'description'
			},
            {
				data: 'value',
				name: 'value'
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
