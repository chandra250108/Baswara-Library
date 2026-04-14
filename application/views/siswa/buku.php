<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h2 class="mb-0 fw-bold">
                    <i class="fas fa-book-open" style="color: #1ABC9C;"></i> Koleksi Buku Perpustakaan
                </h2>
                <p class="text-muted mt-1">Jelajahi koleksi buku dan pinjam yang Anda minati</p>
            </div>
            <div class="rounded-3 px-4 py-2 shadow-sm" style="background: #ECF0F1;">
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <i class="fas fa-database" style="color: #1ABC9C;"></i>
                        <span class="text-muted">Total: <?= count($buku) ?> Buku</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Info Peminjaman (DIPINDAHKAN KE ATAS) -->
        <div class="alert border-0 shadow-sm rounded-3 mb-4" style="background: #ECF0F1; color: #2C3E50;">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle fa-2x me-3" style="color: #1ABC9C;"></i>
                        <strong style="color: #2C3E50;">Info Peminjaman:</strong>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="d-flex flex-wrap gap-3">
                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(26, 188, 156, 0.15); color: #1ABC9C;">
                            <i class="fas fa-user-graduate me-1"></i> Maksimal 3 buku per siswa
                        </span>
                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(26, 188, 156, 0.15); color: #1ABC9C;">
                            <i class="fas fa-calendar-alt me-1"></i> Lama pinjam 7 hari
                        </span>
                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(26, 188, 156, 0.15); color: #1ABC9C;">
                            <i class="fas fa-money-bill me-1"></i> Denda Rp 1.000/hari
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Pencarian -->
        <div class="card border-0 shadow-lg rounded-4 mb-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-search me-2"></i>
                    <strong>Cari Buku</strong>
                </div>
                <small class="opacity-75">Cari berdasarkan judul, penulis, atau penerbit</small>
            </div>
            <div class="card-body" style="background: #ECF0F1;">
                <form action="<?= base_url('index.php/siswa/daftar_buku') ?>" method="get" class="row g-3">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-search" style="color: #1ABC9C;"></i>
                            </span>
                            <input type="text" name="keyword" class="form-control form-control-lg border-0 shadow-none" 
                                   placeholder="Ketik judul buku, penulis, atau penerbit..." 
                                   value="<?= htmlspecialchars($this->input->get('keyword')) ?>">
                            <?php if($this->input->get('keyword')): ?>
                                <a href="<?= base_url('index.php/siswa/daftar_buku') ?>" class="btn btn-outline-secondary" title="Reset pencarian">
                                    <i class="fas fa-times"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn w-100 py-2 rounded-pill" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%); border: none; color: white;">
                                <i class="fas fa-search me-2"></i> Cari
                            </button>
                            <?php if($this->input->get('keyword')): ?>
                                <a href="<?= base_url('index.php/siswa/daftar_buku') ?>" class="btn btn-outline-secondary">
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
        
        <!-- Display Buku dengan Grid System -->
        <div class="row">
            <?php if(!empty($buku)): ?>
                <?php foreach($buku as $row): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4 buku-card fade-in" style="background: #ECF0F1;">
                            <div class="card-img-top text-center p-3" style="height: 250px; display: flex; align-items: center; justify-content: center; background: #ECF0F1;">
                                <?php 
                                $cover_path = 'uploads/' . $row->cover;
                                if(!empty($row->cover) && file_exists($cover_path)): 
                                ?>
                                    <img src="<?= base_url($cover_path) ?>" 
                                         class="img-fluid cover-img" 
                                         style="height: 200px; object-fit: contain;"
                                         alt="<?= $row->judul ?>">
                                <?php else: ?>
                                    <div class="text-center">
                                        <div class="rounded-circle p-4" style="background: rgba(44, 62, 80, 0.1);">
                                            <i class="fas fa-book fa-4x" style="color: #2C3E50;"></i>
                                        </div>
                                        <p class="text-muted mt-2 small">Tidak ada cover</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold" style="color: #2C3E50;"><?= $row->judul ?></h5>
                                <p class="card-text mb-1">
                                    <i class="fas fa-user-edit text-muted me-1"></i> 
                                    <small class="text-muted"><?= $row->penulis ?></small>
                                </p>
                                <p class="card-text mb-2">
                                    <i class="fas fa-building text-muted me-1"></i> 
                                    <small class="text-muted"><?= $row->penerbit ?></small>
                                </p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted small">
                                        <i class="fas fa-boxes me-1"></i> Stok
                                    </span>
                                    <span class="badge rounded-pill px-3 py-2" style="background: <?= $row->stok > 0 ? '#1ABC9C' : '#e74c3c' ?>; color: white;">
                                        <?= $row->stok ?>
                                    </span>
                                </div>
                                
                                <?php if($row->stok > 0): ?>
                                    <button type="button" class="btn w-100 rounded-pill" 
                                            style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%); border: none; color: white;"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#pinjamModal<?= $row->id_buku ?>">
                                        <i class="fas fa-hand-holding-heart me-2"></i> Pinjam Buku
                                    </button>
                                <?php else: ?>
                                    <button class="btn w-100 rounded-pill" style="background: #bdc3c7; border: none; color: white;" disabled>
                                        <i class="fas fa-times-circle me-2"></i> Stok Habis
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal Konfirmasi Peminjaman -->
                    <div class="modal fade" id="pinjamModal<?= $row->id_buku ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4">
                                <div class="modal-header text-white rounded-top-4" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);">
                                    <h5 class="modal-title">
                                        <i class="fas fa-hand-holding-heart me-2"></i> Konfirmasi Peminjaman
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-4" style="background: #ECF0F1;">
                                    <div class="text-center mb-3">
                                        <?php if(!empty($row->cover) && file_exists('uploads/'.$row->cover)): ?>
                                            <img src="<?= base_url('uploads/'.$row->cover) ?>" 
                                                 style="height: 150px; object-fit: contain;" 
                                                 class="img-thumbnail rounded-3">
                                        <?php else: ?>
                                            <div class="rounded-circle d-inline-flex p-4" style="background: rgba(44, 62, 80, 0.1);">
                                                <i class="fas fa-book fa-4x" style="color: #2C3E50;"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <h5 class="text-center fw-bold" style="color: #2C3E50;"><?= $row->judul ?></h5>
                                    <p class="text-center text-muted"><?= $row->penulis ?></p>
                                    <hr style="border-color: #d5dbdb;">
                                    <p class="mb-2">Apakah Anda yakin ingin meminjam buku ini?</p>
                                    <div class="rounded-3 p-3 mt-3" style="background: #ECF0F1;">
                                        <div class="row">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Masa pinjam</small>
                                                <strong style="color: #1ABC9C;">7 hari</strong>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block">Denda keterlambatan</small>
                                                <strong style="color: #e74c3c;">Rp 1.000/hari</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="background: #ECF0F1;">
                                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-2"></i> Batal
                                    </button>
                                    <a href="<?= base_url('index.php/siswa/proses_pinjam/'.$row->id_buku) ?>" 
                                       class="btn rounded-pill px-4" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%); border: none; color: white;">
                                        <i class="fas fa-check me-2"></i> Ya, Pinjam
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state text-center py-5">
                        <div class="rounded-circle d-inline-flex p-5 mb-4" style="background: #ECF0F1;">
                            <i class="fas fa-book-open fa-5x text-muted"></i>
                        </div>
                        <h4 class="text-muted">Tidak ada buku ditemukan</h4>
                        <p class="text-muted">Coba dengan kata kunci pencarian yang berbeda</p>
                        <a href="<?= base_url('index.php/siswa/daftar_buku') ?>" class="btn rounded-pill px-4" style="background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%); border: none; color: white;">
                            <i class="fas fa-undo-alt me-2"></i> Reset Pencarian
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
/* Card Hover */
.buku-card {
    transition: all 0.3s ease;
    overflow: hidden;
}
.buku-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

/* Cover Image Hover */
.cover-img {
    transition: transform 0.3s ease;
}
.buku-card:hover .cover-img {
    transform: scale(1.05);
}

/* Animasi Fade In */
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

/* Stagger Animation */
.buku-card:nth-child(1) { animation-delay: 0.05s; }
.buku-card:nth-child(2) { animation-delay: 0.1s; }
.buku-card:nth-child(3) { animation-delay: 0.15s; }
.buku-card:nth-child(4) { animation-delay: 0.2s; }
.buku-card:nth-child(5) { animation-delay: 0.25s; }
.buku-card:nth-child(6) { animation-delay: 0.3s; }
.buku-card:nth-child(7) { animation-delay: 0.35s; }
.buku-card:nth-child(8) { animation-delay: 0.4s; }

/* Card Title */
.card-title {
    font-size: 1rem;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    min-height: 48px;
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

/* Empty State */
.empty-state {
    animation: fadeInUp 0.5s ease;
}
</style>