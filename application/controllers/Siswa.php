<?php
class Siswa extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'siswa') {
            redirect('auth/login');
        }
        $this->load->model(['Buku_model', 'Transaksi_model', 'User_model']);
    }
    
    public function dashboard() {
        $data['buku_terbaru'] = $this->Buku_model->get_all_buku();
        $data['riwayat'] = $this->Transaksi_model->get_transaksi_by_siswa($this->session->userdata('id'));
        $data['notifikasi'] = $this->Transaksi_model->get_notifikasi_pengembalian($this->session->userdata('id'));
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_siswa');
        $this->load->view('siswa/dashboard', $data);
        $this->load->view('templates/footer');
    }
    
    // Method daftar_buku dengan fitur pencarian dan tombol pinjam
    public function daftar_buku() {
        $keyword = $this->input->get('keyword');
        if($keyword) {
            $data['buku'] = $this->Buku_model->cari_buku($keyword);
        } else {
            $data['buku'] = $this->Buku_model->get_all_buku();
        }
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_siswa');
        $this->load->view('siswa/buku', $data);
        $this->load->view('templates/footer');
    }
    
    public function proses_pinjam($id_buku) {
        $buku = $this->Buku_model->get_buku_by_id($id_buku);
        
        // Cek stok
        if($buku->stok <= 0) {
            $this->session->set_flashdata('error', 'Maaf, stok buku sedang habis!');
            redirect('siswa/daftar_buku');
        }
        
        // Cek apakah siswa sedang meminjam buku ini
        $this->db->where('id_siswa', $this->session->userdata('id'));
        $this->db->where('id_buku', $id_buku);
        $this->db->where('status', 'dipinjam');
        $cek_pinjam = $this->db->get('transaksi')->num_rows();
        
        if($cek_pinjam > 0) {
            $this->session->set_flashdata('error', 'Anda sedang meminjam buku ini!');
            redirect('siswa/daftar_buku');
        }
        
        // Cek maksimal peminjaman (maks 3 buku)
        $this->db->where('id_siswa', $this->session->userdata('id'));
        $this->db->where('status', 'dipinjam');
        $total_pinjam = $this->db->get('transaksi')->num_rows();
        
        if($total_pinjam >= 3) {
            $this->session->set_flashdata('error', 'Anda sudah meminjam 3 buku! Kembalikan terlebih dahulu.');
            redirect('siswa/daftar_buku');
        }
        
        // Proses peminjaman
        $data = array(
            'id_siswa' => $this->session->userdata('id'),
            'id_buku' => $id_buku,
            'tanggal_pinjam' => date('Y-m-d'),
            'batas_pengembalian' => date('Y-m-d', strtotime('+7 days'))
        );
        
        if($this->Transaksi_model->pinjam_buku($data)) {
            $this->session->set_flashdata('success', 'Buku berhasil dipinjam!');
        } else {
            $this->session->set_flashdata('error', 'Gagal meminjam buku!');
        }
        redirect('siswa/daftar_buku');
    }
    
    public function riwayat() {
        $data['riwayat'] = $this->Transaksi_model->get_transaksi_by_siswa($this->session->userdata('id'));
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_siswa');
        $this->load->view('siswa/riwayat', $data);
        $this->load->view('templates/footer');
    }
    
    public function cari_buku_siswa() {
        $keyword = $this->input->get('keyword');
        $data['buku'] = $this->Buku_model->cari_buku($keyword);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_siswa');
        $this->load->view('siswa/buku', $data);
        $this->load->view('templates/footer');
    }

    public function profile() {
        $id = $this->session->userdata('id');
        $data['user'] = $this->User_model->get_user_by_id($id);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_siswa');
        $this->load->view('siswa/profile', $data);
        $this->load->view('templates/footer');
    }

    public function update_profile() {
        $id = $this->session->userdata('id');
        $username = $this->input->post('username');
        $nama = $this->input->post('nama_lengkap');
        $kelas = $this->input->post('kelas');
        $no_hp = $this->input->post('no_hp');
        $alamat = $this->input->post('alamat');
        $password = $this->input->post('password');
        
        // Cek apakah username sudah digunakan oleh user lain (selain dirinya)
        $this->db->where('username', $username);
        $this->db->where('id !=', $id);
        $cek = $this->db->get('users')->num_rows();
        if($cek > 0) {
            $this->session->set_flashdata('error', 'Username sudah digunakan oleh siswa lain!');
            redirect('siswa/profile');
            return;
        }
        
        $data = [
            'username'     => $username,
            'nama_lengkap' => $nama,
            'kelas'        => $kelas,
            'no_hp'        => $no_hp,
            'alamat'       => $alamat
        ];
        
        if (!empty($password)) {
            if (strlen($password) >= 6) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $this->session->set_flashdata('error', 'Password minimal 6 karakter!');
                redirect('siswa/profile');
                return;
            }
        }
        
        if ($this->User_model->update_user($id, $data)) {
            // Update session jika username atau nama berubah
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('nama', $nama);
            $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui profil!');
        }
        redirect('siswa/profile');
    }
}
?>