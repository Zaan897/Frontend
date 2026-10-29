<?php error_reporting(0); ?>

<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>Attendance</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="index.html">Attendance</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="assets/images/users/avatar.jpg" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="assets/images/users/no-image.jpg" alt="John Doe"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name" id="nama_account"></div>
                                <div class="profile-data-title" id="role"></div>
                            </div>
                            <div class="profile-controls">
                               
                            </div>
                        </div>                                                                        
                    </li>
                    <li class="active">
                        <a href="4dm1n"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
                    </li> 
                    <li class="xn-title">Master File</li>
                                       
                    <li>
                        <a href="manage_users"><span class="fa fa-files-o"></span> <span class="xn-text">Manage Users</span></a>
                        
                    </li>
                    <li >
                        <a href="manage_lokasi"><span class="fa fa-file-text-o"></span> <span class="xn-text">Manage Lokasi</span></a>
                        
                    </li>

                    <li>
                        <a href="presensi_laporan">
                            <span class="fa fa-desktop"></span>
                            <span class="xn-text">Absence Record</span>
                        </a>
                    </li>

                    <li class="xn-title">Report</li>
                                     
                    <li>
                        <a href="laporan_harian">
                            <span class="fa fa-desktop"></span>
                            <span class="xn-text">Days</span>
                        </a>
                    </li>
                    <li>
                        <a href="laporan_bulanan"><span class="fa fa-files-o"></span> <span class="xn-text">Month</span></a>
                        
                    </li>
                    
                    
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                    <!-- MESSAGES -->
                    
                </ul>
                
                <?php
                    if($_GET['module']=="manage_users"){
                        include("module/manage_users.php");
                    }else if($_GET['module']=="manage_lokasi"){
                        include("module/manage_lokasi.php");
                    }else if($_GET['module']=="presensi_laporan"){
                        include("module/presensi_laporan.php");
                    }else if($_GET['module']=="laporan_harian"){
                        include("module/laporan_harian.php");   
                    }else if($_GET['module']=="laporan_bulanan"){
                        include("module/laporan_bulanan.php"); 
                    }else{
                        include("module/dash.php");
                    }
                ?>
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <button id="quit" class="btn btn-success btn-lg">Yes</button>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                  
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script> 
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>        
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

        
        <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script> 
        
        <script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>       
        <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>                
        <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>                 
        
        <script type="text/javascript" src="js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
         <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/sweet.js"></script>
        <script type="text/javascript" src="js/link.js"></script>

       
        
       
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->      
        <script>
           var nama = localStorage.getItem("nama");
           var level = localStorage.getItem("level");
           document.getElementById("nama_account").textContent = nama;
           document.getElementById("role").textContent = level;

            
           $(document).ready(function() {

                validasi();
                function validasi(){
                    $.ajax({
                        url:  linker_api +  "api/user/validasi", 
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

                $(document).on('click', '#quit', function() {

                    
                    $.ajax({
                            url: linker_api + "api/logout", 
                            type: 'POST',
                            headers: { 'Accept': 'application/json',
                                        'Authorization': 'Bearer ' + localStorage.getItem('token')  
                                        },
                        
                            success: function(data) {
                                window.location.assign("/attendance");

                            },
                    });
                    // alert("test");
                    return false; 
                });
           }); 
        </script>

        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>

 
        
        
    </body>
</html>






