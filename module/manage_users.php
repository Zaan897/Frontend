<style>
    #overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.6);
    }

    #popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 900px; /* diperbesar */
      max-width: 90%;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
    }

    #popup h2 {
      margin-top: 0;
    }

   

    .close {
      float: right;
      cursor: pointer;
      font-size: 18px;
    }
</style>

<ul class="breadcrumb">
    <li><a href="#">Master File</a></li>                    
    <li class="active">Manage User</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-arrow-circle-o-left"></span> Manage User</h2>
</div>

<div class="page-content-wrap">                
                
    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Data User</h3>
                    <ul class="panel-controls">
                       
                        <li><button id="openPopup" class="btn btn-info"><span class="fa fa-plus"></span> Tambah Data</button></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table id="data-user" class="table datatable table-bordered table-striped table-actions">
                        <thead>
                            <th style="width:4%;">No</th>
                            <th style="width:7%;">Action</th>
                            <th style="width:15%;">Nama</th>
                            <th style="width:15%;">Username</th>
                            <th style="width:10%;">Jenis Kelamin</th>
                            <th style="width:15%;">No. Hp</th>
                            <th style="width:10%;">Level</th>
                            <th style="width:10%;">Penugasan</th>
                            <th style="width:20%;">Lokasi</th>
                            
                            
                        </thead>
                        <tbody>
                            <tr>
                               
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
    </div>        
</div>    

<div id="overlay"></div>
<div id="popup">
  <div class="panel-body">                                                                        
     <form class="form-horizontal">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Tambah Data </strong> User</h3>
                
            </div>
    
            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Name</label>
                <div class="col-md-7 col-xs-12">                                                                                                                                                        
                    <input type="text" id="name" class="form-control" />                                                   
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Username</label>
                <div class="col-md-7 col-xs-12"> 
                      <input type="text" id="username" class="form-control" />                                                                                                                                                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Password</label>
                <div class="col-md-7 col-xs-12">                                                                                                                                                        
                      
                      <input type="text" id="password" class="form-control" />                                                      
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Jenis Kelamin</label>
                <div class="col-md-7 col-xs-12">                                                                                                                                                        
                    <select id="jenis_kelamin" class="form-control">
                        <option>Pria</option>
                        <option>Wanita</option>
                      
                    </select>                                                   
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Level</label>
                <div class="col-md-7 col-xs-12">                                                                                                                                                        
                    <select class="form-control" id="level">
                        <option>Admin</option>
                        <option>User</option>
                      
                    </select>                                                   
                                                  
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">HP</label>
                <div class="col-md-7 col-xs-12"> 
                       <input type="text" id="no_hp" class="form-control" />                                                                                                                                                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Lokasi</label>
                <div class="col-md-7 col-xs-12">                                                                                                                                                        
                    <select class="form-control" id="id_lokasi">
                        <option value="">-- Pilih Lokasi --</option>
                      
                    </select>                                                
                                                  
                </div>
            </div>

            

        </div>
       
        <div class="panel-footer">
            <button type="button" id="closePopup" class="btn btn-default">Close</button>                                    
            <button type="button" id="simpan_data" class="btn btn-success pull-right">Submit</button>
        </div>
      </div> 
    </form>
</div>


<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="js/link.js"></script>

        
<script>

    let mode = 'tambah';
    let edit_id = null;
    
    $(document).ready(function(){
         $("#openPopup").click(function(){
            mode = 'tambah';
            edit_id = null;

            $('form')[0].reset();

            $('.panel-title').html('<strong>Tambah Data</strong> User');

            $("#overlay, #popup").fadeIn();

        });

        $("#closePopup, #overlay").click(function(){
            $("#overlay, #popup").fadeOut();
        });
    });
    
    $(document).ready(function(){

       
        
        $.ajax({
            url: linker_api + "api/lokasi/index",
            type: 'GET',
            headers: { 'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')  
                        },
            success: function(data){
                let select = $('#id_lokasi');
                select.empty();
                select.append('<option value="">-- Pilih Lokasi --</option>');

                data.data.forEach(function(item) {

              
                    select.append(
                        `<option value="${item.id}">${item.nama_tempat}</option>`
                    );
                });
            },
            error: function(){
                alert('Gagal ambil data lokasi');
            }
        });


        validasi();
        function validasi(){
            $.ajax({
                url: linker_api + "api/user/validasi", 
                type: 'GET',
                headers: {'Accept': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.getItem('token')  
                        },
                success: function(data) {

                    if (data.level !== "Admin") {
                        window.location.assign(linker + "attendance/");
                    }
                    

                    },
                    error: function(xhr, status, error) {
                        window.location.assign(linker + "attendance/");

                        console.log(`error : ${error}`, xhr);
                    }
            });
        }

        tampil_user();
        function tampil_user() {
            $('#data-user').dataTable( {
                        "Destroy": true,
                        "ajax": {
                           
                            "url": linker_api + "api/user/index",
                            "type": 'GET',
                            "headers": { 'Accept': 'application/json',
                                        'Authorization': 'Bearer ' + localStorage.getItem('token')  
                                        },
                            
                        },
                        "columns":[  
                                { "data" : "no" }, 
                                { "render": function ( data, type, row ) { //https://www.mynotescode.com/jquery-datatables-dengan-php-dan-mysql/ Tampilkan kolom aksi
                                        var html  = '<div class="btn-group">'
                                        html += '<a data-toggle="dropdown" class="btn btn-success dropdown-toggle">Menu <span class="caret"></span></a>'
                                        html += '<ul class="dropdown-menu mns" role="menu" style="margin: -33px 0 0 85px;">'

                                        html += '<li>';
                                        html += '<div class="col-md-12">';
                                        html += '<button class="btn btn-default btn-block btn-penugasan" data-id="'+row.id+'">';
                                        html += '<span class="fa fa-pencil-square-o"></span>' + (row.penugasan ? 'Batalkan Penugasan' : 'Izinkan Penugasan');
                                        html += '</button>';
                                        html += '</div>';
                                        html += '</li>';

                                        html += '<li>';
                                        html += '<div class="col-md-12">';
                                        html += '<button class="btn btn-default btn-block btn-edit" data-id="'+row.id+'">';
                                        html += '<span class="fa fa-pencil-square-o"></span> Edit Data';
                                        html += '</button></div>';
                                        html += '</li>';
                       

                                        html += '<li>'
                                        html += '<div class="col-md-12"><button class="hapus_data_desa btn btn-default btn-block btn-delete" data-id="'+row.id+'"><span class="fa fa-trash-o"></span>Hapus Data</button></div>'
                                                
                                        html += '</li>'
                                        
                                        html += '</ul>'
                                        html += '</div>'

                                        return html
                                        
                                    }
                                },
                                { "data" : "name"},
                                { "data" : "username"},
                                { "data" : "jenis_kelamin"},
                                { "data" : "no_hp"},
                                { "data" : "level"},
                                { "data" : "penugasan"},
                                { "data" : "lokasi.nama_tempat"},


                            ]
            });
        }

        $(document).on('click', '.btn-penugasan', function() {
            let id = $(this).data('id');
            let penugasanStatus = $(this).data('penugasan');

            console.log($(this).data());
            

            Swal.fire({
                title: 'Yakin?',
                text: "Izinkan user ini untuk penugasan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, izinkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: linker_api + "api/user/update_penugasan/" + id,
                        type: "POST",
                        data: {
                            penugasan: 1,
                        },
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        },
                        success: function(response) {

                            Swal.fire(
                                'Berhasil!',
                                'Sudah ditugaskan.',
                                'success'
                            );

                          
                            $('#data-user').DataTable().ajax.reload();

                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Gagal ditugaskan.',
                                'error'
                            );

                            console.log(xhr);
                        }
                    });

                }
            });
        })

        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            let button = $(this);

            Swal.fire({
                title: 'Yakin?',
                text: "Data akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: linker_api + "api/user/destroy/" + id,
                        type: "DELETE",
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        },
                        success: function(response) {

                            Swal.fire(
                                'Berhasil!',
                                'Data berhasil dihapus.',
                                'success'
                            );

                          
                            $('#data-user').DataTable().ajax.reload();

                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Data gagal dihapus.',
                                'error'
                            );

                            console.log(xhr);
                        }
                    });

                }
            });
        });

        $(document).on('click', '.btn-edit', function(){

            mode = 'edit';

            edit_id = $(this).data('id');

            $.ajax({

                url: linker_api + 'api/user/show/' + edit_id,

                type: 'GET',

                headers: {

                    'Accept': 'application/json',

                    'Authorization': 'Bearer ' + localStorage.getItem('token')

                },

                success: function(response){

                    let user = response.data;

                    $('#name').val(user.name);

                    $('#username').val(user.username);

                    $('#password').val('');

                    $('#jenis_kelamin').val(user.jenis_kelamin);

                    $('#level').val(user.level);

                    $('#no_hp').val(user.no_hp);

                    $('#id_lokasi').val(user.id_lokasi);

                    $('.panel-title').html('<strong>Edit Data</strong> User');

                    $('#popup, #overlay').fadeIn();

                }

            });

        });

        $('#simpan_data').click(function(e){
            e.preventDefault();

            let data = {
                name: $('#name').val(),
                username: $('#username').val(),
                password: $('#password').val(),
                jenis_kelamin: $('#jenis_kelamin').val(),
                level: $('#level').val(), // select level (karena belum ada id)
                id_lokasi: $('#id_lokasi').val(),
                no_hp: $('#no_hp').val(),

            };

            // kirim ke server
            let url = linker_api + "api/register";

            if(mode === 'edit'){

                url = linker_api + "api/user/update/" + edit_id;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                headers: {

                    'Accept': 'application/json',

                    'Authorization': 'Bearer ' + localStorage.getItem('token')

                },
                success: function(response){
                    Swal.fire(
                        'Success!',
                        'Data berhasil disimpan.',
                        'success'
                    );
                    $('#data-user').DataTable().ajax.reload();

                    
                    // reset form
                    $('form')[0].reset();

                    // optional: tutup popup
                    $('#popup, #overlay').fadeOut();
                },
                error: function(xhr){
                    Swal.fire(
                        'Info!',
                        'Perbaiki data yang diinput.',
                        'info'
                    );
                    console.log(xhr.responseText);
                }
            });

        });

    });


</script>    