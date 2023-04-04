<?php
    $theme=$_SESSION['theme'];
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['theme']=$theme;
?>