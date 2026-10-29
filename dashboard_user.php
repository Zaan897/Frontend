<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Presensi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .card-menu {
      transition: 0.3s;
      cursor: pointer;
    }
    .card-menu:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .icon {
      font-size: 40px;
    }
  </style>
</head>
<body>
    <div class="container-fluid p-0">
  <div class="card mb-1 border-0 rounded-0">

    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center fw-bold text-white"
      style="background-color: #1877F2;">

      <!-- Kiri: Title -->
      <div>
        ATTENDANCE
      </div>

      <!-- LOGOUT -->
      <button id="btnLogout" class="btn btn-sm btn-outline-danger fw-semibold px-3">
          <i class="fa fa-sign-out me-1"></i> Logout
      </button>

    </div>

  </div>
</div>

    <div class="container py-4">

        <div class="card mb-4 p-3">
  <div class="row align-items-center">

    <!-- User -->
    <div class="col-12 col-md-6 d-flex align-items-center mb-3 mb-md-0">
      <i class="bi bi-person-circle fs-1 text-primary me-3"></i>
      <div>
        <div><strong id="nama_user"></strong></div>
      </div>
    </div>

    <!-- Lokasi (dengan garis bawah) -->
    <div class="col-12 col-md-6 d-flex align-items-center mb-3 mb-md-0 pb-2 border-bottom">
      <i class="bi bi-geo-alt fs-1 text-danger me-3"></i>
      <div>
        <div>Lokasi Presensi : <strong id="nama_tempat"></strong></div>
      </div>
    </div>

    <!-- Jam (CENTER) -->
    <div class="col-12 d-flex justify-content-center mt-3">
      <span class="me-3">
        <i class="bi bi-clock text-success"></i> Datang: <strong id="datang_abs"></strong>
      </span>
      <span>
        <i class="bi bi-clock-history text-warning"></i> Pulang: <strong id="pulang_abs"></strong>
      </span>
    </div>

  </div>
</div>
 

        <div class="row g-4">

  <!-- Absen Datang -->
                <div class="col-4 col-md-4" id="presensi_datang">
                    <div class="card card-menu text-center p-1">
                    <div class="icon text-primary">
                        <i class="bi bi-box-arrow-in-right"></i>
                    </div>
                    <h6 class="mt-2">Presensi Datang</h6>
                    </div>
                </div>

  <!-- Absen Pulang -->
                <div class="col-4 col-md-4" id="presensi_pulang">
                    <div class="card card-menu text-center p-1">
                    <div class="icon text-danger">
                        <i class="bi bi-box-arrow-left"></i>
                    </div>
                    <h6 class="mt-2">Presensi Pulang</h6>
                    </div>
                </div>

  <!-- Penugasan Datang -->
                <div class="col-4 col-md-4" id="penugasan_datang">
                    <div class="card card-menu text-center p-1">
                    <div class="icon text-success">
                        <i class="bi bi-briefcase"></i>
                    </div>
                    <h6 class="mt-2">Penugasan Datang</h6>
                    </div>
                </div>

  <!-- Penugasan Pulang -->
                <div class="col-4 col-md-4">
                    <div class="card card-menu text-center p-1" id="penugasan_pulang">
                    <div class="icon text-warning">
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                    <h6 class="mt-2">Penugasan Pulang</h6>
                    </div>
                </div>

                <!-- Riwayat Presensi -->
                <div class="col-4 col-md-4">
                    <div class="card card-menu text-center p-1" id="riwayat_presensi">
                    <div class="icon text-info">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h6 class="mt-2">Riwayat Presensi</h6>
                    </div>
                </div>

                <!-- Presensikan Teman -->
                <div class="col-4 col-md-4">
                    <div class="card card-menu text-center p-1" id="presensi_teman">
                    <div class="icon text-secondary">
                        <i class="bi bi-people"></i>
                    </div>
                    <h6 class="mt-2">Presensikan Teman</h6>
                    </div>
                </div>

        </div>

        <div class="card mt-4 p-3">

  <!-- Baris 1: Tanggal + garis bawah -->
            <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                <i class="bi bi-calendar-event fs-4 text-primary me-2"></i>
                <strong id="tgnnya"></strong>
            </div>

            <!-- Baris 2: Datang -->
            <div class="d-flex justify-content-between align-items-start mb-3">

                <div class="d-flex flex-column">
                <div class="d-flex align-items-center">
                    <i class="bi bi-box-arrow-in-right text-success me-2"></i>
                    <span>Datang</span>
                </div>
                <small class="text-muted ms-4" id="ket_nw"></small>
                </div>

                <div class="fw-bold text-success" id="dtg_nw">
                
                </div>

            </div>

            <!-- Baris 3: Pulang -->
            <div class="d-flex justify-content-between align-items-start">

                <div class="d-flex flex-column">
                <div class="d-flex align-items-center">
                    <i class="bi bi-box-arrow-left text-danger me-2"></i>
                    <span>Pulang</span>
                </div>
                <small class="text-muted ms-4" id="ket_plg"></small>
                </div>

                <div class="fw-bold text-danger" id="plg_nw">
                
                </div>

            </div>

        </div>
    </div>

    

</body>
</html>
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript" src="js/sweet.js"></script>
<script type="text/javascript" src="js/link.js"></script>

<script>
           var nama = localStorage.getItem("nama");
           var nama_tempat = localStorage.getItem("nama_tempat");
           var datang_abs = localStorage.getItem("absen_datang");
           var pulang_abs = localStorage.getItem("absen_pulang");
           var id_use = localStorage.getItem("id");

           var a,b;


           document.getElementById("nama_user").textContent = nama;
           document.getElementById("nama_tempat").textContent = nama_tempat;
          


          // document.getElementById("role").textContent = level;
          $(document).ready(function() {

            tampil_waktu();
            function tampil_waktu(){

              $.ajax({
                    url: linker_api + 'api/user/kembali/' + id_use,
                    type: 'get',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    },

                    success: function(data) {
                        
                        document.getElementById("datang_abs").textContent = data.absen_datang;
                        document.getElementById("pulang_abs").textContent = data.absen_pulang;

                       
                    },
                    error: function(xhr, status, error) {                    
                      let info = xhr.responseJSON.errors; 
                      
                      if(xhr.status == 404 || xhr.status == 401) info = xhr.responseJSON.message;
                      Swal.fire({
                          icon: "error",
                          title: "Oops...",
                          text: info.username || info.password || info,
                      });
                     

                  }
                });

            } 

          

            tampil_data();
            function tampil_data(){
                  $.ajax({
                    url: linker_api + 'api/absensi/show/' + id_use,
                    type: 'get',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    },

                    success: function(data) {
                        
                        $("#ket_nw").text(data.data.keterangan_datang);
                        $("#dtg_nw").text(data.data.jam_datang);
                        $("#ket_plg").text(data.data.keterangan_pulang);
                        $("#plg_nw").text(data.data.jam_pulang);


                        const bulan = [
                            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                        ];

                        let tgl = new Date(data.data.tgl);

                        let formatted = tgl.getDate() + " " +
                            bulan[tgl.getMonth()] + " " +
                            tgl.getFullYear();

                        $("#tgnnya").text(formatted);
                      
                        

                       
                    },
                    error: function(xhr, status, error) {                    
                      let info = xhr.responseJSON.errors; 
                      
                      if(xhr.status == 404 || xhr.status == 401) info = xhr.responseJSON.message;
                            $("#ket_nw").text("");
                            $("#dtg_nw").text("");
                            $("#ket_plg").text("");
                            $("#plg_nw").text("");

                      }
                });
            }

            $(document).on('click', '#presensi_datang', function() {
                     window.location.assign('absensi_datang');
                     a = 0;
                     localStorage.setItem('code', a);
            });

            $(document).on('click', '#presensi_pulang', function() {
                     window.location.assign('absensi_datang');
                     b = 1;
                     localStorage.setItem('code', b);
            });

            //penugasan
            $(document).on('click', '#penugasan_datang', function() {
                     window.location.assign('penugasan');
                     a = 0;
                     localStorage.setItem('code', a);
            });

            $(document).on('click', '#penugasan_pulang', function() {
                     window.location.assign('penugasan');
                     b = 1;
                     localStorage.setItem('code', b);
            });

            $(document).on('click', '#riwayat_presensi', function() {
                window.location.assign('/attendance/riwayat_presensi.html');
            });

            $(document).on('click', '#presensi_teman', function() {
                window.location.assign('presensikan_teman.html');
            });

            $(document).on('click', '#btnLogout', function () {

              Swal.fire({
                  title: 'Logout?',
                  text: "Yakin ingin keluar?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#198754',
                  cancelButtonColor: '#6c757d',
                  confirmButtonText: 'Ya',
                  cancelButtonText: 'Tidak'
              }).then((result) => {

                  if (result.isConfirmed) {

                      $.ajax({
                          url: linker_api + "api/logout",
                          type: 'POST',
                          headers: {
                              'Accept': 'application/json',
                              'Authorization': 'Bearer ' + localStorage.getItem('token')
                          },

                          success: function () {

                              
                              localStorage.removeItem('token');

                              window.location.assign("login_users");
                          },

                          error: function () {
                              Swal.fire('Error', 'Gagal logout', 'error');
                          }
                      });

                  }

              });

          });

          });
</script>           
