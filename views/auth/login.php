<?php
    include ('config/config.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap/4.6.1/css/bootstrap.css">
    <link rel="stylesheet" href="assets/plugins/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body class="hold-transition login-page <?php if (isset($_COOKIE["is_mode"])) { ?>dark-mode <?php } ?>" id="mybody"> 
    <div class="wrapper">
        <nav class="navbar navbar-expand">
            <ul class="navbar-nav ml-auto">
                <div class="custom-control custom-switch custom-switch-off-primary custom-switch-on-info">
                    <input type="checkbox" class="custom-control-input" id="dark"
                        <?php if (isset($_COOKIE["is_mode"])) { ?> checked <?php } ?>>
                    <label class="custom-control-label" for="dark"></label>
                </div>
            </ul>
        </nav>
        <section class="content">
            <div class="container-fluid">
                <div class="lockscreen-wrapper">
                    <div class="login-box">
                        <div class="card card-outline card-primary">
                            <div class="card-header text-center">
                                <a href="index.php"><img src="assets/img/logo.png" alt="User Image"></a>
                            </div>
                            <div class="card-body">
                                <?php 
                                    if(isset($_GET['msg'])){
                                        if($_GET['msg'] == "failed"){
                                            echo "<div class='alert alert-danger text-center' role='alert'>
                                            <strong>LOGIN GAGAL!</strong> <br />Username atau Password Salah!
                                          </div>";
                                        } else if ($_GET['msg'] == "success_logout") {
                                            echo "<div class='alert alert-success text-center' role='success'>
                                            <strong>LOGOUT BERHASIL!</strong></div>";
                                        } else if ($_GET['msg'] == "token_invalid") {
                                            echo "<div class='alert alert-danger text-center' role='alert'>
                                            <strong>LOGIN GAGAL!</strong> <br />Token Tidak Sesuai!
                                          </div>";
                                        }
                                    }
                                ?>
                                <form action="core/check_login.php" method="POST" onSubmit="return validasi(this)"
                                    autocomplete="off">
                                    <?php
                                        $sql = 'SELECT username, password FROM users';
                            
                                        $query = mysqli_query($conn, $sql);
                                        
                                        if (!$query) {
                                            die ('SQL Error: ' . mysqli_error($conn));
                                        }
            
                                        $row = mysqli_fetch_array($query);
                                    ?>
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="key" id="key" value="<?= $_SESSION['csrf_token'] ?>">
                                        <input type="text" id="username" name="username" class="form-control"
                                            value="<?= $row["username"] ?>" placeholder="Username" required
                                            maxlength="15">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-danger" id="err_id"></p>
                                    <div class="input-group mb-3">
                                        <input type="password" id="pass" name="pass" class="form-control"
                                            placeholder="Password" required maxlength="10" autocomplete="off">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-danger" id="err_ps"></p>
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="checkbox" id="remember" name="remember"
                                                <?php if (isset($_COOKIE["is_login"])) { ?> checked <?php } ?>>
                                            <label for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                        <div class="col-4">
                                            <input type="submit" class="btn btn-primary btn-block" value="Sign In ">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="assets/plugins/jquery/jquery.min.js?x"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js?x"></script>
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/adminlte.min.js?x"></script>
    <script src="assets/js/main.js?x"></script>
    <script src="assets/js/script.js?x"></script>
    <script type="text/javascript">
    function validasi(form) {
        var iusername = form.username.value;
        var username = iusername.trim();
        var ipass = form.pass.value;
        var pass = ipass.trim();
        pola_data = /^[a-zA-Z0-9+\_\-]{3,15}$/;
        pola_email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (username == "") {
            $("#err_id").html("Username tidak boleh kosong.");
            form.user.focus();
            return (false);
        } else if (!pola_data.test(username)) {
            $("#err_id").html("Username tidak sesuai!");
            form.user.focus();
            return (false);
        } else if (pass == "") {
            $("#err_ps").html("Password tidak boleh kosong.");
            form.pass.focus();
            return (false);
        } else if (!pola_data.test(pass)) {
            $("#err_ps").html("Password tidak sesuai!");
            form.pass.focus();
            return (false);
        }
        $("#err_id").html("");
        $("#err_ps").html("");
        return (true);
    }
    $(function() {
        $('#dark').on('change', function() {
            $('#mode').prop('checked', this.checked);
            if (this.checked) {
                $('#mybody').attr('class', 'hold-transition login-page dark-mode');
            } else {
                $('#mybody').attr('class', 'hold-transition login-page');
            }
        });
    });
    </script>

</body>

</html>