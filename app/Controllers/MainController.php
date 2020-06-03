<?php
namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\TeacherModel;
use CodeIgniter\Controller;
use App\Models\UserModel;
use CodeIgniter\CodeIgniter;

class MainController extends BaseController{
    function __construct()
    {
        helper(['form']);
        $this->user_model = new UserModel();
        $this->teacher_model = new TeacherModel();
        $this->student_model = new StudentModel();
        $this->form_validation = \Config\Services::validation();
    }
    function cek_role($role){
        $result = true;
		if (session()->get('sekolah.project_uas.logged_in_as') != $role) {
			$result = false;
		}
		return $result;
    }
    function index(){
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        $role = session()->get('sekolah.project_uas.logged_in_as');
        if($role == 'admin'){
            return redirect()->to(base_url('adminhome'));
        }else if($role == 'guru'){
            return redirect()->to(base_url('teacherhome'));
        }else if($role == 'murid'){
            return redirect()->to(base_url('studenthome'));
        }
    }
    /* Route Controller List 
    //=========================================================================================================================
    1. studenthome
    2. studendata
    3. studentprofile
    //=========================================================================================================================
    1. adminhome
    2. adminclass
    3. admincourse
    4. adminall
    5. adminprofile
    6. adminstudent
    7. adminteacher
    8. adminuser
    //==========================================================================================================================
    1. teacherhome
    2. teacherdata
    3. teacherprofile
    */
    //==========================================================================================================================
    //==================================================STUDENT CONTROL=========================================================
    function studentdata(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('murid') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $id_murid = $this->student_model->getStudentIdByUserId($data['user_info']['id_user']);
        $data['id_murid'] = $id_murid;
        $data['list_kelas'] = $this->student_model->getClassList($id_murid);
        $data['id_kelas'] = $this->request->getGet('id');
        $data['name_kelas'] = $this->user_model->getNameKelasByIdKelas($data['id_kelas']);
        $data['alokasi_murid'] = $this->student_model->getAlokasiKelas($id_murid, $data['id_kelas']);
        return view('pages/student_data', $data);
    }
    function studenthome(){
        //Check Login    
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('murid') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $id_murid = $this->student_model->getStudentIdByUserId($data['user_info']['id_user']);
        $data['id_murid'] = $id_murid;
        $data['list_kelas'] = $this->student_model->getClassList($id_murid);
        return view('pages/student_home', $data);
    }
    function studentprofile(){
        //Check Login    
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('murid') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $id_murid = $this->student_model->getStudentIdByUserId($data['user_info']['id_user']);
        $data['id_murid'] = $id_murid;
        $data['list_kelas'] = $this->student_model->getClassList($id_murid);
        return view('pages/student_profile', $data);
    }


    //==================================================ADMIN CONTROL=========================================================
    function adminhome(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('admin') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $data['notification_amount'] = 0;
        $belum_baca_notification_list = $this->user_model->getNotificationForUserId($data['user_info']['id_user']);
        $notification_amount = 0;
        $data['notification_list'] = null;
        foreach($belum_baca_notification_list as $notification){
            if($notification['read'] == 'false'){
                $notification_amount++;
                $data['notification_list'][] = $notification;
            }
        }
        $data['notification_amount'] = $notification_amount;
        return view('pages/admin_home', $data);
    }
    function adminclass(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('admin') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $data['list_kelas'] = $this->user_model->getKelas();
        $data['notification_amount'] = 0;
        $belum_baca_notification_list = $this->user_model->getNotificationForUserId($data['user_info']['id_user']);
        $notification_amount = 0;
        $data['notification_list'] = null;
        foreach($belum_baca_notification_list as $notification){
            if($notification['read'] == 'false'){
                $notification_amount++;
                $data['notification_list'][] = $notification;
            }
        }
        $data['notification_amount'] = $notification_amount;
        return view('pages/admin_class', $data);
    }
    function adminprofile(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('admin') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $data['notification_amount'] = 0;
        $belum_baca_notification_list = $this->user_model->getNotificationForUserId($data['user_info']['id_user']);
        $notification_amount = 0;
        $data['notification_list'] = null;
        foreach($belum_baca_notification_list as $notification){
            if($notification['read'] == 'false'){
                $notification_amount++;
                $data['notification_list'][] = $notification;
            }
        }
        $data['notification_amount'] = $notification_amount;
        return view('pages/admin_profile', $data);
    }
    function adminstudent(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('admin') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $data['list_murid'] = $this->user_model->getMurid();
        $data['notification_amount'] = 0;
        $belum_baca_notification_list = $this->user_model->getNotificationForUserId($data['user_info']['id_user']);
        $notification_amount = 0;
        $data['notification_list'] = null;
        foreach($belum_baca_notification_list as $notification){
            if($notification['read'] == 'false'){
                $notification_amount++;
                $data['notification_list'][] = $notification;
            }
        }
        $data['notification_amount'] = $notification_amount;
        return view('pages/admin_student', $data);
    }
    function adminteacher(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('admin') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $data['list_guru'] = $this->user_model->getGuru();
        $data['notification_amount'] = 0;
        $belum_baca_notification_list = $this->user_model->getNotificationForUserId($data['user_info']['id_user']);
        $notification_amount = 0;
        $data['notification_list'] = null;
        foreach($belum_baca_notification_list as $notification){
            if($notification['read'] == 'false'){
                $notification_amount++;
                $data['notification_list'][] = $notification;
            }
        }
        $data['notification_amount'] = $notification_amount;
        return view('pages/admin_teacher', $data);
    }
    function adminuser(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('admin') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $data['list_user'] = $this->user_model->getUser();
        $data['notification_amount'] = 0;
        $belum_baca_notification_list = $this->user_model->getNotificationForUserId($data['user_info']['id_user']);
        $notification_amount = 0;
        $data['notification_list'] = null;
        foreach($belum_baca_notification_list as $notification){
            if($notification['read'] == 'false'){
                $notification_amount++;
                $data['notification_list'][] = $notification;
            }
        }
        $data['notification_amount'] = $notification_amount;
        return view('pages/admin_user', $data);
    }
    function admincourse(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('admin') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $data['list_mata_pelajaran'] = $this->user_model->getMataPelajaran();
        $data['notification_amount'] = 0;
        $belum_baca_notification_list = $this->user_model->getNotificationForUserId($data['user_info']['id_user']);
        $notification_amount = 0;
        $data['notification_list'] = null;
        foreach($belum_baca_notification_list as $notification){
            if($notification['read'] == 'false'){
                $notification_amount++;
                $data['notification_list'][] = $notification;
            }
        }
        $data['notification_amount'] = $notification_amount;
        return view('pages/admin_course', $data);
    }
    function adminall(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('admin') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $data['list_alokasi'] = $this->user_model->getAlokasiKelas();
        $data['list_kelas'] = $this->user_model->getKelas();
        $data['list_murid'] = $this->user_model->getMurid();
        $data['list_guru'] = $this->user_model->getGuru();
        $data['list_mata_pelajaran'] = $this->user_model->getMataPelajaran();
        $data['notification_amount'] = 0;
        $belum_baca_notification_list = $this->user_model->getNotificationForUserId($data['user_info']['id_user']);
        $notification_amount = 0;
        $data['notification_list'] = null;
        foreach($belum_baca_notification_list as $notification){
            if($notification['read'] == 'false'){
                $notification_amount++;
                $data['notification_list'][] = $notification;
            }
        }
        $data['notification_amount'] = $notification_amount;
        return view('pages/admin_all', $data);
    }


    //==================================================TEACHER CONTROL=========================================================
    function teacherhome(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('guru') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $user_info = $this->user_model->getUserInfo();
        $id_guru = $this->teacher_model->getTeacherIdByUserId($user_info['id_user']);
        $data['list_kelas'] = $this->teacher_model->getClassList($id_guru);
        $data['notification_amount'] = 0;
        $belum_baca_notification_list = $this->user_model->getNotificationForUserId($data['user_info']['id_user']);
        $notification_amount = 0;
        $data['notification_list'] = null;
        foreach($belum_baca_notification_list as $notification){
            if($notification['read'] == 'false'){
                $notification_amount++;
                $data['notification_list'][] = $notification;
            }
        }
        $data['notification_amount'] = $notification_amount;
        return view('pages/teacher_home', $data);
    }
    function teacherprofile(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('guru') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        $user_info = $this->user_model->getUserInfo();
        $id_guru = $this->teacher_model->getTeacherIdByUserId($user_info['id_user']);
        $data['list_kelas'] = $this->teacher_model->getClassList($id_guru);
        $data['notification_amount'] = 0;
        $belum_baca_notification_list = $this->user_model->getNotificationForUserId($data['user_info']['id_user']);
        $notification_amount = 0;
        $data['notification_list'] = null;
        foreach($belum_baca_notification_list as $notification){
            if($notification['read'] == 'false'){
                $notification_amount++;
                $data['notification_list'][] = $notification;
            }
        }
        $data['notification_amount'] = $notification_amount;
        return view('pages/teacher_profile', $data);
    }
    function teacherdata(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        //Prevent URL Injection
        if($this->cek_role('guru') != true){
            return redirect()->to(base_url('dashboard'));
        }
        //Get User Info
        $data['user_info'] = $this->user_model->getUserInfo();
        
        $user_info = $data['user_info'];
        $id_guru = $this->teacher_model->getTeacherIdByUserId($user_info['id_user']);
        $data['list_kelas'] = $this->teacher_model->getClassList($id_guru);
        $data['id_kelas'] = $this->request->getGet('id');
        $data['id_mata_pelajaran'] = $this->request->getGet('idmapel');
        $data['name_kelas'] = $this->user_model->getNameKelasByIdKelas($data['id_kelas']);
        $data['list_alokasi'] = $this->teacher_model->getAlokasiKelas($id_guru, $data['id_kelas'], $data['id_mata_pelajaran']);
        $data['notification_amount'] = 0;
        $belum_baca_notification_list = $this->user_model->getNotificationForUserId($data['user_info']['id_user']);
        $notification_amount = 0;
        $data['notification_list'] = null;
        foreach($belum_baca_notification_list as $notification){
            if($notification['read'] == 'false'){
                $notification_amount++;
                $data['notification_list'][] = $notification;
            }
        }
        $data['notification_amount'] = $notification_amount;
        return view('pages/teacher_data', $data);
    }
    function clearnotificationadmin(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        $id_notification = $this->request->getVar('id_notification');
        $this->user_model->clearNotificationByIdNotificationAdmin($id_notification);
        $data = [
            'success' => true
        ];
        return $this->response->setJSON($data);
    }
    function clearnotificationteacher(){
        //Check Login
        if($this->cek_login() != true){
            return redirect()->to(base_url('login'));
        }
        $id_notification = $this->request->getVar('id_notification');
        $this->user_model->clearNotificationByIdNotificationTeacher($id_notification);
        $data = [
            'success' => true
        ];
        return $this->response->setJSON($data);
    }
    function error404(){
        echo view('pages/page_error');
    }
    function cropplugin(){
        
        return view('pages/cropplugin');
    }
    function checksession(){
        echo 'test<br>';
        echo session()->getSessionExpiration();
    }
}
