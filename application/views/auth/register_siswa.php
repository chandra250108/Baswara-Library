<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Siswa - Baswara Library</title>
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
            max-width: 600px;
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
            padding: 30px 25px;
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
            font-size: 50px;
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
            padding: 35px;
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
        
        .form-control, .form-select {
            border-left: none;
            padding: 10px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
            border-color: #d5dbdb;
            color: #2C3E50;
        }
        
        .form-control::placeholder, .form-select::placeholder {
            color: #bdc3c7;
            opacity: 0.8;
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: none;
            border-color: #1ABC9C;
            background: white;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: #1ABC9C;
            color: #1ABC9C;
            background: white;
        }
        
        .btn-register {
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
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 188, 156, 0.4);
            background: linear-gradient(135deg, #16A085 0%, #1ABC9C 100%);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }
        
        .btn-register::before {
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
        
        .btn-register:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #d5dbdb;
        }
        
        .login-link p {
            margin-bottom: 0;
            color: #7f8c8d;
            font-size: 13px;
        }
        
        .login-link a {
            color: #1ABC9C;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .login-link a:hover {
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
        
        /* Password strength indicator */
        .password-strength {
            margin-top: 5px;
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
            color: rgba(255,255,255,0.6);
            font-size: 11px;
            position: relative;
            z-index: 10;
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
                padding: 25px 20px;
            }
        }
        
        /* Input focus animation */
        .form-control:focus, .form-select:focus {
            border-color: #1ABC9C;
            box-shadow: 0 0 0 3px rgba(26, 188, 156, 0.15);
        }
        
        /* Select custom styling */
        .form-select {
            cursor: pointer;
        }
        
        /* Textarea styling */
        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }
        
        /* Row spacing */
        .row.g-3 {
            margin-bottom: -8px;
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
        <i class="fas fa-book-open book" style="top: 10%; left: 3%; font-size: 55px; animation-duration: 15s;"></i>
        <i class="fas fa-book book" style="top: 75%; left: 90%; font-size: 45px; animation-duration: 18s; animation-delay: 2s;"></i>
        <i class="fas fa-user-graduate book" style="top: 85%; left: 5%; font-size: 50px; animation-duration: 20s; animation-delay: 4s;"></i>
        <i class="fas fa-graduation-cap book" style="top: 15%; left: 92%; font-size: 55px; animation-duration: 17s; animation-delay: 1s;"></i>
        <i class="fas fa-pencil-alt book" style="top: 45%; left: 95%; font-size: 40px; animation-duration: 22s; animation-delay: 3s;"></i>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="logo">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3>Registrasi Siswa</h3>
                        <p>Daftar untuk menjadi anggota perpustakaan</p>
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
                        
                        <?php echo validation_errors('<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>', '</div>'); ?>
                        
                        <form action="<?= base_url('index.php/auth/proses_register') ?>" method="post">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">
                                            <i class="fas fa-user me-2"></i> Username
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="username" name="username" 
                                                   placeholder="Masukkan username" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock me-2"></i> Password
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-key"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" name="password" 
                                                   placeholder="Minimal 6 karakter" required>
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="password-strength" id="passwordStrength"></div>
                                        <small class="text-muted">Password minimal 6 karakter</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">
                                    <i class="fas fa-id-card me-2"></i> Nama Lengkap
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-id-card"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                                           placeholder="Masukkan nama lengkap" required>
                                </div>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kelas" class="form-label">
                                            <i class="fas fa-graduation-cap me-2"></i> Kelas
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-graduation-cap"></i>
                                            </span>
                                            <select class="form-select" id="kelas" name="kelas" required>
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
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">
                                            <i class="fas fa-phone me-2"></i> No. HP
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                            <input type="tel" class="form-control" id="no_hp" name="no_hp" 
                                                   placeholder="Contoh: 081234567890" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="alamat" class="form-label">
                                    <i class="fas fa-map-marker-alt me-2"></i> Alamat
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <textarea class="form-control" id="alamat" name="alamat" 
                                              placeholder="Masukkan alamat lengkap" rows="2" required></textarea>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-register w-100">
                                <i class="fas fa-user-plus me-2"></i> Daftar
                            </button>
                        </form>
                        
                        <div class="login-link">
                            <p>
                                <i class="fas fa-sign-in-alt me-1"></i> 
                                Sudah punya akun? <a href="<?= base_url('index.php/auth/login') ?>">Login disini</a>
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
                
                if(strength >= 5) {
                    color = '#10b981';
                    width = '100%';
                } else if(strength >= 4) {
                    color = '#f59e0b';
                    width = '80%';
                } else if(strength >= 3) {
                    color = '#f59e0b';
                    width = '60%';
                } else if(strength >= 2) {
                    color = '#f97316';
                    width = '40%';
                } else if(strength >= 1) {
                    color = '#ef4444';
                    width = '20%';
                }
                
                strengthDiv.style.backgroundColor = color;
                strengthDiv.style.width = width;
            });
        }
        
        // Phone number formatting
        const noHpInput = document.getElementById('no_hp');
        if(noHpInput) {
            noHpInput.addEventListener('input', function(e) {
                let value = this.value.replace(/\D/g, '');
                if(value.startsWith('0')) {
                    value = value.substring(1);
                }
                if(value.length > 12) {
                    value = value.substring(0, 12);
                }
                this.value = '0' + value;
            });
        }
    </script>
</body>
</html>