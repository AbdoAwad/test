@push('css')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<style>
	td.details-control {
		background: url('{{ asset('dashboard/images/details_open.png') }}') no-repeat center center;
		cursor: pointer;
	}
	tr.shown td.details-control {
		background: url('{{ asset('dashboard/images/details_close.png') }}') no-repeat center center;
	}
	.dataTables_wrapper > .row > div {
		width: 100%;
	}
</style>
@endpush

@push('js')
<script src="{{ asset('dashboard/bundles/dataTables.bundle.js') }}"></script>
@endpush