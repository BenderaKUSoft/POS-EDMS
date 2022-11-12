<?php

if (isset($_POST['time_in'])) {

    session_start();

    $_SESSION['time_export'] = $_POST;
}

if (isset($_POST['download_id']) && isset($_POST['status_download'])) {

    session_start();
    
    $_SESSION['data'] = $_POST;

}

?>