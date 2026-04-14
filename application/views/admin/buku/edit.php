<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('index.php/admin/dashboard') ?>" class="text-decoration-none"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('index.php/admin/buku') ?>" class="text-decoration-none"><i class="fas fa-book me-1"></i> Data Buku</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Buku</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-white bg-opacity-25 p-2 me-3">
                                <i class="fas fa-edit fa-2x text-white"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">Edit Buku</h4>
                                <p class="mb-0 opacity-75">Perbaharui informasi koleksi buku</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?= base_url('index.php/admin/update_buku/'.$buku->id_buku) ?>" method="post" id="formEditBuku">
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- Judul Buku -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold" style="color: #2C3E50;">
                                            <i class="fas fa-book" style="color: #1ABC9C;"></i> Judul Buku <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light" style="border-color: #d5dbdb;">
                                                <i class="fas fa-book" style="color: #1ABC9C;"></i>
                                            </span>
                                            <input type="text" class="form-control" id="judul" name="judul" value="<?= $buku->judul ?>" required style="border-color: #d5dbdb;">
                                        </div>
                                    </div>
                                    
                                    <!-- Penulis -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold" style="color: #2C3E50;">
                                            <i class="fas fa-user-edit" style="color: #1ABC9C;"></i> Penulis <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light" style="border-color: #d5dbdb;">
                                                <i class="fas fa-user-edit" style="color: #1ABC9C;"></i>
                                            </span>
                                            <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $buku->penulis ?>" required style="border-color: #d5dbdb;">
                                        </div>
                                    </div>
                                    
                                    <!-- Penerbit -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold" style="color: #2C3E50;">
                                            <i class="fas fa-building" style="color: #1ABC9C;"></i> Penerbit <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light" style="border-color: #d5dbdb;">
                                                <i class="fas fa-building" style="color: #1ABC9C;"></i>
                                            </span>
                                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $buku->penerbit ?>" required style="border-color: #d5dbdb;">
                                        </div>
                                    </div>
                                    
                                    <!-- Stok -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold" style="color: #2C3E50;">
                                            <i class="fas fa-boxes" style="color: #1ABC9C;"></i> Stok Buku <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light" style="border-color: #d5dbdb;">
                                                <i class="fas fa-boxes" style="color: #1ABC9C;"></i>
                                            </span>
                                            <input type="number" class="form-control" id="stok" name="stok" value="<?= $buku->stok ?>" min="1" required style="border-color: #d5dbdb;">
                                        </div>
                                        <small class="text-muted"><i class="fas fa-info-circle me-1" style="color: #1ABC9C;"></i> Minimal stok adalah 1, tidak boleh 0</small>
                                        <div id="stokWarning" class="mt-1"></div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <!-- Cover Buku -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold" style="color: #2C3E50;">
                                            <i class="fas fa-image" style="color: #1ABC9C;"></i> Cover Buku
                                        </label>
                                        <div class="card bg-light border-0 rounded-3">
                                            <div class="card-body text-center">
                                                <?php if(!empty($buku->cover) && file_exists('uploads/'.$buku->cover)): ?>
                                                    <img src="<?= base_url('uploads/'.$buku->cover) ?>" 
                                                         class="img-fluid rounded-3 shadow-sm" 
                                                         style="max-height: 200px; object-fit: contain;"
                                                         alt="<?= $buku->judul ?>">
                                                    <div class="mt-3">
                                                        <span class="badge rounded-pill px-3 py-2" style="background: #10b981; color: white;">
                                                            <i class="fas fa-check-circle me-1"></i> Cover tersedia
                                                        </span>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="py-4">
                                                        <div class="rounded-circle d-inline-flex p-4 mb-2" style="background: rgba(44, 62, 80, 0.1);">
                                                            <i class="fas fa-book fa-4x" style="color: #2C3E50;"></i>
                                                        </div>
                                                        <p class="text-muted mb-0">Tidak ada cover</p>
                                                        <small class="text-muted">Upload cover baru di halaman tambah buku</small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <small class="text-muted"><i class="fas fa-info-circle me-1" style="color: #1ABC9C;"></i> Cover hanya bisa diubah saat menambah buku baru</small>
                                    </div>
                                    
                                    <!-- Informasi Singkat -->
                                    <div class="alert border-0 rounded-3 mt-3" style="background: #ECF0F1;">
                                        <div class="d-flex">
                                            <i class="fas fa-info-circle fa-2x me-3" style="color: #1ABC9C;"></i>
                                            <div>
                                                <strong class="d-block" style="color: #2C3E50;">Informasi Stok</strong>
                                                <small class="text-muted">Stok akan berkurang otomatis saat buku dipinjam dan bertambah saat dikembalikan. Stok minimal adalah 1.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-2 mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-update px-4 py-2" id="btnSubmit">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                                <a href="<?= base_url('index.php/admin/buku') ?>" class="btn btn-kembali px-4 py-2">
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
// Validasi stok tidak boleh 0
const stokInput = document.getElementById('stok');
const stokWarning = document.getElementById('stokWarning');

if(stokInput) {
    // Validasi saat input berubah
    stokInput.addEventListener('input', function() {
        let value = parseInt(this.value);
        
        if(isNaN(value) || value < 1) {
            this.value = 1;
            stokWarning.innerHTML = '<i class="fas fa-exclamation-circle text-danger me-1"></i> <span class="text-danger">Stok tidak boleh 0! Minimal stok adalah 1.</span>';
            stokWarning.style.color = '#dc2626';
        } else {
            stokWarning.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i> <span class="text-success">Stok valid</span>';
            stokWarning.style.color = '#10b981';
            setTimeout(() => {
                if(stokWarning.innerHTML.includes('Stok valid')) {
                    stokWarning.innerHTML = '';
                }
            }, 2000);
        }
    });
    
    // Cegah input 0 atau kurang
    stokInput.addEventListener('keydown', function(e) {
        if(e.key === '-' || e.key === 'e') {
            e.preventDefault();
        }
    });
}

// Form validation sebelum submit
document.getElementById('formEditBuku').addEventListener('submit', function(e) {
    const stok = parseInt(document.getElementById('stok').value);
    
    if(isNaN(stok) || stok < 1) {
        alert('Stok tidak boleh 0! Minimal stok adalah 1.');
        e.preventDefault();
        return false;
    }
    
    const judul = document.getElementById('judul').value.trim();
    const penulis = document.getElementById('penulis').value.trim();
    const penerbit = document.getElementById('penerbit').value.trim();
    
    if(judul === '') {
        alert('Judul buku tidak boleh kosong!');
        e.preventDefault();
        return false;
    }
    
    if(penulis === '') {
        alert('Penulis tidak boleh kosong!');
        e.preventDefault();
        return false;
    }
    
    if(penerbit === '') {
        alert('Penerbit tidak boleh kosong!');
        e.preventDefault();
        return false;
    }
    
    return true;
});

// Disable submit button after click to prevent double submit
const btnSubmit = document.getElementById('btnSubmit');
if(btnSubmit) {
    btnSubmit.addEventListener('click', function() {
        this.disabled = true;
        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyimpan...';
        document.getElementById('formEditBuku').submit();
    });
}
</script>

<style>
/* Breadcrumb */
.breadcrumb {
    background: transparent;
    padding: 0;
}
.breadcrumb-item a {
    color: #7f8c8d;
    transition: color 0.2s;
}
.breadcrumb-item a:hover {
    color: #1ABC9C;
}
.breadcrumb-item.active {
    color: #1ABC9C;
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

/* Form Control */
.form-control {
    border-radius: 10px;
    border: 1px solid #d5dbdb;
    padding: 10px 15px;
    transition: all 0.3s ease;
}
.form-control:focus {
    border-color: #1ABC9C;
    box-shadow: 0 0 0 3px rgba(26, 188, 156, 0.1);
}
.input-group-text {
    border-radius: 10px 0 0 10px;
    border: 1px solid #d5dbdb;
    border-right: none;
}
.form-control:focus + .input-group-text {
    border-color: #1ABC9C;
}

/* Number input */
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button {
    opacity: 1;
}

/* Cover image */
.img-fluid {
    transition: transform 0.3s ease;
}
.img-fluid:hover {
    transform: scale(1.02);
}

/* Tombol Update - Amber Gold */
.btn-update {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border: none;
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
    padding: 8px 24px;
    font-weight: 500;
}
.btn-update:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
    background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
    color: white;
}
.btn-update:active {
    transform: translateY(0);
}

/* Tombol Kembali - Outline */
.btn-kembali {
    background: transparent;
    border: 2px solid #1ABC9C;
    color: #1ABC9C;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
    padding: 8px 24px;
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
</style>