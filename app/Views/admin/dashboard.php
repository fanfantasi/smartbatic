
<div class="col-lg-3 col-md-6">
    <div class="ibox bg-success color-white widget-stat">
        <div class="ibox-body">
            <h2 class="m-b-5 font-strong"><?= number_format($topic, 0); ?></h2>
            <div class="m-b-5">Topik Module</div><i class="ti-write widget-stat-icon"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="ibox bg-info color-white widget-stat">
        <div class="ibox-body">
            <h2 class="m-b-5 font-strong"><?= number_format($module, 0); ?></h2>
            <div class="m-b-5">Module PDF</div><i class="ti-bar-chart widget-stat-icon"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="ibox bg-warning color-white widget-stat">
        <div class="ibox-body">
            <h2 class="m-b-5 font-strong"><?= number_format($videos, 0); ?></h2>
            <div class="m-b-5">Module Videos</div><i class="ti-pin-alt widget-stat-icon"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="ibox bg-danger color-white widget-stat">
        <div class="ibox-body">
            <h2 class="m-b-5 font-strong"><?= number_format($users, 0); ?></h2>
            <div class="m-b-5">Peserta Smart BC</div><i class="ti-user widget-stat-icon"></i>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-body">
            <div class="flexbox mb-4">
                <div>
                    <h3 class="m-0">SMART BATIK CLASS</h3>
                    <div>Laporan Data</div>
                </div>
            </div>
            <div>
            <div id="container"></div>
                    <p class="highcharts-description">
                        Chart showing Peserta Smart Batik Class. Clicking on individual columns
                        brings up more detailed data.
                    </p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (){
        searchcart();
    });

    function searchcart(){
        $.ajax({
            url: 'admin/chatpeserta',
            type: "GET",
            dataType: "json",
            success: function(data) {
               satkerchart(data);
            },
            cache: false
        });
    }

    function satkerchart(data)
    {
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Peserta Smart Batik Class'
            },
            subtitle: {
                text: 'Total '+ data.total +' Peserta'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total Peserta Smart Batik Class'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y} Peserta'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> Peserta<br/>'
            },

            series: [
                {
                    name: "Peserta",
                    colorByPoint: true,
                    data: data.data
                }
            ],
            drilldown:{
                breadcrumbs: {
                    position: {
                        align: 'right'
                    }
                },
                series: data.drilldown
            }
        });
    }
</script>