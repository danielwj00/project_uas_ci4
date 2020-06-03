<?php

namespace App\Controllers;

use App\Models\TeacherModel;
use CodeIgniter\Controller;
use App\Models\UserModel;

class TeacherController extends BaseController
{
    function __construct()
    {
        helper(['form']);
        $this->cek_login();
        $this->user_model = new UserModel();
        $this->teacher_model = new TeacherModel();
        $this->form_validation = \Config\Services::validation();
    }
    function cek_role()
    {
        $result = false;
        if (session()->get('sekolah.project_uas.logged_in_as') == "guru") {
            $result = true;
        }
        return $result;
    }
    function teachereditnilaimodal()
    {
        //Check Login
        if ($this->cek_login() != true) {
            return redirect()->to(base_url('login'));
        }
        //Check Role
        if ($this->cek_role() != true) {
            return redirect()->to(base_url('login'));
        }
        $id_kelas = $this->request->getPost('id_kelas_edit');
        $id_mata_pelajaran = $this->request->getPost('id_mata_pelajaran_edit');
        $id_alokasi = $this->request->getPost('id_alokasi_edit');
        $nilai_tugas = $this->request->getPost('tugas_edit');
        $nilai_uts = $this->request->getPost('uts_edit');
        $nilai_uas = $this->request->getPost('uas_edit');
        $nilai_akhir = 0;
        if ($nilai_tugas != 0 && $nilai_uts != 0 && $nilai_uas != 0) {
            $nilai_akhir = (0.4 * $nilai_tugas) + (0.3 * $nilai_uts) + (0.3 * $nilai_uas);
        }
        $editResult = $this->teacher_model->editNilaiAlokasi($id_alokasi, $nilai_tugas, $nilai_uts, $nilai_uas, $nilai_akhir);
        if ($editResult) {
            session()->setFlashdata('sekolah.project_uas.success', 'Nilai berhasil diubah');
            return redirect()->to(base_url("teacherdata?id=$id_kelas&idmapel=$id_mata_pelajaran"));
        } else {
            //kalo gagal ngapain
            session()->setFlashdata('sekolah.project_uas.fail', 'Nilai gagal diubah');
            return redirect()->to(base_url("teacherdata?id=$id_kelas&idmapel=$id_mata_pelajaran"));
        }
    }
    function teacherupdateprofile()
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
            return redirect()->to(base_url('teacherprofile'));
        }

        $id_user = $user_info['id_user'];
        $name = $this->request->getPost('name_editprofile');
        $email = $this->request->getPost('email_editprofile');
        $password = $this->request->getPost('password_editprofile');
        $confirm_password = $this->request->getPost('confirm_password_editprofile');
        $birthdate = $this->request->getPost('birthdate_editprofile');

        $avatar = $this->request->getFile('upload_foto');
        // $nama_foto = $avatar->getName();

        $img = $_FILES['upload_foto'];
        // $nama_foto = $img['name'];

        if ($password != '') {
            //jika password dimasukkan
            if ($password != $confirm_password) {
                // error message confirm passsword tidak sama
                session()->setFlashdata('sekolah.project_uas.fail', 'Confirm password mismatch');
                return redirect()->to(base_url('teacherprofile#user-settings'));
            }
        }

        $validate_photo_data = [
            'upload_foto' => $avatar
        ];

        if ($avatar->isValid()) {
            if ($this->form_validation->run($validate_photo_data, 'validate_photo') == false) {
                session()->setFlashdata('sekolah.project_uas.error_validation', $this->form_validation->getError('upload_foto'));
                return redirect()->to(base_url('teacherprofile#user-settings'));
            } else {
                // $avatar->move(ROOTPATH . 'assets/poster');
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
                    $this->teacher_model->editUserProfileWithPhoto($id_user, $name, $email, $password, $birthdate, $url_foto);
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
                    $this->teacher_model->editUserProfileNoPasswordWithPhoto($id_user, $name, $email, $birthdate, $url_foto);
                }
                session()->set('sekolah.project_uas.email', $email);
                // success
                session()->setFlashdata('sekolah.project_uas.success', 'Profile edited successfully');
                return redirect()->to(base_url('teacherprofile'));
            }
        } else {
            // ga ganti foto profile
            if ($password != '') {
                $password = hash('sha256', $password);
                $this->teacher_model->editUserProfile($id_user, $name, $email, $password, $birthdate);
            } else {
                $this->teacher_model->editUserProfileNoPassword($id_user, $name, $email, $birthdate);
            }
            session()->set('sekolah.project_uas.email', $email);
            // success
            session()->setFlashdata('sekolah.project_uas.success', 'Profile edited successfully');
            return redirect()->to(base_url('teacherprofile'));
        }
    }
    function teacheraskeditpermission()
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
}
