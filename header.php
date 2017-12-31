<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php $site_basics->site_title("Reservation Form"); ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.16/b-1.4.2/b-html5-1.4.2/b-print-1.4.2/datatables.min.css"/>

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">

    <?php if ($basename == "reservation_form.php" OR $basename == "res_passengers_record.php") {?>
        <link href="css/bus_seats.css" rel="stylesheet">
    <?php } ?>

    <?php if ($basename == "reserved_passengers.php") {?>
        <style>
        #table-reservation{
            cursor: pointer;
        }
        </style>
    <?php } ?>

    <?php if ($basename == "res_passengers_record.php") {?>
        <style>
            table.tbl-pass-record{
                margin: 25px 0px 50px 0px;
            }

            table.tbl-pass-record td{
                padding: 15px;
                padding-left: 0px;
            }
        </style>
    <?php } ?>

    <?php if ($basename == "payment_success.php") {?>
        <style>
            table, table td{
                border: 0px;
            }
            table td{
                padding: 5px;
                padding-left: 0px;
            }
        </style>
    <?php } ?>

    <?php if ($basename == "finish_reservation.php") {?>
        <style>
            .finish-res-content table td{
                padding: 5px;
                padding-left: 0px;
                padding-right: 10px;
            }

            .finish-res-content p{
                font-size: 15px;
            }
        </style>
    <?php } ?>

    <?php if ($basename == "reservation_reports.php") {?>
        <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <?php } ?>

</head>