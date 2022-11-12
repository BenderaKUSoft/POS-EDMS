<?php
session_start();
unset($_SESSION['csrf_token']);
session_destroy();

header("Location: ../index.php?msg=success_logout");