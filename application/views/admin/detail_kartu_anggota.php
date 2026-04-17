<div class="col-md-10">
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h2 class="fw-bold" style="color: #2C3E50;">
                    <i class="fas fa-id-card" style="color: #1ABC9C;"></i> Kartu Anggota
                </h2>
                <p class="text-muted mt-1">Preview dan cetak kartu tanda anggota</p>
            </div>
            <div>
                <a href="<?= base_url('index.php/admin/anggota') ?>" class="btn btn-secondary rounded-pill px-4 me-2">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
                <a href="<?= base_url('index.php/admin/cetak_kartu_anggota/'.$anggota->id) ?>" class="btn btn-success rounded-pill px-4" target="_blank">
                    <i class="fas fa-print me-2"></i> Cetak PDF
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-lg rounded-4 p-4" style="background: #f0f2f5;">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="member-card" style="width: 85.6mm; height: 54mm; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.2); display: flex; font-family: 'Segoe UI', Roboto, Arial, sans-serif; position: relative;">
                        <!-- Sisi Kiri -->
                        <div style="width: 35%; background: linear-gradient(145deg, #1e2a3a 0%, #1ABC9C 100%); color: white; padding: 12px 8px; text-align: center; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div style="font-size: 14px; font-weight: 800; letter-spacing: 1.5px;">BASWARA</div>
                                <div style="font-size: 8px; opacity: 0.8; letter-spacing: 2px;">LIBRARY</div>
                                <div style="font-size: 7px; margin-top: 4px; border-top: 1px solid rgba(255,255,255,0.3); display: inline-block; padding-top: 4px;">MEMBER CARD</div>
                            </div>
                            <div style="margin: 12px 0;">
                                <div style="width: 55px; height: 55px; background: white; border-radius: 50%; margin: 0 auto; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                                    <span style="color: #1ABC9C; font-size: 32px; font-weight: bold;"><?= strtoupper(substr($anggota->nama_lengkap, 0, 1)) ?></span>
                                </div>
                            </div>
                            <div style="font-size: 6px; opacity: 0.6;">www.baswara-library.id</div>
                        </div>

                        <!-- Sisi Kanan -->
                        <div style="width: 65%; padding: 10px 12px; background: white; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div style="border-left: 4px solid #1ABC9C; padding-left: 8px; margin-bottom: 10px;">
                                    <div style="font-size: 12px; font-weight: 700; color: #2C3E50;">IDENTITAS ANGGOTA</div>
                                </div>
                                <div style="font-size: 11px; line-height: 1.45;">
                                    <div style="margin-bottom: 6px;">
                                        <div style="font-weight: 800; color: #1ABC9C;"><?= htmlspecialchars($anggota->nama_lengkap) ?></div>
                                    </div>
                                    <div style="display: flex; margin-bottom: 4px;">
                                        <div style="width: 70px; color: #7f8c8d;">Username</div>
                                        <div>: <?= htmlspecialchars($anggota->username) ?></div>
                                    </div>
                                    <div style="display: flex; margin-bottom: 4px;">
                                        <div style="width: 70px; color: #7f8c8d;">Kelas</div>
                                        <div>: <?= htmlspecialchars($anggota->kelas ?? '-') ?></div>
                                    </div>
                                    <div style="display: flex; margin-bottom: 4px;">
                                        <div style="width: 70px; color: #7f8c8d;">No. HP</div>
                                        <div>: <?= htmlspecialchars($anggota->no_hp ?? '-') ?></div>
                                    </div>
                                    <div style="display: flex; margin-bottom: 4px;">
                                        <div style="width: 70px; color: #7f8c8d;">Alamat</div>
                                        <div style="flex:1;">: <?= htmlspecialchars(substr($anggota->alamat ?? '', 0, 35)) ?></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Footer note di paling bawah sisi kanan -->
                            <div style="text-align: center; font-size: 6px; color: #95a5a6; border-top: 1px solid #ecf0f1; padding-top: 5px; margin-top: 8px;">
                                Berlaku selama menjadi siswa aktif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 text-muted small">
                <i class="fas fa-info-circle"></i> Preview kartu ukuran standar (85.6 x 54 mm). Klik "Cetak PDF" untuk menyimpan/mencetak.
            </div>
        </div>
    </div>
</div>

<style>
    .member-card {
        transition: transform 0.2s ease;
    }
    .member-card:hover {
        transform: scale(1.02);
    }
    @media (max-width: 768px) {
        .member-card {
            transform: scale(0.9);
            margin: -10px;
        }
    }
</style>