<?php
class Buku_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_buku() {
        $this->db->where('is_deleted', 0); // Hanya tampilkan yang belum dihapus
        $this->db->order_by('judul', 'ASC'); // Urutkan A-Z
        return $this->db->get('buku')->result();
    }
    
    public function get_all_buku_with_deleted() {
        $this->db->order_by('judul', 'ASC');
        return $this->db->get('buku')->result();
    }
    
    public function get_deleted_buku() {
        $this->db->where('is_deleted', 1);
        $this->db->order_by('deleted_at', 'DESC');
        return $this->db->get('buku')->result();
    }
    
    public function get_buku_by_id($id) {
        $this->db->where('id_buku', $id);
        $query = $this->db->get('buku');
        return $query->row();
    }
    
    public function insert_buku($data) {
        // Debug: log data yang akan diinsert
        log_message('debug', 'Inserting buku: ' . print_r($data, true));
        
        $result = $this->db->insert('buku', $data);
        
        if(!$result) {
            log_message('error', 'Insert failed: ' . $this->db->last_query());
            log_message('error', 'Database error: ' . $this->db->error()['message']);
        }
        
        return $result;
    }
    
    public function update_buku($id, $data) {
        $this->db->where('id_buku', $id);
        return $this->db->update('buku', $data);
    }
    
    public function delete_buku($id) {
        $this->db->where('id_buku', $id);
        return $this->db->delete('buku');
    }
    
    // Soft delete (arsipkan)
    public function soft_delete_buku($id) {
        $data = array(
            'is_deleted' => 1,
            'deleted_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id_buku', $id);
        return $this->db->update('buku', $data);
    }
    
    // Restore buku (pulihkan dari arsip)
    public function restore_buku($id) {
        $data = array(
            'is_deleted' => 0,
            'deleted_at' => NULL
        );
        $this->db->where('id_buku', $id);
        return $this->db->update('buku', $data);
    }
    
    // Hapus permanen
    public function permanent_delete_buku($id) {
        $this->db->where('id_buku', $id);
        return $this->db->delete('buku');
    }
    
    public function cari_buku($keyword) {
        $this->db->where('is_deleted', 0);
        $this->db->group_start();
        $this->db->like('judul', $keyword);
        $this->db->or_like('penulis', $keyword);
        $this->db->or_like('penerbit', $keyword);
        $this->db->group_end();
        $this->db->order_by('judul', 'ASC');
        return $this->db->get('buku')->result();
    }
    
    public function cari_buku_deleted($keyword) {
        $this->db->where('is_deleted', 1);
        $this->db->group_start();
        $this->db->like('judul', $keyword);
        $this->db->or_like('penulis', $keyword);
        $this->db->or_like('penerbit', $keyword);
        $this->db->group_end();
        $this->db->order_by('deleted_at', 'DESC');
        return $this->db->get('buku')->result();
    }

    public function getChartDataBuku($startDate, $endDate) {
        $labels = [];
        $data = [];
        
        // Generate semua tanggal dalam rentang
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $end->modify('+1 day');
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($start, $interval, $end);
        
        // Ambil data dari database sekaligus untuk efisiensi
        $this->db->select('DATE(created_at) as tanggal, COUNT(*) as jumlah');
        $this->db->from('buku');
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
}
?>