<?php
    require "common/conn.php";

    unset($_SESSION);
    session_destroy();
    header("location: guest_home_page.php");

?>