<?php
    include ('../config/config.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Panel</title>
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
                                    } else if ($_GET['msg'] == "login_success") {
                                        echo "<div class='alert alert-success text-center' role='success'>
                                        <strong>LOGIN BERHASIL!</strong></div>";
                                    }
                                }
                            ?>
                            <div class="d-sm-flex justify-content-between align-items-center" style="text-transform:uppercase; font-weight:bold">
                                <h2>List Warehouse</h2>
                                <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    $datetimes = date('Y-m-d H:i:s');
                                ?>
                                <input type="hidden" name="time_now" id="time_now" value="<?= $datetimes ?>" />
                                <a href="../core/export.php"><button style="text-transform:uppercase; font-weight:bold; margin-right: 5px" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Export ke Excel</button></a>
                                <a href="downloads.php"><button style="text-transform:uppercase; font-weight:bold; margin-right: 5px" class="btn btn-info btn-sm"><i class="fa fa-task"></i> List Download</button></a>
                            </div>
                            <div class="data-tables datatable-dark">
                                <table id="data-table" class="table table-bordered text-center align-middle" style="width:100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Warehouse ID</th>
                                            <th>Nama</th>
                                            <th>Nama Display</th>
                                            <th>Provinsi ID</th>
                                            <th>Regensi Kota ID</th>
                                            <th>Distrik ID</th>
                                            <th>Kota</th>
                                            <th>Origin ID</th>
                                            <th>Status Gudang</th>
                                            <th>Internal</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = 'SELECT * FROM warehouses';
                                            
                                            $query = mysqli_query($conn, $sql);
                                            
                                            if (!$query) {
                                                die ('SQL Error: ' . mysqli_error($conn));
                                            }
                                            $no = 1;

                                            foreach ($query as $row) {
                                                echo "<tr>
                                                        <td>$no</td>
                                                        <td>".$row['warehousesId']."</td>
                                                        <td>".$row['name']."</td>
                                                        <td>".$row['displayName']."</td>
                                                        <td>".$row['provinceId']."</td>
                                                        <td>".$row['cityregencyId']."</td>
                                                        <td>".$row['districtId']."</td>
                                                        <td>".$row['city']."</td>
                                                        <td>".$row['idorigin']."</td>
                                                        <td>".$row['statusGudang']."</td>
                                                        <td>".$row['internal']."</td>
                                                        <td>".$row['address']."</td>
                                                    </tr>";
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
        $(document).ready(function () {
            $('#data-table').DataTable();
        });

        var getTime = document.getElementById("time_now").value;

        $.ajax({
            url: '../core/session.php',
            data: { time_in: getTime },
            type: 'POST'
        });
    </script>

</body>

</html>
