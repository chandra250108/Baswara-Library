<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Header dengan Jam -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h2 class="mb-0 fw-bold">
                    <i class="fas fa-smile-wink text-primary me-2"></i> Dashboard Siswa
                </h2>
                <p class="text-muted mt-1">Selamat datang, <?= $this->session->userdata('nama') ?>!</p>
            </div>
            <div class="bg-light rounded-3 px-4 py-2 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <i class="fas fa-calendar-alt text-primary fa-lg"></i>
                        <span class="text-muted ms-1" id="tanggalSiswa">--/--/----</span>
                    </div>
                    <div class="vr"></div>
                    <div>
                        <i class="fas fa-clock text-primary fa-lg"></i>
                        <span class="fw-bold text-dark ms-1" id="jamSiswa">--:--:--</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Informasi Denda (Buku yang Terlambat) - Tampilan Vertikal -->
        <?php 
        // Inisialisasi variabel
        $buku_terlambat = [];
        $total_denda_terlambat = 0;

        // Pastikan $riwayat ada dan berupa array
        if(isset($riwayat) && !empty($riwayat) && is_array($riwayat)):
            foreach($riwayat as $r):
                if(isset($r->status) && isset($r->batas_pengembalian) && isset($r->judul)):
                    if($r->status == 'dipinjam' && date('Y-m-d') > $r->batas_pengembalian):
                        $tgl1 = new DateTime($r->batas_pengembalian);
                        $tgl2 = new DateTime(date('Y-m-d'));
                        $selisih = $tgl1->diff($tgl2)->days;
                        $denda = $selisih * 1000;
                        $total_denda_terlambat += $denda;
                        
                        $buku_terlambat[] = [
                            'judul' => $r->judul,
                            'batas' => $r->batas_pengembalian,
                            'telat' => $selisih,
                            'denda' => $denda
                        ];
                    endif;
                endif;
            endforeach;
        endif;
        ?>

        <?php if(!empty($buku_terlambat)): ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <!-- Header Minimalis -->
                    <div class="px-3 py-2" style="background: #e74c3c;">
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                                <span class="fw-semibold text-white">Peringatan Keterlambatan</span>
                                <span class="badge bg-white text-danger rounded-pill px-2"><?= count($buku_terlambat) ?> Buku</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-money-bill-wave text-white"></i>
                                <span class="fw-bold text-white">Total Denda: Rp <?= number_format($total_denda_terlambat, 0, ',', '.') ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Body - List Buku Terlambat (VERTIKAL KE BAWAH) -->
                    <div class="p-3" style="background: #fff5f5;">
                        <?php foreach($buku_terlambat as $bt): ?>
                        <div class="bg-white rounded-2 p-2 shadow-sm border-start border-3 border-danger mb-2">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-book text-danger fa-sm"></i>
                                    <span class="small fw-medium text-dark"><?= isset($bt['judul']) ? $bt['judul'] : '-' ?></span>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <span class="small text-muted">
                                        <i class="fas fa-clock me-1"></i> Terlambat <?= isset($bt['telat']) ? $bt['telat'] : 0 ?> hari
                                    </span>
                                    <span class="small fw-bold text-danger">
                                        <i class="fas fa-money-bill-wave me-1"></i> Rp <?= isset($bt['denda']) ? number_format($bt['denda'], 0, ',', '.') : 0 ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Footer dengan Tombol -->
                    <div class="px-3 py-2 d-flex justify-content-between align-items-center flex-wrap gap-2" style="background: #fef5e7; border-top: 1px solid #fdebd0;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-info-circle text-warning fa-sm"></i>
                            <small class="text-muted">Denda Rp 1.000/hari per buku</small>
                        </div>
                        <a href="<?= base_url('index.php/siswa/riwayat') ?>" class="btn-denda-detail">
                            <i class="fas fa-eye me-1"></i> Lihat Detail
                            <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Statistik Cepat (Hanya Total Buku dan Total Peminjaman) -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card border-0 text-white shadow-sm stat-card" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 mb-1">Total Buku</h6>
                                <h2 class="mb-0 fw-bold"><?= isset($buku_terbaru) ? count($buku_terbaru) : 0 ?></h2>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-book fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-white-50">
                                <i class="fas fa-arrow-right me-1"></i> Koleksi perpustakaan
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-0 text-white shadow-sm stat-card" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 mb-1">Total Peminjaman</h6>
                                <h2 class="mb-0 fw-bold"><?= isset($riwayat) ? count($riwayat) : 0 ?></h2>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-history fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-white-50">
                                <i class="fas fa-clock me-1"></i> Riwayat peminjaman
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel Buku Terbaru dan Riwayat -->
        <div class="row">
            <!-- Buku Terbaru -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-lg h-100 rounded-4 buku-card">
                    <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-book-open me-2"></i>
                                <strong>Buku Terbaru</strong>
                            </div>
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-database me-1"></i> <?= isset($buku_terbaru) ? count($buku_terbaru) : 0 ?> Buku
                            </span>
                        </div>
                        <small class="opacity-75">Menampilkan 5 buku terbaru</small>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-modern mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60">Cover</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th width="70" class="text-center">Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($buku_terbaru) && !empty($buku_terbaru)): ?>
                                        <?php 
                                        $buku_sorted = $buku_terbaru;
                                        usort($buku_sorted, function($a, $b) {
                                            return $b->id_buku - $a->id_buku;
                                        });
                                        $buku_list = array_slice($buku_sorted, 0, 5);
                                        foreach($buku_list as $buku): 
                                        ?>
                                        <tr class="fade-in">
                                            <td class="align-middle">
                                                <?php if(!empty($buku->cover) && file_exists('uploads/'.$buku->cover)): ?>
                                                    <img src="<?= base_url('uploads/'.$buku->cover) ?>" width="40" height="50" style="object-fit: cover;" class="rounded shadow-sm cover-img">
                                                <?php else: ?>
                                                    <div class="bg-secondary bg-opacity-10 rounded text-center p-1">
                                                        <i class="fas fa-book fa-2x text-secondary"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="align-middle fw-bold"><?= $buku->judul ?> </td>
                                            <td class="align-middle text-muted"><?= $buku->penulis ?> </td>
                                            <td class="align-middle text-center">
                                                <span class="badge rounded-pill px-3 py-2" style="background: #1ABC9C; color: white;">
                                                    <?= $buku->stok ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <i class="fas fa-inbox fa-3x text-muted mb-2"></i>
                                                <p class="text-muted mb-0">Tidak ada data buku</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center p-3 border-top">
                            <a href="<?= base_url('index.php/siswa/daftar_buku') ?>" class="btn btn-sm rounded-pill px-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%); color: white;">
                                Lihat Semua Buku <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Riwayat Peminjaman (Prioritas Dipinjam di Atas) -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-lg h-100 rounded-4 riwayat-card">
                    <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-history me-2"></i>
                                <strong>Riwayat Peminjaman</strong>
                            </div>
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                <i class="fas fa-chart-line me-1"></i> <?= isset($riwayat) ? count($riwayat) : 0 ?> Transaksi
                            </span>
                        </div>
                        <small class="opacity-75">Prioritas yang sedang dipinjam di atas | Terbaru ke terlama</small>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-modern mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Judul Buku</th>
                                        <th class="text-center">Tgl Pinjam</th>
                                        <th class="text-center">Batas Kembali</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($riwayat) && !empty($riwayat)): ?>
                                        <?php 
                                        // Pisahkan data: dipinjam vs dikembalikan
                                        $dipinjam = [];
                                        $dikembalikan = [];
                                        
                                        foreach($riwayat as $r) {
                                            if($r->status == 'dipinjam') {
                                                $dipinjam[] = $r;
                                            } else {
                                                $dikembalikan[] = $r;
                                            }
                                        }
                                        
                                        // Urutkan berdasarkan ID transaksi (yang lebih besar = lebih baru / terakhir dipinjam)
                                        usort($dipinjam, function($a, $b) {
                                            return $b->id_transaksi - $a->id_transaksi;
                                        });
                                        usort($dikembalikan, function($a, $b) {
                                            return $b->id_transaksi - $a->id_transaksi;
                                        });
                                        
                                        // Gabungkan: dipinjam dulu, baru dikembalikan
                                        $riwayat_sorted = array_merge($dipinjam, $dikembalikan);
                                        $riwayat_list = array_slice($riwayat_sorted, 0, 5);
                                        
                                        foreach($riwayat_list as $r): 
                                        ?>
                                        <tr class="fade-in <?= $r->status == 'dipinjam' ? 'status-dipinjam' : '' ?>">
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <?php if($r->status == 'dipinjam'): ?>
                                                        <div class="rounded-circle p-2 me-2" style="background: rgba(26, 188, 156, 0.15);">
                                                            <i class="fas fa-book-reader" style="color: #1ABC9C;"></i>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="rounded-circle p-2 me-2" style="background: rgba(26, 188, 156, 0.1);">
                                                            <i class="fas fa-check-circle" style="color: #1ABC9C;"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div>
                                                        <strong><?= $r->judul ?></strong>
                                                        <?php if($r->status == 'dipinjam'): ?>
                                                            <span class="badge ms-2 rounded-pill" style="background: #1ABC9C; color: white;">Aktif</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge rounded-pill px-3 py-2" style="background: #ECF0F1; color: #2C3E50;">
                                                    <i class="fas fa-calendar-alt me-1"></i> <?= date('d/m/Y H:i', strtotime($r->tanggal_pinjam)) ?>
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php if($r->status == 'dipinjam' && date('Y-m-d') > $r->batas_pengembalian): ?>
                                                    <span class="badge rounded-pill px-3 py-2" style="background: #e74c3c; color: white;">
                                                        <i class="fas fa-exclamation-triangle me-1"></i> <?= date('d/m/Y', strtotime($r->batas_pengembalian)) ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge rounded-pill px-3 py-2" style="background: #ECF0F1; color: #2C3E50;">
                                                        <i class="fas fa-hourglass-half me-1"></i> <?= date('d/m/Y', strtotime($r->batas_pengembalian)) ?>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php if($r->status == 'dipinjam'): ?>
                                                    <span class="badge rounded-pill px-3 py-2" style="background: #1ABC9C; color: white;">
                                                        <i class="fas fa-hourglass-half me-1"></i> Dipinjam
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge rounded-pill px-3 py-2" style="background: #2C3E50; color: white;">
                                                        <i class="fas fa-check-circle me-1"></i> Dikembalikan
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <i class="fas fa-inbox fa-3x text-muted mb-2"></i>
                                                <p class="text-muted mb-0">Belum ada riwayat peminjaman</p>
                                                <a href="<?= base_url('index.php/siswa/daftar_buku') ?>" class="btn btn-sm mt-3 rounded-pill" style="background: #1ABC9C; color: white;">
                                                    <i class="fas fa-book me-1"></i> Pinjam Buku Sekarang
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center p-3 border-top">
                            <a href="<?= base_url('index.php/siswa/riwayat') ?>" class="btn btn-sm rounded-pill px-4" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%); color: white;">
                                Lihat Semua Riwayat <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quote / Motivasi (Paling Bawah) -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="alert border-0 shadow-sm rounded-3 text-center" style="background: #ECF0F1; color: #2C3E50;">
                    <i class="fas fa-quote-left text-primary me-2" style="color: #1ABC9C;"></i>
                    <span>"Baca buku, perluas wawasan, raih masa depan gemilang"</span>
                    <i class="fas fa-quote-right text-primary ms-2" style="color: #1ABC9C;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Fungsi untuk update jam real-time
function updateRealTimeClock() {
    var now = new Date();
    var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    var dayName = days[now.getDay()];
    var day = now.getDate();
    var month = months[now.getMonth()];
    var year = now.getFullYear();
    var hours = now.getHours().toString().padStart(2, '0');
    var minutes = now.getMinutes().toString().padStart(2, '0');
    var seconds = now.getSeconds().toString().padStart(2, '0');
    
    document.getElementById('tanggalSiswa').innerHTML = dayName + ', ' + day + ' ' + month + ' ' + year;
    document.getElementById('jamSiswa').innerHTML = hours + ':' + minutes + ':' + seconds;
}

updateRealTimeClock();
setInterval(updateRealTimeClock, 1000);
</script>

<style>
/* Stat Card Hover */
.stat-card {
    transition: all 0.3s ease;
    cursor: pointer;
    border-radius: 20px;
}
.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

/* Card Hover */
.buku-card, .riwayat-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}
.buku-card:hover, .riwayat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

/* Table Modern */
.table-modern {
    border-collapse: separate;
    border-spacing: 0;
}
.table-modern tbody tr {
    transition: all 0.2s ease;
}
.table-modern tbody tr:hover {
    background: linear-gradient(90deg, #e8f8f5 0%, #ffffff 100%);
    transform: scale(1.01);
}

/* Status Dipinjam Row */
.status-dipinjam {
    background-color: #e8f8f5;
    border-left: 4px solid #1ABC9C;
}
.status-dipinjam:hover {
    background: linear-gradient(90deg, #d0f0ea 0%, #ffffff 100%) !important;
}

/* Cover Image Hover */
.cover-img {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.cover-img:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

/* Animations */
.fade-in {
    animation: fadeInUp 0.5s ease;
}
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Rounded */
.rounded-4 {
    border-radius: 16px !important;
}
.rounded-top-4 {
    border-top-left-radius: 16px !important;
    border-top-right-radius: 16px !important;
}
.rounded-3 {
    border-radius: 12px !important;
}

/* VR Divider */
.vr {
    width: 1px;
    height: 30px;
    background-color: #dee2e6;
}

/* Card Header Hover */
.card-header {
    transition: all 0.3s ease;
}
.buku-card:hover .card-header {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%) !important;
}
.riwayat-card:hover .card-header {
    background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%) !important;
}

/* Alert Denda */
.alert-danger {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    border: none;
    color: white;
}
.alert-danger .btn-close-white {
    filter: brightness(0) invert(1);
}
.table-borderless th, .table-borderless td {
    padding: 6px 8px;
    color: white;
}
.table-borderless thead th {
    border-bottom: 1px solid rgba(255,255,255,0.3);
    font-weight: 600;
}
.table-borderless tfoot td {
    border-top: 1px solid rgba(255,255,255,0.3);
}

/* Hover effect untuk tombol Lihat Detail */
.btn-denda-detail {
    background: transparent;
    border: none;
    color: #e74c3c;
    font-size: 13px;
    font-weight: 500;
    padding: 5px 12px;
    border-radius: 20px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.btn-denda-detail:hover {
    background: #e74c3c;
    color: white;
    transform: translateX(3px);
    box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
}
.btn-denda-detail:active {
    transform: translateX(1px);
}
</style>