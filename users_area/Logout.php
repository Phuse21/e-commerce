<?php

session_start();

if (isset($_SESSION['user_id'])) {

    unset($_SESSION['user_id']);
    $_SESSION['user_id'] = NULL;
}

session_destroy();

header("Location: ../index.php");