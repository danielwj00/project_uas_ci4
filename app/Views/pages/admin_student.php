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
            </div>
            <!-- <li class="app-notification__footer"><a href="#">See all notifications.</a></li> -->
          </ul>
        </li>
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
  
          <li><a class="dropdown-item" href="adminprofile"><i class="fa fa-user fa-lg"></i> Profile</a></li>
          <li><a class="dropdown-item" href="login"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div id="hoverclick" onclick="location.href='adminprofile';" class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo $user_info['link_foto'] ?>" alt="User Image">
      <div>
        <p class="app-sidebar__user-name"><?php echo $user_info['name']; ?></p>
        <p class="app-sidebar__user-designation">Admin</p>
      </div>
    </div>
    <ul class="app-menu">
      <li><a class="app-menu__item " href="adminhome"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      <li><a class="app-menu__item " href="adminclass"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Class List</span></a></li>
      <li><a class="app-menu__item " href="adminteacher"><i class="app-menu__icon fa fa-black-tie"></i><span class="app-menu__label">Teacher List</span></a></li>
      <li><a class="app-menu__item active" href="adminstudent"><i class="app-menu__icon fa fa-github-alt"></i><span class="app-menu__label">Student List</span></a></li>
      <li><a class="app-menu__item " href="admincourse"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Course List</span></a></li>
      <li><a class="app-menu__item " href="adminuser"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">User List</span></a></li>
      <li><a class="app-menu__item " href="adminall"><i class="app-menu__icon fa fa-cubes"></i><span class="app-menu__label">Class Allocation</span></a></li>
    </ul>
  </aside>
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1></i>Student List</h1>
        <p></p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="#">Student List</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
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
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Option</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $id_role = 'R0003';
                  foreach ($list_murid as $murid) { ?>
                    <tr>
                      <td><?php echo $murid['id_murid'] ?></td>
                      <td><?php echo $murid['name'] ?></td>
                      <td><img src="<?php echo $murid['link_foto']; ?>" alt="" width="50"></td>
                      <td><button type="button" class="btn btn-md btn-primary fas fa-pencil-alt noUnderlineCustom text-white" data-toggle="modal" data-target="#editModal<?php echo $murid['id_user']; ?>"></button>
                        <a type="button" href="<?php echo base_url("admindeleteuserstudent?id=" . $murid['id_user'] . "&role=" . $id_role) ?>" class="btn btn-md btn-danger fas fa-trash noUnderlineCustom text-white"></a></td>
                    </tr>
                    <!-- Modal Form Option-->
                    <div class="modal fade" id="editModal<?php echo $murid['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Edit Siswa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <form action="<?php echo base_url('admineditmuridmodal') ?>" method="POST" enctype="multipart/form-data" method="POST" id="ModalForm">
                              <input type="hidden" id="editId" value="terserah">
                              <div class="form-group">
                                <label for="editId">ID</label>
                                <input type="text" class="form-control" id="editId" placeholder="ID" value="<?php echo $murid['id_user']; ?>" disabled>
                                <input type="hidden" name="id_edit" value="<?php echo $murid['id_user']; ?>">
                              </div>
                              <div class="form-group">
                                <label for="editClass">Email</label>
                                <input type="email" name="email_edit" class="form-control" id="editClass" placeholder="Email" value="<?php echo $murid['email']; ?>" disabled>
                              </div>
                              <div class="form-group">
                                <label for="editClass">Name</label>
                                <input type="text" name="name_edit" class="form-control" id="editClass" placeholder="Name" value="<?php echo $murid['name']; ?>" required>
                              </div>
                              <div class="form-group">
                                <label for="editBirthdase">Birthdate</label>
                                <input type="date" name="birthdate_edit" class="form-control" id="birthdate" placeholder="Birthdate" value="<?php echo $murid['birthdate']; ?>" required>
                              </div>
                              <input type="hidden" name="role_id" value="<?php echo $murid['id_role'] ?>">
                              <div class="modal-footer">
                                <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                <button type="submit" id="saveModalButton" class="btn btn-primary">Save changes</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>


                </tbody>
              </table>
            </div>
          </div>
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
  <!-- Page specific javascripts-->
  <!-- Data table plugin-->
  <script type="text/javascript" src="assets/js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#sampleTable').DataTable();
  </script>

</body>

</html>