<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pendataan Nilai Sekolah</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <script src="https://kit.fontawesome.com/2ae0411939.js" crossorigin="anonymous"></script>
    <script>
        function toggleViewPsw() {
            var x = document.getElementById("inputpsw");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>One Stop Service</h1>
        </div>
        <div class="login-box">
            <form class="login-form" action="<?php echo base_url('do_login'); ?>" method="post">
                <?php $errors_validation = session()->getFlashdata('sekolah.project_uas.errors_validation_login'); ?>
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
                <div class="form-group">
                    <label class="control-label">EMAIL</label>
                    <input class="form-control " type="text" placeholder="Email" name="email" autofocus>
                    <div class="text-danger">
                        <?php 
                        // if ($errors_validation) {
                        //     if(array_key_exists('email', $errors_validation)){
                        //         echo '*' . $errors_validation['email'];
                        //     }
                        // } 
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">PASSWORD</label>
                    <div class="input-group">
                        <input id="inputpsw" class="form-control " type="password" placeholder="Password" name="password">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary" onclick="toggleViewPsw()">
                                <i class="far fa-eye "></i>
                            </button>
                        </div>
                    </div>
                    <p style="position:absolute; left:23%;"class="text-danger">
                        <?php 
                        // if ($errors_validation) {
                        //     if(array_key_exists('password', $errors_validation)){
                        //         echo '*' . $errors_validation['password'];
                        //     }
                        // }
                        $errors_login = session()->getFlashdata('sekolah.project_uas.errors_login');
                        if ($errors_login) {
                            echo '' . $errors_login;
                        }
                        ?>
                    </p>
                </div>
                <div class="form-group">
                    <div class="utility">
                        <div class="animated-checkbox">
                            <label>
                                <!-- <input type="checkbox" name="stay_signed_in" value="true"><span class="label-text">Stay Signed in</span> -->
                            </label>
                        </div>
                        <!-- <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p> -->
                    </div>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
                </div>
            </form>
            <!-- <form class="forget-form" action="<?php echo base_url('do_forgot_password') ?>" method="post">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
                <div class="form-group">
                    <label class="control-label">EMAIL</label>
                    <input class="form-control" type="text" placeholder="Email" name="email">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
                </div>
                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
                </div>
            </form> -->
        </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>
    <script type="text/javascript">
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function() {
            $('.login-box').toggleClass('flipped');
            return false;
        });
    </script>
</body>

</html>