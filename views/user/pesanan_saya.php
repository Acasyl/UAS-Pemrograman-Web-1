<!-- Bootstrap CDN and custom stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Tiket_konser/assets/css/style.css">
<link rel="icon" type="image/png" sizes="32x32" href="/Tiket_konser/assets/img/Logo tiket konser.png">
<link rel="icon" type="image/png" sizes="64x64" href="/Tiket_konser/assets/img/Logo tiket konser.png">
<link rel="apple-touch-icon" href="/Tiket_konser/assets/img/Logo tiket konser.png">

<header class="site-header py-3 mb-3">
  <div class="container d-flex align-items-center justify-content-between">
    <a class="brand h5 m-0 text-decoration-none" href="<?= (isset($_SESSION['user']) && ($_SESSION['user']['role'] ?? 'user') === 'admin') ? '/Tiket_konser/admin' : '/Tiket_konser/' ?>">
      <img src="/Tiket_konser/assets/img/Logo tiket konser.png" alt="Logo" class="brand-logo">
      <span>Tiket Konser</span>
    </a>
    <div class="d-flex align-items-center gap-2">
      <?php if(isset($_SESSION['user'])): ?>
        <?php if(($_SESSION['user']['role'] ?? 'user') === 'user'): ?>
          <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/">Home</a>
          <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/pesanan-saya">Pesanan Saya</a>
        <?php endif; ?>
        <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/profile">Profil</a>
        <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/logout">Logout</a>
      <?php else: ?>
        <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/login">Login</a>
      <?php endif; ?>
    </div>
  </div>
</header>

<div class="container mt-4" style="max-width: 900px;">
  <h4 class="page-title mb-3">Pesanan Saya</h4>

  <?php if (empty($orders)): ?>
    <div class="alert alert-info shadow-soft rounded-12">Anda belum memiliki pesanan.</div>
  <?php else: ?>
    <div class="card shadow-soft rounded-12">
      <div class="card-body p-0">
        <table class="table table-striped m-0 align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>Konser</th>
              <th>Lokasi</th>
              <th>Jumlah</th>
              <th>Total</th>
              <th>Status</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $row): ?>
              <tr>
                <td><?= (int)$row['id'] ?></td>
                <td><?= htmlspecialchars($row['nama_konser']) ?></td>
                <td><?= htmlspecialchars($row['lokasi']) ?></td>
                <td><?= (int)$row['jumlah'] ?></td>
                <td>Rp <?= number_format((float)$row['total']) ?></td>
                <td>
                  <?php
                    $status = $row['status'] ?? 'pending';
                    $badge = 'secondary';
                    if ($status === 'completed') $badge = 'success';
                    elseif ($status === 'cancelled') $badge = 'danger';
                    elseif ($status === 'pending') $badge = 'warning';
                  ?>
                  <span class="badge text-bg-<?= $badge ?>"><?= htmlspecialchars($status) ?></span>
                </td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php endif; ?>
</div>
