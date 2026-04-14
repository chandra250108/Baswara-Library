<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-0 fw-bold" style="color: #2C3E50;">
                    <i class="fas fa-chart-line" style="color: #1ABC9C;"></i> Laporan Transaksi
                </h2>
                <p class="text-muted mt-1">Rekap seluruh transaksi peminjaman buku yang telah dikembalikan</p>
            </div>
            <div>
                <a href="<?= base_url('index.php/admin/export_excel?tanggal_awal='.($tanggal_awal??'').'&tanggal_akhir='.($tanggal_akhir??'').'&id_siswa='.($id_siswa??'').'&id_buku='.($id_buku??'')) ?>" class="btn btn-excel rounded-pill px-4">
                    <i class="fas fa-file-excel me-2"></i> Export ke Excel
                </a>
            </div>
        </div>
        
        <!-- Notifikasi -->
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert" style="background: #e8f8f5; color: #1ABC9C; border-left: 4px solid #1ABC9C;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle fa-2x me-3" style="color: #1ABC9C;"></i>
                    <div>
                        <strong>Berhasil!</strong> <?= $this->session->flashdata('success') ?>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3" role="alert" style="background: #fdeded; color: #e74c3c; border-left: 4px solid #e74c3c;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-circle fa-2x me-3" style="color: #e74c3c;"></i>
                    <div>
                        <strong>Gagal!</strong> <?= $this->session->flashdata('error') ?>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <!-- Filter -->
        <div class="card border-0 shadow-lg mb-4 rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <h5 class="mb-0"><i class="fas fa-filter me-2"></i> Filter Laporan</h5>
            </div>
            <div class="card-body p-4">
                <form method="get" action="<?= base_url('index.php/admin/laporan') ?>" class="row g-3" id="formFilterLaporan">
                    <div class="col-md-3">
                        <label class="form-label fw-bold" style="color: #2C3E50;">
                            <i class="fas fa-user-graduate" style="color: #1ABC9C;"></i> Cari Anggota
                        </label>
                        <select name="id_siswa" id="filter_siswa_laporan" class="form-control" style="width: 100%;">
                            <option value="">-- Semua Anggota --</option>
                            <?php foreach($siswa as $s): ?>
                                <option value="<?= $s->id ?>" <?= ($id_siswa == $s->id) ? 'selected' : '' ?>>
                                    <?= $s->nama_lengkap ?> - Kelas: <?= $s->kelas ?> (<?= $s->username ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text"><i class="fas fa-search" style="color: #1ABC9C;"></i> Ketik nama siswa untuk mencari</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold" style="color: #2C3E50;">
                            <i class="fas fa-book" style="color: #1ABC9C;"></i> Cari Buku
                        </label>
                        <select name="id_buku" id="filter_buku_laporan" class="form-control" style="width: 100%;">
                            <option value="">-- Semua Buku --</option>
                            <?php foreach($buku as $b): ?>
                                <option value="<?= $b->id_buku ?>" <?= ($id_buku == $b->id_buku) ? 'selected' : '' ?>>
                                    <?= $b->judul ?> - <?= $b->penulis ?> (Stok: <?= $b->stok ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text"><i class="fas fa-search" style="color: #1ABC9C;"></i> Ketik judul buku untuk mencari</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold" style="color: #2C3E50;">
                            <i class="fas fa-calendar-alt" style="color: #1ABC9C;"></i> Tanggal Awal
                        </label>
                        <input type="date" class="form-control rounded-3" name="tanggal_awal" value="<?= $tanggal_awal ?? '' ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold" style="color: #2C3E50;">
                            <i class="fas fa-calendar-check" style="color: #1ABC9C;"></i> Tanggal Akhir
                        </label>
                        <input type="date" class="form-control rounded-3" name="tanggal_akhir" value="<?= $tanggal_akhir ?? '' ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-filter flex-grow-1">
                                <i class="fas fa-search me-2"></i> Filter
                            </button>
                            <a href="<?= base_url('index.php/admin/laporan') ?>" class="btn btn-reset">
                                <i class="fas fa-undo-alt me-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Statistik -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body text-center p-4" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%); border-radius: 16px;">
                        <i class="fas fa-exchange-alt fa-2x mb-2 text-white"></i>
                        <h3 class="mb-0 text-white fw-bold"><?= $total_transaksi ?? 0 ?></h3>
                        <small class="text-white opacity-75">Total Transaksi Selesai</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body text-center p-4" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); border-radius: 16px;">
                        <i class="fas fa-money-bill fa-2x mb-2 text-white"></i>
                        <h3 class="mb-0 text-white fw-bold">Rp <?= number_format($total_denda ?? 0, 0, ',', '.') ?></h3>
                        <small class="text-white opacity-75">Total Denda</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel Laporan -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <h5 class="mb-0"><i class="fas fa-table me-2"></i> Data Transaksi (Terbaru ke Terlama)</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-modern mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Tgl Pinjam</th>
                                <th>Batas Kembali</th>
                                <th>Tgl Kembali</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Judul Buku</th>
                                <th>Denda</th>
                                <th>Status Denda</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($transaksi)): ?>
                                <?php $no=1; foreach($transaksi as $row): ?>
                                <tr class="fade-in">
                                    <td class="text-center fw-bold"><?= $no++ ?></td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill px-3 py-2" style="background: #ECF0F1; color: #2C3E50;">
                                            <i class="fas fa-calendar-alt me-1"></i> <?= date('d/m/Y', strtotime($row->tanggal_pinjam)) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill px-3 py-2" style="background: #ECF0F1; color: #2C3E50;">
                                            <i class="fas fa-clock me-1"></i> <?= date('d/m/Y', strtotime($row->batas_pengembalian)) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill px-3 py-2" style="background: #1ABC9C; color: white;">
                                            <i class="fas fa-check-circle me-1"></i> <?= date('d/m/Y', strtotime($row->tanggal_kembali)) ?>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="fw-bold" style="color: #1ABC9C;"><?= $row->nama_lengkap ?></span>
                                    </td>
                                    <td class="align-middle"><?= $row->kelas ?></td>
                                    <td class="align-middle">
                                        <span class="fw-bold" style="color: #1ABC9C;"><?= $row->judul ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill px-3 py-2" style="background: #f59e0b; color: white;">
                                            <i class="fas fa-money-bill me-1"></i> Rp <?= number_format($row->denda, 0, ',', '.') ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if($row->status_denda == 'lunas'): ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #1ABC9C; color: white;">
                                                <i class="fas fa-check-circle me-1"></i> Lunas
                                            </span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #e74c3c; color: white;">
                                                <i class="fas fa-exclamation-circle me-1"></i> Belum Lunas
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group-vertical w-100 gap-1" role="group">
                                            <a href="<?= base_url('index.php/admin/edit_transaksi_laporan/'.$row->id_transaksi) ?>" class="btn btn-edit-laporan btn-sm rounded-pill">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <a href="<?= base_url('index.php/admin/hapus_transaksi_laporan/'.$row->id_transaksi) ?>" class="btn btn-hapus-laporan btn-sm rounded-pill" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                                <i class="fas fa-trash-alt me-1"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                            <h5 class="text-muted">Tidak Ada Data Transaksi</h5>
                                            <p class="text-muted">Belum ada transaksi peminjaman buku yang dikembalikan</p>
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
/* Tombol Filter - Turquoise */
.btn-filter {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
    border-radius: 50px;
    padding: 8px 16px;
}
.btn-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(26, 188, 156, 0.35);
    color: white;
}

/* Tombol Reset - Outline */
.btn-reset {
    background: transparent;
    border: 2px solid #1ABC9C;
    color: #1ABC9C;
    transition: all 0.3s ease;
    border-radius: 50px;
    padding: 8px 16px;
}
.btn-reset:hover {
    transform: translateY(-2px);
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 8px 20px rgba(26, 188, 156, 0.3);
}

/* Tombol Export Excel */
.btn-excel {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
    border-radius: 50px;
    padding: 10px 24px;
}
.btn-excel:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
    color: white;
}

/* Tombol Edit Laporan */
.btn-edit-laporan {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
    border-radius: 50px;
    padding: 5px 12px;
    font-size: 13px;
}
.btn-edit-laporan:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
    color: white;
}

/* Tombol Hapus Laporan */
.btn-hapus-laporan {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
    border-radius: 50px;
    padding: 5px 12px;
    font-size: 13px;
}
.btn-hapus-laporan:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.35);
    color: white;
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

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

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
.rounded-pill {
    border-radius: 50px !important;
}

/* Form Control */
.form-control, .form-select {
    border-radius: 10px;
    border: 1px solid #d5dbdb;
    padding: 10px 15px;
}
.form-control:focus, .form-select:focus {
    border-color: #1ABC9C;
    box-shadow: 0 0 0 3px rgba(26, 188, 156, 0.1);
}

/* Select2 Custom */
.select2-container--bootstrap-5 .select2-selection {
    border-radius: 10px;
    border-color: #d5dbdb;
}
.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
}

.empty-state {
    padding: 40px 20px;
}

.fade-in {
    animation: fadeIn 0.5s ease;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>