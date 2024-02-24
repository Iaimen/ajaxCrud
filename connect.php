<?php

$con = new mysqli('localhost', 'root', '', 'php');

if (!$con) {
    die(mysqli_error($con));
}
?>