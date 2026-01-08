<!-- Bootstrap CDN and custom stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Tiket_konser/assets/css/style.css">
<link rel="icon" type="image/png" href="/Tiket_konser/assets/img/Logo tiket konser.png" sizes="192x192">

<header class="site-header py-3 mb-3">
  <div class="container d-flex align-items-center justify-content-between">
    <a class="brand h5 m-0 text-decoration-none" href="<?= (isset($_SESSION['user']) && ($_SESSION['user']['role'] ?? 'user') === 'admin') ? '/Tiket_konser/admin' : '/Tiket_konser/' ?>">Tiket Konser</a>
    <div class="d-flex gap-2">
      <a class="btn btn-outline-primary btn-sm" href="<?= (isset($_SESSION['user']) && ($_SESSION['user']['role'] ?? 'user') === 'admin') ? '/Tiket_konser/admin' : '/Tiket_konser/' ?>">Home</a>
      <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/logout">Logout</a>
    </div>
  </div>
</header>

<div class="container mt-4" style="max-width: 720px;">
  <h3 class="page-title">Pesan Tiket</h3>

  <?php if(isset($error)): ?>
    <div class="alert alert-danger shadow-soft rounded-12"><?= $error ?></div>
  <?php endif; ?>

  <div class="card shadow-soft mb-3">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h5 class="mb-1"><?= $konser['nama_konser'] ?></h5>
          <div class="text-muted"><?= $konser['artis'] ?> • <?= $konser['lokasi'] ?></div>
          <div class="text-muted">Tanggal: <?= $konser['tanggal'] ?></div>
        </div>
        <div class="text-end">
          <div class="badge-price mb-2">Rp <?= number_format($konser['harga']) ?></div>
          <div class="text-muted">Stok: <?= (int)$konser['stok'] ?></div>
        </div>
      </div>
    </div>
  </div>

  <form method="POST" class="card p-3 shadow-soft rounded-12">
    <label class="form-label">Jumlah Tiket</label>
    <input type="number" name="jumlah" class="form-control mb-3" min="1" max="<?= (int)$konser['stok'] ?>" value="1" required>
    <button class="btn btn-primary w-100">Pesan Sekarang</button>
  </form>
</div>
