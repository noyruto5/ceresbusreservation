<?php include "php_library/SiteBasics.php"; ?>
<?php $site_basics = new SiteBasics; ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php $site_basics->site_title("Register"); ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">

</head>

<body class="gray-bg">

    
    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <?php $site_basics->register(); ?>
            <?php if(isset($site_basics->input_warning)) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?php echo $site_basics->input_warning; ?>
                </div>
            <?php } ?>

            <div>
                <h1 class="logo-name" style="font-size: 50px; letter-spacing: 0px;">WeBR</h1>
            </div>


            <h3>Register to WeBR</h3>
            <p>Create account to see it in action.</p>
            <form class="m-t" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" required="" name="username">
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="First Name" required="" name="fname">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Last Name" required="" name="lname">
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Purok" required="" name="prk">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Brgy" required="" name="brgy">
                    </div>
                </div>
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="City" required="" name="city">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Province" required="" name="province">
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required="" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="" name="password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" required="" name="confirm_password">
                </div>
                <hr>
                <button type="submit" name="register" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login.php">Login</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
