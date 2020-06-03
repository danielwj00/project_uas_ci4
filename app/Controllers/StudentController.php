<?php

namespace App\Controllers;

use App\Models\StudentModel;
use CodeIgniter\Controller;
use App\Models\UserModel;

class StudentController extends BaseController
{
    function __construct()
    {
        helper(['form', 'url']);
        $this->cek_login();
        $this->user_model = new UserModel();
        $this->student_model = new StudentModel();
        $this->form_validation = \Config\Services::validation();
    }
    function cek_role()
    {
        $result = false;
        if (session()->get('sekolah.project_uas.logged_in_as') == "murid") {
            $result = true;
        }
        return $result;
    }
    function studentupdateprofile()
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
        if ($user_info['izin_edit'] == 'false') {
            return redirect()->to(base_url('studentprofile'));
        }

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
                return redirect()->to(base_url('studentprofile#user-settings'));
            }
        }

        $validate_photo_data = [
            'upload_foto' => $avatar
        ];

        if ($avatar->isValid()) {
            if ($this->form_validation->run($validate_photo_data, 'validate_photo') == false) {
                session()->setFlashdata('sekolah.project_uas.error_validation', $this->form_validation->getError('upload_foto'));
                return redirect()->to(base_url('studentprofile#user-settings'));
            } else {
                // $avatar->move(ROOTPATH . 'assets/poster');
                if ($password != '') {
                    $filename = $img['tmp_name'];
                    $client_id = "a199127d5918115"; //Your Client ID here
                    $handle = fopen($filename, "r");
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
                    $this->student_model->editUserProfileWithPhoto($id_user, $name, $email, $password, $birthdate, $url_foto);
                } else {
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
                    $this->student_model->editUserProfileNoPasswordWithPhoto($id_user, $name, $email, $birthdate, $url_foto);
                }
                session()->set('sekolah.project_uas.email', $email);
                // success
                session()->setFlashdata('sekolah.project_uas.success', 'Profile edited successfully');
                return redirect()->to(base_url('studentprofile'));
            }
        } else {
            // ga ganti foto profile
            if ($password != '') {
                $password = hash('sha256', $password);
                $this->student_model->editUserProfile($id_user, $name, $email, $password, $birthdate);
            } else {
                $this->student_model->editUserProfileNoPassword($id_user, $name, $email, $birthdate);
            }
            session()->set('sekolah.project_uas.email', $email);
            // success
            session()->setFlashdata('sekolah.project_uas.success', 'Profile edited successfully');
            return redirect()->to(base_url('studentprofile'));
        }
    }
    function studentaskeditpermission()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_user = $this->request->getVar('id_user');
        $checkIfAlreadyNotify = $this->user_model->checkNotifyUser($id_user);
        if ($checkIfAlreadyNotify == false) {
            $this->user_model->askEditProfilePermission($id_user);
            $data = [
                'success' => true,
                'msg' => "Thanks for contact us. We get back to you"
            ];
            return $this->response->setJSON($data);
        } else {
            $data = [
                'success' => false,
                'msg' => "Already submitting. Waiting for approval"
            ];
            return $this->response->setJSON($data);
        }
    }
    function studentreviewscore()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_user_murid = $this->request->getVar('id_user');
        $id_murid = $this->request->getVar('id_murid');
        $id_guru = $this->request->getVar('id_guru');
        $id_user_guru = $this->user_model->getIdUserGuruByIdGuru($id_guru);
        $id_kelas = $this->request->getVar('id_kelas');
        $name_kelas = $this->request->getVar('name_kelas');
        $name_mata_pelajaran = $this->request->getVar('name_mata_pelajaran');
        $checkIfAlreadyNotify = $this->user_model->checkNotifyUser($id_user_murid);
        if ($checkIfAlreadyNotify == false) {
            $this->student_model->askReviewScore($id_user_murid, $id_murid, $id_user_guru, $id_kelas, $name_kelas, $name_mata_pelajaran);
            $data = [
                'success' => true,
                'msg' => "Thanks for contact us. We get back to you"
            ];
            return $this->response->setJSON($data);
        } else {
            $data = [
                'success' => false,
                'msg' => "Already submitting. Waiting for approval"
            ];
            return $this->response->setJSON($data);
        }
    }
}
