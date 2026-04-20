<?php
class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }
    
    // Method ini akan dipanggil saat mengakses root URL
    public function index() {
        $this->login();
    }
    
    public function login() {
        // Cek apakah sudah login
        if($this->session->userdata('logged_in')) {
            if($this->session->userdata('role') == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('siswa/dashboard');
            }
        }

        $this->load->model('Buku_model');
         $data['buku'] = $this->Buku_model->get_buku_terbaru(4);

        $this->load->view('auth/login', $data);
    }
    
    public function proses_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->User_model->login($username, $password);
        
        if($user) {
            $session_data = array(
                'id' => $user->id,
                'username' => $user->username,
                'nama' => $user->nama_lengkap,
                'role' => $user->role,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            
            if($user->role == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('siswa/dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('auth/login');
        }
    }
    
    public function register_siswa() {
        $this->load->view('auth/register_siswa');
    }
    
    public function proses_register() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        
        if($this->form_validation->run() == FALSE) {
            $this->register_siswa();
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'kelas' => $this->input->post('kelas'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp')
            );
            
            if($this->User_model->register_siswa($data)) {
                $this->session->set_flashdata('success', 'Pendaftaran berhasil! Silakan login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Pendaftaran gagal!');
                $this->register_siswa();
            }
        }
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
?>