<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    use Dompdf\Dompdf;
    use Dompdf\Options;

    class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Load libraries yang diperlukan
        $this->load->library('form_validation');
        
        if(!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('auth/login');
        }
        $this->load->model(['User_model', 'Buku_model', 'Transaksi_model']);
    }
    
    public function dashboard() {
        $data['total_buku'] = count($this->Buku_model->get_all_buku());
        $data['total_siswa'] = count($this->User_model->get_all_siswa());
        $data['total_peminjaman'] = count($this->Transaksi_model->get_all_transaksi());
        $data['peminjaman_aktif'] = $this->Transaksi_model->get_peminjaman_aktif();
        $data['notifikasi'] = $this->Transaksi_model->get_notifikasi_pengembalian();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
    }
    
    // CRUD Buku
    public function buku() {
    // Urutkan berdasarkan judul A-Z
        $this->db->order_by('judul', 'ASC');
        $data['buku'] = $this->Buku_model->get_all_buku();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/buku/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function tambah_buku() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/buku/tambah');
        $this->load->view('templates/footer');
    }
    
    public function simpan_buku() {
    // Load form validation
        $this->load->library('form_validation');
        
        // Validasi semua kolom wajib diisi
        $this->form_validation->set_rules('judul', 'Judul Buku', 'required|trim');
        $this->form_validation->set_rules('penulis', 'Penulis', 'required|trim');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'required|integer|greater_than[0]');
        
        if($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('error', strip_tags($errors));
            redirect('admin/tambah_buku');
            return;
        }
        
        $judul = $this->input->post('judul', TRUE);
        $penulis = $this->input->post('penulis', TRUE);
        $penerbit = $this->input->post('penerbit', TRUE);
        $stok = $this->input->post('stok', TRUE);
        
        // Cek apakah judul buku sudah ada dengan penulis yang sama
        $this->db->where('judul', $judul);
        $this->db->where('penulis', $penulis);
        $cek_buku = $this->db->get('buku')->num_rows();
        
        if($cek_buku > 0) {
            $this->session->set_flashdata('error', 'Buku dengan judul "' . $judul . '" dan penulis "' . $penulis . '" sudah ada di database!');
            redirect('admin/tambah_buku');
            return;
        }
        
        // CEK APAKAH COVER WAJIB DIUPLOAD
        if(empty($_FILES['cover']['name'])) {
            $this->session->set_flashdata('error', 'Cover buku wajib diupload!');
            redirect('admin/tambah_buku');
            return;
        }
        
        // Pastikan folder uploads ada
        $upload_path = './uploads/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        
        // Konfigurasi upload
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp|bmp';
        $config['max_size'] = 10240;
        $config['max_width'] = 5000;
        $config['max_height'] = 5000;
        $config['encrypt_name'] = TRUE;
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        // Data buku
        $data = array(
            'judul' => $judul,
            'penulis' => $penulis,
            'penerbit' => $penerbit,
            'stok' => $stok
        );
        
        // Upload cover
        if($this->upload->do_upload('cover')) {
            $upload_data = $this->upload->data();
            $data['cover'] = $upload_data['file_name'];
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'Upload cover gagal: ' . strip_tags($error));
            redirect('admin/tambah_buku');
            return;
        }
        
        // Insert ke database
        if($this->db->insert('buku', $data)) {
            $this->session->set_flashdata('success', 'Buku berhasil ditambahkan!');
            redirect('admin/buku');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan buku! Error: ' . $this->db->error()['message']);
            redirect('admin/tambah_buku');
        }
    }
    
    public function edit_buku($id) {
        $data['buku'] = $this->Buku_model->get_buku_by_id($id);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/buku/edit', $data);
        $this->load->view('templates/footer');
    }
    
    public function update_buku($id) {
    // Validasi stok tidak boleh 0
        $stok = $this->input->post('stok');
        if($stok < 1) {
            $this->session->set_flashdata('error', 'Stok tidak boleh 0! Minimal stok adalah 1.');
            redirect('admin/edit_buku/'.$id);
            return;
        }
        
        $data = array(
            'judul' => $this->input->post('judul'),
            'penulis' => $this->input->post('penulis'),
            'penerbit' => $this->input->post('penerbit'),
            'stok' => $stok
        );
        
        $this->db->where('id_buku', $id);
        if($this->db->update('buku', $data)) {
            $this->session->set_flashdata('success', 'Buku berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate buku!');
        }
        redirect('admin/buku');
    }
    
    public function hapus_buku($id) {
    // Soft delete - hanya menandai sebagai terhapus
        $data = array(
            'is_deleted' => 1,
            'deleted_at' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('id_buku', $id);
        if($this->db->update('buku', $data)) {
            $this->session->set_flashdata('success', 'Buku berhasil diarsipkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengarsipkan buku!');
        }
        redirect('admin/buku');
    }

    // Restore buku (pulihkan)
    public function restore_buku($id) {
        if($this->Buku_model->restore_buku($id)) {
            $this->session->set_flashdata('success', 'Buku berhasil dipulihkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memulihkan buku!');
        }
        redirect('admin/buku_terhapus');
    }

    // Tampilkan buku yang terhapus
    public function buku_terhapus() {
        $data['buku'] = $this->Buku_model->get_deleted_buku();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/buku/terhapus', $data);
        $this->load->view('templates/footer');
    }

    public function cek_judul_buku() {
        $judul = $this->input->post('judul');
        $penulis = $this->input->post('penulis');
        
        $this->db->where('judul', $judul);
        $this->db->where('penulis', $penulis);
        $exists = $this->db->get('buku')->num_rows() > 0;
        
        echo json_encode(['exists' => $exists]);
    }

    // Cari buku terhapus
    public function cari_buku_terhapus() {
        $keyword = $this->input->get('keyword');
        $data['buku'] = $this->Buku_model->cari_buku_deleted($keyword);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/buku/terhapus', $data);
        $this->load->view('templates/footer');
    }
    
    // CRUD Anggota
    public function anggota() {
        $data['anggota'] = $this->User_model->get_all_siswa();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/anggota/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function cari_anggota() {
        $keyword = $this->input->get('keyword');
        $data['anggota'] = $this->User_model->cari_siswa($keyword);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/anggota/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function transaksi() {
    // Ambil parameter filter
    $id_siswa = $this->input->get('id_siswa');
    $id_buku = $this->input->get('id_buku');
    $tanggal_awal = $this->input->get('tanggal_awal');
    $tanggal_akhir = $this->input->get('tanggal_akhir');
    
    // Query dasar - hanya menampilkan yang statusnya dipinjam
    $this->db->select('transaksi.*, buku.judul, buku.penulis, buku.penerbit, buku.cover, 
                    users.nama_lengkap, users.kelas, users.alamat, users.no_hp, users.username');
    $this->db->from('transaksi');
    $this->db->join('buku', 'buku.id_buku = transaksi.id_buku');
    $this->db->join('users', 'users.id = transaksi.id_siswa');
    $this->db->where('transaksi.status', 'dipinjam');
    
    // Filter berdasarkan anggota
    if($id_siswa && $id_siswa != '') {
        $this->db->where('transaksi.id_siswa', $id_siswa);
    }
    
    // Filter berdasarkan buku
    if($id_buku && $id_buku != '') {
        $this->db->where('transaksi.id_buku', $id_buku);
    }
    
    // Filter tanggal
    if($tanggal_awal && $tanggal_akhir) {
        $this->db->where('transaksi.tanggal_pinjam >=', $tanggal_awal);
        $this->db->where('transaksi.tanggal_pinjam <=', $tanggal_akhir);
    } elseif($tanggal_awal) {
        $this->db->where('transaksi.tanggal_pinjam >=', $tanggal_awal);
    } elseif($tanggal_akhir) {
        $this->db->where('transaksi.tanggal_pinjam <=', $tanggal_akhir);
    }
    
    $this->db->order_by('transaksi.tanggal_pinjam', 'DESC');
    $this->db->order_by('transaksi.id_transaksi', 'DESC'); // tambahan untuk yang tanggal sama
    
    $data['transaksi'] = $this->db->get()->result();
    $data['siswa'] = $this->User_model->get_all_siswa();
    $data['buku'] = $this->Buku_model->get_all_buku();
    $data['id_siswa'] = $id_siswa;
    $data['id_buku'] = $id_buku;
    $data['tanggal_awal'] = $tanggal_awal;
    $data['tanggal_akhir'] = $tanggal_akhir;
    
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar_admin');
    $this->load->view('admin/transaksi/index', $data);
    $this->load->view('templates/footer');
}

// Method untuk refresh tabel transaksi via AJAX
public function refresh_transaksi_table() {
    // Ambil parameter filter dari POST
    $id_siswa = $this->input->post('id_siswa');
    $id_buku = $this->input->post('id_buku');
    $tanggal_awal = $this->input->post('tanggal_awal');
    $tanggal_akhir = $this->input->post('tanggal_akhir');
    
    // Query dasar
    $this->db->select('transaksi.*, buku.judul, buku.penulis, buku.penerbit, buku.cover, 
                    users.nama_lengkap, users.kelas, users.alamat, users.no_hp, users.username');
    $this->db->from('transaksi');
    $this->db->join('buku', 'buku.id_buku = transaksi.id_buku');
    $this->db->join('users', 'users.id = transaksi.id_siswa');
    $this->db->where('transaksi.status', 'dipinjam');
    
    if($id_siswa && $id_siswa != '') {
        $this->db->where('transaksi.id_siswa', $id_siswa);
    }
    
    if($id_buku && $id_buku != '') {
        $this->db->where('transaksi.id_buku', $id_buku);
    }
    
    if($tanggal_awal && $tanggal_akhir) {
        $this->db->where('transaksi.tanggal_pinjam >=', $tanggal_awal);
        $this->db->where('transaksi.tanggal_pinjam <=', $tanggal_akhir);
    } elseif($tanggal_awal) {
        $this->db->where('transaksi.tanggal_pinjam >=', $tanggal_awal);
    } elseif($tanggal_akhir) {
        $this->db->where('transaksi.tanggal_pinjam <=', $tanggal_akhir);
    }
    
    $this->db->order_by('transaksi.tanggal_pinjam', 'DESC');
    $this->db->order_by('transaksi.id_transaksi', 'DESC');
    
    $transaksi = $this->db->get()->result();
    
    // Generate HTML tabel
    $html = '';
    $no = 1;
    foreach($transaksi as $row) {
        $html .= '<tr class="fade-in">';
        $html .= '<td class="text-center fw-bold">' . $no++ . '</td>';
        $html .= '<td class="align-middle">
                    <div class="d-flex flex-column">
                        <span class="fw-bold mb-1" style="color: #1ABC9C;">' . $row->nama_lengkap . '</span>
                        <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-2" onclick="showDetailAnggota(' . $row->id_siswa . ')" style="border-color: #1ABC9C; color: #1ABC9C;">
                            <i class="fas fa-info-circle me-1"></i> Detail
                        </button>
                    </div>
                </td>';
        $html .= '<td class="align-middle">
                    <div class="d-flex flex-column">
                        <span class="fw-bold mb-1" style="color: #1ABC9C;">' . $row->judul . '</span>
                        <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-2" onclick="showDetailBuku(' . $row->id_buku . ')" style="border-color: #1ABC9C; color: #1ABC9C;">
                            <i class="fas fa-info-circle me-1"></i> Detail
                        </button>
                    </div>
                </td>';
        $html .= '<td class="text-center">
                    <span class="badge rounded-pill px-3 py-2" style="background: #ECF0F1; color: #2C3E50;">
                        <i class="fas fa-calendar-alt me-1"></i> ' . date('d/m/Y', strtotime($row->tanggal_pinjam)) . '
                    </span>
                </td>';
        
        // Batas pengembalian
        if(date('Y-m-d') > $row->batas_pengembalian) {
            $html .= '<td class="text-center">
                        <span class="badge rounded-pill px-3 py-2" style="background: #e74c3c; color: white;">
                            <i class="fas fa-exclamation-triangle me-1"></i> ' . date('d/m/Y', strtotime($row->batas_pengembalian)) . '
                        </span>
                    </td>';
        } else {
            $html .= '<td class="text-center">
                        <span class="badge rounded-pill px-3 py-2" style="background: #ECF0F1; color: #2C3E50;">
                            <i class="fas fa-clock me-1"></i> ' . date('d/m/Y', strtotime($row->batas_pengembalian)) . '
                        </span>
                    </td>';
        }
        
        $html .= '<td class="text-center">
                    <span class="badge rounded-pill px-3 py-2" style="background: #f59e0b; color: white;">
                        <i class="fas fa-hourglass-half me-1"></i> Dipinjam
                    </span>
                </td>';
        
        // Status Denda
        if(date('Y-m-d') > $row->batas_pengembalian) {
            $html .= '<td class="text-center">
                        <span class="badge rounded-pill px-3 py-2" style="background: #e74c3c; color: white;">
                            <i class="fas fa-exclamation-circle me-1"></i> Belum Lunas
                        </span>
                    </td>';
        } else {
            $html .= '<td class="text-center">
                        <span class="badge rounded-pill px-3 py-2" style="background: #bdc3c7; color: white;">
                            <i class="fas fa-minus-circle me-1"></i> -
                        </span>
                    </td>';
        }
        
        $html .= '<td class="text-center">
                    <div class="btn-group-vertical w-100 gap-1" role="group">
                        <a href="' . base_url('index.php/admin/kembalikan_buku/'.$row->id_transaksi) . '" class="btn btn-kembalikan btn-sm rounded-pill" onclick="return confirm(\'Yakin buku sudah dikembalikan?\')">
                            <i class="fas fa-undo me-1"></i> Kembalikan
                        </a>
                        <button type="button" class="btn btn-edit-transaksi btn-sm rounded-pill" onclick="openEditModal(' . $row->id_transaksi . ', \'' . $row->tanggal_pinjam . '\', \'' . $row->batas_pengembalian . '\', ' . $row->id_siswa . ', ' . $row->id_buku . ')">
                            <i class="fas fa-edit me-1"></i> Edit
                        </button>
                        <a href="' . base_url('index.php/admin/hapus_transaksi/'.$row->id_transaksi) . '" class="btn btn-hapus-transaksi btn-sm rounded-pill" onclick="return confirm(\'Yakin ingin menghapus transaksi ini? Stok buku akan dikembalikan otomatis.\')">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </a>
                    </div>
                </td>';
        $html .= '</tr>';
    }
    
    if(empty($transaksi)) {
        $html .= '<tr>
                    <td colspan="8" class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak Ada Peminjaman Aktif</h5>
                            <p class="text-muted">Belum ada transaksi peminjaman buku saat ini</p>
                        </div>
                    </td>
                </tr>';
    }
    
    echo json_encode(['html' => $html, 'total' => count($transaksi)]);
}
    
    public function pinjam_buku() {
        $data = array(
            'id_siswa' => $this->input->post('id_siswa'),
            'id_buku' => $this->input->post('id_buku'),
            'tanggal_pinjam' => date('Y-m-d'),
            'batas_pengembalian' => date('Y-m-d', strtotime('+7 days'))
        );
        
        if($this->Transaksi_model->pinjam_buku($data)) {
            $this->session->set_flashdata('success', 'Peminjaman berhasil!');
        } else {
            $this->session->set_flashdata('error', 'Peminjaman gagal!');
        }
        redirect('admin/transaksi');
    }
    
    public function kembalikan_buku($id) {
        if($this->Transaksi_model->kembalikan_buku($id)) {
            $this->session->set_flashdata('success', 'Buku berhasil dikembalikan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengembalikan buku!');
        }
        redirect('admin/transaksi');
    }
    
    public function cari_buku_admin() {
        $keyword = $this->input->get('keyword');
        $data['buku'] = $this->Buku_model->cari_buku($keyword);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/buku/index', $data);
        $this->load->view('templates/footer');
    }

    // Tambah Anggota
    public function tambah_anggota() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/anggota/tambah');
        $this->load->view('templates/footer');
    }

    public function simpan_anggota() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        
        if($this->form_validation->run() == FALSE) {
            // Kirim pesan error spesifik untuk username
            if(form_error('username')) {
                $this->session->set_flashdata('error', 'Username "' . $this->input->post('username') . '" sudah digunakan! Silakan pilih username lain.');
            } else {
                $this->session->set_flashdata('error', validation_errors());
            }
            $this->tambah_anggota();
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'kelas' => $this->input->post('kelas'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'role' => 'siswa',
                'is_deleted' => 0
            );
            
            if($this->db->insert('users', $data)) {
                $this->session->set_flashdata('success', 'Anggota berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan anggota!');
            }
            redirect('admin/anggota');
        }
    }

    public function cek_username() {
        $username = $this->input->post('username');
        
        if(!$username) {
            echo json_encode(['exists' => false]);
            return;
        }
        
        $this->db->where('username', $username);
        $this->db->where('is_deleted', 0); // Abaikan yang sudah dihapus
        $exists = $this->db->get('users')->num_rows() > 0;
        
        echo json_encode(['exists' => $exists]);
    }

    public function cek_no_hp() {
        $no_hp = $this->input->post('no_hp');
        
        if(!$no_hp) {
            echo json_encode(['exists' => false]);
            return;
        }
        
        $this->db->where('no_hp', $no_hp);
        $this->db->where('is_deleted', 0); // Abaikan yang sudah dihapus
        $exists = $this->db->get('users')->num_rows() > 0;
        
        echo json_encode(['exists' => $exists]);
    }

    public function edit_anggota($id) {
        $data['anggota'] = $this->db->get_where('users', ['id' => $id, 'role' => 'siswa'])->row();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/anggota/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update_anggota($id) {
    // Ambil data anggota lama untuk cek username
        $anggota_lama = $this->db->get_where('users', ['id' => $id])->row();
        
        $username_baru = $this->input->post('username');
        $password_baru = $this->input->post('password');
        
        // Validasi username tidak boleh sama dengan yang lain (kecuali dirinya sendiri)
        if($username_baru != $anggota_lama->username) {
            $this->db->where('username', $username_baru);
            $this->db->where('id !=', $id);
            $cek_username = $this->db->get('users')->num_rows();
            
            if($cek_username > 0) {
                $this->session->set_flashdata('error', 'Username "' . $username_baru . '" sudah digunakan!');
                redirect('admin/edit_anggota/'.$id);
                return;
            }
        }
        
        // Validasi No HP tidak boleh sama dengan yang lain (kecuali dirinya sendiri)
        $no_hp_baru = $this->input->post('no_hp');
        if($no_hp_baru != $anggota_lama->no_hp) {
            $this->db->where('no_hp', $no_hp_baru);
            $this->db->where('id !=', $id);
            $cek_nohp = $this->db->get('users')->num_rows();
            
            if($cek_nohp > 0) {
                $this->session->set_flashdata('error', 'Nomor HP "' . $no_hp_baru . '" sudah terdaftar!');
                redirect('admin/edit_anggota/'.$id);
                return;
            }
        }
        
        // Data yang akan diupdate
        $data = array(
            'username' => $username_baru,
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'kelas' => $this->input->post('kelas'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $no_hp_baru
        );
        
        // Jika password diisi, update juga password
        if(!empty($password_baru)) {
            if(strlen($password_baru) >= 6) {
                $data['password'] = password_hash($password_baru, PASSWORD_DEFAULT);
            } else {
                $this->session->set_flashdata('error', 'Password minimal 6 karakter!');
                redirect('admin/edit_anggota/'.$id);
                return;
            }
        }
        
        $this->db->where('id', $id);
        if($this->db->update('users', $data)) {
            $this->session->set_flashdata('success', 'Anggota berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate anggota!');
        }
        redirect('admin/anggota');
    }

    public function hapus_anggota($id) {
        // Cek apakah anggota sedang meminjam buku
        $this->db->where('id_siswa', $id);
        $this->db->where('status', 'dipinjam');
        $cek_pinjam = $this->db->get('transaksi')->num_rows();
        
        if($cek_pinjam > 0) {
            $this->session->set_flashdata('error', 'Anggota sedang meminjam buku, tidak bisa dihapus!');
            redirect('admin/anggota');
            return;
        }
        
        $this->db->where('id', $id);
        if($this->User_model->soft_delete_siswa($id)) {
            $this->session->set_flashdata('success', 'Anggota berhasil diarsipkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus anggota!');
        }
        redirect('admin/anggota');
    }

    // Restore anggota (pulihkan dari arsip)
    public function restore_anggota($id) {
        if($this->User_model->restore_siswa($id)) {
            $this->session->set_flashdata('success', 'Anggota berhasil dipulihkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memulihkan anggota!');
        }
        redirect('admin/anggota_terhapus');
    }

    // Tampilkan anggota yang terhapus
    public function anggota_terhapus() {
        $data['anggota'] = $this->User_model->get_deleted_siswa();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/anggota/terhapus', $data);
        $this->load->view('templates/footer');
    }

    // Cari anggota terhapus
    public function cari_anggota_terhapus() {
        $keyword = $this->input->get('keyword');
        $data['anggota'] = $this->User_model->cari_siswa_deleted($keyword);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/anggota/terhapus', $data);
        $this->load->view('templates/footer');
    }

    public function get_detail_anggota() {
        $id_siswa = $this->input->post('id_siswa');
        $siswa = $this->db->get_where('users', ['id' => $id_siswa])->row();
        
        if($siswa) {
            echo json_encode([
                'success' => true,
                'nama_lengkap' => $siswa->nama_lengkap,
                'username' => $siswa->username,
                'kelas' => $siswa->kelas,
                'alamat' => $siswa->alamat,
                'no_hp' => $siswa->no_hp
            ]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function get_detail_buku() {
        $id_buku = $this->input->post('id_buku');
        $buku = $this->db->get_where('buku', ['id_buku' => $id_buku])->row();
        
        if($buku) {
            echo json_encode([
                'success' => true,
                'judul' => $buku->judul,
                'penulis' => $buku->penulis,
                'penerbit' => $buku->penerbit,
                'stok' => $buku->stok,
                'cover' => $buku->cover
            ]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    // Edit transaksi (perpanjang tanggal)
    public function edit_transaksi($id) {
        $data['transaksi'] = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row();
        $data['siswa'] = $this->User_model->get_all_siswa();
        $data['buku'] = $this->Buku_model->get_all_buku();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/transaksi/edit', $data);
        $this->load->view('templates/footer');
    }

    // Update transaksi (perpanjang tanggal)
    public function update_transaksi($id) {
        $batas_pengembalian = $this->input->post('batas_pengembalian');
        
        $data = array(
            'batas_pengembalian' => $batas_pengembalian
        );
        
        $this->db->where('id_transaksi', $id);
        if($this->db->update('transaksi', $data)) {
            $this->session->set_flashdata('success', 'Tanggal pengembalian berhasil diperpanjang!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperpanjang tanggal!');
        }
        redirect('admin/transaksi');
    }

    public function update_transaksi_lengkap($id) {
    $id_siswa = $this->input->post('id_siswa');
    $id_buku = $this->input->post('id_buku');
    $tanggal_pinjam = $this->input->post('tanggal_pinjam');
    $batas_pengembalian = $this->input->post('batas_pengembalian');
    
    // Ambil data transaksi lama
    $transaksi_lama = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row();
    
    if(!$transaksi_lama) {
        $this->session->set_flashdata('error', 'Transaksi tidak ditemukan!');
        redirect('admin/transaksi');
        return;
    }
    
    // Jika buku berubah, update stok
    if($transaksi_lama->id_buku != $id_buku) {
        // Kembalikan stok buku lama
        $this->db->set('stok', 'stok+1', FALSE);
        $this->db->where('id_buku', $transaksi_lama->id_buku);
        $this->db->update('buku');
        
        // Kurangi stok buku baru
        $this->db->set('stok', 'stok-1', FALSE);
        $this->db->where('id_buku', $id_buku);
        $this->db->update('buku');
    }
    
    // Update data transaksi
    $data = array(
        'id_siswa' => $id_siswa,
        'id_buku' => $id_buku,
        'tanggal_pinjam' => $tanggal_pinjam,
        'batas_pengembalian' => $batas_pengembalian
    );
    
    $this->db->where('id_transaksi', $id);
    $success = $this->db->update('transaksi', $data);
    
    // ========== KIRIM RESPONSE JSON UNTUK AJAX ==========
    if($this->input->is_ajax_request()) {
        if($success) {
            echo json_encode(['success' => true, 'message' => 'Transaksi berhasil diperbaharui!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal memperbaharui transaksi!']);
        }
        return;
    }
    
    if($success) {
        $this->session->set_flashdata('success', 'Transaksi berhasil diperbaharui!');
    } else {
        $this->session->set_flashdata('error', 'Gagal memperbaharui transaksi!');
    }
    redirect('admin/transaksi');
}

    // Hapus transaksi
    public function hapus_transaksi($id) {
        // Ambil data transaksi sebelum dihapus
        $transaksi = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row();
        
        if($transaksi) {
            // Jika status masih dipinjam, kembalikan stok buku
            if($transaksi->status == 'dipinjam') {
                $this->db->set('stok', 'stok+1', FALSE);
                $this->db->where('id_buku', $transaksi->id_buku);
                $this->db->update('buku');
            }
            
            // Hapus transaksi
            $this->db->where('id_transaksi', $id);
            if($this->db->delete('transaksi')) {
                $this->session->set_flashdata('success', 'Transaksi berhasil dihapus!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus transaksi!');
            }
        } else {
            $this->session->set_flashdata('error', 'Transaksi tidak ditemukan!');
        }
        redirect('admin/transaksi');
    }

    // Hapus transaksi dari laporan (soft delete / arsip)
    public function hapus_transaksi_laporan($id) {
        // Hapus transaksi dari database
        $transaksi = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row();
        
        if($transaksi && $transaksi->status == 'dipinjam') {
            // Kembalikan stok jika masih dipinjam
            $this->db->set('stok', 'stok+1', FALSE);
            $this->db->where('id_buku', $transaksi->id_buku);
            $this->db->update('buku');
        }
        
        $this->db->where('id_transaksi', $id);
        if($this->db->delete('transaksi')) {
            $this->session->set_flashdata('success', 'Transaksi berhasil dihapus dari laporan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus transaksi!');
        }
        redirect('admin/laporan');
    }

    // ========== LAPORAN ==========
    public function laporan() {
    $id_siswa = $this->input->get('id_siswa');
    $id_buku = $this->input->get('id_buku');
    $tanggal_awal = $this->input->get('tanggal_awal');
    $tanggal_akhir = $this->input->get('tanggal_akhir');
    
    $this->db->select('transaksi.*, buku.judul, buku.penulis, buku.penerbit, 
                    users.nama_lengkap, users.kelas, users.alamat, users.no_hp');
    $this->db->from('transaksi');
    $this->db->join('buku', 'buku.id_buku = transaksi.id_buku');
    $this->db->join('users', 'users.id = transaksi.id_siswa');
    $this->db->where('transaksi.status', 'dikembalikan');
    
    if($id_siswa && $id_siswa != '') {
        $this->db->where('transaksi.id_siswa', $id_siswa);
    }
    
    if($id_buku && $id_buku != '') {
        $this->db->where('transaksi.id_buku', $id_buku);
    }
    
    if($tanggal_awal && $tanggal_akhir) {
        $this->db->where('transaksi.tanggal_pinjam >=', $tanggal_awal);
        $this->db->where('transaksi.tanggal_pinjam <=', $tanggal_akhir);
    } elseif($tanggal_awal) {
        $this->db->where('transaksi.tanggal_pinjam >=', $tanggal_awal);
    } elseif($tanggal_akhir) {
        $this->db->where('transaksi.tanggal_pinjam <=', $tanggal_akhir);
    }
    
    // Urutkan dari terbaru ke terlama
    $this->db->order_by('transaksi.tanggal_pinjam', 'DESC');
    $this->db->order_by('transaksi.id_transaksi', 'DESC');
    
    $data['transaksi'] = $this->db->get()->result();
    $data['siswa'] = $this->User_model->get_all_siswa();
    $data['buku'] = $this->Buku_model->get_all_buku();
    $data['id_siswa'] = $id_siswa;
    $data['id_buku'] = $id_buku;
    $data['tanggal_awal'] = $tanggal_awal;
    $data['tanggal_akhir'] = $tanggal_akhir;
    $data['total_transaksi'] = count($data['transaksi']);
    $data['total_denda'] = array_sum(array_column($data['transaksi'], 'denda'));
    
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar_admin');
    $this->load->view('admin/laporan', $data);
    $this->load->view('templates/footer');
}

    public function export_pdf() {
        // Ambil parameter filter (sama seperti di laporan.php)
        $tanggal_awal = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $id_siswa = $this->input->get('id_siswa');
        $id_buku = $this->input->get('id_buku');
        
        // Query ambil data transaksi (sama seperti method laporan Anda)
        $this->db->select('transaksi.*, buku.judul, buku.penulis, users.nama_lengkap, users.kelas');
        $this->db->from('transaksi');
        $this->db->join('buku', 'buku.id_buku = transaksi.id_buku');
        $this->db->join('users', 'users.id = transaksi.id_siswa');
        $this->db->where('transaksi.status', 'dikembalikan');
        
        if ($id_siswa) $this->db->where('transaksi.id_siswa', $id_siswa);
        if ($id_buku) $this->db->where('transaksi.id_buku', $id_buku);
        if ($tanggal_awal && $tanggal_akhir) {
            $this->db->where('transaksi.tanggal_pinjam >=', $tanggal_awal);
            $this->db->where('transaksi.tanggal_pinjam <=', $tanggal_akhir);
        }
        
        $transaksi = $this->db->get()->result();
        
        // Siapkan data untuk view
        $data = [
            'transaksi' => $transaksi,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'filter_siswa' => $id_siswa ? $this->db->get_where('users', ['id' => $id_siswa])->row()->nama_lengkap : '',
            'filter_buku' => $id_buku ? $this->db->get_where('buku', ['id_buku' => $id_buku])->row()->judul : ''
        ];
        
        // Load view menjadi HTML
        $html = $this->load->view('admin/laporan_cetak', $data, true);
        
        // Generate PDF menggunakan Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        
        // Bersihkan output buffer
        ob_clean();
        
        // Download PDF
        $dompdf->stream("laporan_transaksi_" . date('Ymd_His') . ".pdf", ["Attachment" => 1]);
        exit;
    }

    // Edit transaksi dari laporan
    public function edit_transaksi_laporan($id) {
        $data['transaksi'] = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row();
        $data['siswa'] = $this->User_model->get_all_siswa();
        $data['buku'] = $this->Buku_model->get_all_buku();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/laporan_edit', $data);
        $this->load->view('templates/footer');
    }

    // Update transaksi dari laporan
    public function update_transaksi_laporan() {
        // Ambil ID dari POST
        $id = $this->input->post('id_transaksi');
        
        $id_siswa = $this->input->post('id_siswa');
        $id_buku = $this->input->post('id_buku');
        $tanggal_pinjam = $this->input->post('tanggal_pinjam');
        $batas_pengembalian = $this->input->post('batas_pengembalian');
        $tanggal_kembali = $this->input->post('tanggal_kembali');
        
        // Hitung denda
        $denda = 0;
        if($tanggal_kembali > $batas_pengembalian) {
            $tgl1 = new DateTime($batas_pengembalian);
            $tgl2 = new DateTime($tanggal_kembali);
            $selisih = $tgl1->diff($tgl2)->days;
            $denda = $selisih * 1000;
        }
        
        $data = array(
            'id_siswa' => $id_siswa,
            'id_buku' => $id_buku,
            'tanggal_pinjam' => $tanggal_pinjam,
            'batas_pengembalian' => $batas_pengembalian,
            'tanggal_kembali' => $tanggal_kembali,
            'denda' => $denda,
            'status' => 'dikembalikan'
        );
        
        $this->db->where('id_transaksi', $id);
        if($this->db->update('transaksi', $data)) {
            $this->session->set_flashdata('success', 'Transaksi berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui transaksi!');
        }
        redirect('admin/laporan');
    }

    public function getChartData() {
        header('Content-Type: application/json');
        try {
            $filterData = $this->input->get('filterData');
            $startDate = $this->input->get('startDate');
            $endDate = $this->input->get('endDate');
            
            if (!$startDate || !$endDate) {
                $endDate = date('Y-m-d');
                $startDate = date('Y-m-d', strtotime('-30 days'));
            }
            
            $data = ['labels' => [], 'data' => []];
            
            switch($filterData) {
                case 'buku':
                    if (method_exists($this->Buku_model, 'getChartDataBuku')) {
                        $data = $this->Buku_model->getChartDataBuku($startDate, $endDate);
                    }
                    break;
                case 'anggota':
                    if (method_exists($this->User_model, 'getChartDataAnggota')) {
                        $data = $this->User_model->getChartDataAnggota($startDate, $endDate);
                    }
                    break;
                case 'peminjaman':
                    if (method_exists($this->Transaksi_model, 'getChartDataPeminjaman')) {
                        $data = $this->Transaksi_model->getChartDataPeminjaman($startDate, $endDate);
                    }
                    break;
                default:
                    $data = ['labels' => [], 'data' => []];
            }
            
            // Pastikan format selalu benar
            if (!isset($data['labels']) || !is_array($data['labels'])) $data['labels'] = [];
            if (!isset($data['data']) || !is_array($data['data'])) $data['data'] = [];
            
            echo json_encode($data);
        } catch (Exception $e) {
            echo json_encode(['labels' => [], 'data' => [], 'error' => $e->getMessage()]);
        }
    }

    // Menampilkan preview kartu anggota (halaman detail)
    public function detail_anggota($id) {
        $anggota = $this->User_model->get_anggota_by_id($id);
        if (!$anggota) show_404();
        $data['anggota'] = $anggota;
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/detail_kartu_anggota', $data);
        $this->load->view('templates/footer');
    }

    // Cetak kartu anggota sebagai PDF (satu kartu)
    public function cetak_kartu_anggota($id) {
        $anggota = $this->User_model->get_anggota_by_id($id);
        if (!$anggota) show_404();

        $data['anggota'] = $anggota;
        $html = $this->load->view('admin/kartu_anggota_cetak', $data, true);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        ob_clean();
        $dompdf->stream("Kartu_Anggota_{$anggota->nama_lengkap}.pdf", ["Attachment" => 0]);
        exit;
    }

    public function profile() {
        $id = $this->session->userdata('id');
        $data['user'] = $this->User_model->get_user_by_id($id);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/profile', $data);
        $this->load->view('templates/footer');
    }

    public function update_profile() {
        $id = $this->session->userdata('id');
        $username = $this->input->post('username');
        $nama = $this->input->post('nama_lengkap');
        $no_hp = $this->input->post('no_hp');
        $alamat = $this->input->post('alamat');
        $password = $this->input->post('password');
        
        // Cek apakah username sudah digunakan oleh user lain (kecuali dirinya sendiri)
        $this->db->where('username', $username);
        $this->db->where('id !=', $id);
        $cek = $this->db->get('users')->num_rows();
        if($cek > 0) {
            $this->session->set_flashdata('error', 'Username "' . $username . '" sudah digunakan oleh user lain!');
            redirect('admin/profile');
            return;
        }
        
        $data = [
            'username'     => $username,
            'nama_lengkap' => $nama,
            'no_hp'        => $no_hp,
            'alamat'       => $alamat
        ];
        
        if (!empty($password)) {
            if (strlen($password) >= 6) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $this->session->set_flashdata('error', 'Password minimal 6 karakter!');
                redirect('admin/profile');
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
        redirect('admin/profile');
    }
}
?>