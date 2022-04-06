<?php
//  check if a session is already started and active.
if (session_status() === PHP_SESSION_NONE)
{
    // start session
    session_start();
}


$con=mysqli_connect("localhost","root","","examination_system");

if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " .mysqli_connect_error();
}
?>