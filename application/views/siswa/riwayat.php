<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h2 class="mb-0 fw-bold">
                    <i class="fas fa-history" style="color: #1ABC9C;"></i> Riwayat Peminjaman
                </h2>
                <p class="text-muted mt-1">Daftar seluruh peminjaman buku Anda</p>
            </div>
        </div>
        
        <!-- Informasi Denda -->
        <?php 
        // Hitung denda dari buku yang BELUM dikembalikan (masih dipinjam)
        $denda_belum_dibayar = 0;
        foreach($riwayat as $r) {
            if($r->status == 'dipinjam' && $r->denda > 0) {
                $denda_belum_dibayar += $r->denda;
            } elseif($r->status == 'dipinjam' && date('Y-m-d') > $r->batas_pengembalian) {
                // Hitung denda jika terlambat tapi belum tercatat
                $tgl1 = new DateTime($r->batas_pengembalian);
                $tgl2 = new DateTime(date('Y-m-d'));
                $selisih = $tgl1->diff($tgl2)->days;
                $denda_belum_dibayar += $selisih * 1000;
            }
        }
        ?>
        
        <?php if($denda_belum_dibayar > 0): ?>
            <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); color: white;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-2 me-3" style="background: rgba(255,255,255,0.2);">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                    <div>
                        <strong class="d-block">⚠️ Informasi Denda!</strong>
                        <small>Anda memiliki total denda sebesar <strong>Rp <?= number_format($denda_belum_dibayar, 0, ',', '.') ?></strong> dari buku yang belum dikembalikan. 
                        Segera kembalikan buku dan selesaikan pembayaran denda di perpustakaan.</small>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- Statistik Ringkas -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card border-0 text-white shadow-sm stat-card" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 mb-1">Total Peminjaman</h6>
                                <h2 class="mb-0 fw-bold"><?= count($riwayat) ?></h2>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-book fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 text-white shadow-sm stat-card" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 mb-1">Sedang Dipinjam</h6>
                                <h2 class="mb-0 fw-bold">
                                    <?php 
                                    $dipinjam = array_filter($riwayat, function($r) {
                                        return $r->status == 'dipinjam';
                                    });
                                    echo count($dipinjam);
                                    ?>
                                </h2>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-hourglass-half fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 text-white shadow-sm stat-card" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 mb-1">Total Denda Keseluruhan</h6>
                                <h2 class="mb-0 fw-bold">
                                    Rp <?php 
                                    // Total denda dari SEMUA transaksi (yang sudah dikembalikan + yang masih dipinjam)
                                    $total_denda_semua = array_sum(array_column($riwayat, 'denda'));
                                    // Tambahkan denda untuk yang masih dipinjam dan terlambat
                                    foreach($riwayat as $r) {
                                        if($r->status == 'dipinjam' && date('Y-m-d') > $r->batas_pengembalian) {
                                            $tgl1 = new DateTime($r->batas_pengembalian);
                                            $tgl2 = new DateTime(date('Y-m-d'));
                                            $selisih = $tgl1->diff($tgl2)->days;
                                            $total_denda_semua += $selisih * 1000;
                                        }
                                    }
                                    echo number_format($total_denda_semua, 0, ',', '.');
                                    ?>
                                </h2>
                            </div>
                            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                                <i class="fas fa-money-bill fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel Riwayat -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-2"></i>
                        <strong>Data Riwayat Peminjaman</strong>
                    </div>
                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                        <i class="fas fa-sort-amount-down me-1"></i> Terbaru ke Terlama
                    </span>
                </div>
                <small class="opacity-75">Prioritas yang sedang dipinjam di atas | Terbaru ke terlama</small>
            </div>
            <div class="card-body p-0" style="background: #ECF0F1;">
                <div class="table-responsive">
                    <table class="table table-hover table-modern mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th><i class="fas fa-book me-1"></i> Judul Buku</th>
                                <th class="text-center"><i class="fas fa-calendar-plus me-1"></i> Tgl Pinjam</th>
                                <th class="text-center"><i class="fas fa-calendar-times me-1"></i> Batas Kembali</th>
                                <th class="text-center"><i class="fas fa-calendar-check me-1"></i> Tgl Kembali</th>
                                <th class="text-center"><i class="fas fa-tag me-1"></i> Status</th>
                                <th class="text-center"><i class="fas fa-money-bill me-1"></i> Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($riwayat)): ?>
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
                                
                                // Urutkan berdasarkan ID transaksi (yang lebih besar = lebih baru)
                                usort($dipinjam, function($a, $b) {
                                    return $b->id_transaksi - $a->id_transaksi;
                                });
                                usort($dikembalikan, function($a, $b) {
                                    return $b->id_transaksi - $a->id_transaksi;
                                });
                                
                                // Gabungkan: dipinjam dulu, baru dikembalikan
                                $riwayat_sorted = array_merge($dipinjam, $dikembalikan);
                                
                                $no=1; 
                                foreach($riwayat_sorted as $row): 
                                    // Hitung denda jika masih dipinjam dan melewati batas
                                    $denda_tampil = $row->denda;
                                    $is_terlambat = false;
                                    if($row->status == 'dipinjam' && date('Y-m-d') > $row->batas_pengembalian) {
                                        $is_terlambat = true;
                                        $tgl1 = new DateTime($row->batas_pengembalian);
                                        $tgl2 = new DateTime(date('Y-m-d'));
                                        $selisih = $tgl1->diff($tgl2)->days;
                                        $denda_tampil = $selisih * 1000;
                                    }
                                ?>
                                <tr class="fade-in <?= $row->status == 'dipinjam' ? 'status-dipinjam' : '' ?>">
                                    <td class="text-center fw-bold"><?= $no++ ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if($row->status == 'dipinjam'): ?>
                                                <div class="rounded-circle p-2 me-2" style="background: rgba(26, 188, 156, 0.15);">
                                                    <i class="fas fa-book-reader" style="color: #1ABC9C;"></i>
                                                </div>
                                            <?php else: ?>
                                                <div class="rounded-circle p-2 me-2" style="background: rgba(44, 62, 80, 0.1);">
                                                    <i class="fas fa-check-circle" style="color: #2C3E50;"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <strong style="color: #2C3E50;"><?= $row->judul ?></strong>
                                                <?php if($row->status == 'dipinjam'): ?>
                                                    <span class="badge ms-2 rounded-pill" style="background: #1ABC9C; color: white;">Aktif</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill px-3 py-2" style="background: #ECF0F1; color: #2C3E50;">
                                            <i class="fas fa-calendar-alt me-1"></i> <?= date('d/m/Y', strtotime($row->tanggal_pinjam)) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if($is_terlambat): ?>
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
                                        <?php if($row->tanggal_kembali): ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #1ABC9C; color: white;">
                                                <i class="fas fa-check-circle me-1"></i> <?= date('d/m/Y', strtotime($row->tanggal_kembali)) ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #bdc3c7; color: white;">
                                                <i class="fas fa-minus-circle me-1"></i> Belum Kembali
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($row->status == 'dipinjam'): ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #1ABC9C; color: white;">
                                                <i class="fas fa-hourglass-half me-1"></i> Dipinjam
                                            </span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #2C3E50; color: white;">
                                                <i class="fas fa-check-circle me-1"></i> Dikembalikan
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($denda_tampil > 0): ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #e74c3c; color: white;">
                                                <i class="fas fa-money-bill-wave me-1"></i> Rp <?= number_format($denda_tampil, 0, ',', '.') ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #1ABC9C; color: white;">
                                                <i class="fas fa-check-circle me-1"></i> Rp 0
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                            <h5 class="text-muted">Belum Ada Riwayat Peminjaman</h5>
                                            <p class="text-muted">Anda belum pernah meminjam buku</p>
                                            <a href="<?= base_url('index.php/siswa/daftar_buku') ?>" class="btn rounded-pill px-4" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%); border: none; color: white;">
                                                <i class="fas fa-book me-2"></i> Pinjam Buku Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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

/* Empty State */
.empty-state {
    padding: 40px 20px;
}
</style>