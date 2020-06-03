<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends BaseController{
    protected $helper = [];
    public function __construct()
    {
        helper(['form','cookie']);
        $this->cek_login();
        $this->user_model = new UserModel();
        $this->form_validation = \Config\Services::validation();
    }
    public function index(){
        if($this->cek_login() == true){
            return redirect()->to(base_url('dashboard'));
        }
        return view('pages/login');
    }
    public function login(){
        if($this->cek_login() == true){
            return redirect()->to(base_url('dashboard'));
        }
        $data['user_info'] = $this->user_model->getUserInfo();
        return view('pages/login', $data);
    }
    public function do_login(){
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $stay_signed_in = 'false';
        // $stay_signed_in = $this->request->getPost('stay_signed_in');
        $inputs = [
            'email' => $email,
            'password' => $password
        ];
        // if ($this->form_validation->run($inputs, 'login') == false) {
        //     session()->setFlashdata('sekolah.project_uas.errors_validation_login', $this->form_validation->getErrors());
        //     return redirect()->to(base_url('login'));
        // }

        $password = hash('sha256', $password);
        $masuk = $this->user_model->login($email, $password);
        if($masuk){
            if($stay_signed_in == 'false'){
                session()->set('sekolah.project_uas.logged_in', "masuk");
                session()->set('sekolah.project_uas.email', $email);
            }
            // else{
            //     set_cookie([
            //         'name' => 'logged_in',
            //         'value' => 'masuk',
            //         'expire' => \time() + 259200,
            //         'secure' => FALSE
            //     ]);
            //     set_cookie([
            //         'name' => 'email',
            //         'value' => $email,
            //         'expire' => \time() + 259200,
            //         'secure' => FALSE
            //     ]);
            // }
            $id_role = $this->user_model->getUserRoleByEmail($email);
            if($id_role == 'R0001'){
                if($stay_signed_in == 'false'){
                    session()->set('sekolah.project_uas.logged_in_as', "admin");
                }
                // else{
                //     set_cookie([
                //         'name' => 'logged_in_as',
                //         'value' => 'admin',
                //         'expire' => \time() + 259200,
                //         'secure' => FALSE
                //     ]);
                // }
                return redirect()->to(base_url());
            }else if($id_role == 'R0002'){
                if($stay_signed_in == 'false'){
                    session()->set('sekolah.project_uas.logged_in_as', "guru");
                }
                // else{
                //     set_cookie([
                //         'name' => 'logged_in_as',
                //         'value' => 'guru',
                //         'expire' => \time() + 259200,
                //         'secure' => FALSE
                //     ]);
                // }
                return redirect()->to(base_url());
            }else if($id_role == 'R0003'){
                if($stay_signed_in == 'false'){
                    session()->set('sekolah.project_uas.logged_in_as', "murid");
                }
                // else{
                //     set_cookie([
                //         'name' => 'logged_in_as',
                //         'value' => 'murid',
                //         'expire' => \time() + 259200,
                //         'secure' => FALSE
                //     ]);
                // }
                return redirect()->to(base_url());
            }
        }else{
            session()->setFlashdata('sekolah.project_uas.errors_login', 'Email or password is incorrect');
            return redirect()->to(base_url('login'));
        }
    }
    function do_logout(){
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}