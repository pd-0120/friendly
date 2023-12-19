<div>
    <div class="row">
        {{-- <div class="col-md-3 form-group">
            <label for="">Date wise Filter</label>
            <select wire:model='dateFilter' class="form-control" x-on:change="$wire.filterData()">
                @foreach ($dateFilterOptions as $key => $dateFilterOption)
                    <option value="{{ $key }}">{{ $dateFilterOption }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="col-md-12"><div id="chart"></div></div>
    </div>
</div>

@push('js')
    <script>

        document.addEventListener('livewire:initialized', () => {
            var chart;
            const paidData = @json($paid);
            const unpaidData = @json($unpaid);

            var series = [{
                name: 'Paid',
                data: paidData
            }, {
                name: 'Unpaid',
                data: unpaidData
            }]

            setTimeout(() => {
                var options = {
                    series: series,
                    chart: {
                        type: 'bar',
                        height: 350,
                        id: 'paychart'
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: true
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: @json($label),
                    },
                    yaxis: {
                        title: {
                            text: '$ (Pay)'
                        }
                    },
                    colors: ['#84D270', '#F72464'],
                    fill: {
                        opacity: 1,
                    },

                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "$" + val
                            }
                        }
                    },
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options)
                chart.render()
            }, 1500);

        });
    </script>
@endpush
