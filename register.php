<?php
include 'config.php';
$message = "";
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password_raw = $_POST['password'];
    if (strlen($password_raw) < 5) { $message = "Password minimal 5 karakter."; }
    else {
        $password = password_hash($password_raw, PASSWORD_DEFAULT);
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
        if (mysqli_num_rows($check) > 0) { $message = "Username sudah digunakan."; }
        else { mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')"); header("Location: login.php"); exit; }
    }
}
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Register - Careon</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"><link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet"><link href="assets/careon.css" rel="stylesheet"></head>
<body><div class="auth-wrapper"><div class="auth-panel-left"><h2 class="auth-headline">"Start your journey<br><span>the smart way."</span></h2><p class="auth-subtext">Buat akun baru untuk mengerjakan asesmen Backend Developer.</p></div><div class="auth-panel-right"><div class="auth-form-container"><h1 class="auth-title">Create Account</h1><p class="auth-subtitle">Sudah punya akun? <a href="login.php">Login</a></p><?php if($message!=''): ?><div class="alert alert-danger" style="border-radius:8px;font-size:13px;"><?= $message; ?></div><?php endif; ?><form method="POST"><div class="mb-3"><label class="form-label">Username</label><div class="input-group"><span class="input-group-text"><i class="bi bi-person-fill"></i></span><input type="text" name="username" class="form-control" placeholder="Contoh: dosen123" required></div></div><div class="mb-4"><label class="form-label">Password</label><div class="input-group"><span class="input-group-text"><i class="bi bi-lock-fill"></i></span><input type="password" name="password" id="pwField" class="form-control" placeholder="Minimal 5 karakter" required><button type="button" class="input-group-text" onclick="togglePw()" style="cursor:pointer;"><i class="bi bi-eye" id="pwEye"></i></button></div></div><button type="submit" name="register" class="btn-primary-careon">Create Account <i class="bi bi-arrow-right"></i></button></form><p class="text-center mt-3"><a href="index.php" style="font-size:13px;color:var(--gray-500);">Kembali ke landing page</a></p></div></div></div><script>function togglePw(){const f=document.getElementById('pwField'),e=document.getElementById('pwEye');if(f.type==='password'){f.type='text';e.className='bi bi-eye-slash';}else{f.type='password';e.className='bi bi-eye';}}</script></body></html>
