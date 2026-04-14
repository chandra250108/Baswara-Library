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
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
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
        
        /* Floating Books Animation */
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
        
        .card {
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
            max-width: 460px;
            background: #ECF0F1;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: slideUp 0.6s ease;
            position: relative;
            z-index: 10;
            margin: 0 auto;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px -12px rgba(0,0,0,0.4);
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
        
        .card-header {
            background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
            color: white;
            text-align: center;
            padding: 35px 30px;
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
            font-size: 55px;
            margin-bottom: 15px;
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
            font-size: 26px;
            letter-spacing: 1px;
        }
        
        .card-header p {
            margin-top: 10px;
            opacity: 0.85;
            font-size: 13px;
        }
        
        .card-body {
            padding: 40px;
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
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
            border-color: #d5dbdb;
            color: #2C3E50;
        }
        
        .form-control::placeholder {
            color: #bdc3c7;
            opacity: 0.8;
        }
        
        .form-control:focus {
            box-shadow: none;
            border-color: #1ABC9C;
            background: white;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: #1ABC9C;
            color: #1ABC9C;
            background: white;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #1ABC9C 0%, #16A085 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            color: white;
            letter-spacing: 1px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 188, 156, 0.4);
            background: linear-gradient(135deg, #16A085 0%, #1ABC9C 100%);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn-login:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #d5dbdb;
        }
        
        .register-link p {
            margin-bottom: 0;
            color: #7f8c8d;
            font-size: 13px;
        }
        
        .register-link a {
            color: #1ABC9C;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .register-link a:hover {
            color: #16A085;
            text-decoration: underline;
        }
        
        /* Alert Styles */
        .alert {
            border-radius: 10px;
            border: none;
            padding: 12px 16px;
            margin-bottom: 20px;
            animation: shake 0.5s ease;
            font-size: 13px;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
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
        
        /* Remember me checkbox */
        .form-check {
            margin-top: 15px;
        }
        
        .form-check-label {
            color: #7f8c8d;
            font-size: 13px;
        }
        
        .form-check-input {
            background-color: white;
            border-color: #d5dbdb;
        }
        
        .form-check-input:checked {
            background-color: #1ABC9C;
            border-color: #1ABC9C;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
            color: rgba(255,255,255,0.6);
            font-size: 11px;
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 460px;
            margin-left: auto;
            margin-right: auto;
        }

        .footer p {
            margin-bottom: 0;
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .card {
                margin: 20px;
                max-width: calc(100% - 40px);
            }
            
            .card-header {
                padding: 25px 20px;
            }
            
            .logo {
                font-size: 40px;
            }
            
            .card-header h3 {
                font-size: 22px;
            }
            
            .card-body {
                padding: 30px 25px;
            }
        }
        
        /* Input focus animation */
        .form-control:focus {
            border-color: #1ABC9C;
            box-shadow: 0 0 0 3px rgba(26, 188, 156, 0.15);
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
</head>
<body>
    <!-- Floating Books Decoration -->
    <div class="floating-books">
        <i class="fas fa-book-open book" style="top: 10%; left: 5%; font-size: 60px; animation-duration: 15s;"></i>
        <i class="fas fa-book book" style="top: 70%; left: 85%; font-size: 50px; animation-duration: 18s; animation-delay: 2s;"></i>
        <i class="fas fa-book-reader book" style="top: 80%; left: 10%; font-size: 45px; animation-duration: 20s; animation-delay: 4s;"></i>
        <i class="fas fa-graduation-cap book" style="top: 15%; left: 88%; font-size: 55px; animation-duration: 17s; animation-delay: 1s;"></i>
        <i class="fas fa-pen-fancy book" style="top: 40%; left: 92%; font-size: 40px; animation-duration: 22s; animation-delay: 3s;"></i>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
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
                
                <div class="footer">
                    <p>© <?= date('Y') ?> Baswara Library | Perpustakaan Digital</p>
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
        
        // Remember Me functionality
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
        
        // Auto save username when typing if remember me is checked
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