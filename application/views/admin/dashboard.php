<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Header dengan Jam Real-time -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h2 class="mb-0 fw-bold" style="color: #2C3E50;">
                    <i class="fas fa-tachometer-alt" style="color: #1ABC9C;"></i> Dashboard Admin
                </h2>
                <p class="text-muted mt-1">Selamat datang, <?= $this->session->userdata('nama') ?>!</p>
            </div>
            <div class="rounded-3 px-4 py-2 shadow-sm" style="background: #ECF0F1;">
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <i class="fas fa-calendar-alt" style="color: #1ABC9C;"></i>
                        <span class="text-muted ms-1" id="tanggalRealTime">--/--/----</span>
                    </div>
                    <div class="vr" style="background-color: #bdc3c7;"></div>
                    <div>
                        <i class="fas fa-clock" style="color: #1ABC9C;"></i>
                        <span class="fw-bold text-dark ms-1" id="jamRealTime">--:--:--</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistik Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card border-0 text-white shadow-sm stat-card" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 mb-1">Total Buku</h6>
                                <h2 class="mb-0 fw-bold"><?= $total_buku ?? 0 ?></h2>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-book fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-white-50">
                                <i class="fas fa-arrow-up me-1"></i> Seluruh koleksi buku
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 text-white shadow-sm stat-card" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 mb-1">Total Siswa</h6>
                                <h2 class="mb-0 fw-bold"><?= $total_siswa ?? 0 ?></h2>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-white-50">
                                <i class="fas fa-user-graduate me-1"></i> Anggota aktif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 text-white shadow-sm stat-card" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 mb-1">Total Peminjaman</h6>
                                <h2 class="mb-0 fw-bold"><?= $total_peminjaman ?? 0 ?></h2>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-exchange-alt fa-2x"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-white-50">
                                <i class="fas fa-chart-line me-1"></i> Seluruh transaksi
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Notifikasi -->
        <?php if(!empty($notifikasi)): ?>
            <div class="alert alert-warning alert-dismissible fade show shadow-sm rounded-3 mb-4" role="alert" style="background: #f39c12; border: none; color: white;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-2 me-3" style="background: rgba(255,255,255,0.2);">
                        <i class="fas fa-bell fa-2x"></i>
                    </div>
                    <div>
                        <strong class="d-block">Pemberitahuan Pengembalian!</strong>
                        <ul class="mb-0 mt-1">
                            <?php foreach($notifikasi as $notif): ?>
                                <li>Buku <strong>"<?= $notif->judul ?>"</strong> harus dikembalikan tanggal 
                                    <strong><?= date('d/m/Y', strtotime($notif->batas_pengembalian)) ?></strong>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <!-- Peminjaman Aktif -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <div>
                        <i class="fas fa-clock me-2"></i>
                        <strong>Peminjaman Aktif</strong>
                    </div>
                    <div class="d-flex gap-2">
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                            <i class="fas fa-chart-line me-1"></i> <?= count($peminjaman_aktif ?? []) ?> Aktif
                        </span>
                        <a href="<?= base_url('index.php/admin/transaksi') ?>" class="btn-lihat-transaksi">
                            <i class="fas fa-arrow-right me-1"></i> Lihat Transaksi
                        </a>
                    </div>
                </div>
                <small class="opacity-75">Daftar buku yang sedang dipinjam (terbaru di atas)</small>
            </div>
            <div class="card-body p-0" style="background: #ECF0F1;">
                <div class="table-responsive">
                    <table class="table table-hover table-modern mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th><i class="fas fa-user me-1"></i> Nama Peminjam</th>
                                <th><i class="fas fa-book me-1"></i> Judul Buku</th>
                                <th class="text-center"><i class="fas fa-calendar-alt me-1"></i> Tanggal Pinjam</th>
                                <th class="text-center"><i class="fas fa-calendar-times me-1"></i> Batas Pengembalian</th>
                                <th class="text-center"><i class="fas fa-tag me-1"></i> Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($peminjaman_aktif)): ?>
                                <?php 
                                // Urutkan berdasarkan ID transaksi (yang lebih besar = lebih baru)
                                $peminjaman_sorted = $peminjaman_aktif;
                                usort($peminjaman_sorted, function($a, $b) {
                                    return $b->id_transaksi - $a->id_transaksi;
                                });
                                $no=1; 
                                foreach($peminjaman_sorted as $row): 
                                ?>
                                <tr class="fade-in">
                                    <td class="text-center fw-bold"><?= $no++ ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle p-2 me-2" style="background: rgba(26, 188, 156, 0.15);">
                                                <i class="fas fa-user" style="color: #1ABC9C;"></i>
                                            </div>
                                            <div>
                                                <span class="fw-bold" style="color: #2C3E50;"><?= $row->nama_lengkap ?></span>
                                                <small class="d-block text-muted"><?= $row->kelas ?? '-' ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle p-2 me-2" style="background: rgba(44, 62, 80, 0.1);">
                                                <i class="fas fa-book" style="color: #2C3E50;"></i>
                                            </div>
                                            <div>
                                                <span class="fw-bold" style="color: #1ABC9C;"><?= $row->judul ?></span>
                                                <small class="d-block text-muted"><?= $row->penulis ?? '-' ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill px-3 py-2" style="background: #ECF0F1; color: #2C3E50;">
                                            <i class="fas fa-calendar-alt me-1"></i> <?= date('d/m/Y', strtotime($row->tanggal_pinjam)) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if(date('Y-m-d') > $row->batas_pengembalian): ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #e74c3c; color: white;">
                                                <i class="fas fa-exclamation-triangle me-1"></i> <?= date('d/m/Y', strtotime($row->batas_pengembalian)) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #ECF0F1; color: #2C3E50;">
                                                <i class="fas fa-hourglass-half me-1"></i> <?= date('d/m/Y', strtotime($row->batas_pengembalian)) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill px-3 py-2" style="background: #1ABC9C; color: white;">
                                            <i class="fas fa-hourglass-half me-1"></i> Dipinjam
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                            <h5 class="text-muted">Tidak Ada Peminjaman Aktif</h5>
                                            <p class="text-muted">Belum ada transaksi peminjaman buku saat ini</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert border-0 shadow-sm rounded-3" style="background: #ECF0F1;">
                    <div class="text-center">
                        <i class="fas fa-info-circle" style="color: #1ABC9C;"></i>
                        <span class="text-muted">Sistem Informasi Perpustakaan Digital</span>
                    </div>
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
    
    document.getElementById('tanggalRealTime').innerHTML = dayName + ', ' + day + ' ' + month + ' ' + year;
    document.getElementById('jamRealTime').innerHTML = hours + ':' + minutes + ':' + seconds;
}

// Jalankan pertama kali
updateRealTimeClock();

// Update setiap detik
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
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}
.stat-card:active {
    transform: translateY(-2px);
}

/* Table Modern */
.table-modern {
    border-collapse: separate;
    border-spacing: 0;
}
.table-modern tbody tr {
    transition: all 0.2s ease;
    cursor: pointer;
}
.table-modern tbody tr:hover {
    background: linear-gradient(90deg, #e8f8f5 0%, #ffffff 100%);
    transform: scale(1.01);
}

/* Animations */
.fade-in {
    animation: fadeIn 0.5s ease;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
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

/* Empty State */
.empty-state {
    padding: 40px 20px;
}
.vr {
    width: 1px;
    height: 30px;
    background-color: #bdc3c7;
}

/* Tombol Lihat Transaksi */
.btn-lihat-transaksi {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    color: white;
    padding: 6px 16px;
    border-radius: 50px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn-lihat-transaksi:hover {
    transform: translateX(3px);
    background: linear-gradient(135deg, #16A085 0%, #1ABC9C 100%);
    box-shadow: 0 4px 12px rgba(26, 188, 156, 0.4);
    color: white;
}
.btn-lihat-transaksi:active {
    transform: translateX(1px);
}
</style>