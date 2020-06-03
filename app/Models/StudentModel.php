<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect('default');
        $this->user_model = new UserModel();
    }
    function test()
    {
        return 'success';
    }
    function getStudentIdByUserId($id_user)
    {
        $sql = 'SELECT * from murid where id_user=?';
        $query = $this->db->query($sql, [$id_user]);
        $data = $query->getRowArray();
        return $data['id_murid'];
    }
    function getClassList($id_murid)
    {
        $sql = "SELECT distinct ak.id_kelas as 'id_kelas',
        k.name 'name_kelas' 
        from alokasi_kelas as ak
        inner join kelas as k
        on ak.id_kelas=k.id_kelas
        where id_murid=?";
        $query = $this->db->query($sql, [$id_murid]);
        return $query->getResultArray();
    }
    function getAlokasiKelas($id_murid, $id_kelas)
    {
        $sql = "SELECT 
        id_alokasi,
        m.id_murid as 'id_murid',
        m.name as 'name_murid',
        k.id_kelas as 'id_kelas',
        k.name as 'name_kelas',
        g.id_guru as 'id_guru',
        g.name as 'name_guru',
        mp.id_mata_pelajaran as 'id_mata_pelajaran',
        mp.name as 'name_mata_pelajaran',
        nilai_tugas,
        nilai_uts,
        nilai_uas,
        nilai_akhir
        from alokasi_kelas as ak
        inner join murid as m
        on m.id_murid=ak.id_murid
        inner join kelas as k
        on k.id_kelas=ak.id_kelas
        inner join guru as g
        on g.id_guru=ak.id_guru
        inner join mata_pelajaran as mp
        on mp.id_mata_pelajaran=ak.id_mata_pelajaran
        where ak.id_murid=? and ak.id_kelas=?";
        $query = $this->db->query($sql, [$id_murid, $id_kelas]);
        return $query->getResultArray();
    }
    function editUserProfileWithPhoto($id, $name, $email, $password, $birthdate, $nama_foto)
    {
        if (preg_match("/^([a-f0-9]{64})$/", $password) != 1) {
            $password = hash('sha256', $password);
        }
        $db = \Config\Database::connect('default');
        $db->transBegin();
        $izin_edit = 'false';
        $sql = 'UPDATE user set name=?, email=?, password=?, birthdate=?, link_foto=?, izin_edit=? where id_user=?';
        $db->query($sql, [$name, $email, $password, $birthdate, $nama_foto, $izin_edit, $id]);

        if ($db->transStatus() === FALSE) {
            $db->transRollback();
            return false;
        } else {
            $db->transCommit();
            return true;
        }
    }
    function editUserProfileNoPasswordWithPhoto($id, $name, $email, $birthdate, $nama_foto)
    {
        $db = \Config\Database::connect('default');
        $db->transBegin();
        $izin_edit = 'false';
        $sql = 'UPDATE user set name=?, email=?, birthdate=?, link_foto=?, izin_edit=? where id_user=?';
        $db->query($sql, [$name, $email, $birthdate, $nama_foto, $izin_edit, $id]);

        if ($db->transStatus() === FALSE) {
            $db->transRollback();
            return false;
        } else {
            $db->transCommit();
            return true;
        }
    }
    function editUserProfile($id, $name, $email, $password, $birthdate)
    {
        if (preg_match("/^([a-f0-9]{64})$/", $password) != 1) {
            $password = hash('sha256', $password);
        }
        $db = \Config\Database::connect('default');
        $db->transBegin();
        $izin_edit = 'false';
        $sql = 'UPDATE user set name=?, email=?, password=?, birthdate=?, izin_edit=? where id_user=?';
        $db->query($sql, [$name, $email, $password, $birthdate, $izin_edit, $id]);

        if ($db->transStatus() === FALSE) {
            $db->transRollback();
            return false;
        } else {
            $db->transCommit();
            return true;
        }
    }
    function editUserProfileNoPassword($id, $name, $email, $birthdate)
    {
        $db = \Config\Database::connect('default');
        $db->transBegin();
        $izin_edit = 'false';
        $sql = 'UPDATE user set name=?, email=?, birthdate=?, izin_edit=? where id_user=?';
        $db->query($sql, [$name, $email, $birthdate, $izin_edit, $id]);

        if ($db->transStatus() === FALSE) {
            $db->transRollback();
            return false;
        } else {
            $db->transCommit();
            return true;
        }
    }
    function askReviewScore($id_user_murid, $id_murid, $id_user_guru, $id_kelas, $name_kelas, $name_mata_pelajaran)
    {
        $db = \Config\Database::connect('default');
        
        $name_murid = $this->user_model->getUserNameById($id_user_murid);
        $db->transBegin();
        $message = $id_murid.'-'.$name_murid.' mengajukan peninjauan nilai kelas ['.$id_kelas.']'.$name_kelas.'-'.$name_mata_pelajaran;
        $sql = 'INSERT into notification(from_id_user, to_id_user, message)
            values(?,?,?)';
        $db->query($sql, [$id_user_murid, $id_user_guru, $message]);
        if ($db->transStatus() === FALSE) {
            $db->transRollback();
            return false;
        } else {
            $db->transCommit();
            return true;
        }
    }
}
