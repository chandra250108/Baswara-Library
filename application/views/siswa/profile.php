<!-- views/siswa/profile.php -->
<div class="col-md-10">
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h2 class="mb-0 fw-bold">
                    <i class="fas fa-user-circle text-primary me-2" style="color:#1ABC9C;"></i> Profil Saya
                </h2>
                <p class="text-muted mt-1">Kelola data diri Anda</p>
            </div>
        </div>

        <!-- Card Profile -->
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-sm border-0 rounded-4 profile-card">
                    <div class="card-header bg-white py-3 rounded-top-4" style="border-bottom: 2px solid #1ABC9C;">
                        <h5 class="mb-0"><i class="fas fa-address-card me-2" style="color:#1ABC9C;"></i> Biodata Diri</h5>
                    </div>
                    <div class="card-body">
                        <!-- Notifikasi -->
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i> <?= $this->session->flashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php elseif($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i> <?= $this->session->flashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('index.php/siswa/update_profile') ?>" method="post">
                            <!-- Username -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control profile-input" name="username" 
                                       value="<?= htmlspecialchars($user->username) ?>" required>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control profile-input" id="nama_lengkap" name="nama_lengkap" 
                                       value="<?= htmlspecialchars($user->nama_lengkap) ?>" required>
                            </div>

                            <!-- Kelas -->
                            <div class="mb-3">
                                <label for="kelas" class="form-label fw-semibold">Kelas</label>
                                <input type="text" class="form-control profile-input" id="kelas" name="kelas" 
                                       value="<?= htmlspecialchars($user->kelas ?? '') ?>" required>
                            </div>

                            <!-- No HP -->
                            <div class="mb-3">
                                <label for="no_hp" class="form-label fw-semibold">No. HP</label>
                                <input type="text" class="form-control profile-input" id="no_hp" name="no_hp" 
                                       value="<?= htmlspecialchars($user->no_hp ?? '') ?>">
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label fw-semibold">Alamat</label>
                                <textarea class="form-control profile-input" id="alamat" name="alamat" rows="3"><?= htmlspecialchars($user->alamat ?? '') ?></textarea>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password Baru</label>
                                <input type="password" class="form-control profile-input" id="password" name="password" 
                                       placeholder="Kosongkan jika tidak ingin mengubah">
                                <small class="text-muted">Minimal 6 karakter jika diisi.</small>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?= base_url('index.php/siswa/dashboard') ?>" class="btn btn-secondary btn-back">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary btn-save">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Hover effect untuk card profile - selaras dengan dashboard */
.profile-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}
.profile-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}

/* Hover effect untuk input form - seperti di dashboard */
.profile-input {
    transition: all 0.2s ease;
    border-radius: 12px;
    border: 1px solid #e0e0e0;
}
.profile-input:focus {
    border-color: #1ABC9C;
    box-shadow: 0 0 0 0.2rem rgba(26, 188, 156, 0.25);
    outline: none;
}
.profile-input:hover {
    border-color: #1ABC9C;
    background-color: #fef9e6;
}

/* Hover effect untuk tombol Kembali */
.btn-back {
    transition: all 0.3s ease;
    background-color: #6c757d;
    border: none;
}
.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
    background-color: #5a6268;
}

/* Hover effect untuk tombol Simpan (primary) - sesuai gaya dashboard */
.btn-save {
    background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
    border: none;
    transition: all 0.3s ease;
}
.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(26, 188, 156, 0.4);
    background: linear-gradient(135deg, #16A085 0%, #1ABC9C 100%);
}

/* Efek tambahan untuk alert */
.alert {
    border-radius: 12px;
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
</style>