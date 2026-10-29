<?php include 'layouts/header.php'; ?>

<style>

    .filter-row{
        margin-bottom:20px;
    }

    .btn-wrapper{
        display: flex;
        align-items: flex-end;
        gap: 10px;
    }

    .btn-filter{

        height:38px;

        padding:0 18px;

        font-size:13px;

        font-weight:600;

        border-radius:4px;

        display:flex;

        align-items:center;

        justify-content:center;

        gap:6px;

    }

    .btn-filter i{
        margin-right: 4px;
        font-size: 12px;
    }

    .checkbox-wrapper{
        margin-top:10px;
    }

    .button-group-custom{

        display:flex;

        align-items:center;

        gap:10px;

        margin-top:1px;

    }

</style>

<div class="page-content-wrap">

    <!-- BREADCRUMB -->
    <ul class="breadcrumb">
        <li>Master File</li>
        <li>Days</li>
    </ul>

    <!-- TITLE -->
    <div class="page-title">
        <h2>
            <span class="fa fa-arrow-circle-o-left"></span>
            Laporan Harian
        </h2>
    </div>

    <!-- PANEL -->
    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">
                Rekap Presensi Harian
            </h3>

        </div>

        <div class="panel-body">
            
            <!-- FILTER -->
            <div class="row filter-row">

                <!-- FILTER TANGGAL -->
                <div class="col-md-5">

                    <label>Tanggal</label>

                    <input
                        type="date"
                        class="form-control"
                        id="tanggal">

                    <div class="checkbox-wrapper">

                        <label class="checkbox-inline">

                            <input
                                type="checkbox"
                                id="semuaData">

                            Tampilkan semua presensi

                        </label>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="col-md-4">

                    <label>&nbsp;</label>

                    <div class="button-group-custom">

                        <button
                            class="btn btn-primary btn-filter"
                            id="btnFilter">

                            <i class="fa fa-search"></i>
                            Tampilkan
                        </button>

                        <button
                            class="btn btn-success btn-filter"
                            id="btnExcel">

                            <i class="fa fa-file-excel-o"></i>
                            Export
                        </button>

                    </div>

                </div>

            </div>

            <table class="table table-bordered table-striped" id="data-presensi">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Tanggal</th>
                        <th>Jam Datang</th>
                        <th>Keterangan Datang</th>
                        <th>Jam Pulang</th>
                        <th>Keterangan Pulang</th>
                        <th>Presensi</th>
                        <th>Keterangan Presensi</th>
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

    let today = new Date().toISOString().split('T')[0];

    $('#tanggal').val(today);

    $('#semuaData').change(function(){

        if($(this).is(':checked')){

            $('#tanggal').prop('disabled', true);

        }else{

            $('#tanggal').prop('disabled', false);

        }

    });

    $('#btnFilter').click(function(){
        tampilPresensi();
    });

    tampilPresensi();
    loadUser();

    // LOAD TABLE
    function tampilPresensi(){

        $('#data-presensi').DataTable({

            destroy: true,

            ajax: {
                url: linker_api + 'api/absence/laporan',
                type: 'GET',

                data: {

                    tanggal: $('#semuaData').is(':checked')
                        ? ''
                        : $('#tanggal').val()

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
                    data: 'tgl'
                },

                {
                    data: 'jam_datang',
                    render: function(data){
                        return data ?? '-';
                    }
                },

                {
                    data: 'keterangan_datang',
                    render: function(data){
                        return data ?? '-';
                    }
                },

                {
                    data: 'jam_pulang',
                    render: function(data){
                        return data ?? '-';
                    }
                },

                {
                    data: 'keterangan_pulang',
                    render: function(data){
                        return data ?? '-';
                    }
                },

                {
                    data: 'presensi'
                },

                {
                    data: 'keterangan_presensi'
                }

            ]

        });

    }

    // LOAD USER
    function loadUser(){

        $.ajax({

            url: linker_api + 'api/user/index',
            type: 'GET',

            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },

            success: function(response){

                let select = $('#id_user');

                select.empty();

                select.append(`
                    <option value="">
                        -- Pilih User --
                    </option>
                `);

                response.data.forEach(function(user){

                    // HANYA USER
                    if(user.level != 'Admin'){

                        select.append(`
                            <option value="${user.id}">
                                ${user.name}
                            </option>
                        `);

                    }

                });

            }

        });

    }

    // SIMPAN
    $('#btnSimpan').click(function(){

        let id_user = $('#id_user').val();
        let presensi = $('#presensi').val();

        $.ajax({

            url: linker_api + 'api/absence/store',
            type: 'POST',

            data: {
                id_user: id_user,
                presensi: presensi
            },

            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },

            success: function(response){

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Presensi berhasil ditambahkan'
                });

                $('#modalTambah').modal('hide');

                $('#id_user').val('');
                $('#presensi').val('');

                tampilPresensi();

            },

            error: function(xhr){

                let message = 'Gagal menambahkan presensi';

                if(xhr.status == 409){
                    message = 'Presensi user sudah ada hari ini';
                }

                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: message
                });

            }

        });

    });

    $('#btnExcel').click(function(){

        let table = $('#data-presensi').DataTable();

        let data = table.rows().data().toArray();

        let excelData = [];

        data.forEach(function(row, index){

            excelData.push({

                'No': index + 1,
                'Nama User': row.nama_user,
                'Tanggal': row.tgl,
                'Jam Datang': row.jam_datang ?? '-',
                'Keterangan Datang': row.keterangan_datang ?? '-',
                'Jam Pulang': row.jam_pulang ?? '-',
                'Keterangan Pulang': row.keterangan_pulang ?? '-',
                'Presensi': row.presensi,
                'Keterangan Presensi': row.keterangan_presensi

            });

        });

        let worksheet = XLSX.utils.json_to_sheet(excelData);

        let workbook = XLSX.utils.book_new();

        XLSX.utils.book_append_sheet(
            workbook,
            worksheet,
            'Laporan Harian'
        );

        XLSX.writeFile(
            workbook,
            'laporan_harian.xlsx'
        );

    });

});

</script>