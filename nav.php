<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <img alt="image" class="img-circle" src="img/site-logo-small.png"/>
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold" style="color:white;">Web-base Booking and Reservation</strong><br/></span></span>
            </li>
            <li>
                <a href="index.php"><i class="fa fa-home"></i> <span class="nav-label">Home</span> </a>
            </li>
            <li <?php if($basename == 'add_bus_details.php' OR $basename == 'bus_details.php') {echo "class='active'";} ?>>
                <a href="bus_details.php"><i class="fa fa-bus"></i> <span class="nav-label">Bus Details</span></a>
            </li>
         
            <?php if($site_basics->get_role() == 'guest') {?>

            <li <?php if($basename == 'reservation_form.php' OR $basename == 'reserved_passengers.php') {echo "class='active'";} ?> >
                <a href="reservation_form.php"><i class="fa fa-book"></i> <span class="nav-label">Reservation Form</span></a>
            </li>
            <?php } else {?>
            <li <?php if($basename == 'reservation_form.php' OR $basename == 'reserved_passengers.php') {echo "class='active'";} ?> >
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">Book and Reservation</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="reservation_form.php">Reservation Form</a></li>
                    <li><a href="reserved_passengers.php">Reserved Passengers</a></li>
                </ul>
            </li>
            <?php }?>

            <?php if($site_basics->get_role() != 'guest') {?>
            <li <?php 
                    if($basename == 'bus_trip_reports.php' OR
                        $basename == 'reservation_reports.php' OR
                        $basename == 'paypal_payments.php' OR
                        $basename == 'terminal_payments.php') 
                    {echo "class='active'";} 
                    ?>
                    >
                <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="bus_trip_reports.php">Bus Trip Reports</a></li>
                    <li><a href="reservation_reports.php">Reservation Reports</a></li>
                </ul>
            </li>
            <?php }?>

            <li>
                <a href="contacts.php"><i class="fa fa-phone"></i> <span class="nav-label">Contacts</span>
            </li>
        </ul>

    </div>
</nav>

<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to Web-based Booking and Reservation System.</span>&nbsp;&nbsp;
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
    </div>