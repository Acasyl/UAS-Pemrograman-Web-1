<!-- Bootstrap CDN and custom stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Tiket_konser/assets/css/style.css">

<div class="auth-wrap">
<div class="container col-md-4">
<h4 class="text-center mb-3 h-title">Login Aplikasi Tiket Konser</h4>

<?php if(isset($error)): ?>
<div class="alert alert-danger shadow-soft rounded-12"><?= $error ?></div>
<?php endif; ?>

<form method="POST" class="card p-3 shadow-soft rounded-12">
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
    <button class="btn btn-primary w-100">Login</button>
</form>

<p class="text-center mt-2 text-muted">
    Belum punya akun? <a href="/Tiket_konser/register">Daftar</a>
</p>
</div>
</div>
