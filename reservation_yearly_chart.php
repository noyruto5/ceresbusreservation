<?php
include "php_library/SiteBasics.php";
include "php_library/ReservationReports.php";

$res_reports = new ReservationReports;
$res_reports->yearly_res_chart();
?>