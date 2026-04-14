<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('index.php/admin/dashboard') ?>" class="text-decoration-none"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('index.php/admin/buku') ?>" class="text-decoration-none"><i class="fas fa-book me-1"></i> Data Buku</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Buku</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-white bg-opacity-25 p-2 me-3">
                                <i class="fas fa-plus fa-2x text-white"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">Tambah Buku Baru</h4>
                                <p class="mb-0 opacity-75">Tambahkan koleksi buku baru ke perpustakaan</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <!-- Notifikasi Error -->
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
                        
                        <form action="<?= base_url('index.php/admin/simpan_buku') ?>" method="post" enctype="multipart/form-data" id="formTambahBuku">
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
                                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul buku" required style="border-color: #d5dbdb;">
                                        </div>
                                        <small class="text-muted" id="judulWarning"></small>
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
                                            <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukkan nama penulis" required style="border-color: #d5dbdb;">
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
                                            <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit" required style="border-color: #d5dbdb;">
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
                                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Jumlah stok buku" min="1" value="1" required style="border-color: #d5dbdb;">
                                        </div>
                                        <small class="text-muted"><i class="fas fa-info-circle me-1" style="color: #1ABC9C;"></i> Stok minimal 1, tidak boleh 0</small>
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
                                                <div id="preview" class="mb-3">
                                                    <div class="rounded-circle d-inline-flex p-4" style="background: rgba(44, 62, 80, 0.1);">
                                                        <i class="fas fa-cloud-upload-alt fa-4x" style="color: #2C3E50;"></i>
                                                    </div>
                                                    <p class="text-muted mt-2 mb-0">Belum ada cover</p>
                                                </div>
                                                <input type="file" class="form-control" id="cover" name="cover" accept="image/jpeg,image/png,image/gif,image/webp">
                                                <small class="text-muted d-block mt-2">
                                                    <i class="fas fa-info-circle me-1" style="color: #1ABC9C;"></i> Format: JPG, PNG, GIF, WEBP<br>
                                                    <i class="fas fa-database me-1" style="color: #1ABC9C;"></i> Max 10MB
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Informasi Tambahan -->
                            <div class="alert border-0 rounded-3 mt-2" style="background: #ECF0F1;">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle fa-2x me-3" style="color: #1ABC9C;"></i>
                                    <div>
                                        <strong class="d-block" style="color: #2C3E50;">Informasi Penambahan Buku</strong>
                                        <small class="text-muted">Stok akan berkurang otomatis saat buku dipinjam dan bertambah saat dikembalikan. Cover buku bersifat opsional.</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-2 mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-simpan px-4 py-2" id="btnSubmit">
                                    <i class="fas fa-save me-2"></i> Simpan
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
// Preview gambar sebelum upload
const coverInput = document.getElementById('cover');
const previewDiv = document.getElementById('preview');

if(coverInput) {
    coverInput.addEventListener('change', function(evt) {
        const [file] = this.files;
        if (file) {
            // Cek ukuran file (10MB = 10 * 1024 * 1024 = 10485760 bytes)
            if(file.size > 10485760) {
                alert('Ukuran file terlalu besar! Maksimal 10MB');
                this.value = '';
                previewDiv.innerHTML = `
                    <div class="rounded-circle d-inline-flex p-4" style="background: rgba(44, 62, 80, 0.1);">
                        <i class="fas fa-cloud-upload-alt fa-4x" style="color: #2C3E50;"></i>
                    </div>
                    <p class="text-muted mt-2 mb-0">Belum ada cover</p>
                `;
                return;
            }
            
            // Cek tipe file
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if(!allowedTypes.includes(file.type)) {
                alert('Tipe file tidak diizinkan! Gunakan JPG, PNG, GIF, atau WEBP');
                this.value = '';
                previewDiv.innerHTML = `
                    <div class="rounded-circle d-inline-flex p-4" style="background: rgba(44, 62, 80, 0.1);">
                        <i class="fas fa-cloud-upload-alt fa-4x" style="color: #2C3E50;"></i>
                    </div>
                    <p class="text-muted mt-2 mb-0">Belum ada cover</p>
                `;
                return;
            }
            
            // Preview gambar
            const reader = new FileReader();
            reader.onload = function(e) {
                previewDiv.innerHTML = `
                    <img src="${e.target.result}" class="img-fluid rounded-3 shadow-sm" style="max-height: 150px; object-fit: contain;">
                    <p class="text-success mt-2 mb-0 small">
                        <i class="fas fa-check-circle me-1"></i> Cover siap diupload
                    </p>
                `;
            };
            reader.readAsDataURL(file);
        } else {
            previewDiv.innerHTML = `
                <div class="rounded-circle d-inline-flex p-4" style="background: rgba(44, 62, 80, 0.1);">
                    <i class="fas fa-cloud-upload-alt fa-4x" style="color: #2C3E50;"></i>
                </div>
                <p class="text-muted mt-2 mb-0">Belum ada cover</p>
            `;
        }
    });
}

// Fungsi untuk mengecek apakah judul buku sudah ada
async function cekJudulBuku(judul, penulis) {
    if(!judul || !penulis) return false;
    
    try {
        const response = await fetch('<?= base_url("index.php/admin/cek_judul_buku") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `judul=${encodeURIComponent(judul)}&penulis=${encodeURIComponent(penulis)}`
        });
        const data = await response.json();
        return data.exists;
    } catch(error) {
        console.error('Error:', error);
        return false;
    }
}

// Validasi realtime untuk judul dan penulis
const judulInput = document.getElementById('judul');
const penulisInput = document.getElementById('penulis');
const judulWarning = document.getElementById('judulWarning');

async function validateJudul() {
    const judul = judulInput.value.trim();
    const penulis = penulisInput.value.trim();
    
    if(judul && penulis) {
        const exists = await cekJudulBuku(judul, penulis);
        if(exists) {
            judulWarning.innerHTML = '<i class="fas fa-exclamation-circle text-danger me-1"></i> <span class="text-danger">Buku dengan judul dan penulis ini sudah ada!</span>';
            judulWarning.style.color = '#dc2626';
            return false;
        } else {
            judulWarning.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i> <span class="text-success">Judul buku tersedia</span>';
            judulWarning.style.color = '#10b981';
            return true;
        }
    } else {
        judulWarning.innerHTML = '';
        return true;
    }
}

if(judulInput && penulisInput) {
    let timeoutId;
    judulInput.addEventListener('input', () => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(validateJudul, 500);
    });
    penulisInput.addEventListener('input', () => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(validateJudul, 500);
    });
}

// Form validation
document.getElementById('formTambahBuku').addEventListener('submit', async function(e) {
    const judul = document.getElementById('judul').value.trim();
    const penulis = document.getElementById('penulis').value.trim();
    const penerbit = document.getElementById('penerbit').value.trim();
    const stok = document.getElementById('stok').value;
    
    // Validasi semua kolom harus diisi
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
    
    // Validasi stok tidak boleh 0 atau kosong
    if(stok === '' || parseInt(stok) < 1) {
        alert('Stok tidak boleh 0! Minimal stok adalah 1.');
        e.preventDefault();
        return false;
    }
    
    // Validasi judul duplikat
    const exists = await cekJudulBuku(judul, penulis);
    if(exists) {
        alert('Buku dengan judul "' + judul + '" dan penulis "' + penulis + '" sudah ada di database!');
        e.preventDefault();
        return false;
    }
    
    // Jika semua validasi lolos, submit form
    const btnSubmit = document.getElementById('btnSubmit');
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyimpan...';
    
    return true;
});
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

/* File input */
input[type=file] {
    padding: 8px;
    border-radius: 10px;
    border: 1px solid #d5dbdb;
}
input[type=file]::file-selector-button {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    margin-right: 10px;
    transition: all 0.3s ease;
}
input[type=file]::file-selector-button:hover {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    transform: translateY(-1px);
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

/* Tombol Simpan - Emerald Green */
.btn-simpan {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    color: white;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 50px;
    padding: 8px 24px;
    font-weight: 500;
}
.btn-simpan:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: white;
}
.btn-simpan:active {
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