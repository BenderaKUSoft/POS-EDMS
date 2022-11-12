<?php

include ('../config/config.php');
require ('phpsheets.php');

session_start();

$data = $_SESSION['data'];
$times = $_SESSION['time_export'];

if (is_array($data) && is_array($times)) {
    $download_id = $data['download_id'];
    $status = $data['status_download'];
    $time_in = $times['time_in'];

    $getValue = mysqli_query($conn, "SELECT Id, time_in FROM downloads WHERE Id='$download_id' AND status='$status'");

    if ($getValue) {
        $sql = "UPDATE downloads SET status = 1 WHERE Id='$download_id' AND time_in='$time_in'";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            Excel::saveExcel(true, $download_id, 1 );
            header("Location: ../views/list_download.php");
        }
    }
}

?>