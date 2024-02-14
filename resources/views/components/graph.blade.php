
<!-- <div style="width: 500px;"><canvas id="dimensions"></canvas></div><br/> -->
<div class="container">
    <canvas id="visits"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- <script type="module" src="dimensions.js"></script> -->
@push('scripts')
    <script type="module" src="{{ asset('/js/visitsGraph.js') }}"></script>
@endpush
