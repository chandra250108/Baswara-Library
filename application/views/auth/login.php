<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Baswara Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
            padding: 40px 0;
        }
        
        /* Background Pattern Overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.03)" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
            opacity: 0.3;
            pointer-events: none;
        }
        
        /* Floating Books Decoration */
        .floating-books {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .book {
            position: absolute;
            opacity: 0.06;
            animation: float 20s infinite ease-in-out;
            color: #1ABC9C;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        .main-container {
            position: relative;
            z-index: 10;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Katalog Buku (kiri) */
        .books-section {
            background: rgba(236, 240, 241, 0.95);
            border-radius: 20px;
            padding: 20px;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            animation: slideUp 0.6s ease;
        }
        
        .books-section h4 {
            color: #2C3E50;
            font-weight: 700;
            margin-bottom: 20px;
            border-left: 4px solid #1ABC9C;
            padding-left: 15px;
        }
        
        .book-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .book-item {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            text-align: center;
            padding: 12px;
        }
        
        .book-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        /* Cover tidak terpotong */
        .book-cover {
            width: 100%;
            height: 180px;
            object-fit: contain;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
            padding: 5px;
        }
        
        .book-cover-placeholder {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #d5dbdb, #bdc3c7);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            color: white;
            font-size: 48px;
        }
        
        .book-title {
            font-weight: 600;
            font-size: 14px;
            color: #2C3E50;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .book-author {
            font-size: 12px;
            color: #7f8c8d;
        }
        
        .book-stock {
            font-size: 11px;
            background: #e8f8f5;
            color: #1ABC9C;
            display: inline-block;
            padding: 2px 10px;
            border-radius: 20px;
            margin-top: 6px;
        }
        
        /* Login Card (kanan) */
        .login-card {
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.3);
            overflow: hidden;
            background: #ECF0F1;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: slideUp 0.6s ease;
            height: 100%;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px -12px rgba(0,0,0,0.4);
        }
        
        .card-header {
            background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
            color: white;
            text-align: center;
            padding: 25px 20px;
            position: relative;
            overflow: hidden;
        }
        
        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(26, 188, 156, 0.1) 0%, transparent 70%);
            animation: shine 12s infinite;
        }
        
        @keyframes shine {
            0% { transform: translate(-30%, -30%) rotate(0deg); }
            100% { transform: translate(30%, 30%) rotate(360deg); }
        }
        
        .logo {
            font-size: 48px;
            margin-bottom: 10px;
            color: #1ABC9C;
            animation: gentleBounce 3s infinite ease-in-out;
        }
        
        @keyframes gentleBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }
        
        .card-header h3 {
            margin: 0;
            font-weight: 700;
            font-size: 24px;
            letter-spacing: 1px;
        }
        
        .card-header p {
            margin-top: 8px;
            opacity: 0.85;
            font-size: 12px;
        }
        
        .card-body {
            padding: 30px;
            background: #ECF0F1;
        }
        
        .form-label {
            font-weight: 600;
            color: #2C3E50;
            margin-bottom: 8px;
            font-size: 13px;
        }
        
        .input-group-text {
            background: white;
            border-right: none;
            color: #7f8c8d;
            border-color: #d5dbdb;
        }
        
        .form-control {
            border-left: none;
            padding: 10px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
            border-color: #d5dbdb;
            color: #2C3E50;
        }
        
        .form-control:focus {
            border-color: #1ABC9C;
            box-shadow: 0 0 0 3px rgba(26, 188, 156, 0.15);
        }
        
        .input-group:focus-within .input-group-text {
            border-color: #1ABC9C;
            color: #1ABC9C;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
            border: none;
            padding: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            color: white;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 188, 156, 0.4);
        }
        
        .register-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #d5dbdb;
            font-size: 13px;
        }
        
        .register-link a {
            color: #1ABC9C;
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 10px;
            padding: 10px 15px;
            margin-bottom: 20px;
            font-size: 13px;
        }
        
        .alert-danger {
            background: #fdeded;
            color: #e74c3c;
            border-left: 4px solid #e74c3c;
        }
        
        .alert-success {
            background: #e8f8f5;
            color: #1ABC9C;
            border-left: 4px solid #1ABC9C;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .book-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
            .book-cover, .book-cover-placeholder {
                height: 140px;
            }
            .card-body {
                padding: 25px;
            }
        }
        
        @media (max-width: 576px) {
            .book-grid {
                grid-template-columns: 1fr;
            }
            .books-section {
                margin-bottom: 20px;
            }
        }
        
        .btn-outline-secondary {
            border-color: #d5dbdb;
            color: #7f8c8d;
        }
        
        .btn-outline-secondary:hover {
            background: #1ABC9C;
            border-color: #1ABC9C;
            color: white;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="floating-books">
        <i class="fas fa-book-open book" style="top: 10%; left: 5%; font-size: 60px; animation-duration: 15s;"></i>
        <i class="fas fa-book book" style="top: 70%; left: 85%; font-size: 50px; animation-duration: 18s; animation-delay: 2s;"></i>
        <i class="fas fa-book-reader book" style="top: 80%; left: 10%; font-size: 45px; animation-duration: 20s; animation-delay: 4s;"></i>
        <i class="fas fa-graduation-cap book" style="top: 15%; left: 88%; font-size: 55px; animation-duration: 17s; animation-delay: 1s;"></i>
        <i class="fas fa-pen-fancy book" style="top: 40%; left: 92%; font-size: 40px; animation-duration: 22s; animation-delay: 3s;"></i>
    </div>
    
    <div class="main-container">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-7">
                <div class="books-section">
                    <h4><i class="fas fa-book-open me-2" style="color:#1ABC9C;"></i> Koleksi Buku Terbaru</h4>
                    <div class="book-grid">
                        <?php 
                        // Tampilkan maksimal 4 buku
                        $buku_display = isset($buku) ? array_slice($buku, 0, 4) : [];
                        if(!empty($buku_display)): 
                            foreach($buku_display as $bk): 
                        ?>
                            <div class="book-item">
                                <?php if(!empty($bk->cover) && file_exists('uploads/'.$bk->cover)): ?>
                                    <img src="<?= base_url('uploads/'.$bk->cover) ?>" class="book-cover" alt="<?= htmlspecialchars($bk->judul) ?>">
                                <?php else: ?>
                                    <div class="book-cover-placeholder">
                                        <i class="fas fa-book"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="book-title"><?= htmlspecialchars($bk->judul) ?></div>
                                <div class="book-author"><?= htmlspecialchars($bk->penulis) ?></div>
                                <div class="book-stock">
                                    <i class="fas fa-copy me-1"></i> Stok: <?= $bk->stok ?>
                                </div>
                            </div>
                        <?php 
                            endforeach; 
                        else: 
                        ?>
                            <div class="text-center text-muted py-4 col-12">
                                <i class="fas fa-inbox fa-3x mb-2"></i>
                                <p>Belum ada buku tersedia</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Kolom Kanan: Form Login -->
            <div class="col-lg-5">
                <div class="login-card">
                    <div class="card-header">
                        <div class="logo">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3>Baswara Library</h3>
                        <p>Temukan & Pinjam Buku Favoritmu</p>
                    </div>
                    <div class="card-body">
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i> <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i> <?= $this->session->flashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('index.php/auth/proses_login') ?>" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">
                                    <i class="fas fa-user me-2"></i> Username
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           placeholder="Masukkan username" required autofocus>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i> Password
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="Masukkan password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    <i class="fas fa-check-circle me-1"></i> Ingat saya
                                </label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-login w-100">
                                <i class="fas fa-sign-in-alt me-2"></i> Masuk
                            </button>
                        </form>
                        
                        <div class="register-link">
                            <p>
                                <i class="fas fa-user-plus me-1"></i> 
                                Belum punya akun? <a href="<?= base_url('index.php/auth/register_siswa') ?>">Daftar sebagai Siswa</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer text-center mt-4">
            <p style="color: rgba(255,255,255,0.6); font-size: 11px;">© <?= date('Y') ?> Baswara Library | Perpustakaan Digital</p>
        </div>
    </div>
    
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        if(togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
        }
        
        const rememberMe = document.querySelector('#rememberMe');
        const usernameInput = document.querySelector('#username');
        if(localStorage.getItem('rememberedUsername')) {
            usernameInput.value = localStorage.getItem('rememberedUsername');
            if(rememberMe) rememberMe.checked = true;
        }
        if(rememberMe) {
            rememberMe.addEventListener('change', function() {
                if(this.checked) {
                    localStorage.setItem('rememberedUsername', usernameInput.value);
                } else {
                    localStorage.removeItem('rememberedUsername');
                }
            });
        }
        if(usernameInput && rememberMe) {
            usernameInput.addEventListener('input', function() {
                if(rememberMe.checked) {
                    localStorage.setItem('rememberedUsername', this.value);
                }
            });
        }
    </script>
</body>
</html>