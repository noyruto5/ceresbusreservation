<?php
include "php_library/SiteBasics.php";
include "php_library/Reservation.php";

$reservation = new Reservation;
$reservation->available_seats();
?>