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
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script> -->
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
    <div id="hoverclick" onclick="location.href='teacherprofile';" class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo $user_info['link_foto'] ?>" alt="User Image">
      <div>
        <p class="app-sidebar__user-name"><?php echo $user_info['name'] ?></p>
        <p class="app-sidebar__user-designation">Teacher</p>
      </div>
    </div>
    <ul class="app-menu">
      <li><a class="app-menu__item" href="teacherhome"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      </li>
      <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Class</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <?php foreach ($list_kelas as $kelas) { ?>
            <?php
            if ($kelas['id_kelas'] == $id_kelas) { ?>
              <!-- active -->
            <?php
            } else { ?>
              <!-- nonactive -->
            <?php
            } ?>
            <li><a class="treeview-item <?php echo ($kelas['id_kelas'] == $id_kelas && $kelas['id_mata_pelajaran'] == $id_mata_pelajaran ? 'active' : ''); ?>" href="teacherdata?id=<?php echo $kelas['id_kelas'] ?>&idmapel=<?php echo $kelas['id_mata_pelajaran'] ?>"><i class="icon <?php echo ($kelas['id_kelas'] == $id_kelas && $kelas['id_mata_pelajaran'] == $id_mata_pelajaran ? 'far fa-dot-circle' : 'fa fa-circle'); ?>"></i><?php echo $kelas['name_kelas'] . ' - ' . $kelas['name_mata_pelajaran'] ?></a></li>
          <?php } ?>
        </ul>
      </li>
    </ul>
  </aside>
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1></i><?php echo $id_kelas . ' - ' . $name_kelas . ' - ' . $list_alokasi[0]['name_mata_pelajaran'] ?></h1>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item active"><a href="#">Class</a></li>
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
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>

            <?php } ?>
            <?php
            if (!empty(session()->getFlashdata('sekolah.project_uas.fail'))) { ?>

              <div class="alert alert-danger">
                <?php echo session()->getFlashdata('sekolah.project_uas.fail'); ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>

            <?php } ?>
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Tugas 40%</th>
                    <th>UTS 30%</th>
                    <th>UAS 30%</th>
                    <th>Nilai Akhir</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($list_alokasi as $alokasi) { ?>
                    <tr>
                      <td><?php echo $alokasi['name_murid'] ?></td>
                      <td><?php echo $alokasi['id_murid'] ?></td>
                      <td><?php echo $alokasi['nilai_tugas'] ?></td>
                      <td><?php echo $alokasi['nilai_uts'] ?></td>
                      <td><?php echo $alokasi['nilai_uas'] ?></td>
                      <td><?php echo $alokasi['nilai_akhir'] ?></td>
                      <td>
                        <button type="button" class="btn btn-md btn-primary fas fa-pencil-alt noUnderlineCustom text-white" data-toggle="modal" data-target="#editModal<?php echo $alokasi['id_alokasi'] ?>"></button>
                        <!-- <button type="button" class="btn btn-md btn-danger fas fa-trash noUnderlineCustom text-white"></button> -->
                      </td>
                    </tr>
                    <div class="modal fade" id="editModal<?php echo $alokasi['id_alokasi'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Edit Nilai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <form action="teachereditnilaimodal" method="POST" enctype="multipart/form-data" id="ModalForm">
                              <input type="hidden" name="id_kelas_edit" value="<?php echo $id_kelas ?>">
                              <input type="hidden" name="id_mata_pelajaran_edit" value="<?php echo $alokasi['id_mata_pelajaran'] ?>">
                              <input type="hidden" name="id_alokasi_edit" value="<?php echo $alokasi['id_alokasi'] ?>">
                              <div class="form-group">
                                <label for="editClass">Nama</label>
                                <input type="text" name="name_edit" class="form-control" id="editName" value="<?php echo $alokasi['name_murid'] ?>" disabled>
                              </div>
                              <div class="form-group">
                                <label for="editSurname">ID Murid</label>
                                <input type="text" name="id_murid_edit" class="form-control" id="editSurname" value="<?php echo $alokasi['id_murid'] ?>" disabled>
                              </div>
                              <div class="form-group">
                                <label for="editEmail">Nilai Tugas</label>
                                <input type="text" name="tugas_edit" class="form-control" id="tugas_edit" placeholder="Masukkan angka" value="<?php echo $alokasi['nilai_tugas'] ?>">
                              </div>
                              <div class="form-group">
                                <label for="editEmail">Nilai UTS</label>
                                <input type="text" name="uts_edit" class="form-control" id="tugas_edit" placeholder="Masukkan angka" value="<?php echo $alokasi['nilai_uts'] ?>">
                              </div>
                              <div class="form-group">
                                <label for="editEmail">Nilai UAS</label>
                                <input type="text" name="uas_edit" class="form-control" id="tugas_edit" placeholder="Masukkan angka" value="<?php echo $alokasi['nilai_uas'] ?>">
                              </div>
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
    $(document).ready(function() {
      // Setup - add a text input to each footer cell
      $('#sampleTable thead tr').clone(true).appendTo('#sampleTable thead');
      $('#sampleTable thead tr:eq(1) th').each(function(i) {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');

        $('input', this).on('keyup change', function() {
          if (table.column(i).search() !== this.value) {
            table
              .column(i)
              .search(this.value)
              .draw();
          }
        });
      });

      var table = $('#sampleTable').DataTable({
        orderCellsTop: true,
        fixedHeader: true
      });
    });
  </script>

</body>

</html>