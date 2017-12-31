<?php
include "php_library/SiteBasics.php";
include "php_library/Reservation.php";

$res = new Reservation;
$res->update_seat();
?>