<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('index.php/admin/dashboard') ?>" class="text-decoration-none"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('index.php/admin/laporan') ?>" class="text-decoration-none"><i class="fas fa-chart-line"></i> Laporan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Transaksi</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                        <div class="d-flex align-items-center py-2">
                            <div class="rounded-circle bg-white bg-opacity-25 p-2 me-3">
                                <i class="fas fa-edit fa-2x text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">Edit Transaksi Laporan</h5>
                                <small class="opacity-75">Perbaharui data transaksi yang telah dikembalikan</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?= base_url('index.php/admin/update_transaksi_laporan') ?>" method="post" id="formEditLaporan">
                            <input type="hidden" name="id_transaksi" value="<?= $transaksi->id_transaksi ?>">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #2C3E50;">
                                        <i class="fas fa-user-graduate" style="color: #1ABC9C;"></i> Nama Siswa
                                    </label>
                                    <select name="id_siswa" id="edit_laporan_siswa" class="form-control" required style="width: 100%;">
                                        <option value="">-- Pilih Siswa --</option>
                                        <?php foreach($siswa as $s): ?>
                                            <option value="<?= $s->id ?>" <?= ($s->id == $transaksi->id_siswa) ? 'selected' : '' ?>>
                                                <?= $s->nama_lengkap ?> - <?= $s->kelas ?> (<?= $s->username ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="form-text"><i class="fas fa-search" style="color: #1ABC9C;"></i> Ketik nama siswa untuk mencari</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold" style="color: #2C3E50;">
                                        <i class="fas fa-book" style="color: #1ABC9C;"></i> Judul Buku
                                    </label>
                                    <select name="id_buku" id="edit_laporan_buku" class="form-control" required style="width: 100%;">
                                        <option value="">-- Pilih Buku --</option>
                                        <?php foreach($buku as $b): ?>
                                            <option value="<?= $b->id_buku ?>" <?= ($b->id_buku == $transaksi->id_buku) ? 'selected' : '' ?>>
                                                <?= $b->judul ?> - <?= $b->penulis ?> (Stok: <?= $b->stok ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="form-text"><i class="fas fa-search" style="color: #1ABC9C;"></i> Ketik judul buku untuk mencari</div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold" style="color: #2C3E50;">
                                        <i class="fas fa-calendar-plus" style="color: #1ABC9C;"></i> Tanggal Pinjam
                                    </label>
                                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control rounded-3" value="<?= $transaksi->tanggal_pinjam ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold" style="color: #2C3E50;">
                                        <i class="fas fa-calendar-times" style="color: #1ABC9C;"></i> Batas Kembali
                                    </label>
                                    <input type="date" name="batas_pengembalian" id="batas_pengembalian" class="form-control rounded-3" value="<?= $transaksi->batas_pengembalian ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold" style="color: #2C3E50;">
                                        <i class="fas fa-calendar-check" style="color: #1ABC9C;"></i> Tanggal Kembali
                                    </label>
                                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control rounded-3" value="<?= $transaksi->tanggal_kembali ?>" required>
                                </div>
                            </div>
                            
                            <div class="alert alert-light border mb-4 rounded-3" style="background: #ECF0F1;">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle fa-2x me-3" style="color: #1ABC9C;"></i>
                                    <div>
                                        <strong class="fw-bold" style="color: #2C3E50;">Informasi Denda</strong><br>
                                        <small class="text-muted">Denda akan dihitung otomatis berdasarkan keterlambatan (Rp 1.000/hari)</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-2 mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-simpan px-4 py-2 fw-bold">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                                <a href="<?= base_url('index.php/admin/laporan') ?>" class="btn btn-kembali px-4 py-2">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Tombol Simpan - Turquoise */
.btn-simpan {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    border: none;
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
}
.btn-simpan:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(26, 188, 156, 0.35);
    background: linear-gradient(135deg, #16A085 0%, #1ABC9C 100%);
    color: white;
}

/* Tombol Kembali - Outline */
.btn-kembali {
    background: transparent;
    border: 2px solid #1ABC9C;
    color: #1ABC9C;
    transition: all 0.3s ease;
    border-radius: 50px;
    padding: 8px 20px;
    text-decoration: none;
}
.btn-kembali:hover {
    transform: translateY(-2px);
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 8px 20px rgba(26, 188, 156, 0.3);
}

/* Card Style */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 16px !important;
    overflow: hidden;
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
.form-control, select.form-control {
    border-radius: 10px;
    border: 1px solid #d5dbdb;
    padding: 10px 12px;
}
.form-control:focus, select.form-control:focus {
    border-color: #1ABC9C;
    box-shadow: 0 0 0 3px rgba(26, 188, 156, 0.1);
    outline: none;
}

/* Breadcrumb */
.breadcrumb {
    background: transparent;
    padding: 0;
}
.breadcrumb-item a {
    color: #6c757d;
    text-decoration: none;
    transition: color 0.2s;
}
.breadcrumb-item a:hover {
    color: #1ABC9C;
}
.breadcrumb-item.active {
    color: #1ABC9C;
}

/* Select2 Custom */
.select2-container--bootstrap-5 .select2-selection {
    border-radius: 10px;
    border-color: #d5dbdb;
    min-height: 46px;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    line-height: 44px;
    padding-left: 12px;
    color: #2C3E50;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 44px;
}
.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
}
.select2-container--bootstrap-5 .select2-dropdown {
    border-radius: 12px;
    border-color: #d5dbdb;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.select2-search__field {
    border-radius: 8px !important;
    border: 1px solid #d5dbdb !important;
    padding: 8px 12px !important;
}

/* Border top */
.border-top {
    border-top: 1px solid #e0e0e0 !important;
}

/* Form text */
.form-text {
    color: #6c757d;
    font-size: 12px;
    margin-top: 5px;
}
</style>