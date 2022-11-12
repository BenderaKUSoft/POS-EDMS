<?php
    include ('../config/config.php');

    session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Download Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">

    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <?php
            include ('layouts/sidebar.php');
        ?>
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right align-center">
                            <li>
                                <h3>
                                    <div class="date">
                                        <script type='text/javascript'>
                                            <!--
                                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                                                'November', 'Desember'
                                            ];
                                            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                            var date = new Date();
                                            var day = date.getDate();
                                            var month = date.getMonth();
                                            var thisDay = date.getDay(),
                                                thisDay = myDays[thisDay];
                                            var yy = date.getYear();
                                            var year = (yy < 1000) ? yy + 1900 : yy;
                                            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                            //
                                            -->
                                        </script></b>
                                    </div>
                                </h3>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
                                        
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <?php 
                                if(isset($_GET['msg'])){
                                    if($_GET['msg'] == "proses_download"){
                                        echo "<div class='alert alert-warning text-center' role='warning'>
                                        <strong>WARNING!</strong> <br />Data sedang dalam proses export!
                                    </div>";
                                    }
                                }
                            ?>
                            <div class="d-sm-flex justify-content-between align-items-center" style="text-transform:uppercase; font-weight:bold">
                                <h2>Download List Wait</h2>
                                <a href='../views/index.php'><button style="text-transform:uppercase; font-weight:bold;" class="btn btn-info btn-sm"><i class="fa fa-arrow-left" style="margin-right: 5px;"></i> Kembali</button></a>
                            </div>
                            <div class="data-tables datatable-dark">
                                <table id="dataTable3" class="table table-bordered text-center align-middle" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>User ID</th>
                                            <th>Nama User</th>
                                            <th>Keterangan</th>
                                            <th>Status Unduh</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = 'SELECT * FROM downloads';
                                            
                                            $query = mysqli_query($conn, $sql);
                                            
                                            if (!$query) {
                                                die ('SQL Error: ' . mysqli_error($conn));
                                            }
                                            $no = 1;

                                            foreach ($query as $row) {
                                                echo "<tr>
                                                        <td>$no</td>
                                                        <td>".$row['user_id']."</td>
                                                        <td>".$row['username']."</td>
                                                        <td>".$row['keterangan']."</td>";

                                                        if ($row['status'] == 0) {
                                                            echo "<input type='hidden' id='key_id' value='".$row['Id']."'>";
                                                            echo "<input type='hidden' id='status' value='".$row['status']."'>";

                                                            echo "<td style='color: Orange;'>DALAM PROSES</td>";
                                                        }

                                                        if ($row['status'] == 1) {
                                                            $path_file = ($row['path_file']);

                                                            echo "<td style='color: Green;'>SELESAI</td>";

                                                            echo "<td><a href='../core/download.php?filename=$path_file'><button style='height: 30px; width: 30px; background-color: #4CAF50; border: none; color: white; text-align: center; text-decoration: none; display: inline-block;'><i class='fa fa-download'></i></button></a></td>";
                                                        } else {
                                                            echo "<td style='color: Red;'> TUNGGU </td>";
                                                        }

                                                echo "</tr>";
                                                $no++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- main content area end -->
    
    <div>
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>by ws</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->

    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="../assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="../assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <script type="text/javascript">

        var status = document.getElementById("status").value;
        var id = document.getElementById("key_id").value;

        $.ajax({
            url: '../core/session.php',
            data: { download_id: id, status_download: status },
            type: 'POST'
        });

        var url = "../core/proses_export.php"; // membuat url tujuan
        var count = 10; // membuat hitungan kedalam detik
        function countDown() {
            if (count > 0) {
                count--;
                $('#status');
                setTimeout("countDown()", 1000);
            } else {
                window.location.href = url;
            }
        }

        if (status == 0) {
            countDown();
        }
    </script>

</body>

</html>
