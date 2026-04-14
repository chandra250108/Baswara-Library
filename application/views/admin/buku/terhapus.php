<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h2 class="mb-0 fw-bold" style="color: #2C3E50;">
                    <i class="fas fa-trash-alt" style="color: #1ABC9C;"></i> Arsip Buku
                </h2>
                <p class="text-muted mt-1">Daftar buku yang telah diarsipkan/dihapus</p>
            </div>
            <a href="<?= base_url('index.php/admin/buku') ?>" class="btn btn-kembali rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Data Buku
            </a>
        </div>
        
        <!-- Form Pencarian -->
        <div class="card border-0 shadow-lg rounded-4 mb-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-search me-2"></i>
                    <strong>Cari Arsip Buku</strong>
                </div>
                <small class="opacity-75">Cari berdasarkan judul, penulis, atau penerbit</small>
            </div>
            <div class="card-body">
                <form action="<?= base_url('index.php/admin/cari_buku_terhapus') ?>" method="get" class="row g-3">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-search" style="color: #1ABC9C;"></i>
                            </span>
                            <input type="text" name="keyword" class="form-control form-control-lg border-0 shadow-none" 
                                   placeholder="Ketik judul buku, penulis, atau penerbit..." 
                                   value="<?= htmlspecialchars($this->input->get('keyword')) ?>">
                            <?php if($this->input->get('keyword')): ?>
                                <a href="<?= base_url('index.php/admin/buku_terhapus') ?>" class="btn btn-outline-secondary" title="Reset pencarian">
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
                                <a href="<?= base_url('index.php/admin/buku_terhapus') ?>" class="btn btn-outline-secondary">
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
        
        <!-- Tabel Arsip Buku -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-archive me-2"></i>
                        <strong>Buku Terhapus</strong>
                    </div>
                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                        <i class="fas fa-trash me-1"></i> <?= count($buku) ?> Buku
                    </span>
                </div>
                <small class="opacity-75">Buku yang diarsipkan dapat dipulihkan kembali</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-modern mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th width="80" class="text-center">Cover</th>
                                <th><i class="fas fa-book me-1"></i> Judul Buku</th>
                                <th><i class="fas fa-user-edit me-1"></i> Penulis</th>
                                <th><i class="fas fa-building me-1"></i> Penerbit</th>
                                <th width="150" class="text-center"><i class="fas fa-calendar-times me-1"></i> Tanggal Dihapus</th>
                                <th width="120" class="text-center"><i class="fas fa-cog me-1"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($buku)): ?>
                                <?php $no=1; foreach($buku as $row): ?>
                                <tr class="fade-in">
                                    <td class="text-center fw-bold"><?= $no++ ?></td>
                                    <td class="text-center">
                                        <?php if(!empty($row->cover) && file_exists('uploads/'.$row->cover)): ?>
                                            <img src="<?= base_url('uploads/'.$row->cover) ?>" 
                                                 width="45" height="60" 
                                                 style="object-fit: cover; border-radius: 8px;" 
                                                 class="shadow-sm cover-img"
                                                 alt="<?= $row->judul ?>">
                                        <?php else: ?>
                                            <div class="rounded d-inline-flex p-2" style="background: rgba(44, 62, 80, 0.1);">
                                                <i class="fas fa-book fa-2x" style="color: #2C3E50;"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle p-2 me-2" style="background: rgba(26, 188, 156, 0.15);">
                                                <i class="fas fa-book" style="color: #1ABC9C;"></i>
                                            </div>
                                            <span class="fw-bold" style="color: #1ABC9C;"><?= $row->judul ?></span>
                                        </div>
                                    </td>
                                    <td class="align-middle" style="color: #2C3E50;"><?= $row->penulis ?> </td>
                                    <td class="align-middle" style="color: #2C3E50;"><?= $row->penerbit ?> </td>
                                    <td class="text-center align-middle">
                                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b;">
                                            <i class="fas fa-calendar-times me-1"></i> <?= date('d/m/Y H:i', strtotime($row->deleted_at)) ?>
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a href="<?= base_url('index.php/admin/restore_buku/'.$row->id_buku) ?>" class="btn btn-restore btn-sm rounded-pill px-3" onclick="return confirm('Pulihkan buku ini?')" title="Pulihkan Buku">
                                            <i class="fas fa-trash-restore me-1"></i> Pulihkan
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-archive fa-4x text-muted mb-3"></i>
                                            <h5 class="text-muted">Tidak Ada Buku Terhapus</h5>
                                            <p class="text-muted">Semua buku masih aktif di perpustakaan</p>
                                            <a href="<?= base_url('index.php/admin/buku') ?>" class="btn btn-kembali rounded-pill px-4">
                                                <i class="fas fa-arrow-left me-2"></i> Kembali ke Data Buku
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

/* Tombol Restore/Pulihkan - Emerald Green */
.btn-restore {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
    padding: 5px 16px;
    font-size: 13px;
}
.btn-restore:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: white;
}
.btn-restore:active {
    transform: translateY(0);
}

/* Tombol Kembali - Outline */
.btn-kembali {
    background: transparent;
    border: 2px solid #1ABC9C;
    color: #1ABC9C;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
    padding: 8px 20px;
    font-weight: 500;
}
.btn-kembali:hover {
    transform: translateY(-2px);
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 8px 20px rgba(26, 188, 156, 0.3);
}
.btn-kembali:active {
    transform: translateY(0);
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
</style>