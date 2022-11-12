<?php
// Load file koneksi.php
include "../config/config.php";
require_once ('phpsheets.php');

session_start();

$wh = mysqli_query($conn, "SELECT status_download FROM warehouses");

if ($wh) {
    foreach ($wh as $row) {
        if ($row['status_download'] == 0) {
            $update = "UPDATE warehouses SET status_download = 1";
        } else if ($row['status_download'] == 1) {
            // header("Location: ../views/index.php?msg=proses_download");
            $update = "UPDATE warehouses SET status_download = 1";
        }
    }
    $data = mysqli_query($conn, $update);

    if ($data) {
        // Get User ID and Username
        $userId = $_SESSION['user_id'];
        $userName = $_SESSION['username'];
        $times = $_SESSION['time_export'];
        $keterangan = "Daftar Warehouse";

        if (is_array($times)) {
            $time_in = $times['time_in'];
        }

        // POST to Table Downloads
        $sql = "INSERT INTO downloads (user_id, username, keterangan, status, time_in) VALUES ('$userId', '$userName', '$keterangan', '0', '$time_in')";

        $query = mysqli_query($conn, $sql);

        header("Location: ../views/list_download.php");
    }
}

?>