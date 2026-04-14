<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Header dengan animasi -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-0 fw-bold" style="color: #2C3E50;">
                    <i class="fas fa-exchange-alt" style="color: #1ABC9C;"></i> Transaksi Peminjaman
                </h2>
                <p class="text-muted mt-1">Kelola peminjaman buku perpustakaan</p>
            </div>
            <div class="animated-icon">
                <i class="fas fa-book-reader fa-3x" style="color: #1ABC9C; opacity: 0.5;"></i>
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
        
        <!-- Form Peminjaman dengan Select2 -->
        <div class="card border-0 shadow-lg mb-4 rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex align-items-center py-2">
                    <i class="fas fa-hand-holding-heart fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-0 fw-bold">Form Peminjaman Buku</h5>
                        <small>Isi form berikut untuk meminjamkan buku kepada siswa</small>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('index.php/admin/pinjam_buku') ?>" method="post" class="row g-4" id="formPinjam">
                    <div class="col-md-5">
                        <label class="form-label fw-bold" style="color: #2C3E50;">
                            <i class="fas fa-user-graduate" style="color: #1ABC9C;"></i> Pilih Siswa <span class="text-danger">*</span>
                        </label>
                        <select name="id_siswa" id="pinjam_id_siswa" class="form-control" required style="width: 100%;">
                            <option value=""></option>
                            <?php foreach($siswa as $s): ?>
                                <option value="<?= $s->id ?>"><?= $s->nama_lengkap ?> - Kelas: <?= $s->kelas ?> (<?= $s->username ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text"><i class="fas fa-search" style="color: #1ABC9C;"></i> Ketik nama siswa untuk mencari</div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-bold" style="color: #2C3E50;">
                            <i class="fas fa-book" style="color: #1ABC9C;"></i> Pilih Buku <span class="text-danger">*</span>
                        </label>
                        <select name="id_buku" id="pinjam_id_buku" class="form-control" required style="width: 100%;">
                            <option value=""></option>
                            <?php foreach($buku as $b): ?>
                                <option value="<?= $b->id_buku ?>" data-stok="<?= $b->stok ?>" <?= $b->stok <= 0 ? 'disabled' : '' ?>>
                                    <?= $b->judul ?> - <?= $b->penulis ?> (Stok: <?= $b->stok ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text"><i class="fas fa-search" style="color: #1ABC9C;"></i> Ketik judul buku untuk mencari</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">&nbsp;</label>
                        <button type="submit" class="btn btn-pinjam w-100 py-2 fw-bold" id="btnPinjam">
                            <i class="fas fa-save me-2"></i> Pinjam
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Filter Pencarian -->
        <div class="card border-0 shadow-sm mb-4 rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex align-items-center py-2">
                    <i class="fas fa-filter fa-2x me-3"></i>
                    <div>
                        <h5 class="mb-0 fw-bold">Filter Pencarian</h5>
                        <small>Filter transaksi berdasarkan anggota, buku, dan/atau rentang tanggal</small>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <form method="get" action="<?= base_url('index.php/admin/transaksi') ?>" class="row g-3" id="formFilter">
                    <div class="col-md-3">
                        <label class="form-label fw-bold" style="color: #2C3E50;">
                            <i class="fas fa-user-graduate" style="color: #1ABC9C;"></i> Cari Anggota
                        </label>
                        <select name="id_siswa" id="filter_siswa" class="form-control select2-filter-siswa" style="width: 100%;">
                            <option value="">-- Semua Anggota --</option>
                            <?php foreach($siswa as $s): ?>
                                <option value="<?= $s->id ?>" <?= ($id_siswa == $s->id) ? 'selected' : '' ?>>
                                    <?= $s->nama_lengkap ?> - Kelas: <?= $s->kelas ?> (<?= $s->username ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text"><i class="fas fa-search"></i> Ketik nama siswa untuk mencari</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold" style="color: #2C3E50;">
                            <i class="fas fa-book" style="color: #1ABC9C;"></i> Cari Buku
                        </label>
                        <select name="id_buku" id="filter_buku" class="form-control select2-filter-buku" style="width: 100%;">
                            <option value="">-- Semua Buku --</option>
                            <?php foreach($buku as $b): ?>
                                <option value="<?= $b->id_buku ?>" <?= ($id_buku == $b->id_buku) ? 'selected' : '' ?>>
                                    <?= $b->judul ?> - <?= $b->penulis ?> (Stok: <?= $b->stok ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text"><i class="fas fa-search"></i> Ketik judul buku untuk mencari</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold" style="color: #2C3E50;">
                            <i class="fas fa-calendar-alt" style="color: #1ABC9C;"></i> Tanggal Awal
                        </label>
                        <input type="date" class="form-control rounded-3" name="tanggal_awal" value="<?= $tanggal_awal ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold" style="color: #2C3E50;">
                            <i class="fas fa-calendar-check" style="color: #1ABC9C;"></i> Tanggal Akhir
                        </label>
                        <input type="date" class="form-control rounded-3" name="tanggal_akhir" value="<?= $tanggal_akhir ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-filter flex-grow-1">
                                <i class="fas fa-search me-2"></i> Filter
                            </button>
                            <a href="<?= base_url('index.php/admin/transaksi') ?>" class="btn btn-reset">
                                <i class="fas fa-undo-alt me-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Data Transaksi -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <div>
                        <i class="fas fa-table me-2"></i>
                        <strong>Daftar Peminjaman Aktif</strong>
                    </div>
                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                        <i class="fas fa-chart-line me-1"></i> <?= count($transaksi) ?> Transaksi
                    </span>
                </div>
                <small class="opacity-75">Menampilkan transaksi dari yang terbaru ke terlama</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-modern mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th width="110" class="text-center">Tgl Pinjam</th>
                                <th width="110" class="text-center">Batas Kembali</th>
                                <th width="80" class="text-center">Status</th>
                                <th width="120" class="text-center">Status Denda</th>
                                <th width="180" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($transaksi)): ?>
                                <?php $no=1; foreach($transaksi as $row): ?>
                                <tr class="fade-in">
                                    <td class="text-center fw-bold"><?= $no++ ?></td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold mb-1" style="color: #1ABC9C;"><?= $row->nama_lengkap ?></span>
                                            <button type="button" class="btn btn-sm btn-outline-info rounded-pill px-2" onclick="showDetailAnggota(<?= $row->id_siswa ?>)" style="border-color: #1ABC9C; color: #1ABC9C;">
                                                <i class="fas fa-info-circle me-1"></i> Detail
                                            </button>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold mb-1" style="color: #1ABC9C;"><?= $row->judul ?></span>
                                            <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-2" onclick="showDetailBuku(<?= $row->id_buku ?>)" style="border-color: #1ABC9C; color: #1ABC9C;">
                                                <i class="fas fa-info-circle me-1"></i> Detail
                                            </button>
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
                                                <i class="fas fa-clock me-1"></i> <?= date('d/m/Y', strtotime($row->batas_pengembalian)) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill px-3 py-2" style="background: #f59e0b; color: white;">
                                            <i class="fas fa-hourglass-half me-1"></i> Dipinjam
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if(date('Y-m-d') > $row->batas_pengembalian): ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #e74c3c; color: white;">
                                                <i class="fas fa-exclamation-circle me-1"></i> Belum Lunas
                                            </span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill px-3 py-2" style="background: #bdc3c7; color: white;">
                                                <i class="fas fa-minus-circle me-1"></i> -
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group-vertical w-100 gap-1" role="group">
                                            <a href="<?= base_url('index.php/admin/kembalikan_buku/'.$row->id_transaksi) ?>" class="btn btn-kembalikan btn-sm rounded-pill" onclick="return confirm('Yakin buku sudah dikembalikan?')">
                                                <i class="fas fa-undo me-1"></i> Kembalikan
                                            </a>
                                            <a href="<?= base_url('index.php/admin/edit_transaksi/'.$row->id_transaksi) ?>" class="btn btn-edit-transaksi btn-sm rounded-pill">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <a href="<?= base_url('index.php/admin/hapus_transaksi/'.$row->id_transaksi) ?>" class="btn btn-hapus-transaksi btn-sm rounded-pill" onclick="return confirm('Yakin ingin menghapus transaksi ini? Stok buku akan dikembalikan otomatis.')">
                                                <i class="fas fa-trash-alt me-1"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-5">
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
    </div>
</div>

<!-- Modal Edit Transaksi -->
<div class="modal fade" id="modalEditTransaksi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i> Edit Transaksi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="formEditTransaksiModal">
                    <input type="hidden" name="id_transaksi" id="edit_id_transaksi">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Siswa</label>
                        <select name="id_siswa" id="edit_id_siswa" class="form-control" required>
                            <option value=""></option>
                            <?php foreach($siswa as $s): ?>
                                <option value="<?= $s->id ?>"><?= $s->nama_lengkap ?> - Kelas: <?= $s->kelasa ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Buku</label>
                        <select name="id_buku" id="edit_id_buku" class="form-control" required>
                            <option value=""></option>
                            <?php foreach($buku as $b): ?>
                                <option value="<?= $b->id_buku ?>"><?= $b->judul ?> - <?= $b->penulis ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" id="edit_tanggal_pinjam" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Batas Kembali</label>
                            <input type="date" name="batas_pengembalian" id="edit_batas_pengembalian" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-simpan flex-grow-1">
                            <i class="fas fa-save me-2"></i> Simpan
                        </button>
                        <button type="button" class="btn btn-kembali" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i> Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Anggota -->
<div class="modal fade" id="modalDetailAnggota" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <h5 class="modal-title">
                    <i class="fas fa-user-graduate me-2"></i> Biodata Anggota
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="modalAnggotaBody">
                <div class="text-center py-4">
                    <div class="spinner-border" style="color: #1ABC9C;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Buku -->
<div class="modal fade" id="modalDetailBuku" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header text-white rounded-top-4" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);">
                <h5 class="modal-title">
                    <i class="fas fa-book-open me-2"></i> Informasi Buku
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="modalBukuBody">
                <div class="text-center py-4">
                    <div class="spinner-border" style="color: #1ABC9C;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat data...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Tombol Pinjam - Turquoise */
.btn-pinjam {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    border: none;
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
}
.btn-pinjam:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(26, 188, 156, 0.35);
    background: linear-gradient(135deg, #16A085 0%, #1ABC9C 100%);
    color: white;
}

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

/* Tombol Kembalikan - Emerald */
.btn-kembalikan {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
    border-radius: 50px;
    padding: 5px 12px;
    font-size: 13px;
}
.btn-kembalikan:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
    color: white;
}

/* Tombol Edit Transaksi - Amber */
.btn-edit-transaksi {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
    border-radius: 50px;
    padding: 5px 12px;
    font-size: 13px;
}
.btn-edit-transaksi:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
    color: white;
}

/* Tombol Hapus Transaksi - Coral */
.btn-hapus-transaksi {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
    border-radius: 50px;
    padding: 5px 12px;
    font-size: 13px;
}
.btn-hapus-transaksi:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.35);
    color: white;
}

/* Select2 Custom */
.select2-container--bootstrap-5 .select2-selection {
    border-radius: 10px;
    border-color: #d5dbdb;
}
.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
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

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

.fade-in {
    animation: fadeIn 0.5s ease;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.empty-state {
    padding: 40px 20px;
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

/* Tombol Detail konsisten */
.btn-outline-info, .btn-outline-success {
    width: 85px;
    font-size: 12px;
    padding: 4px 8px;
}
#totalTransaksi {
    transition: all 0.3s ease;
}
</style>

<script>
$(document).ready(function() {
    // Inisialisasi Select2 untuk form pinjam siswa
    $('#pinjam_id_siswa').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Ketik nama siswa untuk mencari...',
        allowClear: true,
        minimumInputLength: 1,
        dropdownParent: $('#formPinjam'),
        language: {
            noResults: function() { return "Tidak ada siswa ditemukan"; },
            searching: function() { return "Mencari..."; },
            inputTooShort: function() { return "Ketik minimal 1 karakter untuk mencari"; }
        }
    });
    
    // Inisialisasi Select2 untuk form pinjam buku
    $('#pinjam_id_buku').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Ketik judul buku untuk mencari...',
        allowClear: true,
        minimumInputLength: 1,
        dropdownParent: $('#formPinjam'),
        language: {
            noResults: function() { return "Tidak ada buku ditemukan"; },
            searching: function() { return "Mencari..."; },
            inputTooShort: function() { return "Ketik minimal 1 karakter untuk mencari"; }
        }
    });
    
    // Inisialisasi Select2 untuk filter siswa
    $('#filter_siswa').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Ketik nama siswa untuk mencari...',
        allowClear: true,
        minimumInputLength: 1,
        language: {
            noResults: function() { return "Tidak ada siswa ditemukan"; },
            searching: function() { return "Mencari..."; },
            inputTooShort: function() { return "Ketik minimal 1 karakter untuk mencari"; }
        }
    });
    
    // Inisialisasi Select2 untuk filter buku
    $('#filter_buku').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Ketik judul buku untuk mencari...',
        allowClear: true,
        minimumInputLength: 1,
        language: {
            noResults: function() { return "Tidak ada buku ditemukan"; },
            searching: function() { return "Mencari..."; },
            inputTooShort: function() { return "Ketik minimal 1 karakter untuk mencari"; }
        }
    });
    
    // Validasi sebelum submit form pinjam
    $('#formPinjam').on('submit', function(e) {
        var siswa = $('#pinjam_id_siswa').val();
        var buku = $('#pinjam_id_buku').val();
        
        if(!siswa || siswa === '') {
            Swal.fire('Peringatan', 'Silakan pilih siswa terlebih dahulu!', 'warning');
            e.preventDefault();
            return false;
        }
        
        if(!buku || buku === '') {
            Swal.fire('Peringatan', 'Silakan pilih buku terlebih dahulu!', 'warning');
            e.preventDefault();
            return false;
        }
        
        var selectedOption = $('#pinjam_id_buku option:selected');
        var stok = selectedOption.data('stok');
        if(stok <= 0) {
            Swal.fire('Gagal', 'Stok buku habis, tidak bisa dipinjam!', 'error');
            e.preventDefault();
            return false;
        }
        
        return true;
    });
    
    // Filter form submit - refresh tabel via AJAX
    $('#formFilter').on('submit', function(e) {
        e.preventDefault();
        refreshTransaksiTable();
    });
    
    // Reset filter
    $('.btn-reset').on('click', function(e) {
        e.preventDefault();
        $('#filter_siswa').val(null).trigger('change');
        $('#filter_buku').val(null).trigger('change');
        $('input[name="tanggal_awal"]').val('');
        $('input[name="tanggal_akhir"]').val('');
        refreshTransaksiTable();
    });
});

// Fungsi refresh tabel via AJAX
function refreshTransaksiTable() {
    var formData = $('#formFilter').serialize();
    
    $.ajax({
        url: '<?= base_url("index.php/admin/refresh_transaksi_table") ?>',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if(response.html) {
                $('.table-modern tbody').html(response.html);
                $('.badge.bg-light.text-dark').html('<i class="fas fa-chart-line me-1"></i> ' + response.total + ' Transaksi');
                // Re-inisialisasi animasi fade-in
                $('.fade-in').each(function(index) {
                    $(this).css('animation', 'none');
                    setTimeout(() => {
                        $(this).css('animation', 'fadeIn 0.5s ease');
                    }, 10);
                });
            }
        },
        error: function() {
            location.reload();
        }
    });
}

// Fungsi showDetailAnggota - Memanggil controller admin/get_detail_anggota
function showDetailAnggota(id_siswa) {
    var myModal = new bootstrap.Modal(document.getElementById('modalDetailAnggota'));
    myModal.show();
    
    document.getElementById('modalAnggotaBody').innerHTML = '<div class="text-center py-4"><div class="spinner-border" style="color: #1ABC9C;"></div><p class="mt-2">Memuat data...</p></div>';
    
    $.ajax({
        url: '<?= base_url("index.php/admin/get_detail_anggota") ?>',
        type: 'POST',
        data: {id_siswa: id_siswa},
        dataType: 'json',
        success: function(data) {
            if(data.success) {
                var html = `
                    <div class="text-center mb-4">
                        <div class="rounded-circle d-inline-flex p-4" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);">
                            <i class="fas fa-user-circle fa-4x text-white"></i>
                        </div>
                        <h4 class="mt-3 mb-0" style="color: #2C3E50;">${escapeHtml(data.nama_lengkap)}</h4>
                        <p class="text-muted">@${escapeHtml(data.username)}</p>
                        <span class="badge rounded-pill px-3 py-2 mt-2" style="background: #1ABC9C; color: white;">
                            <i class="fas fa-graduation-cap me-1"></i> Kelas: ${escapeHtml(data.kelas)}
                        </span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded-3" style="background: #ECF0F1;">
                                <label class="text-muted small mb-1"><i class="fas fa-phone me-1" style="color: #1ABC9C;"></i> No. Telepon</label>
                                <p class="mb-0 fw-bold" style="color: #2C3E50;">${escapeHtml(data.no_hp) || '-'}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded-3" style="background: #ECF0F1;">
                                <label class="text-muted small mb-1"><i class="fas fa-calendar-alt me-1" style="color: #1ABC9C;"></i> Status</label>
                                <p class="mb-0 fw-bold" style="color: #2C3E50;">Aktif</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-card p-3 rounded-3" style="background: #ECF0F1;">
                                <label class="text-muted small mb-1"><i class="fas fa-map-marker-alt me-1" style="color: #1ABC9C;"></i> Alamat</label>
                                <p class="mb-0" style="color: #2C3E50;">${escapeHtml(data.alamat) || '-'}</p>
                            </div>
                        </div>
                    </div>
                `;
                document.getElementById('modalAnggotaBody').innerHTML = html;
            } else {
                document.getElementById('modalAnggotaBody').innerHTML = '<div class="alert alert-danger text-center">Gagal memuat data anggota!</div>';
            }
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
            document.getElementById('modalAnggotaBody').innerHTML = '<div class="alert alert-danger text-center">Terjadi kesalahan saat memuat data!<br>Cek koneksi internet Anda.</div>';
        }
    });
}

// Fungsi showDetailBuku - Memanggil controller admin/get_detail_buku
function showDetailBuku(id_buku) {
    var myModal = new bootstrap.Modal(document.getElementById('modalDetailBuku'));
    myModal.show();
    
    document.getElementById('modalBukuBody').innerHTML = '<div class="text-center py-4"><div class="spinner-border" style="color: #1ABC9C;"></div><p class="mt-2">Memuat data...</p></div>';
    
    $.ajax({
        url: '<?= base_url("index.php/admin/get_detail_buku") ?>',
        type: 'POST',
        data: {id_buku: id_buku},
        dataType: 'json',
        success: function(data) {
            if(data.success) {
                var coverHtml = (data.cover && data.cover !== '') 
                    ? `<img src="<?= base_url('uploads/') ?>${data.cover}" class="img-fluid rounded-3" style="max-height: 150px;">`
                    : `<div class="rounded-circle d-inline-flex p-4" style="background: rgba(44, 62, 80, 0.1);"><i class="fas fa-book fa-4x" style="color: #2C3E50;"></i></div>`;
                
                var html = `
                    <div class="text-center mb-4">
                        ${coverHtml}
                        <h4 class="mt-3 mb-0" style="color: #1ABC9C;">${escapeHtml(data.judul)}</h4>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded-3" style="background: #ECF0F1;">
                                <label class="text-muted small mb-1"><i class="fas fa-user-edit me-1" style="color: #1ABC9C;"></i> Penulis</label>
                                <p class="mb-0 fw-bold" style="color: #2C3E50;">${escapeHtml(data.penulis)}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card p-3 rounded-3" style="background: #ECF0F1;">
                                <label class="text-muted small mb-1"><i class="fas fa-building me-1" style="color: #1ABC9C;"></i> Penerbit</label>
                                <p class="mb-0 fw-bold" style="color: #2C3E50;">${escapeHtml(data.penerbit)}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-card p-3 rounded-3" style="background: #ECF0F1; text-align: center;">
                                <label class="text-muted small mb-1"><i class="fas fa-boxes me-1" style="color: #1ABC9C;"></i> Stok Tersedia</label>
                                <p class="mb-0"><span class="badge fs-6 px-3 py-2 rounded-pill" style="background: ${data.stok > 0 ? '#1ABC9C' : '#e74c3c'}; color: white;">${data.stok} Buku</span></p>
                            </div>
                        </div>
                    </div>
                `;
                document.getElementById('modalBukuBody').innerHTML = html;
            } else {
                document.getElementById('modalBukuBody').innerHTML = '<div class="alert alert-danger text-center">Gagal memuat data buku!</div>';
            }
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
            document.getElementById('modalBukuBody').innerHTML = '<div class="alert alert-danger text-center">Terjadi kesalahan saat memuat data!<br>Cek koneksi internet Anda.</div>';
        }
    });
}

// Fungsi escape HTML untuk keamanan (mencegah XSS)
function escapeHtml(str) {
    if (!str) return '';
    return str
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}
</script>