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
    <header class="app-header"><a class="app-header__logo" href="teacherhome">Teacher</a>
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
                            url: "<?php echo base_url('clearnotificationteacher') ?>",
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
            </div>
            <!-- <li class="app-notification__footer"><a href="#">See all notifications.</a></li> -->
          </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">

            <li><a class="dropdown-item" href="teacherprofile"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div id="hoverclick" onclick="location.href='teacherprofile';" class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo $user_info['link_foto'] ?>" alt="User Image" info>
        <div>
          <p class="app-sidebar__user-name"><?php echo $user_info['name'] ?></p>
          <p class="app-sidebar__user-designation">Teacher</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="teacherhome"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Class</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <?php foreach ($list_kelas as $kelas) { ?>
              <li><a class="treeview-item" href="teacherdata?id=<?php echo $kelas['id_kelas'] ?>&idmapel=<?php echo $kelas['id_mata_pelajaran'] ?>"><i class="icon fa fa-circle-o"></i><?php echo $kelas['name_kelas'] . ' - ' . $kelas['name_mata_pelajaran'] ?></a></li>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </aside>
    <main class="app-content">
      <div class="row user">
        <div class="col-md-12">
          <div class="profile">
            <div class="info"><img class="user-img" src="<?php echo $user_info['link_foto'] ?>">
              <h4><?php echo $user_info['name'] ?></h4>
              <p>Teacher</p>
            </div>
            <div class="cover-image"></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item"><a class="nav-link active" href="#user-profile" data-toggle="tab">Profile</a></li>
              <li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Settings</a></li>
            </ul>
          </div>
        </div>
        <!-- Profile -->
        <div class="col-md-6">
          <div class="tab-content">
            <div class="tab-pane active" id="user-profile">
              <div class="tile user-settings">
                <h4 class="line-head">Profile</h4>
                <?php
                if (!empty(session()->getFlashdata('sekolah.project_uas.success'))) { ?>

                  <div class="alert alert-success">
                    <?php echo session()->getFlashdata('sekolah.project_uas.success'); ?>
                  </div>

                <?php } ?>
                <?php
                if (!empty(session()->getFlashdata('sekolah.project_uas.fail'))) { ?>

                  <div class="alert alert-danger">
                    <?php echo session()->getFlashdata('sekolah.project_uas.fail'); ?>
                  </div>

                <?php } ?>
                <form>
                  <div class="row">
                    <div class="col-md-12 mb-4 text-center">
                      <!-- <label>Photo</label> -->
                      <img class="img-fluid mx-auto responsive-img img-thumbnail" src="<?php echo $user_info['link_foto'] ?>" alt="No images available">
                    </div>
                    <div class="col-md-12 mb-4">
                      <label>Name</label>
                      <input value="<?php echo $user_info['name']; ?>" class="form-profile" type="text">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 mb-4">
                      <label>Birthdate</label>
                      <input value="<?php echo $user_info['birthdate']; ?>" class="form-profile" type="text">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 mb-4">
                      <label>Email</label>
                      <input value="<?php echo $user_info['email']; ?>" class="form-profile" type="text">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 mb-4">
                      <label>Password</label>
                      <input value="*****" class="form-profile" type="text">
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="tab-pane fade" id="user-settings">
              <div class="tile user-settings">
                <h4 class="line-head">Settings</h4>
                <?php
                if (!empty(session()->getFlashdata('sekolah.project_uas.success'))) { ?>

                  <div class="alert alert-success">
                    <?php echo session()->getFlashdata('sekolah.project_uas.success'); ?>
                  </div>

                <?php } ?>
                <?php
                if (!empty(session()->getFlashdata('sekolah.project_uas.fail'))) { ?>

                  <div class="alert alert-danger">
                    <?php echo session()->getFlashdata('sekolah.project_uas.fail'); ?>
                  </div>

                <?php } ?>
                <?php if ($user_info['izin_edit'] == "true") { ?>
                  <form action="teacherupdateprofile" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-12 mb-4 text-center">
                        <img class="img-fluid mx-auto responsive-img img-thumbnail" src="<?php echo $user_info['link_foto'] ?>" alt="No images available">
                      </div>
                      <div class="col-md-12 mb-4">
                        <label>Name</label>
                        <input value="<?php echo $user_info['name']; ?>" name="name_editprofile" class="form-control" type="text">
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 mb-4">
                        <label>Birthdate</label>
                        <input value="<?php echo $user_info['birthdate']; ?>" name="birthdate_editprofile" class="form-control" type="date">
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 mb-4">
                        <label>Email</label>
                        <input value="<?php echo $user_info['email']; ?>" name="email_editprofile" class="form-control" type="text">
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 mb-4">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password_editprofile" placeholder="Leave empty to not change. . .">
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 mb-4">
                        <label>Confirm Password</label>
                        <input class="form-control" type="password" name="confirm_password_editprofile" placeholder="Leave empty to not change. . .">
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 mb-4">
                        <label>Upload Photo</label><br>
                        <label for="poster" class="btn btn-primary">
                          <img id="output_image" src="<?php echo $user_info['link_foto']; ?>" alt="" width="300"> <i class="fas fa-edit"></i>
                        </label>
                        <input id="poster" name="upload_foto" type="file" onchange="preview_image(event)" style="display:none" />
                      </div>
                    </div>
                    <div class="row mb-10">
                      <div class="col-md-12">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                      </div>
                    </div>
                  </form>
                <?php } else { ?>
                  <span style="display:block" class="d-none alert alert-success mb-3" id="res_message"></span>
                  <!-- tidak dapat mengedit... minta izin kepada admin untuk melakukan edit... -->
                  <form action="javascript:void(0)" id="ajax_form_request_permission" method="post" accept-charset="utf-8">
                    <input type="hidden" name="id_user" value="<?php echo $user_info['id_user'] ?>">
                    <button type="submit" id="send_form_request" class="btn btn-info">Minta izin edit</button>
                  </form>
                <?php } ?>
              </div>
            </div>
          </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>


    <script type='text/javascript'>
      function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('output_image');
          output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
      }
    </script>
    <script>
      if ($("#ajax_form_request_permission").length > 0) {
        $("#ajax_form_request_permission").validate({

          // rules: {
          //     name: {
          //         required: true,
          //     },

          //     email: {
          //         required: true,
          //         maxlength: 50,
          //         email: true,
          //     },

          //     message: {
          //         required: true,
          //     },
          // },
          // messages: {

          //     name: {
          //         required: "Please enter name",
          //     },
          //     email: {
          //         required: "Please enter valid email",
          //         email: "Please enter valid email",
          //         maxlength: "The email name should less than or equal to 50 characters",
          //     },
          //     message: {
          //         required: "Please enter message",
          //     },

          // },
          submitHandler: function(form) {
            $('#send_form_request').html('Sending..');
            $.ajax({
              url: "<?php echo base_url('teacheraskeditpermission') ?>",
              type: "POST",
              data: $('#ajax_form_request_permission').serialize(),
              dataType: "json",
              success: function(response) {
                console.log(response);
                console.log(response.success);
                $('#send_form_request').html('Minta izin edit');
                $('#res_message').html(response.msg);
                $('#res_message').show();
                $('#res_message').removeClass('d-none');

                document.getElementById("ajax_form_request_permission").reset();
                setTimeout(function() {
                  $('#res_message').hide();
                  $('#res_message').html('');
                }, 10000);
              }
            });
          }
        })
      }
    </script>
  </body>
</php>