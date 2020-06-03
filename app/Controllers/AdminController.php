<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class AdminController extends BaseController
{
    function __construct()
    {
        helper(['form']);
        $this->cek_login();
        $this->user_model = new UserModel();
        $this->form_validation = \Config\Services::validation();
    }
    function cek_role()
    {
        $result = false;
        if (session()->get('sekolah.project_uas.logged_in_as') == "admin") {
            $result = true;
        }
        return $result;
    }

    /*=================================================== Admin Controller List ===============================================
    //============================================================ Add ========================================================
    1. adminadduser
    2. adminaddclass
    3. adminaddallocation
    4. adminaddcourse
    //=========================================================== Edit ========================================================
    1. admineditusermodal
    2. admineditmuridmodal
    3. admineditgurumodal
    4. admineditclassmodal
    5. admineditcoursemodal
    //========================================================== Delete =======================================================
    1. admindeleteuser
    2. admindeleteuserstudent
    3. admindeleteuserteacher
    4. admindeleteclass
    5. admindeleteallocation
    6. admindeletecourse
    //========================================================== Profile =======================================================
    1. adminupdateprofile
    =================================================== Admin Controller List ================================================*/


    //============================================================ Add ========================================================
    function adminadduser()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $email = $this->request->getPost('email_add');
        $email = esc($email);
        $password = $this->request->getPost('password_add');
        $password = esc($password);
        $name = $this->request->getPost('name_add');
        $name = esc($name);
        $birthdate = $this->request->getPost('birthdate_add');
        $role = $this->request->getPost('role_add');
        $link_foto = '';

        $addresult = $this->user_model->addUser($email, $password, $name, $birthdate, $role, $link_foto);
        if ($addresult) {
            session()->setFlashdata('sekolah.project_uas.success', 'User created successfully');
            return redirect()->to(base_url('adminuser'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'User cannot created');
            return redirect()->to(base_url('adminuser'));
        }
    }
    function adminaddclass()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $name = $this->request->getPost('name_add');
        $name = esc($name);
        $addresult = $this->user_model->addKelas($name);
        if ($addresult) {
            session()->setFlashdata('sekolah.project_uas.success', 'Class created successfully');
            return redirect()->to(base_url('adminclass'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'Class cannot be created');
            return redirect()->to(base_url('adminclass'));
        }
    }
    function adminaddcourse()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $name = $this->request->getPost('name_add');
        $name = esc($name);

        $addResult = $this->user_model->addMataPelajaran($name);
        if ($addResult) {
            session()->setFlashdata('sekolah.project_uas.success', 'Course added successfully');
            return redirect()->to(base_url('admincourse'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'Course cannot be added');
            return redirect()->to(base_url('admincourse'));
        }
    }
    function adminaddallocation()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_kelas = $this->request->getPost('id_kelas');
        $id_murid = $this->request->getPost('id_murid');
        $id_guru = $this->request->getPost('id_guru');
        $id_mata_pelajaran = $this->request->getPost('id_mata_pelajaran');

        $checkIfValid = $this->user_model->checkAddAlokasiKelas($id_kelas, $id_murid, $id_guru, $id_mata_pelajaran);
        if ($checkIfValid == false) {
            session()->setFlashdata('sekolah.project_uas.fail', 'Allocation cannot be doubled');
            return redirect()->to(base_url('adminall'));
        } else {
            $addResult = $this->user_model->addAlokasiKelas($id_kelas, $id_murid, $id_guru, $id_mata_pelajaran);
            if ($addResult) {
                session()->setFlashdata('sekolah.project_uas.success', 'Allocation added successfully');
                return redirect()->to(base_url('adminall'));
            } else {
                //kalo gagal ngapain
                session()->setFlashdata('sekolah.project_uas.fail', 'Allocation cannot be added');
                return redirect()->to(base_url('adminall'));
            }
        }
    }

    //=========================================================== Edit ========================================================
    function admineditusermodal()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_user = $this->request->getPost('id_edit');
        $name = $this->request->getPost('name_edit');
        $name = esc($name);
        $birthdate = $this->request->getPost('birthdate_edit');
        $id_role = $this->request->getPost('role_id');

        $editresult = $this->user_model->editUserName($id_user, $name, $birthdate, $id_role);
        if ($editresult) {
            session()->setFlashdata('sekolah.project_uas.success', 'User edited successfully');
            return redirect()->to(base_url('adminuser'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'User cannot be edited');
            return redirect()->to(base_url('adminuser'));
        }
    }
    function admineditgurumodal()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_user = $this->request->getPost('id_edit');
        $name = $this->request->getPost('name_edit');
        $name = esc($name);
        $birthdate = $this->request->getPost('birthdate_edit');
        $id_role = $this->request->getPost('role_id');

        $editresult = $this->user_model->editUserName($id_user, $name, $birthdate, $id_role);
        if ($editresult) {
            session()->setFlashdata('sekolah.project_uas.success', 'User edited successfully');
            return redirect()->to(base_url('adminteacher'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'User cannot be edited');
            return redirect()->to(base_url('adminteacher'));
        }
    }
    function admineditmuridmodal()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_user = $this->request->getPost('id_edit');
        $name = $this->request->getPost('name_edit');
        $name = esc($name);
        $birthdate = $this->request->getPost('birthdate_edit');
        $id_role = $this->request->getPost('role_id');

        $editresult = $this->user_model->editUserName($id_user, $name, $birthdate, $id_role);
        if ($editresult) {
            session()->setFlashdata('sekolah.project_uas.success', 'User edited successfully');
            return redirect()->to(base_url('adminstudent'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'User cannot be edited');
            return redirect()->to(base_url('adminstudent'));
        }
    }
    function admineditcoursemodal()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_mata_pelajaran = $this->request->getPost('id_mata_pelajaran');
        $name = $this->request->getPost('name_edit');
        $name = esc($name);

        $editresult = $this->user_model->editMataPelajaran($id_mata_pelajaran, $name);
        if ($editresult) {
            session()->setFlashdata('sekolah.project_uas.success', 'Course edited successfully');
            return redirect()->to(base_url('admincourse'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'Course cannot be edited');
            return redirect()->to(base_url('admincourse'));
        }
    }
    function admineditclassmodal()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_kelas = $this->request->getPost('id_kelas');
        $name = $this->request->getPost('name_edit');
        $name = esc($name);

        $editresult = $this->user_model->editKelas($id_kelas, $name);
        if ($editresult) {
            session()->setFlashdata('sekolah.project_uas.success', 'Class edited successfully');
            return redirect()->to(base_url('adminclass'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'Class cannot be edited');
            return redirect()->to(base_url('adminclass'));
        }
    }
    //========================================================== Delete =======================================================
    function admindeleteallocation()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_alokasi = $this->request->getPost('id_alokasi');

        $deleteResult = $this->user_model->deleteAlokasiKelas($id_alokasi);
        if ($deleteResult) {
            session()->setFlashdata('sekolah.project_uas.success', 'Allocation deleted successfully');
            return redirect()->to(base_url('adminall'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'Allocation cannot be deleted');
            return redirect()->to(base_url('adminall'));
        }
    }
    function admindeleteuser()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_user = $this->request->getGet('id');
        $id_role = $this->request->getGet('role');
        if ($id_user != null && $id_role != null) {
            $deleteResult = $this->user_model->deleteUser($id_user, $id_role);
            if ($deleteResult) {
                session()->setFlashdata('sekolah.project_uas.success', 'User deleted successfully');
                return redirect()->to(base_url('adminuser'));
            } else {
                //kalo gagal ngapain
                session()->setFlashdata('sekolah.project_uas.fail', 'User cannot be deleted');
                return redirect()->to(base_url('adminuser'));
            }
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'User cannot be deleted');
            return redirect()->to(base_url('adminuser'));
        }
    }
    function admindeleteuserteacher()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_user = $this->request->getGet('id');
        $id_role = $this->request->getGet('role');

        if ($id_user != null && $id_role != null) {
            $deleteResult = $this->user_model->deleteUser($id_user, $id_role);
            if ($deleteResult) {
                session()->setFlashdata('sekolah.project_uas.success', 'User deleted successfully');
                return redirect()->to(base_url('adminteacher'));
            } else {
                //kalo gagal ngapain
                session()->setFlashdata('sekolah.project_uas.fail', 'User cannot be deleted');
                return redirect()->to(base_url('adminteacher'));
            }
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'User cannot be deleted');
            return redirect()->to(base_url('adminteacher'));
        }
    }
    function admindeleteuserstudent()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_user = $this->request->getGet('id');
        $id_role = $this->request->getGet('role');

        if ($id_user != null && $id_role != null) {
            $deleteResult = $this->user_model->deleteUser($id_user, $id_role);
            if ($deleteResult) {
                session()->setFlashdata('sekolah.project_uas.success', 'User deleted successfully');
                return redirect()->to(base_url('adminstudent'));
            } else {
                //kalo gagal ngapain
                session()->setFlashdata('sekolah.project_uas.fail', 'User cannot be deleted');
                return redirect()->to(base_url('adminstudent'));
            }
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'User cannot be deleted');
            return redirect()->to(base_url('adminstudent'));
        }
    }
    function admindeleteclass()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id = $this->request->getGet('id');

        $deleteResult = $this->user_model->deleteKelas($id);
        if ($deleteResult) {
            session()->setFlashdata('sekolah.project_uas.success', 'Class deleted successfully');
            return redirect()->to(base_url('adminclass'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'Class cannot be deleted');
            return redirect()->to(base_url('adminclass'));
        }
    }
    function admindeletecourse()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id = $this->request->getGet('id');
        $deleteResult = $this->user_model->deleteMataPelajaran($id);
        if ($deleteResult) {
            session()->setFlashdata('sekolah.project_uas.success', 'Course deleted successfully');
            return redirect()->to(base_url('admincourse'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'Course cannot be deleted');
            return redirect()->to(base_url('admincourse'));
        }
    }

    //========================================================== Profile =======================================================
    function adminupdateprofile()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $user_info = $this->user_model->getUserInfo();
        $id_user = $user_info['id_user'];
        $name = $this->request->getPost('name_editprofile');
        $name = esc($name);
        $email = $this->request->getPost('email_editprofile');
        $email = esc($email);
        $password = $this->request->getPost('password_editprofile');
        $password = esc($password);
        $confirm_password = $this->request->getPost('confirm_password_editprofile');
        $confirm_password = esc($confirm_password);
        $birthdate = $this->request->getPost('birthdate_editprofile');
        $birthdate = esc($birthdate);

        $avatar = $this->request->getFile('upload_foto');
        // $nama_foto = $avatar->getName();

        $img = $_FILES['upload_foto'];
        // $nama_foto = $img['name'];

        if ($password != '') {
            //jika password dimasukkan
            if ($password != $confirm_password) {
                // error message confirm passsword tidak sama
                session()->setFlashdata('sekolah.project_uas.fail', 'Confirm password mismatch');
                return redirect()->to(base_url('adminprofile#user-settings'));
            }
        }

        $validate_photo_data = [
            'upload_foto' => $avatar
        ];

        if ($avatar->isValid()) {
            if ($this->form_validation->run($validate_photo_data, 'validate_photo') == false) {
                session()->setFlashdata('sekolah.project_uas.error_validation', $this->form_validation->getError('upload_foto'));
                return redirect()->to(base_url('adminprofile#user-settings'));
            } else {
                if ($password != '') {
                    $filename = $img['tmp_name'];
                    $client_id = "a199127d5918115"; //Your Client ID here
                    $handle = fopen($filename, "r+");
                    $data = fread($handle, filesize($filename));
                    $pvars   = array('image' => base64_encode($data));
                    $timeout = 30;
                    $curl    = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
                    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
                    $out = curl_exec($curl);
                    curl_close($curl);
                    $pms = json_decode($out, true);
                    $url = $pms['data']['link'];
                    if ($url != "") {
                        // $user->editBackgroundPhoto($url);
                        $url_foto = $url;
                        // echo $url;
                        // echo "<img src='$url_foto' alt=''>";
                    } else {
                        $url_foto = '';
                        echo "<h2>There's a Problem</h2>";
                        echo $pms['data']['error']['message'];
                    }
                    $password = hash('sha256', $password);
                    $this->user_model->editUserProfileWithPhoto($id_user, $name, $email, $password, $birthdate, $url_foto);
                } else {
                    $filename = $img['tmp_name'];;
                    $client_id = "a199127d5918115"; //Your Client ID here
                    $handle = fopen($filename, "r+");
                    $data = fread($handle, filesize($filename));
                    $pvars   = array('image' => base64_encode($data));
                    $timeout = 30;
                    $curl    = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
                    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
                    $out = curl_exec($curl);
                    curl_close($curl);
                    $pms = json_decode($out, true);
                    $url = $pms['data']['link'];
                    if ($url != "") {
                        // $user->editBackgroundPhoto($url);
                        $url_foto = $url;
                        // echo $url;
                        // echo "<img src='$url_foto' alt=''>";
                    } else {
                        $url_foto = '';
                        echo "<h2>There's a Problem</h2>";
                        echo $pms['data']['error']['message'];
                    }
                    $this->user_model->editUserProfileNoPasswordWithPhoto($id_user, $name, $email, $birthdate, $url_foto);
                }
                session()->set('sekolah.project_uas.email', $email);
                // success
                session()->setFlashdata('sekolah.project_uas.success', 'Profile edited successfully');
                return redirect()->to(base_url('adminprofile'));
            }
        } else {
            // ga ganti foto profile
            if ($password != '') {
                $password = hash('sha256', $password);
                $this->user_model->editUserProfile($id_user, $name, $email, $password, $birthdate);
            } else {
                $this->user_model->editUserProfileNoPassword($id_user, $name, $email, $birthdate);
            }
            session()->set('sekolah.project_uas.email', $email);
            // success
            session()->setFlashdata('sekolah.project_uas.success', 'Profile edited successfully');
            return redirect()->to(base_url('adminprofile'));
        }
    }
    function admingrantpermissionprofileedit()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_user = $this->request->getGet('id');
        $grantResult = $this->user_model->grantEditProfilePermission($id_user);
        if ($grantResult) {
            session()->setFlashdata('sekolah.project_uas.success', 'Permission granted successfully');
            return redirect()->to(base_url('adminuser'));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'Permission cannot be granted');
            return redirect()->to(base_url('adminuser'));
        }
    }
}
