<!-- Bootstrap CDN and custom stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Tiket_konser/assets/css/style.css">
<link rel="icon" type="image/png" sizes="32x32" href="/Tiket_konser/assets/img/Logo tiket konser.png">
<link rel="icon" type="image/png" sizes="64x64" href="/Tiket_konser/assets/img/Logo tiket konser.png">
<link rel="apple-touch-icon" href="/Tiket_konser/assets/img/Logo tiket konser.png">

<header class="site-header py-3 mb-3">
  <div class="container d-flex align-items-center justify-content-between">
    <a class="brand h5 m-0 text-decoration-none" href="/Tiket_konser/">
      <img src="/Tiket_konser/assets/img/Logo tiket konser.png" alt="Logo" class="brand-logo">
      <span>Tiket Konser</span>
    </a>
    <div class="d-flex align-items-center gap-3">
      <a class="btn btn-outline-primary btn-sm" href="<?= (isset($_SESSION['user']) && ($_SESSION['user']['role'] ?? 'user') === 'admin') ? '/Tiket_konser/admin' : '/Tiket_konser/' ?>">Home</a>
      <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/logout">Logout</a>
    </div>
  </div>
</header>

<div class="container" style="max-width: 760px;">
  <h3 class="page-title">Profil</h3>

  <?php if(isset($error)): ?>
    <div class="alert alert-danger shadow-soft rounded-12"><?= $error ?></div>
  <?php endif; ?>

  <div class="card shadow-soft mb-3">
    <div class="card-body d-flex align-items-center gap-3">
      <img src="<?= $user['foto'] ?? 'https://ui-avatars.com/api/?background=4a6bff&color=fff&name=' . urlencode($user['nama'] ?? 'U') ?>" alt="avatar" class="avatar-lg rounded-circle">
      <div>
        <div class="fw-bold fs-5"><?= htmlspecialchars($user['nama'] ?? '') ?></div>
        <div class="text-muted"><?= htmlspecialchars($user['email'] ?? '') ?></div>
        <div class="badge bg-light text-dark border mt-1">Role: <strong><?= htmlspecialchars($user['role'] ?? 'user') ?></strong></div>
      </div>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-12 col-md-6">
      <div class="card p-3 shadow-soft h-100">
        <h6 class="mb-2">Ganti Nama</h6>
        <form method="POST" action="/Tiket_konser/profile/update-name">
          <input type="text" name="nama" value="<?= htmlspecialchars($user['nama'] ?? '') ?>" class="form-control mb-3" placeholder="Nama lengkap" required>
          <button class="btn btn-primary">Simpan Nama</button>
        </form>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="card p-3 shadow-soft h-100">
        <h6 class="mb-2">Ganti Foto Profil</h6>
        <form method="POST" action="/Tiket_konser/profile/update-photo" enctype="multipart/form-data">
          <input type="file" name="foto" accept="image/png,image/jpeg,image/webp" class="form-control mb-3" required>
          <button class="btn btn-primary">Simpan Foto</button>
        </form>
      </div>
    </div>
  </div>
</div>
