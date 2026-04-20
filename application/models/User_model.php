<?php
class User_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('users');
        $user = $query->row();
        
        if($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }
    
    public function register_siswa($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['role'] = 'siswa';
        $data['is_deleted'] = 0;
        return $this->db->insert('users', $data);
    }
    
    public function get_all_siswa() {
        $this->db->where('role', 'siswa');
        $this->db->where('is_deleted', 0); // Hanya yang belum dihapus
        return $this->db->get('users')->result();
    }
    
    public function get_all_siswa_with_deleted() {
        $this->db->where('role', 'siswa');
        return $this->db->get('users')->result();
    }
    
    public function get_deleted_siswa() {
        $this->db->where('role', 'siswa');
        $this->db->where('is_deleted', 1);
        $this->db->order_by('deleted_at', 'DESC');
        return $this->db->get('users')->result();
    }
    
    public function get_siswa_by_id($id) {
        return $this->db->get_where('users', ['id' => $id, 'is_deleted' => 0])->row();
    }
    
    public function soft_delete_siswa($id) {
        $data = array(
            'is_deleted' => 1,
            'deleted_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
    
    public function restore_siswa($id) {
        $data = array(
            'is_deleted' => 0,
            'deleted_at' => NULL
        );
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
    
    public function cari_siswa($keyword) {
        $this->db->where('role', 'siswa');
        $this->db->where('is_deleted', 0);
        $this->db->group_start();
        $this->db->like('nama_lengkap', $keyword);
        $this->db->or_like('username', $keyword);
        $this->db->or_like('kelas', $keyword);
        $this->db->group_end();
        return $this->db->get('users')->result();
    }
    
    public function cari_siswa_deleted($keyword) {
        $this->db->where('role', 'siswa');
        $this->db->where('is_deleted', 1);
        $this->db->group_start();
        $this->db->like('nama_lengkap', $keyword);
        $this->db->or_like('username', $keyword);
        $this->db->or_like('kelas', $keyword);
        $this->db->group_end();
        $this->db->order_by('deleted_at', 'DESC');
        return $this->db->get('users')->result();
    }

    public function getChartDataAnggota($startDate, $endDate) {
        $labels = [];
        $data = [];
        
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($start, $interval, $end);
        
        $this->db->select('DATE(created_at) as tanggal, COUNT(*) as jumlah');
        $this->db->from('users');
        $this->db->where('role', 'siswa');
        $this->db->where('is_deleted', 0);
        $this->db->where('DATE(created_at) >=', $startDate);
        $this->db->where('DATE(created_at) <=', $endDate);
        $this->db->group_by('DATE(created_at)');
        $query = $this->db->get();
        $result = [];
        foreach ($query->result() as $row) {
            $result[$row->tanggal] = $row->jumlah;
        }
        
        foreach ($period as $date) {
            $dateString = $date->format('Y-m-d');
            $formattedDate = $date->format('d M');
            $labels[] = $formattedDate;
            $data[] = isset($result[$dateString]) ? (int)$result[$dateString] : 0;
        }
        
        return ['labels' => $labels, 'data' => $data];
    }

    // application/models/User_model.php

    // application/models/User_model.php
    public function get_anggota_by_id($id) {
        $this->db->where('id', $id);
        $this->db->where('role', 'siswa');
        $query = $this->db->get('users');
        return $query->row();
    }

    public function get_user_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('users')->row();
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
}
?>