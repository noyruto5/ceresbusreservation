<?php
    include "php_library/SiteBasics.php";
    $site_basics = new SiteBasics;
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ceres Bus Reservation | Account Verification</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">

        <?php if ($site_basics->verify_account() === TRUE) { ?>
            <h2 class="font-bold">Account activated</h2>
            <br />
            <div class="error-desc">
                Your account is now activated. Please click the button below to go to log in page.
            </div><br />
            <a href="login.php" class="btn btn-success">Log in</a>
        <?php } else { ?>
            <h2 class="font-bold">Verify your account</h2>
            <br />
            <div class="error-desc">
                A confirmation link has been emailed to you. Please sign in to your email and confirm your email address by 
                clicking the attached link to verify your account.
            </div>
        <?php } ?>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
