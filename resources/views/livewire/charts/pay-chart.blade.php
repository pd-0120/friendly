<div>
    <div class="row">
        <div class="col-md-3 form-group">
            <label for="">Date wise Filter</label>
            <select name='dateFilter' class="form-control" onchange="filterData()" id="dateFilter">
                @foreach ($dateFilterOptions as $key => $dateFilterOption)
                    <option value="{{ $key }}">{{ $dateFilterOption }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12"><div id="chart"></div></div>
    </div>
</div>

@push('js')
    <script>
        window.chart = "";

            setTimeout(() => {

                var options = {
                chart: {
                    height: 350,
                    type: 'bar',
                },
                dataLabels: {
                    enabled: false
                },
                series: [],
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                },
                yaxis: {
                    title: {
                        text: '$ (Pay)'
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "$ " + val + " thousands"
                        }
                    }
                },
                noData: {
                    text: 'Loading...'
                }}

                window.chart = new ApexCharts(document.querySelector("#chart"), options)
                window.chart.render()
                filterData()
            }, 15);

            function filterData() {
                let options = {};
                options.dateFilter = $('#dateFilter').val();


                var url = route('chart.user-pay-bar-chart',options );
                console.log(url)
                axios({
                method: 'GET',
                url: url,
                }).then(function(response) {
                    let series = [
                        {
                            name: "Paid",
                            data: response.data.paid
                        } ,{
                            name: "Unpaid",
                            data: response.data.unpaid
                        }
                    ];

                    let categories = response.data.categories;

                    window.chart.updateOptions({
                        series: series,
                        xaxis: {
                            categories : categories
                        }
                    })
                })
            }
    </script>
@endpush
