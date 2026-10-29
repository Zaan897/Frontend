<?php include 'layouts/header.php'; ?>

<style>

.filter-row{
    display: flex;
    align-items: flex-end;
    gap: 20px;
    margin-bottom: 20px;
}

.btn-wrapper{

    display:flex;

    align-items:center;

    gap:10px;

    margin-top:24px;

}

.btn-filter{
    height: 34px;
    padding: 4px 14px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 3px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 1px;
}

.btn-filter i{
    margin-right: 4px;
    font-size: 12px;
}

</style>

<div class="page-content-wrap">

    <!-- BREADCRUMB -->
    <ul class="breadcrumb">
        <li>Report</li>
        <li>Month</li>
    </ul>

    <!-- TITLE -->
    <div class="page-title">
        <h2>
            <span class="fa fa-calendar"></span>
            Laporan Bulanan
        </h2>
    </div>

    <!-- PANEL -->
    <div class="panel panel-default">

        <div class="panel-heading">

            <h3 class="panel-title">
                Rekap Presensi Bulanan
            </h3>

        </div>

        <div class="panel-body">

            <!-- FILTER -->
            <div class="row filter-row">

                <div class="col-md-4">
                    <label>Bulan</label>
                    <select class="form-control" id="bulan">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5" selected>Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Tahun</label>
                    <select class="form-control" id="tahun">
                        <option value="2026" selected>2026</option>
                    </select>
                </div>

                <div class="col-md-4 btn-wrapper">

                    <button class="btn btn-primary btn-filter" id="btnFilter">
                        <i class="fa fa-search"></i>
                        Tampilkan
                    </button>

                    <button class="btn btn-success btn-filter" id="btnExcel">
                        <i class="fa fa-file-excel-o"></i>
                        Export 
                    </button>

                </div>

            </div>

            <!-- TABLE -->
            <table class="table table-bordered table-striped" id="table-bulanan">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Hadir</th>
                        <th>Sakit</th>
                        <th>Cuti</th>
                        <th>Izin</th>
                        <th>Tidak Hadir</th>
                    </tr>

                </thead>

                <tbody></tbody>

            </table>

        </div>

    </div>

</div>

<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script type="text/javascript" src="js/sweet.js"></script>
<script type="text/javascript" src="js/link.js"></script>

<script>

$(document).ready(function(){

    // DEFAULT BULAN & TAHUN
    let bulanSekarang = new Date().getMonth() + 1;
    let tahunSekarang = new Date().getFullYear();

    $('#bulan').val(bulanSekarang);
    $('#tahun').val(tahunSekarang);

    tampilData();

    // FILTER
    $('#btnFilter').click(function(){
        tampilData();
    });

    // LOAD DATA
    function tampilData(){

        $('#table-bulanan').DataTable({

            destroy: true,

            ajax: {

                url: linker_api + 'api/absence/laporan_bulanan',

                type: 'GET',

                data: {
                    bulan: $('#bulan').val(),
                    tahun: $('#tahun').val()
                },

                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },

                dataSrc: 'data'

            },

            columns: [

                {
                    data: null,
                    render: function(data, type, row, meta){
                        return meta.row + 1;
                    }
                },

                {
                    data: 'nama_user'
                },

                {
                    data: 'hadir'
                },

                {
                    data: 'sakit'
                },

                {
                    data: 'cuti'
                },

                {
                    data: 'izin'
                },

                {
                    data: 'tidak_hadir'
                }

            ]

        });

    }

    $('#btnExcel').click(function(){

        let table = $('#table-bulanan').DataTable();

        let data = table.rows().data().toArray();

        let excelData = [];

        data.forEach(function(row, index){

            excelData.push({

                'No': index + 1,
                'Nama User': row.nama_user,
                'Hadir': row.hadir,
                'Sakit': row.sakit,
                'Cuti': row.cuti,
                'Izin': row.izin,
                'Tidak Hadir': row.tidak_hadir

            });

        });

        let worksheet = XLSX.utils.json_to_sheet(excelData);

        let workbook = XLSX.utils.book_new();

        XLSX.utils.book_append_sheet(
            workbook,
            worksheet,
            'Laporan Bulanan'
        );

        let bulanText = $('#bulan option:selected').text();

        let tahun = $('#tahun').val();

        XLSX.writeFile(
            workbook,
            'laporan_bulanan_' + bulanText + '_' + tahun + '.xlsx'
        );

    });

});

</script>