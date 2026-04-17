<?php
class Transaksi_model extends CI_Model {
    
    public function pinjam_buku($data) {
    // Set default status denda menjadi belum_lunas
        $data['status_denda'] = 'belum_lunas';
        
        // Kurangi stok buku
        $this->db->set('stok', 'stok-1', FALSE);
        $this->db->where('id_buku', $data['id_buku']);
        $this->db->update('buku');
        
        return $this->db->insert('transaksi', $data);
    }
    
    public function kembalikan_buku($id_transaksi) {
    // Ambil data transaksi
        $transaksi = $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi])->row();
        
        if(!$transaksi) {
            return false;
        }
        
        // Hitung denda jika terlambat
        $today = date('Y-m-d');
        $denda = 0;
        $status_denda = 'lunas'; // Default lunas
        
        if($today > $transaksi->batas_pengembalian) {
            $tgl1 = new DateTime($transaksi->batas_pengembalian);
            $tgl2 = new DateTime($today);
            $selisih = $tgl1->diff($tgl2)->days;
            $denda = $selisih * 1000; // Denda Rp 1000/hari
            $status_denda = 'lunas'; // Setelah dikembalikan, status denda menjadi lunas
        }
        
        // Update transaksi
        $data = [
            'tanggal_kembali' => $today,
            'status' => 'dikembalikan',
            'denda' => $denda,
            'status_denda' => $status_denda
        ];
        
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('transaksi', $data);
        
        // Tambah stok buku
        $this->db->set('stok', 'stok+1', FALSE);
        $this->db->where('id_buku', $transaksi->id_buku);
        return $this->db->update('buku');
    }
    
    public function get_transaksi_by_siswa($id_siswa) {
        $this->db->select('transaksi.*, buku.judul, users.nama_lengkap');
        $this->db->from('transaksi');
        $this->db->join('buku', 'buku.id_buku = transaksi.id_buku');
        $this->db->join('users', 'users.id = transaksi.id_siswa');
        $this->db->where('transaksi.id_siswa', $id_siswa);
        $this->db->order_by('transaksi.tanggal_pinjam', 'DESC'); // DESC = terbaru dulu
        return $this->db->get()->result();
    }
    
    public function get_all_transaksi() {
        $this->db->select('transaksi.*, buku.judul, buku.penulis, buku.penerbit, 
                        users.nama_lengkap, users.kelas, users.alamat, users.no_hp');
        $this->db->from('transaksi');
        $this->db->join('buku', 'buku.id_buku = transaksi.id_buku');
        $this->db->join('users', 'users.id = transaksi.id_siswa');
        $this->db->order_by('transaksi.tanggal_pinjam', 'DESC');
        
        $result = $this->db->get()->result();
        
        // Update status denda untuk yang masih dipinjam dan terlambat
        foreach($result as $row) {
            if($row->status == 'dipinjam' && date('Y-m-d') > $row->batas_pengembalian) {
                $row->status_denda = 'belum_lunas';
            }
        }
        
        return $result;
    }
    
    public function get_peminjaman_aktif() {
        $this->db->select('transaksi.*, buku.judul, buku.penulis, users.nama_lengkap, users.kelas, users.no_hp');
        $this->db->from('transaksi');
        $this->db->join('buku', 'buku.id_buku = transaksi.id_buku');
        $this->db->join('users', 'users.id = transaksi.id_siswa');
        $this->db->where('transaksi.status', 'dipinjam');
        $this->db->order_by('transaksi.tanggal_pinjam', 'DESC');
        
        $result = $this->db->get()->result();
        
        // Update status denda untuk yang terlambat
        foreach($result as $row) {
            if(date('Y-m-d') > $row->batas_pengembalian) {
                $row->status_denda = 'belum_lunas';
            }
        }
        
        return $result;
    }
    
    public function get_notifikasi_pengembalian($id_siswa = null) {
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        
        $this->db->select('transaksi.*, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('buku', 'buku.id_buku = transaksi.id_buku');
        $this->db->where('transaksi.status', 'dipinjam');
        $this->db->where("(batas_pengembalian = '$today' OR batas_pengembalian = '$tomorrow')");
        
        if($id_siswa) {
            $this->db->where('transaksi.id_siswa', $id_siswa);
        }
        
        return $this->db->get()->result();
    }

    public function getChartDataPeminjaman($startDate, $endDate) {
        $labels = [];
        $data = [];
        
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($start, $interval, $end);
        
        $this->db->select('DATE(tanggal_pinjam) as tanggal, COUNT(*) as jumlah');
        $this->db->from('transaksi');
        $this->db->where('DATE(tanggal_pinjam) >=', $startDate);
        $this->db->where('DATE(tanggal_pinjam) <=', $endDate);
        $this->db->group_by('DATE(tanggal_pinjam)');
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
}
?>