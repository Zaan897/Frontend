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
    <li class="active">Manage Lokasi</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-arrow-circle-o-left"></span> Manage Lokasi</h2>
</div>

<div class="page-content-wrap">                
                
    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Data Lokasi</h3>
                    <ul class="panel-controls">
                       
                        <li><button id="openPopup" class="btn btn-info"><span class="fa fa-plus"></span> Tambah Data</button></li>
                    </ul>                                
                </div>
                <div class="panel-body">
                    <table id="data-lokasi" class="table datatable table-bordered table-striped table-actions">
                        <thead>
                            <th style="width:4%;">No</th>
                            <th style="width:7%;">Action</th>
                            <th style="width:15%;">Nama Tempat</th>
                            <th style="width:15%;">Absen Datang</th>
                            <th style="width:15%;">Absen Pulang</th>
                            <th style="width:15%;">Radius</th>
                            <th style="width:15%;">Latitude</th>
                            <th style="width:10%;">Longitude</th>
                            
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
                <h3 class="panel-title"><strong>Tambah Data </strong> Lokasi</h3>
                
            </div>
    
            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Nama Tempat</label>
                <div class="col-md-6 col-xs-12">                                                                                                                                                        
                    <input type="text" id="nama_tempat" class="form-control" />                                                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Absen Datang</label>
                <div class="col-md-6 col-xs-12"> 
                     <input type="text"  id="absen_datang" class="form-control timepicker24" readonly />                                                                                                                                                   
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Absen Pulang</label>
                <div class="col-md-6 col-xs-12">                                                                                                                                                        
                      
                     <input type="text"  id="absen_pulang" class="form-control timepicker24" readonly />                                                   
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Radius (Meter)</label>
                <div class="col-md-6 col-xs-12">                                                                                                                                                        
                    <input type="text" id="radius" class="form-control"/>                                                     
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Latitude</label>
                <div class="col-md-6 col-xs-12">                                                                                                                                                        
                    <input type="text" id="lat" class="form-control" readonly />                                                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-xs-12 control-label">Longitude</label>
                <div class="col-md-6 col-xs-12">                                                                                                                                                        
                    <input type="text" id="lng" class="form-control" readonly/>                                                    
                                                  
                </div>
            </div>

            <div id="map" style="width:100%; height:400px;"></div>

        </div>
       
        <div class="panel-footer">
            <button id="closePopup" class="btn btn-default">Close</button>                                    
            <button id="simpan_data" class="btn btn-success pull-right">Submit</button>
        </div>
      </div> 
    </form>
</div>


<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXgC8-OHwuHFdM5K0Qxi1xmvxcSBmrLWo&sensor=false&callback=initMap" async defer></script>
<script type="text/javascript" src="js/link.js"></script>

<script>

function initMap() {

    var lokasiAwal = { lat: 0.5435, lng: 123.0568 };

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: lokasiAwal
    });

    marker = new google.maps.Marker({
        position: lokasiAwal,
        map: map,
        draggable: true
    });

    document.getElementById('lat').value = lokasiAwal.lat;
    document.getElementById('lng').value = lokasiAwal.lng;

    marker.addListener('dragend', function(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
    });

    map.addListener('click', function(event) {
        marker.setPosition(event.latLng);

        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
    });
}
</script>
        
<script>
    
    let mode = 'tambah';
    let edit_id = null;

    $(document).ready(function(){
        $("#openPopup").click(function(){
            mode = 'tambah';
            edit_id = null;

            $('form')[0].reset();

            $("#overlay, #popup").fadeIn();

            $('.panel-title').html('<strong>Tambah Data</strong> Lokasi');
            
            var lat = 0.5435;
            var lng = 123.0568;
            var lokasiAwal = { lat: lat, lng: lng };

            // update map & marker
            map.setCenter(lokasiAwal);
            marker.setPosition(lokasiAwal);

            // update input
            $("#lat").val(lat);
            $("#lng").val(lng);

            $("#nama_tempat").val('');
            $("#absen_datang").val('');
            $("#absen_pulang").val('');
            $("#radius").val('');
            

        });

        $("#closePopup, #overlay").click(function(){
            $("#overlay, #popup").fadeOut();
        });
    });

    $(document).ready(function(){

        $('#absen_pulang').on('change', function(){
            let val = $(this).val();

            if(val){
                let parts = val.split(':');

                let jam = parts[0].padStart(2, '0');
                let menit = parts[1] ? parts[1].padStart(2, '0') : '00';
                let detik = parts[2] ? parts[2].padStart(2, '0') : '00';

                $(this).val(jam + ':' + menit + ':' + detik);
            }
        });

        $('#absen_datang').on('change', function(){
            let val = $(this).val();

            if(val){
                let parts = val.split(':');

                let jam = parts[0].padStart(2, '0');
                let menit = parts[1] ? parts[1].padStart(2, '0') : '00';
                let detik = parts[2] ? parts[2].padStart(2, '0') : '00';

                $(this).val(jam + ':' + menit + ':' + detik);
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

        tampil_lokasi();
        function tampil_lokasi() {
            $('#data-lokasi').dataTable( {
                        "Destroy": true,
                        "ajax": {
                           
                            "url": linker_api + "api/lokasi/index",
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
                                        

                                        html += '<li>'
                                        html += '<div class="col-md-12"><button class="btn btn-default btn-block btn-edit" data-id="'+row.id+'"><span class="fa fa-pencil-square-o"></span>Edit Data</button></div>'
                                                
                                        html += '</li>'

                                        html += '<li>'
                                        html += '<div class="col-md-12"><button class="hapus_data_desa btn btn-default btn-block btn-delete" data-id="'+row.id+'"><span class="fa fa-trash-o"></span>Hapus Data</button></div>'
                                                
                                        html += '</li>'
                                        
                                        html += '</ul>'
                                        html += '</div>'

                                        return html
                                        
                                    }
                                },
                                { "data" : "nama_tempat"},
                                { "data" : "absen_datang"},
                                { "data" : "absen_pulang"},
                                { "data" : "radius"},
                                { "data" : "lat"},
                                { "data" : "lang"},

                            ]
            });
        }

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
                        url: linker_api + "api/lokasi/destroy/" + id,
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

                            // hapus row tanpa reload
                            //button.closest('tr').remove();
                             $('#data-lokasi').DataTable().ajax.reload();

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

        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');

            $.ajax({
                url: linker_api + "api/lokasi/show/" + id,
                type: "GET",
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                success: function(response) {
                    let data = response.data;

                    mode = 'edit';
                    edit_id = data.id;

                    $('#nama_tempat').val(data.nama_tempat);
                    $('#absen_datang').val(data.absen_datang);
                    $('#absen_pulang').val(data.absen_pulang);
                    $('#radius').val(data.radius);
                    $('#lat').val(data.lat);
                    $('#lang').val(data.lang);

                    $("#overlay, #popup").fadeIn();

                    $('.panel-title').html('<strong> Edit Data</strong> Lokasi');

                    var lat = parseFloat(data.lat);
                    var lng = parseFloat(data.lang);

                    var lokasiAwal = { lat: lat, lng: lng };

                    // update map & marker
                    map.setCenter(lokasiAwal);
                    marker.setPosition(lokasiAwal);

                    // pastikan input juga ter-update
                    $("#lat").val(lat);
                    $("#lng").val(lng);

                },
                error: function() {
                    Swal.fire('Gagal!', 'Tidak bisa mengambil data.', 'error');
                }
            });
        });

        $('#simpan_data').click(function(e){
            e.preventDefault();

            let data = {
                nama_tempat: $('#nama_tempat').val(),
                absen_datang: $('#absen_datang').val(),
                absen_pulang: $('#absen_pulang').val(),
                radius: $('#radius').val(),
                lat: $('#lat').val(),
                lang: $('#lng').val()
            };

            console.log("DATA KIRIM:", data);

            let url = "";
            let method = "";

            if (mode === 'tambah') {
                url = linker_api + "api/lokasi/store";
                method = "POST";
            } else {
                url = linker_api + "api/lokasi/update/" + edit_id;
                method = "POST"; 
            }

            $.ajax({
                url: url, 
                type: method,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                data: data,
                success: function(response){

                    Swal.fire(
                        'Success!',
                        mode === 'tambah' ? 'Data berhasil ditambahkan.' : 'Data berhasil diupdate.',
                        'success'
                    );

                    $('#data-lokasi').DataTable().ajax.reload();


                    $('form')[0].reset();
                    mode = 'tambah';
                    edit_id = null;

                    $('#overlay, #popup').fadeOut();

                    $('.panel-title').html('<strong>Tambah Data</strong> Lokasi');
                },
                error: function(xhr){
                    Swal.fire('Gagal!', 'Periksa data.', 'error');
                    console.log(xhr.responseText);
                }
            });

        });
    });

</script>    