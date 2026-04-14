<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h2 class="mb-0 fw-bold" style="color: #2C3E50;">
                    <i class="fas fa-trash-alt" style="color: #1ABC9C;"></i> Arsip Anggota
                </h2>
                <p class="text-muted mt-1">Daftar anggota yang telah diarsipkan/dihapus</p>
            </div>
            <a href="<?= base_url('index.php/admin/anggota') ?>" class="btn btn-kembali rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Data Anggota
            </a>
        </div>
        
        <!-- Form Pencarian -->
        <div class="card border-0 shadow-lg rounded-4 mb-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-search me-2"></i>
                    <strong>Cari Arsip Anggota</strong>
                </div>
                <small class="opacity-75">Cari berdasarkan nama, username, atau kelas</small>
            </div>
            <div class="card-body">
                <form action="<?= base_url('index.php/admin/cari_anggota_terhapus') ?>" method="get" class="row g-3">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-search" style="color: #1ABC9C;"></i>
                            </span>
                            <input type="text" name="keyword" class="form-control form-control-lg border-0 shadow-none" 
                                   placeholder="Ketik nama, username, atau kelas..." 
                                   value="<?= htmlspecialchars($this->input->get('keyword')) ?>">
                            <?php if($this->input->get('keyword')): ?>
                                <a href="<?= base_url('index.php/admin/anggota_terhapus') ?>" class="btn btn-outline-secondary" title="Reset pencarian">
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
                                <a href="<?= base_url('index.php/admin/anggota_terhapus') ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-undo-alt"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Tabel Arsip Anggota -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-archive me-2"></i>
                        <strong>Anggota Terhapus</strong>
                    </div>
                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                        <i class="fas fa-users me-1"></i> <?= count($anggota) ?> Anggota
                    </span>
                </div>
                <small class="opacity-75">Anggota yang diarsipkan dapat dipulihkan kembali</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-modern mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas</th>
                                <th>Alamat</th>
                                <th>No. HP</th>
                                <th>Tanggal Dihapus</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($anggota)): ?>
                                <?php $no=1; foreach($anggota as $row): ?>
                                <tr class="fade-in">
                                    <td class="text-center fw-bold"><?= $no++ ?></td>
                                    <td><?= $row->username ?> </td>
                                    <td><?= $row->nama_lengkap ?> </td>
                                    <td><?= $row->kelas ?> </td>
                                    <td><?= $row->alamat ?> </td>
                                    <td><?= $row->no_hp ?> </td>
                                    <td><?= date('d/m/Y H:i', strtotime($row->deleted_at)) ?> </td>
                                    <td>
                                        <a href="<?= base_url('index.php/admin/restore_anggota/'.$row->id) ?>" class="btn btn-restore btn-sm rounded-pill" onclick="return confirm('Pulihkan anggota ini?')">
                                            <i class="fas fa-trash-restore me-1"></i> Pulihkan
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="fas fa-archive fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">Tidak Ada Anggota Terhapus</h5>
                                        <p class="text-muted">Semua anggota masih aktif</p>
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
/* Tombol */
.btn-cari {
    background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
    border-radius: 50px;
}
.btn-cari:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(20, 184, 166, 0.35);
    color: white;
}

.btn-restore {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
    border-radius: 50px;
    padding: 5px 12px;
}
.btn-restore:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
    color: white;
}

.btn-kembali {
    background: transparent;
    border: 2px solid #1ABC9C;
    color: #1ABC9C;
    transition: all 0.3s ease;
    border-radius: 50px;
    padding: 8px 20px;
}
.btn-kembali:hover {
    transform: translateY(-2px);
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 8px 20px rgba(26, 188, 156, 0.3);
}

.table-modern tbody tr:hover {
    background: linear-gradient(90deg, #e8f8f5 0%, #ffffff 100%);
    transform: scale(1.01);
}

.fade-in {
    animation: fadeInUp 0.5s ease;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.rounded-4 {
    border-radius: 16px !important;
}
.rounded-top-4 {
    border-top-left-radius: 16px !important;
    border-top-right-radius: 16px !important;
}
</style>