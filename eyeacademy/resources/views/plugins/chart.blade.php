@push('css')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/charts-c3/c3.min.css') }}"/>
@endpush

@push('js')
<script src="{{ asset('dashboard/bundles/apexcharts.bundle.js') }}"></script>
<script src="{{ asset('dashboard/bundles/counterup.bundle.js') }}"></script>
<script src="{{ asset('dashboard/bundles/knobjs.bundle.js') }}"></script>
<script src="{{ asset('dashboard/bundles/c3.bundle.js') }}"></script>
<script src="{{ asset('dashboard/bundles/echarts.bundle.js') }}"></script>
<script src="{{ asset('dashboard/js/chart/c3.js') }}"></script>
<script src="{{ asset('dashboard/js/chart/echart.js') }}"></script>
<script src="{{ asset('dashboard/js/chart/apex.js') }}"></script>
@endpush