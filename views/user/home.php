<!-- Bootstrap CDN and custom stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Tiket_konser/assets/css/style.css">
<link rel="icon" type="image/png" href="/Tiket_konser/assets/img/Logo tiket konser.png">

<header class="site-header py-3 mb-3">
  <div class="container d-flex align-items-center justify-content-between">
    <a class="brand h5 m-0 text-decoration-none" href="/Tiket_konser/">
      <img src="/Tiket_konser/assets/img/Logo tiket konser.png" alt="Logo" class="brand-logo">
      <span>Tiket Konser Moonstage</span>
    </a>
    <div class="d-flex align-items-center gap-2">
      <?php if(isset($_SESSION['user'])): ?>
        <?php if(($_SESSION['user']['role'] ?? 'user') === 'user'): ?>
          <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/pesanan-saya">Pesanan Saya</a>
        <?php endif; ?>
        <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/profile">Profil</a>
        <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/logout">Logout</a>
      <?php else: ?>
        <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/login">Login</a>
        <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/register">Register</a>
      <?php endif; ?>
    </div>
  </div>
</header>

<div class="container mt-4">
  <h4 class="page-title mb-3">Daftar Konser</h4>

  <?php if (empty($konser)): ?>
    <div class="alert alert-info shadow-soft rounded-12">Belum ada konser tersedia.</div>
  <?php else: ?>
    <div class="row g-3">
      <?php foreach ($konser as $k): ?>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card h-100 shadow-soft rounded-12">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title mb-1"><?php echo htmlspecialchars($k['nama_konser']); ?></h5>
              <div class="text-muted mb-1"><?php echo htmlspecialchars($k['artis']); ?> • <?php echo htmlspecialchars($k['lokasi']); ?></div>
              <div class="text-muted mb-2">Tanggal: <?php echo htmlspecialchars($k['tanggal']); ?></div>
              <div class="mt-auto d-flex justify-content-between align-items-center">
                <div class="badge-price">Rp <?php echo number_format((float)$k['harga']); ?></div>
                <div class="text-muted small">Stok: <?php echo (int)$k['stok']; ?></div>
              </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
              <a class="btn btn-primary w-100 <?php echo ((int)$k['stok'] <= 0) ? 'disabled' : ''; ?>" href="/Tiket_konser/pesan/<?php echo (int)$k['id']; ?>">
                <?php echo ((int)$k['stok'] <= 0) ? 'Habis' : 'Pesan'; ?>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
