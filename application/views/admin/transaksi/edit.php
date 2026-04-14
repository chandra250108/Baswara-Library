<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('index.php/admin/dashboard') ?>" class="text-decoration-none"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('index.php/admin/transaksi') ?>" class="text-decoration-none"><i class="fas fa-exchange-alt"></i> Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Transaksi</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-lg">
                    <div class="card-header text-white py-3" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-white bg-opacity-25 p-2 me-3">
                                <i class="fas fa-edit fa-2x text-white"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">Edit Transaksi Peminjaman</h4>
                                <p class="mb-0 opacity-75">Perbaharui data peminjaman buku</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?= base_url('index.php/admin/update_transaksi_lengkap/'.$transaksi->id_transaksi) ?>" method="post" id="formEditTransaksi">
                            <!-- Pilih Siswa - Dengan Select2 -->
                            <div class="mb-4">
                                <label class="form-label fw-bold" style="color: #2C3E50;">
                                    <i class="fas fa-user-graduate" style="color: #1ABC9C;"></i> Pilih Siswa
                                </label>
                                <select name="id_siswa" id="edit_id_siswa" class="form-control" required style="width: 100%;">
                                    <option value=""></option>
                                    <?php foreach($siswa as $s): ?>
                                        <option value="<?= $s->id ?>" <?= ($s->id == $transaksi->id_siswa) ? 'selected' : '' ?>>
                                            <?= $s->nama_lengkap ?> - Kelas: <?= $s->kelas ?> (<?= $s->username ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-text">
                                    <i class="fas fa-search" style="color: #1ABC9C;"></i> Ketik nama siswa untuk mencari
                                </div>
                            </div>

                            <!-- Pilih Buku - Dengan Select2 -->
                            <div class="mb-4">
                                <label class="form-label fw-bold" style="color: #2C3E50;">
                                    <i class="fas fa-book" style="color: #1ABC9C;"></i> Pilih Buku
                                </label>
                                <select name="id_buku" id="edit_id_buku" class="form-control" required style="width: 100%;">
                                    <option value=""></option>
                                    <?php foreach($buku as $b): ?>
                                        <option value="<?= $b->id_buku ?>" data-stok="<?= $b->stok ?>" <?= ($b->id_buku == $transaksi->id_buku) ? 'selected' : '' ?>>
                                            <?= $b->judul ?> - <?= $b->penulis ?> (Stok: <?= $b->stok ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-text">
                                    <i class="fas fa-search" style="color: #1ABC9C;"></i> Ketik judul buku untuk mencari
                                </div>
                            </div>

                            <div class="row">
                                <!-- Tanggal Pinjam -->
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold" style="color: #2C3E50;">
                                        <i class="fas fa-calendar-plus" style="color: #1ABC9C;"></i> Tanggal Pinjam
                                    </label>
                                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="<?= $transaksi->tanggal_pinjam ?>" required>
                                </div>

                                <!-- Batas Pengembalian -->
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold" style="color: #2C3E50;">
                                        <i class="fas fa-calendar-times" style="color: #1ABC9C;"></i> Batas Pengembalian
                                    </label>
                                    <input type="date" name="batas_pengembalian" id="batas_pengembalian" class="form-control" value="<?= $transaksi->batas_pengembalian ?>" required>
                                </div>
                            </div>

                            <!-- Informasi Status -->
                            <div class="alert alert-light border mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-info-circle fa-2x me-3" style="color: #1ABC9C;"></i>
                                            <div>
                                                <small class="text-muted d-block">Status Saat Ini</small>
                                                <span class="badge px-3 py-2" style="background: #f59e0b; color: white; border-radius: 50px;">
                                                    <i class="fas fa-hourglass-half me-1"></i> <?= ucfirst($transaksi->status) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-clock fa-2x me-3" style="color: #1ABC9C;"></i>
                                            <div>
                                                <small class="text-muted d-block">Durasi Peminjaman</small>
                                                <strong style="color: #1ABC9C;">
                                                    <?php 
                                                    $tgl1 = new DateTime($transaksi->tanggal_pinjam);
                                                    $tgl2 = new DateTime($transaksi->batas_pengembalian);
                                                    $diff = $tgl1->diff($tgl2)->days;
                                                    echo $diff . " hari";
                                                    ?>
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Peringatan Jika Terlambat -->
                            <?php if(date('Y-m-d') > $transaksi->batas_pengembalian && $transaksi->status == 'dipinjam'): ?>
                                <div class="alert alert-danger mb-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle fa-3x me-3"></i>
                                        <div>
                                            <h6 class="mb-1 fw-bold">⚠️ Peringatan Terlambat!</h6>
                                            <p class="mb-0">Buku ini sudah melewati batas waktu pengembalian.</p>
                                            <small>Terlambat: <strong><?= floor((strtotime(date('Y-m-d')) - strtotime($transaksi->batas_pengembalian)) / (60 * 60 * 24)) ?> hari</strong></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-2 mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-simpan px-4 py-2">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                                <a href="<?= base_url('index.php/admin/transaksi') ?>" class="btn btn-kembali px-4 py-2">
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

<script>
$(document).ready(function() {
    // Validasi tanggal
    $('#batas_pengembalian, #tanggal_pinjam').on('change', function() {
        var tanggal_pinjam = $('#tanggal_pinjam').val();
        var batas_kembali = $('#batas_pengembalian').val();
        
        if(tanggal_pinjam && batas_kembali && batas_kembali < tanggal_pinjam) {
            alert('Batas pengembalian tidak boleh kurang dari tanggal pinjam!');
            $('#batas_pengembalian').val(tanggal_pinjam);
        }
    });
    
    // Submit form
    $('#formEditTransaksi').on('submit', function(e) {
        var siswa = $('#edit_id_siswa').val();
        var buku = $('#edit_id_buku').val();
        
        if(!siswa || siswa === '') {
            alert('Silakan pilih siswa terlebih dahulu!');
            e.preventDefault();
            return false;
        }
        
        if(!buku || buku === '') {
            alert('Silakan pilih buku terlebih dahulu!');
            e.preventDefault();
            return false;
        }
        
        return confirm('Yakin ingin menyimpan perubahan? Stok buku akan disesuaikan otomatis.');
    });
});
</script>

<style>
.btn-simpan {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    border: none;
    color: white;
    font-weight: 500;
    border-radius: 50px;
    transition: all 0.3s ease;
    padding: 10px 24px;
}
.btn-simpan:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(26, 188, 156, 0.35);
    background: linear-gradient(135deg, #16A085 0%, #1ABC9C 100%);
    color: white;
}

.btn-kembali {
    background: transparent;
    border: 2px solid #1ABC9C;
    color: #1ABC9C;
    font-weight: 500;
    border-radius: 50px;
    transition: all 0.3s ease;
    padding: 10px 24px;
    text-decoration: none;
}
.btn-kembali:hover {
    transform: translateY(-2px);
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 8px 20px rgba(26, 188, 156, 0.3);
}

.card {
    border-radius: 20px;
    overflow: hidden;
}

.form-control, select.form-control {
    border-radius: 12px;
    border: 1px solid #e0e0e0;
    padding: 10px 12px;
}

.form-control:focus, select.form-control:focus {
    border-color: #1ABC9C;
    box-shadow: 0 0 0 0.2rem rgba(26, 188, 156, 0.25);
    outline: none;
}

/* Select2 Custom */
.select2-container--bootstrap-5 .select2-selection {
    border-radius: 12px !important;
    min-height: 46px !important;
    border: 1px solid #e0e0e0 !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    line-height: 44px !important;
    padding-left: 12px !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 44px !important;
}

.select2-container--bootstrap-5 .select2-dropdown {
    border-radius: 12px !important;
    border-color: #e0e0e0 !important;
}

.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%) !important;
}
</style>