<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('index.php/admin/dashboard') ?>" class="text-decoration-none"><i class="fas fa-home me-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('index.php/admin/anggota') ?>" class="text-decoration-none"><i class="fas fa-users me-1"></i> Data Anggota</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Anggota</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-white bg-opacity-25 p-2 me-3">
                                <i class="fas fa-user-plus fa-2x text-white"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">Tambah Anggota Baru</h4>
                                <p class="mb-0 opacity-75">Registrasi anggota perpustakaan baru</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
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
                        
                        <form action="<?= base_url('index.php/admin/simpan_anggota') ?>" method="post" id="formTambahAnggota">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Username -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold" style="color: #2C3E50;">
                                            <i class="fas fa-user" style="color: #1ABC9C;"></i> Username <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light" style="border-color: #d5dbdb;">
                                                <i class="fas fa-user" style="color: #1ABC9C;"></i>
                                            </span>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required style="border-color: #d5dbdb;">
                                        </div>
                                        <small class="text-muted"><i class="fas fa-info-circle me-1" style="color: #1ABC9C;"></i> Username harus unik</small>
                                        <div id="usernameWarning" class="mt-1"></div>
                                    </div>
                                    
                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold" style="color: #2C3E50;">
                                            <i class="fas fa-lock" style="color: #1ABC9C;"></i> Password <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light" style="border-color: #d5dbdb;">
                                                <i class="fas fa-key" style="color: #1ABC9C;"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter" required style="border-color: #d5dbdb;">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-color: #d5dbdb;">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <small class="text-muted"><i class="fas fa-info-circle me-1" style="color: #1ABC9C;"></i> Minimal 6 karakter</small>
                                        <div class="password-strength mt-2" id="passwordStrength"></div>
                                    </div>
                                    
                                    <!-- Nama Lengkap -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold" style="color: #2C3E50;">
                                            <i class="fas fa-id-card" style="color: #1ABC9C;"></i> Nama Lengkap <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light" style="border-color: #d5dbdb;">
                                                <i class="fas fa-id-card" style="color: #1ABC9C;"></i>
                                            </span>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required style="border-color: #d5dbdb;">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <!-- Kelas -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold" style="color: #2C3E50;">
                                            <i class="fas fa-graduation-cap" style="color: #1ABC9C;"></i> Kelas <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light" style="border-color: #d5dbdb;">
                                                <i class="fas fa-graduation-cap" style="color: #1ABC9C;"></i>
                                            </span>
                                            <select class="form-select" id="kelas" name="kelas" required style="border-color: #d5dbdb;">
                                                <option value="">Pilih Kelas</option>
                                                <optgroup label="Kelas X">
                                                    <option value="X AKL">X AKL</option>
                                                    <option value="X PPLG">X PPLG</option>
                                                    <option value="X TJKT">X TJKT</option>
                                                    <option value="X MPLB">X MPLB</option>
                                                </optgroup>
                                                <optgroup label="Kelas XI">
                                                    <option value="XI AKL">XI AKL</option>
                                                    <option value="XI PPLG">XI PPLG</option>
                                                    <option value="XI TJKT">XI TJKT</option>
                                                    <option value="XI MPLB">XI MPLB</option>
                                                </optgroup>
                                                <optgroup label="Kelas XII">
                                                    <option value="XII AKL">XII AKL</option>
                                                    <option value="XII PPLG">XII PPLG</option>
                                                    <option value="XII TJKT">XII TJKT</option>
                                                    <option value="XII MPLB">XII MPLB</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Alamat -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold" style="color: #2C3E50;">
                                            <i class="fas fa-map-marker-alt" style="color: #1ABC9C;"></i> Alamat <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light" style="border-color: #d5dbdb;">
                                                <i class="fas fa-map-marker-alt" style="color: #1ABC9C;"></i>
                                            </span>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Masukkan alamat lengkap" required style="border-color: #d5dbdb;"></textarea>
                                        </div>
                                    </div>
                                    
                                    <!-- No. HP -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold" style="color: #2C3E50;">
                                            <i class="fas fa-phone" style="color: #1ABC9C;"></i> No. HP <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light" style="border-color: #d5dbdb;">
                                                <i class="fas fa-phone" style="color: #1ABC9C;"></i>
                                            </span>
                                            <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 081234567890" required style="border-color: #d5dbdb;">
                                        </div>
                                        <small class="text-muted"><i class="fas fa-info-circle me-1" style="color: #1ABC9C;"></i> Hanya angka, maksimal 13 digit</small>
                                        <div id="noHpWarning" class="mt-1"></div>
                                    </div>
                            </div>
                            
                            <!-- Informasi Tambahan -->
                            <div class="alert border-0 rounded-3 mt-2" style="background: #ECF0F1;">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle fa-2x me-3" style="color: #1ABC9C;"></i>
                                    <div>
                                        <strong class="d-block" style="color: #2C3E50;">Informasi Pendaftaran</strong>
                                        <small class="text-muted">Anggota yang terdaftar akan dapat meminjam buku maksimal 3 buku sekaligus dengan masa pinjam 7 hari.</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-2 mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-simpan px-4 py-2" id="btnSubmit">
                                    <i class="fas fa-save me-2"></i> Simpan
                                </button>
                                <a href="<?= base_url('index.php/admin/anggota') ?>" class="btn btn-kembali px-4 py-2">
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
// Toggle Password Visibility
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

if(togglePassword) {
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });
}

// Password Strength Indicator
const passwordInput = document.getElementById('password');
const strengthDiv = document.getElementById('passwordStrength');

if(passwordInput) {
    passwordInput.addEventListener('input', function() {
        const value = this.value;
        let strength = 0;
        
        if(value.length >= 6) strength++;
        if(value.match(/[a-z]+/)) strength++;
        if(value.match(/[A-Z]+/)) strength++;
        if(value.match(/[0-9]+/)) strength++;
        if(value.match(/[$@#&!]+/)) strength++;
        
        let color = '#dc2626';
        let width = '20%';
        let text = 'Lemah';
        
        if(strength >= 5) {
            color = '#10b981';
            width = '100%';
            text = 'Kuat';
        } else if(strength >= 4) {
            color = '#f59e0b';
            width = '80%';
            text = 'Baik';
        } else if(strength >= 3) {
            color = '#f59e0b';
            width = '60%';
            text = 'Sedang';
        } else if(strength >= 2) {
            color = '#f97316';
            width = '40%';
            text = 'Lemah';
        } else if(strength >= 1) {
            color = '#ef4444';
            width = '20%';
            text = 'Sangat Lemah';
        }
        
        if(value.length > 0) {
            strengthDiv.style.display = 'block';
            strengthDiv.innerHTML = `<div class="d-flex justify-content-between align-items-center mb-1"><small class="text-muted">Kekuatan Password: <span style="color: ${color}">${text}</span></small></div><div style="height: 4px; background-color: #e5e7eb; border-radius: 2px; overflow: hidden;"><div style="width: ${width}; background-color: ${color}; height: 100%; transition: all 0.3s ease;"></div></div>`;
        } else {
            strengthDiv.style.display = 'none';
            strengthDiv.innerHTML = '';
        }
    });
}

// Fungsi untuk mengecek username sudah ada atau belum
async function cekUsername(username) {
    if(!username || username.length < 3) return false;
    
    try {
        const response = await fetch('<?= base_url("index.php/admin/cek_username") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `username=${encodeURIComponent(username)}`
        });
        const data = await response.json();
        return data.exists;
    } catch(error) {
        console.error('Error:', error);
        return false;
    }
}

// Fungsi untuk mengecek nomor HP sudah ada atau belum
async function cekNoHp(no_hp) {
    if(!no_hp || no_hp.length < 10) return false;
    
    try {
        const response = await fetch('<?= base_url("index.php/admin/cek_no_hp") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `no_hp=${encodeURIComponent(no_hp)}`
        });
        const data = await response.json();
        return data.exists;
    } catch(error) {
        console.error('Error:', error);
        return false;
    }
}

// Validasi realtime untuk username
const usernameInput = document.getElementById('username');
const usernameWarning = document.getElementById('usernameWarning');
let usernameTimeoutId;

if(usernameInput) {
    usernameInput.addEventListener('input', async function() {
        clearTimeout(usernameTimeoutId);
        const username = this.value.trim();
        
        if(username.length < 3) {
            usernameWarning.innerHTML = '<i class="fas fa-info-circle text-muted me-1"></i> <span class="text-muted">Username minimal 3 karakter</span>';
            usernameWarning.style.color = '#6c757d';
            document.getElementById('btnSubmit').disabled = false;
            return;
        }
        
        usernameTimeoutId = setTimeout(async () => {
            const exists = await cekUsername(username);
            if(exists) {
                usernameWarning.innerHTML = '<i class="fas fa-exclamation-circle text-danger me-1"></i> <span class="text-danger">Username "' + username + '" sudah digunakan! Silakan pilih username lain.</span>';
                usernameWarning.style.color = '#dc2626';
                document.getElementById('btnSubmit').disabled = true;
            } else {
                usernameWarning.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i> <span class="text-success">Username tersedia</span>';
                usernameWarning.style.color = '#10b981';
                document.getElementById('btnSubmit').disabled = false;
            }
        }, 500);
    });
}

// Validasi realtime untuk nomor HP
const noHpInput = document.getElementById('no_hp');
const noHpWarning = document.getElementById('noHpWarning');
let noHpTimeoutId;

if(noHpInput) {
    // Format nomor HP
    noHpInput.addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, '');
        if(value.length > 0 && !value.startsWith('0')) {
            value = '0' + value;
        }
        if(value.length > 13) {
            value = value.substring(0, 13);
        }
        this.value = value;
    });
    
    noHpInput.addEventListener('keypress', function(e) {
        const charCode = e.which ? e.which : e.keyCode;
        if (charCode < 48 || charCode > 57) {
            e.preventDefault();
        }
    });
    
    // Cek keunikan nomor HP
    noHpInput.addEventListener('input', async function() {
        clearTimeout(noHpTimeoutId);
        const no_hp = this.value.trim();
        
        if(no_hp.length < 10) {
            noHpWarning.innerHTML = '<i class="fas fa-info-circle text-muted me-1"></i> <span class="text-muted">Nomor HP minimal 10 digit</span>';
            noHpWarning.style.color = '#6c757d';
            document.getElementById('btnSubmit').disabled = false;
            return;
        }
        
        noHpTimeoutId = setTimeout(async () => {
            const exists = await cekNoHp(no_hp);
            if(exists) {
                noHpWarning.innerHTML = '<i class="fas fa-exclamation-circle text-danger me-1"></i> <span class="text-danger">Nomor HP "' + no_hp + '" sudah terdaftar! Silakan gunakan nomor lain.</span>';
                noHpWarning.style.color = '#dc2626';
                document.getElementById('btnSubmit').disabled = true;
            } else {
                noHpWarning.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i> <span class="text-success">Nomor HP tersedia</span>';
                noHpWarning.style.color = '#10b981';
                document.getElementById('btnSubmit').disabled = false;
            }
        }, 500);
    });
}

// Username validation (no spaces)
if(usernameInput) {
    usernameInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/\s/g, '');
    });
}

// Form validation before submit
document.getElementById('formTambahAnggota').addEventListener('submit', async function(e) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const noHp = document.getElementById('no_hp').value;
    const namaLengkap = document.getElementById('nama_lengkap').value;
    const kelas = document.getElementById('kelas').value;
    const alamat = document.getElementById('alamat').value;
    
    if(username.length < 3) {
        alert('Username minimal 3 karakter!');
        e.preventDefault();
        return false;
    }
    
    if(password.length < 6) {
        alert('Password minimal 6 karakter!');
        e.preventDefault();
        return false;
    }
    
    if(namaLengkap === '') {
        alert('Nama lengkap tidak boleh kosong!');
        e.preventDefault();
        return false;
    }
    
    if(kelas === '') {
        alert('Kelas harus dipilih!');
        e.preventDefault();
        return false;
    }
    
    if(alamat === '') {
        alert('Alamat tidak boleh kosong!');
        e.preventDefault();
        return false;
    }
    
    if(noHp.length < 10) {
        alert('Nomor HP minimal 10 digit!');
        e.preventDefault();
        return false;
    }
    
    // Cek username sudah ada
    const usernameExists = await cekUsername(username);
    if(usernameExists) {
        alert('Username "' + username + '" sudah digunakan! Silakan pilih username lain.');
        e.preventDefault();
        return false;
    }
    
    // Cek nomor HP sudah ada
    const noHpExists = await cekNoHp(noHp);
    if(noHpExists) {
        alert('Nomor HP "' + noHp + '" sudah terdaftar! Silakan gunakan nomor lain.');
        e.preventDefault();
        return false;
    }
    
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
.form-control, .form-select {
    border-radius: 10px;
    border: 1px solid #d5dbdb;
    padding: 10px 15px;
    transition: all 0.3s ease;
}
.form-control:focus, .form-select:focus {
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

/* Textarea */
textarea.form-control {
    resize: vertical;
    min-height: 80px;
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
.btn-simpan:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
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

/* Toggle password button */
.btn-outline-secondary {
    border-color: #d5dbdb;
    color: #7f8c8d;
}
.btn-outline-secondary:hover {
    background: #1ABC9C;
    border-color: #1ABC9C;
    color: white;
}
</style>