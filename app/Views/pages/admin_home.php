<!DOCTYPE php>
<php lang="en">

  <head>
    <title>Pendataan Nilai Sekolah</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <script src="https://kit.fontawesome.com/2ae0411939.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
  </head>

  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="adminhome">Admin</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
      
        <!--Notification Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"> <span id="notification_amount" class="counter counter-lg"><?php echo $notification_amount; ?></span></i></a>
          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <li id="notification_amount_text" class="app-notification__title">Notifications</li>
            <div class="app-notification__content">
              <?php
              if ($notification_list != null) {
                foreach ($notification_list as $notification) { ?>
                  <li id="ajax_form_notification<?php echo $notification['id_notification']; ?>">
                    <a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                      <div>
                        <p class="app-notification__message" style="display:inline-block !important; width:70%;"><?php echo $notification['message']; ?></p>
                        <!-- <p class="app-notification__meta">2 min ago</p> -->
                        <form action="javascript:void(0)" id="ajax_form_clear_notification<?php echo $notification['id_notification']; ?>" method="post" accept-charset="utf-8" style="display:inline-block !important;width:20%;">
                          <input type="hidden" name="id_notification" value="<?php echo $notification['id_notification']; ?>">
                          <button class="btn btn-warning" type="submit">Clear</button>
                        </form>
                      </div>
                    </a>
                  </li>
                  <script>
                    if ($("#ajax_form_clear_notification<?php echo $notification['id_notification']; ?>").length > 0) {
                      $("#ajax_form_clear_notification<?php echo $notification['id_notification']; ?>").validate({
                        submitHandler: function(form) {
                          $.ajax({
                            url: "<?php echo base_url('clearnotificationadmin') ?>",
                            type: "POST",
                            data: $('#ajax_form_clear_notification<?php echo $notification['id_notification']; ?>').serialize(),
                            dataType: "json",
                            success: function(response) {
                              console.log(response);
                              console.log(response.success);
                              // $('#send_form_request').html('Minta izin edit');
                              // $('#res_message').html(response.msg);
                              // $('#res_message').show();
                              // $('#res_message').removeClass('d-none');

                              document.getElementById("ajax_form_notification<?php echo $notification['id_notification']; ?>").style.display = "none";
                              var notification_amount = document.getElementById("notification_amount").innerHTML;
                              notification_amount = parseInt(notification_amount);
                              notification_amount = notification_amount - 1;
                              document.getElementById("notification_amount").innerHTML = notification_amount;
                              // // setTimeout(function() {
                              //   $('#res_message').hide();
                              //   $('#res_message').html('');
                              // }, 10000);
                            }
                          });
                        }
                      })
                    }
                  </script>
              <?php }
              } ?>
              <!-- <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">Mail server not working</p>
                    <p class="app-notification__meta">5 min ago</p>
                  </div>
                </a></li>
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">Transaction complete</p>
                    <p class="app-notification__meta">2 days ago</p>
                  </div>
                </a></li>
              <div class="app-notification__content">
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Lisa sent you a mail</p>
                      <p class="app-notification__meta">2 min ago</p>
                    </div>
                  </a></li>
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Mail server not working</p>
                      <p class="app-notification__meta">5 min ago</p>
                    </div>
                  </a></li>
                <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                    <div>
                      <p class="app-notification__message">Transaction complete</p>
                      <p class="app-notification__meta">2 days ago</p>
                    </div>
                  </a></li> -->
            </div>
            <!-- <li class="app-notification__footer"><a href="#">See all notifications.</a></li> -->
          </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
        
            <li><a class="dropdown-item" href="<?php echo base_url('adminprofile') ?>"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('logout') ?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div id="hoverclick" onclick="location.href='adminprofile';" class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo $user_info['link_foto'] ?>" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?php echo $user_info['name'] ?></p>
          <p class="app-sidebar__user-designation">Admin</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="adminhome"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item " href="adminclass"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Class List</span></a></li>
        <li><a class="app-menu__item " href="adminteacher"><i class="app-menu__icon fa fa-black-tie"></i><span class="app-menu__label">Teacher List</span></a></li>
        <li><a class="app-menu__item " href="adminstudent"><i class="app-menu__icon fa fa-github-alt"></i><span class="app-menu__label">Student List</span></a></li>
        <li><a class="app-menu__item " href="admincourse"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Course List</span></a></li>
        <li><a class="app-menu__item " href="adminuser"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">User List</span></a></li>
        <li><a class="app-menu__item " href="adminall"><i class="app-menu__icon fa fa-cubes"></i><span class="app-menu__label">Class Allocation</span></a></li>
      </ul>
    </aside>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="adminhome">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <div onclick="location.href='adminclass';" class="widget-small primary coloured-icon hoverclick"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4><a href="adminclass">Class List</a></h4>
              <p><b></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-lg-12">
          <div onclick="location.href='adminteacher';" class="widget-small info coloured-icon hoverclick"><i class="icon fa fa-black-tie fa-3x"></i>
            <div class="info">
              <h4><a href="adminteacher">Teacher List</a></h4>
              <p><b></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-lg-12">
          <div onclick="location.href='adminstudent';" class="widget-small warning coloured-icon hoverclick"><i class="icon fa fa-github-alt fa-3x"></i>
            <div class="info">
              <h4><a href="adminstudent">Student List</a></h4>
              <p><b></b></p>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-lg-12">
          <div onclick="location.href='admincourse';" class="widget-small danger coloured-icon hoverclick"><i class="icon fa fa-archive fa-3x"></i>
            <div class="info">
              <h4><a href="admincourse">Course List</a></h4>
              <p><b></b></p>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-lg-12">
          <div onclick="location.href='adminuser';" class="widget-small primary coloured-icon hoverclick"><i class="icon fa fa-user fa-3x"></i>
            <div class="info">
              <h4><a href="adminuser">User List</a></h4>
              <p><b></b></p>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-lg-12">
          <div onclick="location.href='adminall';" class="widget-small info coloured-icon hoverclick"><i class="icon fa fa-cubes fa-3x"></i>
            <div class="info">
              <h4><a href="adminall">Class Allocation</a></h4>
              <p><b></b></p>
            </div>
          </div>
        </div>



      </div>
      <!-- <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Monthly Sales</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Support Requests</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
            </div>
          </div>
        </div>
      </div> -->
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>
  </body>
</php>