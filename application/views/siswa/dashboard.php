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

        <?php 
        // Cari buku yang batas pengembaliannya besok
        $buku_batas_besok = [];
        $besok = date('Y-m-d', strtotime('+1 day'));
        
        if(isset($riwayat) && !empty($riwayat) && is_array($riwayat)):
            foreach($riwayat as $r):
                if(isset($r->status) && isset($r->batas_pengembalian) && isset($r->judul)):
                    if($r->status == 'dipinjam' && $r->batas_pengembalian == $besok):
                        $buku_batas_besok[] = [
                            'judul' => $r->judul,
                            'batas' => $r->batas_pengembalian,
                            'id_transaksi' => $r->id_transaksi
                        ];
                    endif;
                endif;
            endforeach;
        endif;
        ?>

        <?php if(!empty($buku_batas_besok)): ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden notification-card-warning">
                    <div class="notification-header-warning px-4 py-3">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="notification-icon-warning">
                                    <i class="fas fa-bell fa-xl"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold text-white">Peringatan Batas Pengembalian</h5>
                                    <small class="text-white-50">Segera kembalikan buku Anda</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div class="countdown-badge">
                                    <i class="fas fa-calendar-day me-1"></i>
                                    <span class="fw-bold">Batas: BESOK</span>
                                </div>
                                <span class="badge-notification-warning">
                                    <i class="fas fa-book me-1"></i> <?= count($buku_batas_besok) ?> Buku
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-body-warning p-3">
                        <?php foreach($buku_batas_besok as $bt): ?>
                        <div class="notification-item-warning mb-2">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="book-icon-warning">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark"><?= isset($bt['judul']) ? $bt['judul'] : '-' ?></div>
                                        <div class="small text-muted">
                                            <i class="fas fa-calendar-alt me-1"></i> Batas: <?= date('d/m/Y', strtotime($bt['batas'])) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="status-badge-warning">
                                    <i class="fas fa-hourglass-half me-1"></i> 
                                    <span class="fw-semibold">Besok Terakhir!</span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Informasi Denda (Buku yang Terlambat) - Tampilan Lebih Menarik -->
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
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden notification-card-danger">
                    <div class="notification-header-danger px-4 py-3">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="notification-icon-danger">
                                    <i class="fas fa-exclamation-triangle fa-xl"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold text-white">Peringatan Keterlambatan</h5>
                                    <small class="text-white-50">Anda memiliki denda yang harus dibayar</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="total-denda-badge">
                                    <i class="fas fa-money-bill-wave me-1"></i>
                                    <span class="fw-bold">Rp <?= number_format($total_denda_terlambat, 0, ',', '.') ?></span>
                                </div>
                                <span class="badge-notification-danger">
                                    <i class="fas fa-book me-1"></i> <?= count($buku_terlambat) ?> Buku
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-body-danger p-3">
                        <?php foreach($buku_terlambat as $bt): ?>
                        <div class="notification-item-danger mb-2">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="book-icon-danger">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark"><?= isset($bt['judul']) ? $bt['judul'] : '-' ?></div>
                                        <div class="small text-muted">
                                            <i class="fas fa-clock me-1"></i> Terlambat <?= isset($bt['telat']) ? $bt['telat'] : 0 ?> hari
                                        </div>
                                    </div>
                                </div>
                                <div class="denda-badge">
                                    <i class="fas fa-money-bill-wave me-1"></i>
                                    <span class="fw-semibold">Rp <?= isset($bt['denda']) ? number_format($bt['denda'], 0, ',', '.') : 0 ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="notification-footer px-4 py-2">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-info-circle text-muted fa-sm"></i>
                                <small class="text-muted">Denda Rp 1.000/hari per buku</small>
                            </div>
                            <a href="<?= base_url('index.php/siswa/riwayat') ?>" class="btn-denda-detail-modern">
                                <i class="fas fa-eye me-1"></i> Lihat Detail
                                <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
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
                            <a href="<?= base_url('index.php/siswa/daftar_buku') ?>" class="btn btn-sm rounded-pill px-4 btn-lihat-buku" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%); color: white;">
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
                                                <a href="<?= base_url('index.php/siswa/daftar_buku') ?>" class="btn btn-sm mt-3 rounded-pill btn-pinjam-sekarang" style="background: #1ABC9C; color: white;">
                                                    <i class="fas fa-book me-1"></i> Pinjam Buku Sekarang
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center p-3 border-top">
                            <a href="<?= base_url('index.php/siswa/riwayat') ?>" class="btn btn-sm rounded-pill px-4 btn-lihat-riwayat" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%); color: white;">
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
.buku-card .table thead th {
    background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%) !important;
    color: white !important;
    transition: all 0.3s ease;
}
.buku-card:hover .table thead th {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%) !important;
    color: white !important;
}
.riwayat-card:hover .card-header {
    background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%) !important;
}
.riwayat-card .table thead th {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%) !important;
    color: white !important;
    transition: all 0.3s ease;
}
.riwayat-card:hover .table thead th {
    background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%) !important;
    color: white !important;
}

/* ========== STYLE NOTIFIKASI MODERN & MENARIK ========== */

/* NOTIFIKASI WARNING (Batas Besok) */
.notification-card-warning {
    transition: all 0.3s ease;
}
.notification-card-warning:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 35px rgba(243, 156, 18, 0.2) !important;
}

.notification-header-warning {
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    position: relative;
    overflow: hidden;
}
.notification-header-warning::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    pointer-events: none;
}

.notification-icon-warning {
    width: 48px;
    height: 48px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
}

.countdown-badge {
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(4px);
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 13px;
    color: white;
}

.badge-notification-warning {
    background: white;
    color: #e67e22;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.notification-body-warning {
    background: linear-gradient(135deg, #fffaf0 0%, #fff5e6 100%);
}

.notification-item-warning {
    background: white;
    border-radius: 12px;
    padding: 12px 16px;
    transition: all 0.2s ease;
    border-left: 3px solid #f39c12;
}
.notification-item-warning:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.book-icon-warning {
    width: 40px;
    height: 40px;
    background: rgba(243, 156, 18, 0.15);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #f39c12;
    font-size: 18px;
}

.status-badge-warning {
    background: rgba(243, 156, 18, 0.15);
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 12px;
    color: #e67e22;
}

/* NOTIFIKASI DANGER (Denda) */
.notification-card-danger {
    transition: all 0.3s ease;
}
.notification-card-danger:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 35px rgba(231, 76, 60, 0.2) !important;
}

.notification-header-danger {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    position: relative;
    overflow: hidden;
}
.notification-header-danger::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    pointer-events: none;
}

.notification-icon-danger {
    width: 48px;
    height: 48px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
}

.total-denda-badge {
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(4px);
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 13px;
    color: white;
}

.badge-notification-danger {
    background: white;
    color: #c0392b;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.notification-body-danger {
    background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
}

.notification-item-danger {
    background: white;
    border-radius: 12px;
    padding: 12px 16px;
    transition: all 0.2s ease;
    border-left: 3px solid #e74c3c;
}
.notification-item-danger:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.book-icon-danger {
    width: 40px;
    height: 40px;
    background: rgba(231, 76, 60, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #e74c3c;
    font-size: 18px;
}

.denda-badge {
    background: rgba(231, 76, 60, 0.12);
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 13px;
    color: #e74c3c;
    font-weight: 500;
}

.notification-footer {
    background: #f8f9fa;
    border-top: 1px solid rgba(0,0,0,0.05);
}

.btn-denda-detail-modern {
    background: transparent;
    border: none;
    color: #e74c3c;
    font-size: 13px;
    font-weight: 500;
    padding: 6px 14px;
    border-radius: 30px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn-denda-detail-modern:hover {
    background: #e74c3c;
    color: white;
    transform: translateX(3px);
    box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
}

/* HOVER UNTUK TOMBOL LIHAT BUKU */
.btn-lihat-buku {
    transition: all 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
}
.btn-lihat-buku:hover {
    transform: translateX(5px) !important;
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%) !important;
    box-shadow: 0 4px 12px rgba(26, 188, 156, 0.3) !important;
    letter-spacing: 0.5px !important;
}

/* HOVER UNTUK TOMBOL LIHAT RIWAYAT */
.btn-lihat-riwayat {
    transition: all 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
}
.btn-lihat-riwayat:hover {
    transform: translateX(5px) !important;
    background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%) !important;
    box-shadow: 0 4px 12px rgba(44, 62, 80, 0.3) !important;
    letter-spacing: 0.5px !important;
}

/* HOVER UNTUK TOMBOL PINJAM SEKARANG */
.btn-pinjam-sekarang {
    transition: all 0.3s ease !important;
}
.btn-pinjam-sekarang:hover {
    transform: translateX(3px) !important;
    background: #16A085 !important;
    box-shadow: 0 4px 12px rgba(26, 188, 156, 0.3) !important;
}
</style>