<ul class="breadcrumb">
    <li><a href="#">Home</a></li>                    
    <li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB -->        
 
<style>

    .custom-soft-card{
        border-radius: 16px !important;
        border: none !important;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.10);
        transition: all .25s ease;
    }

    .custom-soft-card:hover{
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    }

    .widget-danger{
        background: linear-gradient(135deg,#ff758c,#ff7eb3) !important;
    }

    .widget-danger{
        background: linear-gradient(135deg,#4b6cb7, #182848) !important;
    }

    .widget-primary{
        background: linear-gradient(135deg,#4facfe,#00c6fb) !important;
    }

    .widget-info{
        background: linear-gradient(135deg,#667eea,#764ba2) !important;
    }

    .widget-title,
    .widget-subtitle,
    .widget-int,
    .widget-big-int,
    .widget-data,
    .widget-item-left span,
    .widget-buttons a{
        color: #fff !important;
    }

    .widget-item-left{
        border-right: 1px solid rgba(255,255,255,.15) !important;
    }

    .widget-buttons{
        background: rgba(255,255,255,.06);
    }

    /* Chart */
    .custom-chart-panel{
        border: none !important;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .custom-chart-panel .panel-heading{
        background: #ffffff !important;
        border-bottom: 1px solid #f1f1f1;
    }

    .custom-chart-panel .panel-title{
        font-weight: 600;
        color: #2c3e50;
    }

    .custom-chart-panel .panel-body{
        background: #fff;
    }

    .label-hadir{
    background: #1dd1a1 !important;
    color: #fff !important;
}

    .label-sakit{
        background: #ff6b6b !important;
        color: #fff !important;
    }

    .label-izin{
        background: #54a0ff !important;
        color: #fff !important;
    }

    .label-cuti{
        background: #feca57 !important;
        color: #fff !important;
    }

    .label-tidak-hadir{
        background: #576574 !important;
        color: #fff !important;
    }

</style>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    
    <!-- START WIDGETS -->                    
    <div class="row">

        <!-- SLIDER -->
        <div class="col-md-3">

            <div class="widget widget-danger widget-carousel custom-soft-card">

                <div class="owl-carousel" id="owl-example">

                    <div>
                        <div class="widget-title">Tidak Hadir</div>
                        <div class="widget-subtitle">Total presensi tidak hadir</div>
                        <div class="widget-int" id="totalTidakHadir">0</div>
                    </div>

                    <div>
                        <div class="widget-title">Sakit</div>
                        <div class="widget-subtitle">Total presensi sakit</div>
                        <div class="widget-int" id="totalSakit">0</div>
                    </div>

                    <div>
                        <div class="widget-title">Izin</div>
                        <div class="widget-subtitle">Total presensi izin</div>
                        <div class="widget-int" id="totalIzin">0</div>
                    </div>

                    <div>
                        <div class="widget-title">Cuti</div>
                        <div class="widget-subtitle">Total presensi cuti</div>
                        <div class="widget-int" id="totalCuti">0</div>
                    </div>

                    <div>
                        <div class="widget-title">Penugasan</div>
                        <div class="widget-subtitle">Total presensi penugasan</div>
                        <div class="widget-int" id="totalPenugasan">0</div>
                    </div>

                </div>

            </div>

        </div>

        <!-- REGULER -->
        <div class="col-md-3">

            <div class="widget widget-warning widget-item-icon custom-soft-card">

                <div class="widget-item-left">
                    <span class="fa fa-calendar"></span>
                </div>

                <div class="widget-data">
                    <div class="widget-int num-count" id="totalReguler">0</div>
                    <div class="widget-title">REGULER</div>
                    <div class="widget-subtitle">Presensi reguler</div>
                </div>

            </div>

        </div>

        <!-- TOTAL USER -->
        <div class="col-md-3">

            <div class="widget widget-primary widget-item-icon custom-soft-card">

                <div class="widget-item-left">
                    <span class="fa fa-users"></span>
                </div>

                <div class="widget-data">
                    <div class="widget-int num-count" id="totalUser">0</div>
                    <div class="widget-title">TOTAL USER</div>
                    <div class="widget-subtitle">User terdaftar</div>
                </div>

            </div>

        </div>

        <!-- CLOCK -->
        <div class="col-md-3">

            <div class="widget widget-info widget-padding-sm custom-soft-card">

                <div class="widget-big-int plugin-clock">
                    00:00
                </div>

                <div class="widget-subtitle plugin-date">
                    Loading...
                </div>

                <div class="widget-buttons widget-c3">



                </div>

            </div>

        </div>

    </div>
    <!-- END WIDGETS -->                    
    
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default custom-chart-panel">

                <div class="panel-heading">
                    <h3 class="panel-title">
                        Grafik Presensi Untuk Tahun 2026
                    </h3>
                </div>

                <div class="panel-body">

                    <div id="morris-bar-example"
                       style="height:400px;">
                    </div>

                </div>

            </div>
        </div>

        <div class="col-md-5">
            
            <!-- START PROJECTS BLOCK -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title-box">
                        <h3>Presensi Hari Ini</h3>
                        <span>Data kehadiran user hari ini</span>
                    </div>                                    
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                            </ul>                                        
                        </li>                                        
                    </ul>
                </div>
                <div class="panel-body panel-body-table">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="50%">Nama</th>
                                    <th width="20%">Status</th>
                                    <th width="10%">Jam Datang</th>
                                    <th width="10%">Jam Pulang</th>
                                </tr>
                            </thead>
                            <tbody id="tablePresensiHariIni">

                                <tr>
                                    <td colspan="4" class="text-center">
                                        Loading...
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            <!-- END PROJECTS BLOCK -->
            
        </div>
        

    </div>

    <!-- END DASHBOARD CHART -->
    
</div>

<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
<script type='text/javascript' src='js/plugins/owl/owl.carousel.min.js'></script>

<script type="text/javascript" src="js/sweet.js"></script>
<script type="text/javascript" src="js/link.js"></script>

<script>

$(document).ready(function(){

    loadDashboard();

    // loadChartHariIni();
    //loadChartBulanan();

    loadTes();
    //testing();

    $("#owl-example").owlCarousel({

        autoPlay: 3000,
        navigation: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true

    });


});

function loadDashboard(){

    $.ajax({

        url: linker_api + 'api/dashboard',

        type: 'GET',

        headers: {

            'Accept': 'application/json',

            'Authorization': 'Bearer ' + localStorage.getItem('token')

        },

        success: function(response){

            $('#totalTidakHadir').html(response.tidak_hadir);
            $('#totalSakit').html(response.sakit);
            $('#totalIzin').html(response.izin);
            $('#totalCuti').html(response.cuti);
            $('#totalPenugasan').html(response.penugasan);
            $('#totalReguler').html(response.reguler);
            $('#totalUser').html(response.total_user);

            loadPresensiHariIni();

        },

        error: function(xhr){

            console.log(xhr.responseText);

        }

    });

}

function loadPresensiHariIni(){

    $.ajax({

        url: linker_api + 'api/dashboard/presensi-hari-ini',

        type: 'GET',

        headers: {

            'Accept': 'application/json',

            'Authorization': 'Bearer ' + localStorage.getItem('token')

        },

        success: function(response){

            let html = '';

            if(response.length == 0){

                html += `
                    <tr>
                        <td colspan="4" class="text-center">
                            Tidak ada data presensi hari ini
                        </td>
                    </tr>
                `;

            }else{

                response.forEach(function(item){

                    html += `
                        <tr>

                            <td>
                                <strong>${item.user.name}</strong>
                            </td>

                            <td>

                                ${getBadgeStatus(item)}

                            </td>

                            <td>
                                ${item.jam_datang ?? '-'}
                            </td>

                            <td>
                                ${item.jam_pulang ?? '-'}
                            </td>

                        </tr>
                    `;

                });

            }

            $('#tablePresensiHariIni').html(html);

        },

        error: function(xhr){

            console.log(xhr.responseText);

        }

    });

}

function getStatusColor(status){

    switch(status){

    case 'Cuti':
            return 'label-warning';

        case 'Hadir':
            return 'label-success';

        case 'Penugasan':
            return 'label-success';

        case 'Sakit':
            return 'label-danger';

        case 'Izin':
            return 'label-info';

        case 'Tidak Hadir':
            return 'label-primary';

        default:
            return 'label-default';

    }

}


function getBadgeStatus(item){

    let status = item.presensi;

    let badge = 'label-default';

    switch(status){

        case 'Hadir':
            badge = 'label-hadir';
            break;

        case 'Sakit':
            badge = 'label-sakit';
            break;

        case 'Izin':
            badge = 'label-izin';
            break;

        case 'Cuti':
            badge = 'label-cuti';
            break;

        case 'Tidak Hadir':
            badge = 'label-tidak-hadir';
            break;

    }

    if(
        status === 'Hadir' &&
        item.keterangan_presensi
    ){

        return `
            <span class="label ${badge}">
                ${status}
            </span>

            <small style="display:block;margin-top:4px;color:#666;">
                ${item.keterangan_presensi}
            </small>
        `;
    }

    return `
        <span class="label ${badge}">
            ${status}
        </span>
    `;

}




function loadTes(){
     const bulanShort = {
    "January": "Jan",
    "February": "Feb",
    "March": "Mar",
    "April": "Apr",
    "May": "Mei",
    "June": "Jun",
    "July": "Jul",
    "August": "Agu",
    "September": "Sep",
    "October": "Okt",
    "November": "Nov",
    "December": "Des"
};

    $.ajax({

        url: linker_api + 'api/dashboard/bar',

        type: 'GET',

        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        },

        success: function(response) {

            let chartData = [];

            response.data.forEach(function(item) {

                chartData.push({

                    y: bulanShort[item.bulan] || item.bulan,

                    hadir: Number(item.hadir) || 0,
                    cuti: Number(item.cuti) || 0,
                    sakit: Number(item.sakit) || 0,
                    izin: Number(item.izin) || 0,
                    tidak_hadir: Number(item.tidak_hadir) || 0

                });

            });

            // reset container biar tidak double chart
            $('#morris-bar-example').empty();

            Morris.Bar({

                element: 'morris-bar-example',

                data: chartData,

                xkey: 'y',

                ykeys: [
                    'hadir',
                    'cuti',
                    'sakit',
                    'izin',
                    'tidak_hadir'
                ],

                labels: [
                    'Hadir',
                    'Cuti',
                    'Sakit',
                    'Izin',
                    'Tidak Hadir'
                ],

                barColors: [
                    '#1dd1a1',
                    '#5f27cd',
                    '#ff6b6b',
                    '#feca57',
                    '#576574'
                ],

                resize: true,
                hideHover: 'auto',
                xLabelAngle: 45

            });

        },

        error: function(xhr) {
            console.log(xhr.responseText);
        }

    });

}

</script>