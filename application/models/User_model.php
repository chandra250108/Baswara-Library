<?php
class User_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        $user = $query->row();
        
        if($user) {
            // Cek password_hash (untuk password yang di-hash)
            if (password_verify($password, $user->password)) {
                return $user;
            }
            // Cek MD5 (untuk password MD5)
            else if (md5($password) === $user->password) {
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
}
?>