<style>
    #overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.6);
      z-index: 999;
    }

    #popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 700px;
      max-width: 90%;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
      z-index: 1000;
    }
</style>

<!-- BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Master File</a></li>
    <li class="active">Absence Record</li>
</ul>

<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Presensi Laporan</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Data Presensi</h3>

                    <ul class="panel-controls">
                        <li>
                            <button id="openPopup" class="btn btn-warning">
                                <span class="fa fa-plus"></span> Tambah Presensi
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="panel-body">

                    <table id="data-presensi" class="table datatable table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:5%">No</th>
                                <th>Actions</th>
                                <th>Nama User</th>
                                <th>Tanggal</th>
                                <th>Presensi</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

</div>

<!-- POPUP -->
<div id="overlay"></div>

<div id="popup">

    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title" id="popupTitle">
                <strong>Tambah</strong> Presensi
            </h3>
        </div>

        <div class="panel-body">

            <form id="form-presensi" class="form-horizontal">

                <input type="hidden" id="edit_user_id">

                <!-- USER -->
                <div class="form-group" id="userGroup">
                    <label class="col-md-3 control-label">User</label>

                    <div class="col-md-8">
                        <select id="id_user" class="form-control">
                            <option value="">-- Pilih User --</option>
                        </select>
                        <p id="editUserText" style="display:none; margin-top:8px; font-weight:bold;"></p>
                    </div>
                </div>

                <!-- PRESENSI -->
                <div class="form-group">
                    <label class="col-md-3 control-label">Presensi</label>

                    <div class="col-md-8">
                        <select id="presensi" class="form-control">
                            <option value="">-- Pilih Presensi --</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Cuti">Cuti</option>
                            <option value="Izin">Izin</option>
                            <option value="Tidak Hadir">Tidak Hadir</option>
                        </select>
                    </div>
                </div>


            </form>

        </div>

        <div class="panel-footer">
            <button id="closePopup" class="btn btn-default">
                Close
            </button>

            <button id="simpan_presensi" class="btn btn-success pull-right">
                Submit
            </button>
        </div>

    </div>

</div>

<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/sweet.js"></script>
<script type="text/javascript" src="js/link.js"></script>

<script>

$(document).ready(function(){

    let editId = null;

    validasiAdmin();
    loadUser();
    tampilPresensi();

    // OPEN POPUP
    $("#openPopup").click(function(){

        editId = null;

        $('#edit_user_id').val('');

        $('#userGroup').show();

        $('#popupTitle').html('<strong>Tambah</strong> Presensi');

        $('#form-presensi')[0].reset();

        $('#edit_id_user').val('');

        $('#id_user').css({
            'pointer-events': 'auto',
            'background': ''
        });

        $("#overlay").fadeIn();
        $("#popup").fadeIn();

    });

    // CLOSE POPUP
    $("#closePopup, #overlay").click(function(e){
        e.preventDefault();

        editId = null;

        $('#edit_user_id').val('');

        $('#userGroup').show();

        $('#form-presensi')[0].reset();

        $('#popupTitle').html('<strong>Tambah</strong> Presensi');

        $('#id_user').css({
            'pointer-events': 'auto',
            'background': ''
        });

        $("#overlay").fadeOut();
        $("#popup").fadeOut();
    });

    // VALIDASI ADMIN
    function validasiAdmin(){

        $.ajax({
            url: linker_api + "api/user/validasi",
            type: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },

            success: function(data){

                if(data.level !== "Admin"){
                    window.location.assign(linker + "attendance/");
                }

            },

            error: function(){
                window.location.assign(linker + "attendance/");
            }

        });

    }

    // LOAD USER
    function loadUser(){

        $.ajax({
            url: linker_api + "api/absensi/user",
            type: 'GET',

            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },

            success: function(response){

                let select = $('#id_user');

                select.empty();

                select.append('<option value="">-- Pilih User --</option>');

                response.data.forEach(function(user){

                    select.append(`
                        <option value="${user.id}">
                            ${user.name}
                        </option>
                    `);

                });

            }

        });

    }

    // TAMPIL DATA
    function tampilPresensi(){

        $('#data-presensi').DataTable({

            destroy: true,

            ajax: {
                url: linker_api + "api/absensi/index",
                type: "GET",

                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            },

            columns: [

                {
                    data: 'no'
                },

                {
                    data: 'id',
                    render: function(data, type, row){

                        console.log(row);

                        return `
                            <button class="btn btn-info btn-sm editPresensi"
                                data-id="${row.id}"
                                data-user="${row.user.id}"
                                data-name="${row.user.name}"
                                data-tgl="${row.tgl}"
                                data-presensi="${row.presensi}">
                                
                                <span class="fa fa-pencil"></span>
                            </button>

                            <button class="btn btn-danger btn-sm deletePresensi"
                                data-id="${row.id}">
                                
                                <span class="fa fa-trash"></span>
                            </button>
                        `;
                    }
                },

                {
                    data: 'user.name'
                },

                {
                    data: 'tgl'
                },

                {
                    data: null,
                    render: function(data, type, row){

                        if(
                            row.presensi === 'Hadir' &&
                            row.keterangan_presensi
                        ){

                            return `
                                <span class="badge badge-success">
                                    ${row.presensi}
                                </span>
                                -
                                <strong>${row.keterangan_presensi}</strong>
                            `;

                        }

                        let badgeClass = 'badge-default';

                        if(row.presensi === 'Sakit'){
                            badgeClass = 'badge-danger';
                        }

                        else if(row.presensi === 'Cuti'){
                            badgeClass = 'badge-primary';
                        }

                        else if(row.presensi === 'Izin'){
                            badgeClass = 'badge-warning';
                        }

                        else if(row.presensi === 'Tidak Hadir'){
                            badgeClass = 'badge-dark';
                        }

                        return `
                            <span class="badge ${badgeClass}">
                                ${row.presensi}
                            </span>
                        `;
                    }
                }

            ]

        });

    }

    // EDIT
    $(document).on('click', '.editPresensi', function(){

        editId = $(this).data('id');

        let namaUser = $(this).data('name');
        let userId   = $(this).data('user');

        console.log(userId);
        console.log(typeof userId);

        /*
        |--------------------------------------------------------------------------
        | TITLE
        |--------------------------------------------------------------------------
        */

        $('#popupTitle').html(
            '<strong>Edit Presensi</strong> ' + namaUser
        );

        /*
        |--------------------------------------------------------------------------
        | SIMPAN USER ID
        |--------------------------------------------------------------------------
        */

        $('#edit_user_id').val(userId);

        /*
        |--------------------------------------------------------------------------
        | SET PRESENSI
        |--------------------------------------------------------------------------
        */

        $('#presensi')
            .val($(this).data('presensi'))
            .change();

        /*
        |--------------------------------------------------------------------------
        | HIDE USER GROUP
        |--------------------------------------------------------------------------
        */

        $('#userGroup').hide();

        $("#overlay").fadeIn();
        $("#popup").fadeIn();

    });

    // SIMPAN
    $('#simpan_presensi').click(function(e){

        e.preventDefault();

        let data = {

            id_user: editId
                ? parseInt($('#edit_user_id').val())
                : parseInt($('#id_user').val()),
            presensi: $('#presensi').val(),
        };

        $.ajax({

            url: editId
                ? linker_api + "api/absence/update/" + editId
                : linker_api + "api/absensi/absence",
            type: "POST",
            data: data,

            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },

            success: function(response){
                
                editId = null;

                Swal.fire(
                    'Success!',
                    response.message,
                    'success'
                );

                $('#data-presensi').DataTable().ajax.reload();

                $('#popup').fadeOut();
                $('#overlay').fadeOut();

                $('#form-presensi')[0].reset();

            },

            error: function(xhr){

                console.log(xhr.responseText);

                let message = 'Gagal menambahkan/mengubah presensi';

                if(xhr.responseJSON && xhr.responseJSON.message){
                    message = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: message
                });

            }

        });

    });

    // DELETE
    $(document).on('click', '.deletePresensi', function(){

        let id = $(this).data('id');

        Swal.fire({
            title: 'Hapus Presensi?',
            text: 'Data yang dihapus tidak dapat dikembalikan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if(result.isConfirmed){

                $.ajax({

                    url: linker_api + "api/absence/delete/" + id,
                    type: "DELETE",

                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    },

                    success: function(response){

                        Swal.fire(
                            'Berhasil!',
                            response.message,
                            'success'
                        );

                        $('#data-presensi').DataTable().ajax.reload();

                    },

                    error: function(){

                        Swal.fire(
                            'Error!',
                            'Gagal menghapus presensi',
                            'error'
                        );

                    }

                });

            }

        });

    });

});

</script>