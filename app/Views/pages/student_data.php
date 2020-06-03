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
    <header class="app-header"><a class="app-header__logo" href="studenthome">Student</a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">

            <!-- Notification Menu
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification__title">You have 4 new notifications.</li>
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
                                </a></li>
                        </div>
                    </div>
                    <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
                </ul>
            </li> -->
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">

                    <li><a class="dropdown-item" href="studentprofile"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div id="hoverclick" onclick="location.href='studentprofile';" class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo $user_info['link_foto'] ?>" alt="User Image" info>
            <div>
                <p class="app-sidebar__user-name"><?php echo $user_info['name']; ?></p>
                <p class="app-sidebar__user-designation"><?php echo $id_murid ?></p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item" href="studenthome"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
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
                        <li><a class="treeview-item <?php echo ($kelas['id_kelas'] == $id_kelas ? 'active' : ''); ?>" href="studentdata?id=<?php echo $kelas['id_kelas'] ?>"><i class="icon <?php echo ($kelas['id_kelas'] == $id_kelas ? 'far fa-dot-circle' : 'fa fa-circle'); ?>"></i><?php echo $kelas['id_kelas'] . ' - ' . $kelas['name_kelas'] ?></a></li>
                    <?php } ?>
                </ul>
            </li>
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1></i><?php echo $id_kelas . ' - ' . $name_kelas ?></h1>
                <p></p>
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
                            </div>

                        <?php } ?>
                        <?php
                        if (!empty(session()->getFlashdata('sekolah.project_uas.fail'))) { ?>

                            <div class="alert alert-danger">
                                <?php echo session()->getFlashdata('sekolah.project_uas.fail'); ?>
                            </div>

                        <?php } ?>
                        <div id="res_message_ajax_form_request_review" class="d-none alert alert-success">

                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>Tugas 40%</th>
                                        <th>UTS 30%</th>
                                        <th>UAS 30%</th>
                                        <th>Nilai Akhir</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alokasi_murid as $alokasi) { ?>
                                        <tr>
                                            <td><?php echo $alokasi['name_mata_pelajaran'] ?></td>
                                            <td><?php echo $alokasi['name_guru'] ?></td>
                                            <td><?php echo $alokasi['nilai_tugas'] ?></td>
                                            <td><?php echo $alokasi['nilai_uts'] ?></td>
                                            <td><?php echo $alokasi['nilai_uas'] ?></td>
                                            <td><?php echo $alokasi['nilai_akhir'] ?></td>
                                            <td>
                                                <form action="javascript:void(0)" id="ajax_form_request_review<?php echo $alokasi['id_alokasi'] ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_guru" value="<?php echo $alokasi['id_guru'] ?>">
                                                    <input type="hidden" name="id_murid" value="<?php echo $alokasi['id_murid']; ?>">
                                                    <input type="hidden" name="id_kelas" value="<?php echo $alokasi['id_kelas']; ?>">
                                                    <input type="hidden" name="name_kelas" value="<?php echo $name_kelas ?>">
                                                    <input type="hidden" name="id_user" value="<?php echo $user_info['id_user'] ?>">
                                                    <input type="hidden" name="name_mata_pelajaran" value="<?php echo $alokasi['name_mata_pelajaran'] ?>">
                                                    <button type="submit" id="send_form_request_review<?php echo $alokasi['id_alokasi'] ?>" class="btn btn-primary">Request Review (Protes)</button>
                                                </form>
                                                <script>
                                                    if ($('#ajax_form_request_review<?php echo $alokasi['id_alokasi'] ?>').length > 0) {
                                                        $('#ajax_form_request_review<?php echo $alokasi['id_alokasi'] ?>').validate({
                                                            submitHandler: function(form) {
                                                                $('#send_form_request_review<?php echo $alokasi['id_alokasi'] ?>').html('Sending...');
                                                                $.ajax({
                                                                    url: "<?php echo base_url('studentreviewscore') ?>",
                                                                    type: "POST",
                                                                    data: $('#ajax_form_request_review<?php echo $alokasi['id_alokasi'] ?>').serialize(),
                                                                    dataType: "json",
                                                                    success: function(response) {
                                                                        console.log(response);
                                                                        $('#send_form_request_review<?php echo $alokasi['id_alokasi'] ?>').html('Request Review (Protes)');
                                                                        $('#res_message_ajax_form_request_review').html(response.msg + '<button type="button" class="close" data-dismiss="alert">&times;</button>');
                                                                        $('#res_message_ajax_form_request_review').show();
                                                                        $('#res_message_ajax_form_request_review').removeClass('d-none');
                                                                        setTimeout(function() {
                                                                            $('#res_message_ajax_form_request_review').hide();
                                                                            $('#res_message_ajax_form_request_review').html('');
                                                                        }, 10000);
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    }
                                                </script>
                                            </td>
                                            <!-- <td>
                                                <button type="button" class="btn btn-md btn-primary fas fa-pencil-alt noUnderlineCustom text-white" data-toggle="modal" data-target="#editModal<?php //echo $alokasi['id_alokasi'] 
                                                                                                                                                                                                ?>"></button>
                                                <button type="button" class="btn btn-md btn-danger fas fa-trash noUnderlineCustom text-white"></button>
                                            </td> -->
                                        </tr>
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
    <script type="text/javascript" src="assets/js/plugins/chart.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
    </script>


</body>

</html>