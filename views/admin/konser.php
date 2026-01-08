<!-- Bootstrap CDN and custom stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Tiket_konser/assets/css/style.css">
<link rel="icon" type="image/png" href="/Tiket_konser/assets/img/Logo tiket konser.png">

<header class="site-header py-3 mb-3">
  <div class="container d-flex align-items-center justify-content-between">
    <a class="brand h5 m-0 text-decoration-none" href="/Tiket_konser/admin">
      <img src="/Tiket_konser/assets/img/Logo tiket konser.png" alt="Logo" class="brand-logo">
      <span>Tiket Konser Moonstage</span>
    </a>
    <div class="d-flex align-items-center gap-2">
      <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/profile">Profil</a>
      <a class="btn btn-outline-primary btn-sm" href="/Tiket_konser/logout">Logout</a>
    </div>
  </div>
  </header>

<div class="container mt-4">
<h4 class="page-title">Dashboard Admin</h4>

<!-- Stats cards -->
<div class="row g-3 mb-4">
  <div class="col-12 col-sm-6 col-lg-3">
    <div class="card shadow-soft rounded-12 h-100">
      <div class="card-body">
        <div class="text-muted small">Total Pengguna</div>
        <div class="fs-4 fw-bold"><?= (int)($totalUsers ?? 0) ?></div>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-lg-3">
    <div class="card shadow-soft rounded-12 h-100">
      <div class="card-body">
        <div class="text-muted small">Total Konser</div>
        <div class="fs-4 fw-bold"><?= (int)($totalKonser ?? 0) ?></div>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-lg-3">
    <div class="card shadow-soft rounded-12 h-100">
      <div class="card-body">
        <div class="text-muted small">Total Pesanan</div>
        <div class="fs-4 fw-bold"><?= (int)($totalPesanan ?? 0) ?></div>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-lg-3">
    <div class="card shadow-soft rounded-12 h-100">
      <div class="card-body">
        <div class="text-muted small">Total Pendapatan</div>
        <div class="fs-4 fw-bold">Rp <?= number_format((float)($totalRevenue ?? 0)) ?></div>
      </div>
    </div>
  </div>
</div>

<!-- Recent orders -->
<div class="card shadow-soft rounded-12 mb-4">
  <div class="card-header bg-transparent border-0">
    <h5 class="m-0">Pesanan Terbaru</h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-dark table-striped table-hover align-middle m-0">
      <tr>
        <th>#</th>
        <th>Pengguna</th>
        <th>Konser</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
      <?php if (!empty($recentOrders)): ?>
        <?php foreach ($recentOrders as $row): ?>
          <tr>
            <td><?= (int)$row['id'] ?></td>
            <td><?= htmlspecialchars($row['user_nama']) ?></td>
            <td><?= htmlspecialchars($row['nama_konser']) ?></td>
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
            <td class="text-nowrap">
              <a href="/Tiket_konser/admin?order_id=<?= (int)$row['id'] ?>&set_status=pending" class="btn btn-sm btn-outline-warning">Pending</a>
              <a href="/Tiket_konser/admin?order_id=<?= (int)$row['id'] ?>&set_status=completed" class="btn btn-sm btn-outline-success">Selesai</a>
              <a href="/Tiket_konser/admin?order_id=<?= (int)$row['id'] ?>&set_status=cancelled" class="btn btn-sm btn-outline-danger">Batal</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="8" class="text-center text-muted">Belum ada pesanan</td></tr>
      <?php endif; ?>
    </table>
  </div>
</div>

<h4 class="page-title">Kelola Data Konser</h4>

<form method="POST" class="row g-2 mb-4 card p-3 shadow-soft rounded-12">
    <div class="col"><input name="nama_konser" class="form-control" placeholder="Nama Konser"></div>
    <div class="col"><input name="artis" class="form-control" placeholder="Artis"></div>
    <div class="col"><input type="date" name="tanggal" class="form-control"></div>
    <div class="col"><input name="lokasi" class="form-control" placeholder="Lokasi"></div>
    <div class="col"><input name="harga" class="form-control" placeholder="Harga"></div>
    <div class="col"><input name="stok" class="form-control" placeholder="Stok"></div>
    <div class="col"><button name="tambah" class="btn btn-success">Tambah</button></div>
</form>

<table class="table table-dark table-striped table-hover align-middle rounded-12 overflow-hidden">
<tr>
<th>Nama</th><th>Artis</th><th>Tanggal</th><th>Harga</th><th>Stok</th><th>Aksi</th>
</tr>
<?php foreach($konser as $k): ?>
<tr>
<td><?= $k['nama_konser'] ?></td>
<td><?= $k['artis'] ?></td>
<td><?= $k['tanggal'] ?></td>
<td><?= $k['harga'] ?></td>
<td><?= $k['stok'] ?></td>
<td>
    <a href="?hapus=<?= $k['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
</td>
</tr>
<?php endforeach ?>
</table>

<a href="/Tiket_konser/admin" class="btn btn-secondary">Kembali</a>
</div>
