<div>
    <div id="chart">

    </div>
</div>

@push('js')
    <script>
        setTimeout(() => {
            var options = {
                series: [{
                    name: 'Paid',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }, {
                    name: 'Unpaid',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                }],
                chart: {
                    type: 'bar',
                    height: 350
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
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                },
                yaxis: {
                    title: {
                        text: '$ (Pay)'
                    }
                },
                colors: ['#F72464', '#84D270'],
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

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }, 15);
    </script>
@endpush
