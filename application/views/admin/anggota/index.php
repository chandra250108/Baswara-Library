<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h2 class="mb-0 fw-bold" style="color: #2C3E50;">
                    <i class="fas fa-users" style="color: #1ABC9C;"></i> Data Anggota (Siswa)
                </h2>
                <p class="text-muted mt-1">Kelola data anggota perpustakaan</p>
            </div>
            <a href="<?= base_url('index.php/admin/tambah_anggota') ?>" class="btn btn-tambah rounded-pill px-4">
                <i class="fas fa-plus me-2"></i> Tambah Anggota
            </a>
        </div>
        
        <!-- Form Pencarian -->
        <div class="card border-0 shadow-lg rounded-4 mb-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-search me-2"></i>
                    <strong>Cari Anggota</strong>
                </div>
                <small class="opacity-75">Cari berdasarkan nama, username, atau kelas</small>
            </div>
            <div class="card-body">
                <form action="<?= base_url('index.php/admin/cari_anggota') ?>" method="get" class="row g-3">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-search" style="color: #1ABC9C;"></i>
                            </span>
                            <input type="text" name="keyword" class="form-control form-control-lg border-0 shadow-none" 
                                   placeholder="Ketik nama, username, atau kelas..." 
                                   value="<?= htmlspecialchars($this->input->get('keyword')) ?>">
                            <?php if($this->input->get('keyword')): ?>
                                <a href="<?= base_url('index.php/admin/anggota') ?>" class="btn btn-outline-secondary" title="Reset pencarian">
                                    <i class="fas fa-times"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-cari w-100 py-2 rounded-pill">
                                <i class="fas fa-search me-2"></i> Cari
                            </button>
                            <?php if($this->input->get('keyword')): ?>
                                <a href="<?= base_url('index.php/admin/anggota') ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-undo-alt"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Notifikasi -->
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 mb-4" role="alert" style="background: #e8f8f5; color: #1ABC9C; border-left: 4px solid #1ABC9C;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-2 me-3" style="background: rgba(26, 188, 156, 0.15);">
                        <i class="fas fa-check-circle fa-2x" style="color: #1ABC9C;"></i>
                    </div>
                    <div>
                        <strong>Berhasil!</strong> <?= $this->session->flashdata('success') ?>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3 mb-4" role="alert" style="background: #fdeded; color: #e74c3c; border-left: 4px solid #e74c3c;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-2 me-3" style="background: rgba(231, 76, 60, 0.15);">
                        <i class="fas fa-exclamation-circle fa-2x" style="color: #e74c3c;"></i>
                    </div>
                    <div>
                        <strong>Gagal!</strong> <?= $this->session->flashdata('error') ?>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <!-- Tabel Data Anggota -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-2"></i>
                        <strong>Daftar Anggota</strong>
                    </div>
                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                        <i class="fas fa-users me-1"></i> <?= count($anggota) ?> Anggota
                    </span>
                </div>
                <small class="opacity-75">Data seluruh siswa yang terdaftar sebagai anggota perpustakaan</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-modern mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th><i class="fas fa-user me-1"></i> Username</th>
                                <th><i class="fas fa-id-card me-1"></i> Nama Lengkap</th>
                                <th class="text-center"><i class="fas fa-graduation-cap me-1"></i> Kelas</th>
                                <th><i class="fas fa-map-marker-alt me-1"></i> Alamat</th>
                                <th class="text-center"><i class="fas fa-phone me-1"></i> No. HP</th>
                                <th class="text-center"><i class="fas fa-cog me-1"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($anggota)): ?>
                                <?php $no=1; foreach($anggota as $row): ?>
                                <tr class="fade-in">
                                    <td class="text-center fw-bold"><?= $no++ ?></td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle p-2 me-2" style="background: rgba(26, 188, 156, 0.15);">
                                                <i class="fas fa-user" style="color: #1ABC9C;"></i>
                                            </div>
                                            <span class="fw-bold" style="color: #2C3E50;"><?= $row->username ?></span>
                                        </div>
                                    </td>
                                    <td class="align-middle" style="color: #2C3E50;"><?= $row->nama_lengkap ?> </td>
                                    <td class="text-center align-middle">
                                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(26, 188, 156, 0.15); color: #1ABC9C;">
                                            <i class="fas fa-graduation-cap me-1"></i> <?= $row->kelas ?>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt" style="color: #1ABC9C;"></i>
                                            <span class="text-muted ms-2"><?= $row->alamat ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fas fa-phone" style="color: #1ABC9C;"></i>
                                            <span class="ms-2"><?= $row->no_hp ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group" role="group">
                                             <a href="<?= base_url('index.php/admin/detail_anggota/'.$row->id) ?>" class="btn btn-info btn-sm rounded-pill me-2" title="Detail Kartu">
                                                <i class="fas fa-id-card me-1"></i> Kartu
                                            </a>
                                            <a href="<?= base_url('index.php/admin/edit_anggota/'.$row->id) ?>" class="btn btn-edit btn-sm rounded-pill me-2" title="Edit Anggota">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <a href="<?= base_url('index.php/admin/hapus_anggota/'.$row->id) ?>" class="btn btn-hapus btn-sm rounded-pill" onclick="return confirm('Yakin ingin menghapus anggota ini?')" title="Hapus Anggota">
                                                <i class="fas fa-trash-alt me-1"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-users fa-4x text-muted mb-3"></i>
                                            <h5 class="text-muted">Tidak Ada Data Anggota</h5>
                                            <p class="text-muted">Belum ada siswa yang terdaftar sebagai anggota</p>
                                            <a href="<?= base_url('index.php/admin/tambah_anggota') ?>" class="btn btn-tambah rounded-pill px-4">
                                                <i class="fas fa-plus me-2"></i> Tambah Anggota
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
/* ========== BUTTON FANCY STYLES ========== */

/* Tombol Tambah - Emerald Green */
.btn-tambah {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
    padding: 8px 20px;
}
.btn-tambah:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: white;
}
.btn-tambah:active {
    transform: translateY(0);
}

/* Tombol Cari - Turquoise Blue */
.btn-cari {
    background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
    border: none;
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
    padding: 8px 20px;
}
.btn-cari:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(20, 184, 166, 0.35);
    background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
    color: white;
}
.btn-cari:active {
    transform: translateY(0);
}

/* Tombol Detail - Info Blue */
.btn-info {
    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
    border: none;
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
    padding: 5px 16px;
    font-size: 13px;
}
.btn-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(14, 165, 233, 0.35);
    background: linear-gradient(135deg, #0284c7 0%, #0ea5e9 100%);
    color: white;
}

/* Tombol Edit - Amber Gold */
.btn-edit {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border: none;
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
    padding: 5px 16px;
    font-size: 13px;
}
.btn-edit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
    background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
    color: white;
}
.btn-edit:active {
    transform: translateY(0);
}

/* Tombol Hapus - Coral Red */
.btn-hapus {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    border: none;
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
    padding: 5px 16px;
    font-size: 13px;
}
.btn-hapus:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(239, 68, 68, 0.35);
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: white;
}
.btn-hapus:active {
    transform: translateY(0);
}

/* ========== END BUTTON FANCY STYLES ========== */

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
.rounded-pill {
    border-radius: 50px !important;
}

/* Empty State */
.empty-state {
    padding: 40px 20px;
}

/* Input Group */
.input-group-text {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
}
.form-control {
    border-radius: 0;
}
.form-control:focus {
    box-shadow: none;
}
.btn-outline-secondary {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;
}

/* Button Group */
.btn-group .btn {
    margin: 0 2px;
}
</style>