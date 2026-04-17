<!DOCTYPE html>
<html>
<head>
    <title>Kartu Anggota Baswara Library</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: #eef2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* CARD FIX PRESISI */
    .card {
        width: 323px;
        height: 204px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #000;
        background: #ffffff;
        box-sizing: border-box; 
        line-height: 2.3;
    }

    /* TABLE */
    table {
        width: 100%;
        height: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    /* KIRI */
    .left-col {
        width: 35%;
        background: #1ABC9C; 
        color: white;
        text-align: center;
        padding: 10px 6px;
        vertical-align: middle; 
    }

    /* BRAND */
    .brand {
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 1.5px;
    }

    .brand-sub {
        font-size: 8px;
        letter-spacing: 2px;
    }

    .member-badge {
        font-size: 7px;
        margin-top: 4px;
        border-top: 1px solid rgba(255,255,255,0.4);
        display: inline-block;
        padding-top: 3px;
    }

    .avatar {
        width: 57px;
        height: 57px;
        background: white;
        border-radius: 50%;
        margin: 10px auto; 

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 26px;
        font-weight: bold;
        color: #1ABC9C;

        line-height: 1.7;
        padding-top: 3px; 
    }

    /* WEBSITE */
    .website {
        font-size: 7px;
        margin-top: 6px;
    }

    /* KANAN */
    .right-col {
        width: 65%;
        background: #ffffff;
        padding: 12px 12px 10px 12px;
        vertical-align: top;
        position: relative;
        box-sizing: border-box;
    }

    /* TITLE */
    .title {
        font-size: 12px;
        font-weight: bold;
        color: #2C3E50;
        margin-bottom: 10px;
        padding-left: 8px;
        border-left: 4px solid #1ABC9C;
    }

    /* NAMA */
    .nama {
        font-size: 11px;
        font-weight: bold;
        color: #1ABC9C;
        margin-bottom: 8px;
    }

    .info-row {
        font-size: 10px;
        margin-bottom: 3px;
        display: flex;
        flex-direction: row;
        align-items: center;
        line-height: 1.4;
    }

    .label {
        display: inline-block;
        width: 65px;
        color: #7f8c8d;
        flex-shrink: 0;
    }

    .value {
        color: #2C3E50;
        flex: 1;
        word-break: break-word;
    }

    /* FOOTER FIX PALING BAWAH */
    .footer-note {
        position: absolute;
        bottom: 1.5px;
        left: 12px;
        right: 12px;
        text-align: center;
        font-size: 8px;
        color: 1px solid #95a5a6;
        border-top: 1.5px solid #ecf0f1;
        padding-top: 4px;
    }
    </style>
</head>
<body>
    <div class="card">
        <table>
            <tr>
                <!-- Kolom kiri -->
                <td class="left-col">
                    <div class="brand">BASWARA</div>
                    <div class="brand-sub">LIBRARY</div>
                    <div class="member-badge">MEMBER CARD</div>

                    <div class="avatar">
                        <?= strtoupper(substr($anggota->nama_lengkap, 0, 1)) ?>
                    </div>

                    <div class="website">www.baswara-library.id</div>
                </td>

                <!-- Kolom kanan -->
                <td class="right-col">
                    <div class="title">IDENTITAS ANGGOTA</div>

                    <div class="nama"><?= htmlspecialchars($anggota->nama_lengkap) ?></div>

                     <div class="info-row">
                            <span class="label">Username</span>
                            <span class="value">: <?= htmlspecialchars($anggota->username) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label">Kelas</span>
                            <span class="value">: <?= htmlspecialchars($anggota->kelas ?? '-') ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label">No. HP</span>
                            <span class="value">: <?= htmlspecialchars($anggota->no_hp ?? '-') ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label">Alamat</span>
                            <span class="value">: <?= htmlspecialchars(substr($anggota->alamat ?? '', 0, 35)) ?></span>
                        </div>

                    <div class="footer-note">
                        Berlaku selama menjadi siswa aktif
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>